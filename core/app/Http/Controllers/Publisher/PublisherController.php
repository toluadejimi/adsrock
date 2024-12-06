<?php

namespace App\Http\Controllers\Publisher;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\PublisherAd;
use App\Models\EarningLog;
use App\Lib\GoogleAuthenticator;
use App\Models\DeviceToken;
use App\Models\Form;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PublisherController extends Controller
{
    public function home()
    {
        $pageTitle                  = 'Publisher Dashboard';
        $publisher                  = auth()->guard('publisher')->user();
        $report['trx_months']       = collect([]);
        $report['trx_month_amount'] = collect([]);
        $withdrawData['date']       = collect([]);
        $withdrawData['amount']     = collect([]);

        $transaction = EarningLog::whereYear('created_at', '>=', Carbon::now()->subYear())
            ->wherePublisherId($publisher->id)
            ->selectRaw("SUM(amount) as amount, DATE_FORMAT(created_at,'%M') as months")
            ->orderBy('created_at')
            ->groupBy('months')
            ->get();

        $withdraw = Withdrawal::whereYear('created_at', '>=', Carbon::now()->subYear())->where('status', Status::WITHDRAW_SUCCESS)
            ->wherePublisherId($publisher->id)
            ->selectRaw("SUM(amount) as amount, DATE_FORMAT(created_at,'%M') as months")
            ->orderBy('created_at')
            ->groupBy('months')
            ->get();

        $withdraw->map(function ($item) use ($withdrawData) {
            $withdrawData['date']->push($item->months);
            $withdrawData['amount']->push($item->amount);
        });

        $transaction->map(function ($aaa) use ($report) {
            $report['trx_months']->push($aaa->months);
            $report['trx_month_amount']->push(getAmount($aaa->amount));
        });

        $perDay = EarningLog::wherePublisherId($publisher->id)->where('date', Carbon::now()->toDateString())->first();

        $totalWithdraw = Withdrawal::wherePublisherId($publisher->id)->where('status', Status::WITHDRAW_SUCCESS)->sum('amount');
        $publisherAd   = PublisherAd::wherePublisherId($publisher->id)->get();
        $todayReport   = $publisherAd->where('date', Carbon::now()->toDateString());
        $kyc           = getContent('kyc.content', true);
        return view('Template::publisher.dashboard', compact('pageTitle', 'todayReport', 'publisherAd', 'publisher', 'totalWithdraw', 'report', 'withdrawData', 'perDay', 'kyc'));
    }


    public function perDay()
    {
        $pageTitle = "Day to Day Earnings";
        $logs      = EarningLog::where('publisher_id', auth()->guard('publisher')->id())->dateFilter('date')->with('advertise')->latest()->paginate(getPaginate());
        return view('Template::publisher.reports.day_today', compact('pageTitle', 'logs'));
    }

    public function show2faForm()
    {
        $ga        = new GoogleAuthenticator();
        $publisher = auth()->guard('publisher')->user();
        $secret    = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($publisher->username . '@' . gs('site_name'), $secret);
        $pageTitle = '2FA Setting';
        return view('Template::publisher.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request)
    {
        $user = auth()->guard('publisher')->user();
        $request->validate([
            'key'  => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user, $request->code, $request->key);
        if ($response) {
            $user->tsc = $request->key;
            $user->ts  = 1;
            $user->save();
            $notify[] = ['success', 'Google authenticator activated successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }

    public function disable2fa(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);
        $user     = auth()->guard('publisher')->user();
        $response = verifyG2fa($user, $request->code);
        if ($response) {
            $user->tsc = null;
            $user->ts  = 0;
            $user->save();
            $notify[] = ['success', 'Two factor authenticator deactivated successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }

    public function adReport()
    {
        $pageTitle = 'Per Day Advertise Report';
        $reports   = PublisherAd::where('publisher_id', auth()->guard('publisher')->id())->with('advertise')->searchable(['advertise:ad_title'])->dateFilter('date')->latest()->paginate(getPaginate());
        return view('Template::publisher.reports.ads_report', compact('pageTitle', 'reports'));
    }

    public function publisherData()
    {
        $user = auth()->guard('publisher')->user();
        if ($user->profile_complete == Status::YES) {
            return to_route('publisher.dashboard');
        }

        $pageTitle  = 'Publisher Data';
        $info       = json_decode(json_encode(getIpInfo()), true);
        $mobileCode = @implode(',', $info['code']);
        $countries  = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        return view('Template::publisher.publisher_data', compact('pageTitle', 'user', 'countries', 'mobileCode'));
    }


    public function publisherDataSubmit(Request $request)
    {

        $user = auth()->guard('publisher')->user();

        if ($user->profile_complete == Status::YES) {
            return to_route('publisher.dashboard');
        }

        $countryData  = (array)json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryCodes = implode(',', array_keys($countryData));
        $mobileCodes  = implode(',', array_column($countryData, 'dial_code'));
        $countries    = implode(',', array_column($countryData, 'country'));

        $request->validate([
            'country_code' => 'required|in:' . $countryCodes,
            'country'      => 'required|in:' . $countries,
            'mobile_code'  => 'required|in:' . $mobileCodes,
            'username'     => 'required|unique:publishers|min:6',
            'mobile'       => ['required', 'regex:/^([0-9]*)$/', Rule::unique('publishers')->where('dial_code', $request->mobile_code)],
        ]);


        if (preg_match("/[^a-z0-9_]/", trim($request->username))) {
            $notify[] = ['info', 'Username can contain only small letters, numbers and underscore.'];
            $notify[] = ['error', 'No special character, space or capital letters in username.'];
            return back()->withNotify($notify)->withInput($request->all());
        }

        $user->country_code = $request->country_code;
        $user->mobile       = $request->mobile;
        $user->username     = $request->username;

        $user->address      = $request->address;
        $user->city         = $request->city;
        $user->state        = $request->state;
        $user->zip          = $request->zip;
        $user->country_name = @$request->country;
        $user->dial_code    = $request->mobile_code;

        $user->profile_complete = Status::YES;
        $user->save();

        return to_route('publisher.dashboard');
    }

    public function addDeviceToken(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()->all()];
        }

        $deviceToken = DeviceToken::where('advertiser_id', auth()->guard('publisher')->id())->where('token', $request->token)->first();

        if ($deviceToken) {
            return ['success' => true, 'message' => 'Already exists'];
        }

        $deviceToken               = new DeviceToken();
        $deviceToken->publisher_id = auth()->guard('publisher')->user()->id;
        $deviceToken->token        = $request->token;
        $deviceToken->is_app       = Status::NO;
        $deviceToken->save();

        return ['success' => true, 'message' => 'Token saved successfully'];
    }


    public function kycForm()
    {
        $user = auth()->guard('publisher')->user();
        if (auth()->guard('publisher')->user()->kv == Status::KYC_PENDING) {
            $notify[] = ['error', 'Your KYC is under review'];
            return to_route('publisher.dashboard')->withNotify($notify);
        }
        if (auth()->guard('publisher')->user()->kv == Status::KYC_VERIFIED) {
            $notify[] = ['error', 'You are already KYC verified'];
            return to_route('publisher.dashboard')->withNotify($notify);
        }
        $pageTitle = 'KYC Form';
        $form      = Form::where('act', 'kyc')->first();
        return view('Template::publisher.kyc.form', compact('pageTitle', 'form', 'user'));
    }

    public function kycData()
    {
        $user      = auth()->guard('publisher')->user();
        $pageTitle = 'KYC Data';
        abort_if($user->kv == Status::VERIFIED, 403);
        return view('Template::publisher.kyc.info', compact('pageTitle', 'user'));
    }

    public function kycSubmit(Request $request)
    {
        $form           = Form::where('act', 'kyc')->firstOrFail();
        $formData       = $form->form_data;
        $formProcessor  = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $user = auth()->guard('publisher')->user();
        foreach (@$user->kyc_data ?? [] as $kycData) {
            if ($kycData->type == 'file') {
                fileManager()->removeFile(getFilePath('verify') . '/' . $kycData->value);
            }
        }
        $userData                   = $formProcessor->processFormData($request, $formData);
        $user->kyc_data             = $userData;
        $user->kyc_rejection_reason = null;
        $user->kv                   = Status::KYC_PENDING;
        $user->save();

        $notify[] = ['success', 'KYC data submitted successfully'];
        return to_route('publisher.dashboard')->withNotify($notify);
    }

    public function downloadAttachment($fileHash)
    {
        $filePath  = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $title     = slug(gs('site_name')) . '- attachments.' . $extension;
        try {
            $mimetype = mime_content_type($filePath);
        } catch (\Exception $e) {
            $notify[] = ['error', 'File does not exists'];
            return back()->withNotify($notify);
        }
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }
}
