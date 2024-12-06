<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\IpChart;
use App\Models\IpLog;
use Illuminate\Http\Request;

class ManageIpController extends Controller
{
    
    // ======================IP ========================
    public function ipLog(Request $request)
    {
        $pageTitle = "Advertise Ip Logs";
        $logs = IpLog::searchable(['ipChart:ip', 'advertise:ad_title', 'advertise.type:ad_name'])->orderBy('id', 'DESC')->whereHas('advertise')->whereHas('ipChart', function ($ip) {
            $ip->where('blocked', Status::IP_NOT_BLOCKED);
        })->with(['advertise', 'ipChart'])->paginate(getPaginate());

        return view('admin.advertise.ip_logs', compact('pageTitle', 'logs'));
    }
    public function blockedIpLog(Request $request)
    {
        $pageTitle = "Blocked Ip Logs";
        $logs = IpChart::where('blocked', Status::IP_BLOCKED)->searchable(['ip'])->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('admin.advertise.blocked_ip_logs', compact('pageTitle', 'logs'));
    }

    public function blockIp($id)
    {
        $block = IpChart::findOrFail($id);
        $block->blocked = Status::IP_BLOCKED;
        $block->save();
        $notify[] = ['success', 'IP blocked successfully'];
        return back()->withNotify($notify);
    }

    public function unBlockIp($id)
    {
        $unblockIp = IpChart::findOrFail($id);
        $unblockIp->blocked = Status::IP_NOT_BLOCKED;
        $unblockIp->update();
        $notify[] = ['success', 'Ip unblocked successfully'];
        return back()->withNotify($notify);
    }
}
