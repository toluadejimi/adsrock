<?php

namespace App\Http\Controllers\Publisher;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Keyword;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function all()
    {
        $pageTitle = "All Domains";
        $domains   = Domain::searchable(['domain_name'])->where('publisher_id', auth()->guard('publisher')->user()->id)->orderBy('id', 'DESC')->paginate(getPaginate());
        $keywords  = Keyword::select('keywords')->pluck('keywords')->toArray();
        return view('Template::publisher.domain.domain_verify', compact('domains', 'pageTitle', 'keywords'));
    }

    public function storeDomainVerify(Request $request, $id = 0)
    {
        $validation = $id ? 'nullable' : 'required';
        $request->validate(
            [
                'domain_name' => [$validation, 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],
                'keywords'    => 'required|array|min:1',
                'keywords.*'  => 'required'
            ],
            [
                'keywords.*.required' => 'The keywords field is required.',
                'domain_name.url'     => 'Please enter a valid url.'
            ]
        );

        $publisher = auth()->guard('publisher')->user();

        if ($id) {
            $domainVerify = Domain::where('publisher_id', $publisher->id)->findOrFail($id);
            $notification = 'Domain updated successfully';
        } else {
            $domainVerify              = new Domain();
            $notification              = 'Domain added successfully';
            $domainVerify->tracker     = getTrx();
            $domainVerify->domain_name = urlToDomain($request->domain_name);
            $domainVerify->verify_code = getTrx(32);
        }

        $domainVerify->publisher_id = $publisher->id;
        $domainVerify->keywords     = $request->keywords;
        $domainVerify->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function domainVerifyAct($tracker)
    {
        $general   = gs();
        $domain    = Domain::where('status', Status::UNVERIFIED)->where('publisher_id', auth()->guard('publisher')->id())->where('tracker', $tracker)->firstOrFail();
        $fileName  = titleToKey($general->site_name) . '.txt';
        $fileURL   = 'http://' . $domain->domain_name . '/' . titleToKey($general->site_name) . '.txt';
        $pageTitle = "Verify Your Domain: " . $domain->domain_name;

        return view('Template::publisher.domain.verify_page', compact('pageTitle', 'domain', 'fileURL', 'fileName'));
    }


    public function domainCheck($tracker)
    {
        $general = gs();
        $domain  = Domain::where("tracker", $tracker)->where('publisher_id', auth()->guard('publisher')->id())->where('status', Status::DOMAIN_UNVERIFIED)->firstOrFail();
    

        $fileURL = 'http://' . $domain->domain_name . '/' . titleToKey($general->site_name) . '.txt';
        try {
            $verification = file_get_contents($fileURL);
            if ($domain->verify_code == $verification) {
                if ($general->domain_approval == Status::ENABLE) {
                    $domain->status = Status::DOMAIN_PENDING;
                    $notify[]       = ['info', 'Your domain has been submitted for approval'];
                } else {
                    $domain->status = Status::DOMAIN_VERIFIED;
                    $notify[]       = ['success', 'Your domain has been verified'];
                }
                $domain->save();
                return to_route("publisher.domain.all")->withNotify($notify);
            } else {
                $notify[] = ['error', 'File not matched'];
                return back()->withNotify($notify);
            }
        } catch (\ErrorException $e) {
            $notify[] = ['warning', 'Please put your file to indicated path'];
            return back()->withNotify($notify);
        }

        $notify[] = ['error', 'We couldn\'t verify your domain. Please try again'];
        return back()->withNotify($notify);
    }

    public function domainRemove($tracker)
    {
        $domain = Domain::where('publisher_id', auth()->guard('publisher')->id())->where('tracker', $tracker)->firstOrFail();
        $domain->delete();
        $notify[] = ['success', 'Domain removed successfully'];
        return back()->withNotify($notify);
    }
}
