<?php

namespace App\Http\Controllers\Advertiser;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Transaction;
use App\Models\Deposit;
use App\Models\DeviceToken;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AdvertiserController extends Controller
{
    public function home()
    {
        $pageTitle                      = 'Dashboard';
        $report['trx_months']           = collect([]);
        $report['deposit_months']       = collect([]);
        $report['trx_month_amount']     = collect([]);
        $report['deposit_month_amount'] = collect([]);
        $advertiser                     = auth()->guard('advertiser')->user();

        $transaction = Transaction::whereYear('created_at', '>=', Carbon::now()->subYear())
            ->where('advertiser_id', $advertiser->id)
            ->selectRaw("SUM(amount) as amount, DATE_FORMAT(created_at,'%M') as months")
            ->orderBy('created_at')
            ->groupBy('months')
            ->get();

        $depositsMonth = Deposit::whereYear('created_at', '>=', Carbon::now()->subYear())
            ->where('advertiser_id', $advertiser->id)
            ->selectRaw("SUM(final_amount) as depoAmount, DATE_FORMAT(created_at,'%M') as months")
            ->orderBy('created_at')
            ->groupBy('months')
            ->get();

        $transaction->map(function ($trx) use ($report) {
            $report['trx_months']->push($trx->months);
            $report['trx_month_amount']->push(getAmount($trx->amount));
        });

        $depositsMonth->map(function ($deposit) use ($report) {
            $report['deposit_months']->push($deposit->months);
            $report['deposit_month_amount']->push(getAmount($deposit->depoAmount));
        });

        $perDay = Transaction::where('advertiser_id', $advertiser->id)->where('date', Carbon::now()->toDateString())->get();
        $yDay   = Transaction::where('advertiser_id', $advertiser->id)->where('date', Carbon::now()->subDays(1)->toDateString())->get();

        $totalDeposit = Deposit::where('advertiser_id', $advertiser->id)->successful()->sum('amount');
        $totalTrx     = Transaction::where('advertiser_id', $advertiser->id)->count();
        $totalAd      = Advertise::where('advertiser_id', $advertiser->id)->get();
        $advertises   = Advertise::where('advertiser_id', auth()->guard('advertiser')->id())->where('status', Status::ADVERTISER_ACTIVE)->select('id', 'advertiser_id', 'ad_name', 'ad_title', 'ad_type', 'status', 'resolution', 'image')->latest()->take(10)->get();

        return view('Template::advertiser.dashboard', compact('pageTitle', 'totalAd', 'report', 'totalDeposit', 'totalTrx', 'perDay', 'yDay', 'advertiser', 'advertises'));
    }

    public function depositHistory(Request $request)
    {
        $pageTitle = 'Deposit History';
        $deposits  = auth()->guard('advertiser')->user()->deposits()->searchable(['trx', 'gateway:name'])->with(['gateway'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('Template::advertiser.deposit_history', compact('pageTitle', 'deposits'));
    }


    public function transactions()
    {
        $pageTitle    = 'Transactions';
        $remarks      = Transaction::where('advertiser_id', auth()->guard('advertiser')->id())->distinct('remark')->orderBy('remark')->get('remark');
        $transactions = Transaction::where('advertiser_id', auth()->guard('advertiser')->id())->searchable(['trx'])->filter(['trx_type', 'remark'])->dateFilter()->orderBy('id', 'desc')->paginate(getPaginate());
        return view('Template::advertiser.transations', compact('pageTitle', 'transactions', 'remarks'));
    }


    public function advertiserData()
    {

        $user = auth()->guard('advertiser')->user();

        if ($user->profile_complete == Status::YES) {
            return to_route('advertiser.dashboard');
        }

        $pageTitle  = 'advertiser Data';
        $info       = json_decode(json_encode(getIpInfo()), true);
        $mobileCode = @implode(',', $info['code']);
        $countries  = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        return view('Template::advertiser.advertiser_data', compact('pageTitle', 'user', 'countries', 'mobileCode'));
    }


    public function advertiserDataSubmit(Request $request)
    {
        $user = auth()->guard('advertiser')->user();

        if ($user->profile_complete == Status::YES) {
            return to_route('advertiser.dashboard');
        }

        $countryData  = (array)json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryCodes = implode(',', array_keys($countryData));
        $mobileCodes  = implode(',', array_column($countryData, 'dial_code'));
        $countries    = implode(',', array_column($countryData, 'country'));

        $request->validate([
            'country_code' => 'required|in:' . $countryCodes,
            'country'      => 'required|in:' . $countries,
            'mobile_code'  => 'required|in:' . $mobileCodes,
            'username'     => 'required|unique:advertisers|min:6',
            'mobile'       => ['required', 'regex:/^([0-9]*)$/', Rule::unique('advertisers')->where('dial_code', $request->mobile_code)],
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

        return to_route('advertiser.dashboard');
    }

    public function addDeviceToken(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()->all()];
        }

        $deviceToken = DeviceToken::where('advertiser_id', auth()->guard('advertiser')->user()->id)->where('token', $request->token)->first();

        if ($deviceToken) {
            return ['success' => true, 'message' => 'Already exists'];
        }

        $deviceToken                = new DeviceToken();
        $deviceToken->advertiser_id = auth()->guard('advertiser')->user()->id;
        $deviceToken->token         = $request->token;
        $deviceToken->is_app        = Status::NO;
        $deviceToken->save();

        return ['success' => true, 'message' => 'Token saved successfully'];
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
