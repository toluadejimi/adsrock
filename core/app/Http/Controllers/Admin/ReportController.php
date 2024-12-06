<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EarningLog;
use App\Models\NotificationLog;
use App\Models\Transaction;
use App\Models\UserLogin;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function publisherEarningLog(Request $request)
    {
        $pageTitle = 'Publisher Earning Logs';
        $earningLogs = EarningLog::searchable(['publisher:username', 'advertise:ad_name', 'advertise:ad_name,ad_type'])->dateFilter('date')->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('admin.reports.earning_log', compact('pageTitle', 'earningLogs'));
    }


    public function transaction(Request $request, $id = null)
    {
        $pageTitle = 'Transaction Logs';
        $remarks = Transaction::distinct('remark')->orderBy('remark')->get('remark');
        $transactions = Transaction::searchable(['trx','advertiser:username'])->filter(['trx_type','remark'])->dateFilter()->orderBy('id','desc')->with('advertiser')->whereHas('advertiser');
        if ($id) {
            $transactions = $transactions->where('advertiser_id',$id);
        }
        $transactions = $transactions->paginate(getPaginate());

        return view('admin.reports.transactions', compact('pageTitle', 'transactions','remarks'));
    }



    public function loginHistoryAdvertiser(Request $request)
    {
        $pageTitle = 'Advertiser Login History';
        $loginLogs = UserLogin::orderBy('id', 'desc')->searchable(['advertiser:username'])->with('advertiser')->paginate(getPaginate());
        return view('admin.reports.advertiser_logins', compact('pageTitle', 'loginLogs'));
    }
    public function loginHistoryPublisher(Request $request)
    {
        $pageTitle = 'Publisher Login History';
        $loginLogs = UserLogin::orderBy('id', 'desc')->searchable(['publisher:username'])->with('publisher')->paginate(getPaginate());
        return view('admin.reports.publisher_logins', compact('pageTitle', 'loginLogs'));
    }

    public function loginIpHistory($ip)
    {
        $pageTitle = 'Login by - ' . $ip;
        $loginLogs = UserLogin::where('user_ip', $ip)->orderBy('id', 'desc')->with('user')->paginate(getPaginate());
        return view('admin.reports.logins', compact('pageTitle', 'loginLogs', 'ip'));
    }

    public function notificationHistory(Request $request)
    {
        $pageTitle = 'Notification History';
        $logs = NotificationLog::orderBy('id', 'desc')->searchable(['advertiser:username'])->with('publisher', 'advertiser')->paginate(getPaginate());
        return view('admin.reports.notification_history', compact('pageTitle', 'logs'));
    }

    public function emailDetails($id)
    {
        $pageTitle = 'Email Details';
        $email = NotificationLog::findOrFail($id);
        return view('admin.reports.email_details', compact('pageTitle', 'email'));
    }
}
