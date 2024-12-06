<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class ManageCountryController extends Controller
{
    public function countryList()
    {
        $pageTitle     = "All Country";
        $countriesJson = $this->countryJson();
        $countries     = Country::searchable(['country_name', 'country_code'])->paginate(getPaginate());
        return view('admin.country.country_list', compact('pageTitle', 'countries', 'countriesJson'));
    }

    public function countryStore(Request $request, $id = 0)
    {
        $countryJson = $this->countryJson();
        $request->validate([
            'country' => 'required|string|unique:countries,country_code,' . $id . "|in:" . collect($countryJson)->keys()->implode(','),
        ]);

        $countryCode   = $request->country;
        $singleCountry = $countryJson->$countryCode;

        if ($id) {
            $country  = Country::findOrFail($id);
            $notify[] = ['success', 'Country updated successfully'];
        } else {
            $country  = new Country();
            $notify[] = ['success', 'Country added successfully'];
        }

        $country->country_name = $singleCountry->country;
        $country->country_code = $countryCode;

        $country->save();
        return back()->withNotify($notify);
    }


    public function countryStatus($id)
    {
        return Country::changeStatus($id);
    }

    private function countryJson()
    {
        return json_decode(file_get_contents(resource_path('views/partials/country.json')));
    }
}
