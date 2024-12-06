<?php

namespace App\Http\Controllers\Gateway;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\AdminNotification;
use App\Models\Advertiser;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Models\PlanPrice;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function deposit($id = 0)
    {
        if ($id) {
            $plan      = PlanPrice::active()->findOrFail($id);
            $amount    = getAmount(@$plan->price);
            $pageTitle = 'Payment Methods';
        } else {
            $plan      = '';
            $amount    = old('amount');
            $pageTitle = 'Deposit Methods';
        }

        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->with('method')->orderby('name')->get();
        return view('Template::advertiser.payment.deposit', compact('gatewayCurrency', 'plan', 'pageTitle', 'amount'));
    }

    public function depositInsert(Request $request)
    {
        $request->validate([
            'amount'   => 'required|numeric|gt:0',
            'gateway'  => 'required',
            'currency' => 'required',
        ]);


        $advertiser = auth()->guard('advertiser')->user();
        $plan       = session()->get('plan');

        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->where('method_code', $request->gateway)->where('currency', $request->currency)->first();

        if (!$gate) {
            $notify[] = ['error', 'Invalid gateway'];
            return back()->withNotify($notify);
        }

        if ($plan) {
            $planId = $plan->id;
            $amount = $plan->price;
        } else {
            $amount = $request->amount;
            $planId = 0;
            if ($gate->min_amount > $amount || $gate->max_amount < $amount) {
                $notify[] = ['error', 'Please follow deposit limit'];
                return back()->withNotify($notify);
            }
        }

        $charge      = $gate->fixed_charge + ($amount * $gate->percent_charge / 100);
        $payable     = $amount + $charge;
        $finalAmount = $payable * $gate->rate;

        $data                  = new Deposit();
        $data->advertiser_id   = $advertiser->id;
        $data->plan_id         = $planId;
        $data->method_code     = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->amount          = $amount;
        $data->charge          = $charge;
        $data->rate            = $gate->rate;
        $data->final_amount    = $finalAmount;
        $data->btc_amount      = 0;
        $data->btc_wallet      = "";
        $data->trx             = getTrx();
        $data->success_url     = urlPath('advertiser.deposit.history');
        $data->failed_url      = urlPath('advertiser.deposit.history');
        $data->save();
        session()->put('Track', $data->trx);
        return to_route('advertiser.deposit.confirm');
    }



    public function depositConfirm()
    {
        $track   = session()->get('Track');
        $deposit = Deposit::where('trx', $track)->where('status', Status::PAYMENT_INITIATE)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();

        if ($deposit->method_code >= 1000) {
            return to_route('advertiser.deposit.manual.confirm');
        }


        $dirName = $deposit->gateway->alias;
        $new     = __NAMESPACE__ . '\\' . $dirName . '\\ProcessController';
        $data = $new::process($deposit);
        $data = json_decode($data);

        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return back()->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }

        // for Stripe V3
        if (@$data->session) {
            $deposit->btc_wallet = $data->session->id;
            $deposit->save();
        }

        $pageTitle = 'Payment Confirm';
        return view("Template::$data->view", compact('data', 'pageTitle', 'deposit'));
    }


    public static function userDataUpdate($deposit, $isManual = null)
    {
        if ($deposit->status == Status::PAYMENT_INITIATE || $deposit->status == Status::PAYMENT_PENDING) {
            $deposit->status = Status::PAYMENT_SUCCESS;
            $deposit->save();

            $advertiser           = Advertiser::where('id', $deposit->advertiser_id)->first();
            $advertiser->balance += $deposit->amount;
            $advertiser->save();

            $methodName = $deposit->methodName();

            $transaction                = new Transaction();
            $transaction->advertiser_id = $advertiser->id;
            $transaction->amount        = $deposit->amount;
            $transaction->post_balance  = $advertiser->balance;
            $transaction->charge        = $deposit->charge;
            $transaction->trx_type      = '+';
            $transaction->details       = 'Deposit Via ' . $methodName;
            $transaction->trx           = $deposit->trx;
            $transaction->remark        = 'deposit';
            $transaction->save();

            $plan = null;
            if ($deposit->plan_id) {
                $plan = PlanPrice::find($deposit->plan_id);

                if ($plan) {
                    $advertiser->balance -= $deposit->amount;
                    $advertiser->save();

                    if ($plan->type == 'impression') {
                        $advertiser->impression_credit += $plan->credit;
                    } else {
                        $advertiser->click_credit += $plan->credit;
                    }

                    $advertiser->plan_id = $plan->id;
                    $advertiser->save();

                    $transaction                = new Transaction();
                    $transaction->advertiser_id = $advertiser->id;
                    $transaction->amount        = $deposit->amount;
                    $transaction->post_balance  = $advertiser->balance;
                    $transaction->charge        = 0;
                    $transaction->trx_type      = '-';
                    $transaction->details       = $plan->name . ' Plan purchased';
                    $transaction->trx           = $deposit->trx;
                    $transaction->remark        = 'purchased_plan';
                    $transaction->date          = now();
                    $transaction->save();
                }
            }



            if (!$isManual) {
                $adminNotification                = new AdminNotification();
                $adminNotification->advertiser_id = $deposit->advertiser_id;
                $adminNotification->title         = 'Deposit successful via ' . $methodName;
                $adminNotification->click_url     = urlPath('admin.deposit.successful');
                $adminNotification->save();
            }

            if (@$plan) {
                notify($advertiser, $isManual ? 'PURCHASE_REQUEST' : 'PLAN_PURCHASED', [
                    'plan'            => $plan->name,
                    'credit'          => $plan->credit,
                    'type'            => $plan->type,
                    'method_name'     => $deposit->gatewayCurrency()->name,
                    'method_currency' => $deposit->method_currency,
                    'method_amount'   => showAmount($deposit->final_amount, currencyFormat: false),
                    'amount'          => showAmount($deposit->amount, currencyFormat: false),
                    'charge'          => showAmount($deposit->charge, currencyFormat: false),
                    'rate'            => showAmount($deposit->rate, currencyFormat: false),
                    'trx'             => $deposit->trx,
                    'post_balance'    => showAmount($advertiser->balance, currencyFormat: false)
                ]);
            } else {

                notify($advertiser, $isManual ? 'DEPOSIT_APPROVE' : 'DEPOSIT_COMPLETE', [
                    'method_name'     => $methodName,
                    'method_currency' => $deposit->method_currency,
                    'method_amount'   => showAmount($deposit->final_amount, currencyFormat: false),
                    'amount'          => showAmount($deposit->amount, currencyFormat: false),
                    'charge'          => showAmount($deposit->charge, currencyFormat: false),
                    'rate'            => showAmount($deposit->rate, currencyFormat: false),
                    'trx'             => $deposit->trx,
                    'post_balance'    => showAmount($advertiser->balance, currencyFormat: false)
                ]);
            }
        }
    }

    public function manualDepositConfirm()
    {
        $track = session()->get('Track');
        $data  = Deposit::with('gateway')->where('status', Status::PAYMENT_INITIATE)->where('trx', $track)->first();
        abort_if(!$data, 404);
        if ($data->method_code > 999) {
            $pageTitle = 'Confirm Deposit';
            $method    = $data->gatewayCurrency();
            $gateway   = $method->method;
            return view('Template::advertiser.payment.manual', compact('data', 'pageTitle', 'method', 'gateway'));
        }
        abort(404);
    }

    public function manualDepositUpdate(Request $request)
    {
        $track = session()->get('Track');
        $data  = Deposit::with('gateway')->where('status', Status::PAYMENT_INITIATE)->where('trx', $track)->first();
        abort_if(!$data, 404);
        $gatewayCurrency = $data->gatewayCurrency();
        $gateway         = $gatewayCurrency->method;
        $formData        = $gateway->form->form_data;

        $formProcessor  = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData = $formProcessor->processFormData($request, $formData);


        $data->detail = $userData;
        $data->status = Status::PAYMENT_PENDING;
        $data->save();

        $adminNotification                = new AdminNotification();
        $adminNotification->advertiser_id = $data->advertiser->id;
        $adminNotification->title         = 'Deposit request from ' . $data->advertiser->username;
        $adminNotification->click_url     = urlPath('admin.deposit.details', $data->id);
        $adminNotification->save();

        notify($data->user, 'DEPOSIT_REQUEST', [
            'method_name'     => $data->gatewayCurrency()->name,
            'method_currency' => $data->method_currency,
            'method_amount'   => showAmount($data->final_amount, currencyFormat: false),
            'amount'          => showAmount($data->amount, currencyFormat: false),
            'charge'          => showAmount($data->charge, currencyFormat: false),
            'rate'            => showAmount($data->rate, currencyFormat: false),
            'trx'             => $data->trx
        ]);

        $notify[] = ['success', 'You have deposit request has been taken'];
        return to_route('advertiser.deposit.history')->withNotify($notify);
    }
}
