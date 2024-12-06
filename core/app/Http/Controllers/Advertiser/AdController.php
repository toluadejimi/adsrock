<?php

namespace App\Http\Controllers\Advertiser;

use App\Constants\Status;
use App\Http\Controllers\Controller;;

use App\Models\AdType;
use App\Models\PlanPrice;
use App\Models\Analytic;
use App\Models\Country;
use App\Models\Transaction;
use App\Models\Advertise;
use App\Models\Keyword;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        $advertiserId = auth()->guard('advertiser')->id();
        $advertises   = Advertise::where('advertiser_id', $advertiserId)->searchable(['ad_name', 'ad_title', 'resolution'])->with('advertiser')->orderBy('impression', 'desc')->orderBy('clicked', 'desc')->paginate(getPaginate());
        $pageTitle    = 'All Ad';
        return view('Template::advertiser.ad.index', compact('advertises', 'pageTitle'));
    }

    public function status($id)
    {
        $ad = Advertise::where('advertiser_id', auth()->guard('advertiser')->id())->findOrFail($id);
        if (($ad->ad_type == 'click' && $ad->advertiser->click_credit > 0) || ($ad->ad_type == 'impression' && $ad->advertiser->impression_credit > 0)) {
            return Advertise::changeStatus($id);
        } else {
            if ($ad->status == Status::INACTIVATE_ADVERTISE) {
                $notify[] = ['error', 'You must purchase a plan to active this ad'];
                return to_route('advertiser.ad.price.plan')->withNotify($notify);
            } else {
                return Advertise::changeStatus($id);
            }
        }
    }

    public function create()
    {
        $pageTitle = 'Create Ad';
        $types     = AdType::enable()->get();
        return view('Template::advertiser.ad.create', compact('pageTitle', 'types'));
    }

    public function adCreate($id)
    {
        $adType    = AdType::enable()->findOrFail($id);
        $pageTitle = "Create Ad";
        $keywords  = Keyword::select('keywords')->pluck('keywords')->toArray();
        $countries = Country::active()->get();
        return view('Template::advertiser.ad.create_form', compact('pageTitle', 'adType', 'keywords', 'countries'));
    }

    public function store(Request $request, $id = 0)
    {
        $isRequired = $id ? 'nullable' : 'required';

        $request->validate([
            'title'            => 'required',
            'type'             => 'required|in:click,impression',
            'redirect_url'     => 'required|url',
            'add_keywords'     => 'required|array|min:1',
            'add_keywords.*'   => 'required',
            'target_country'   => 'required_without:is_global|array|min:1',
            'target_country.*' => 'required|required',
            'image'            => [$isRequired, 'image', new FileTypeValidate(['jpg', 'jpeg', 'png', 'gif'])],
        ]);

        if ($request->is_global) {
            $countries = Country::active()->get();
        } else {
            $countries = Country::active()->whereIn('country_code', $request->target_country)->get();
            if ($request->target_country && $countries->count() != count($request->target_country)) {
                $notify[] = ['error', 'Invalid target country input'];
                return back()->withNotify($notify)->withInput();
            }
        }


        $advertiser = auth()->guard('advertiser')->user();

        if ($request->type == 'click' && $advertiser->click_credit <= 0 || $request->type == 'impression' && $advertiser->impression_credit <= 0) {
            $notify[] = ['error', 'Please purchase' . ' ' . ucfirst($request->type) . ' ' . 'plan first'];
            return back()->withNotify($notify)->withInput();
        }

        if ($id) {
            $ad      = Advertise::where('advertiser_id', $advertiser->id)->findOrFail($id);
            $message = 'Advertise updated successfully';
        } else {
            $ad      = new Advertise();
            $message = 'Advertise created successfully';
        }

        $adType = AdType::enable()->findOrFail($request->type_id);

        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $imagePath = $image->getPathname();
            $imageSize = getimagesize($imagePath);
            $width     = $imageSize[0];
            $height    = $imageSize[1];

            if ((int)$adType->width != $width || $adType->height != $height) {
                $notify[] = ['error', 'Image resolution must be ' . $adType->width . 'x' . $adType->height . 'px'];
                return back()->withNotify($notify)->withInput();
            }

            try {
                $old       = @$ad->image;
                $ad->image = fileUploader($request->image, getFilePath('advertise'), null, $old);
            } catch (\Exception $exp) {

                $notify[] = ['error', 'Couldn\'t upload your advertise'];
                return back()->withNotify($notify)->withInput();
            }
        }

        $ad->advertiser_id = $advertiser->id;
        $ad->ad_type_id    = $request->type_id;
        $ad->track_id      = getTrx();
        $ad->ad_name       = $adType->ad_name;
        $ad->ad_title      = $request->title;
        $ad->redirect_url  = $request->redirect_url;
        $ad->ad_type       = $request->type;
        $ad->resolution    = $adType->slug;
        $ad->global        = $request->is_global ? Status::YES : Status::NO;
        $ad->keywords      = $request->add_keywords;
        $ad->status        = Status::ACTIVE_ADVERTISE;
        $ad->save();
        $ad->countries()->sync($countries);

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    public function edit($id)
    {
        $pageTitle   = 'Edit Ad';
        $ad          = Advertise::where('advertiser_id', auth()->guard('advertiser')->id())->findOrFail($id);
        $adType      = AdType::enable()->find($ad->ad_type_id);
        $keywords    = Keyword::select('keywords')->pluck('keywords')->toArray();
        $countries   = Country::active()->get();
        $adCountries = $ad->countries()->pluck('country_code')->toArray();

        return view('Template::advertiser.ad.create_form', compact('pageTitle', 'adType', 'ad', 'countries', 'keywords', 'adCountries'));
    }

    public function details($id)
    {
        $pageTitle = 'Advertise Details';
        $advertise = Advertise::where('advertiser_id', auth()->guard('advertiser')->id())->with('type')->findOrFail($id);
        return view('Template::advertiser.ad.detail', compact('advertise', 'pageTitle'));
    }

    public function report()
    {
        $reports   = Analytic::where('advertiser_id', auth()->guard('advertiser')->user()->id)->with('advertise')->searchable(['country', 'advertise:ad_title'])->orderBy('id', 'DESC')->paginate(getPaginate());
        $pageTitle = 'Advertise Reports';
        return view('Template::advertiser.ad.report', compact('reports', 'pageTitle'));
    }

    public function pricePlans()
    {
        $plans            = PlanPrice::orderBy('price', 'asc')->active()->get();
        $pageTitle        = 'Pricing Plan';
        $advertiserPlanId = auth()->guard('advertiser')->user()->plan_id;
        return view('Template::advertiser.ad.plan', compact('pageTitle', 'plans', 'advertiserPlanId'));
    }

    public function purchasePlan($id)
    {
        $plan = PlanPrice::active()->findOrFail($id);
        if ($plan->price > auth()->guard('advertiser')->user()->balance) {
            $notify[] = ['error', 'Insufficient balance'];
            return back()->withNotify($notify);
        }
        $pageTitle = "Purchase Preview";
        return view('Template::advertiser.ad.purchase_preview', compact('pageTitle', 'plan'));
    }

    public function confirmPurchasePlan(Request $request)
    {

        $request->validate([
            'plan_id' => 'required|integer',
        ]);

        $plan       = PlanPrice::active()->findOrFail($request->plan_id);
        $advertiser = auth()->guard('advertiser')->user();

        if ($plan->price > $advertiser->balance) {
            $notify[] = ['error', 'Insufficient your balance'];
            return to_route('advertiser.ad.price.plan')->withNotify($notify);
        }

        $advertiser->balance -= $plan->price;

        if ($plan->type === 'impression') {
            $advertiser->impression_credit += $plan->credit;
        } else {
            $advertiser->click_credit += $plan->credit;
        }

        $advertiser->plan_id = $plan->id;
        $advertiser->save();

        $trx                = new Transaction();
        $trx->advertiser_id = $advertiser->id;
        $trx->amount        = $plan->price;
        $trx->charge        = 0;
        $trx->post_balance  = $advertiser->balance;
        $trx->trx_type      = '-';
        $trx->remark        = 'purchased_plan';
        $trx->details       = $plan->name . ' ' . 'Plan Purchased';
        $trx->trx           = getTrx();
        $trx->date          = now();
        $trx->save();

        $notify[] = ['success', 'Plan purchased successfully'];
        return to_route('advertiser.ad.price.plan')->withNotify($notify);
    }
}
