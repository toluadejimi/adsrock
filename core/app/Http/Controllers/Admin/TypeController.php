<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdType;
use Illuminate\Http\Request;

class TypeController extends Controller
{

    public function type()
    {
        $pageTitle = 'Advertise Types';
        $types     = AdType::searchable(['ad_name', 'type'])->paginate(getPaginate());
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
}
