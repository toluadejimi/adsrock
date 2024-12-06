<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlanPrice;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    public function planPrice()
    {
        $pageTitle = 'Advertiser Plan';
        $plans     = PlanPrice::orderBy('price')->searchable(['name', 'credit', 'type'])->paginate(getPaginate());
        return view('admin.advertise.plan_price', compact('pageTitle', 'plans'));
    }

    public function storePricePlan(Request $request, $id = 0)
    {
        $request->validate([
            'name'   => 'required|unique:plan_prices,name,' . $id,
            'type'   => 'required|in:click,impression',
            'price'  => 'required|numeric|min:1',
            'credit' => 'required|numeric|min:1',
        ]);

        if ($id) {
            $plan         = PlanPrice::findOrFail($id);
            $notification = 'Plan updated successfully';
        } else {
            $plan         = new PlanPrice();
            $notification = 'Plan added successfully';
        }

        $plan->name   = $request->name;
        $plan->type   = $request->type;
        $plan->price  = $request->price;
        $plan->credit = $request->credit;
        $plan->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function planPriceStatus($id)
    {
        return PlanPrice::changeStatus($id);
    }
}
