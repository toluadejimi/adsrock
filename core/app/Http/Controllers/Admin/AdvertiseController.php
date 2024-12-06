<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constants\Status;
use App\Models\AdType;
use App\Models\Country;
use App\Models\Advertise;
use App\Models\Cost;
use App\Models\Keyword;

class AdvertiseController extends Controller
{
    public function index()
    {
        $advertises = Advertise::searchable(['ad_name', 'ad_title', 'advertiser:username', 'clicked', 'impression', 'countries:country_name'])->with('advertiser')->filter(['advertiser_id'])->orderBy('impression', 'DESC')->orderBy('clicked', 'DESC')->paginate(getPaginate());
        $pageTitle  = 'All Advertise';
        
        return view('admin.advertise.index', compact('advertises', 'pageTitle'));
    }

    public function status($id)
    {
        return Advertise::changeStatus($id);
    }

    public function detail($id)
    {
        $advertise   = Advertise::with('countries')->findOrFail($id);
        $pageTitle   = 'Advertise Details';
        $keywords    = Keyword::select('keywords')->pluck('keywords')->toArray();
        $countries   = Country::active()->get();
        $adCountries = $advertise->countries()->pluck('country_code')->toArray();

        return view('admin.advertise.detail', compact('advertise', 'pageTitle', 'keywords', 'countries', 'adCountries'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'redirect_url'     => 'required|url',
            'keywords'         => 'required',
            'keywords.*'       => 'required',
            'target_country'   => 'sometimes|required',
            'target_country.*' => 'sometimes|required',
        ]);

        $ad = Advertise::findOrFail($id);

        if ($request->global) {
            $countries = Country::active()->get();
        } else {
            $countries = Country::active()->whereIn('country_code', $request->target_country)->get();
        }

        if ($request->target_country && @$countries->count() !== count(@$request->target_country) &&  !@$request->global) {
            $notify[] = ['error', 'Invalid target country input'];
            return back()->withNotify($notify);
        }

        if ($request->global == 'on') {
            $ad->global = Status::YES;

            $ad->countries()->sync($countries);
        } else {

            $ad->countries()->sync($countries);
            $ad->global = Status::NO;
        }
        $ad->keywords     = $request->keywords;
        $ad->redirect_url = $request->redirect_url;
        $ad->update();
        $notify[] = ['success', 'Advertise updated successfully'];
        return back()->withNotify($notify);
    }


    //advertise-Type
    public function type()
    {
        $pageTitle = 'Advertise Types';
        $types     = AdType::searchable(['ad_name'])->paginate(getPaginate());
        return view('admin.advertise.ad_type', compact('pageTitle', 'types'));
    }

    public function storeADType(Request $request, $id = 0)
    {
        $request->validate([
            'ad_name' => 'required|unique:ad_types,ad_name,' . $id,
            'type'    => 'required',
            'width'   => 'required|integer|gt:0',
            'height'  => 'required|integer|gt:0',
            'slug'    => 'required|unique:ad_types,slug,' . $id,
        ]);

        if ($id) {
            $adType       = AdType::findOrFail($id);
            $notification = 'AD Type updated successfully';
        } else {
            $adType       = new AdType();
            $notification = 'AD Type added successfully';
        }

        $adType->ad_name = $request->ad_name;
        $adType->type    = $request->type;
        $adType->width   = $request->width;
        $adType->height  = $request->height;
        $adType->slug    = $request->slug;
        $adType->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function typeStatus($id)
    {
        return AdType::changeStatus($id);
    }

    public function perCost()
    {
        $pageTitle = 'Manage Cost';
        $costs     = Cost::with('country')->searchable('country_code', 'country:country_name')->paginate(getPaginate());
        $countries = Country::active()->get();
        return view('admin.advertise.per_cost', compact('pageTitle', 'countries', 'costs'));
    }

    public function perCostStoreUpdate(Request $request, $id = 0)
    {
        $request->validate([
            'cpc'        => 'required|numeric|min:0',
            'cpm'        => 'required|numeric|min:0',
            'epm'        => 'required|numeric|gt:0',
            'epc'        => 'required|numeric|gt:0',
            'country_id' => 'required|integer|unique:costs,country_id,' . $id
        ]);

        $country = Country::findOrFail($request->country_id);

        if ($id) {
            $cost     = Cost::findOrFail($id);
            $notify[] = ['success', 'Cost updated successfully'];
        } else {
            $cost     = new Cost();
            $notify[] = ['success', 'Cost added successfully'];
        }
        $cost->cpc        = $request->cpc;
        $cost->cpm        = $request->cpm;
        $cost->epc        = $request->epc;
        $cost->epm        = $request->epm;
        $cost->country_id = $country->id;
        $cost->save();

        return back()->withNotify($notify);
    }
}
