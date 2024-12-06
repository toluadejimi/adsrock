<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\AdType;
use App\Models\Advertise;
use App\Models\PublisherAd;


class AdvertiseController extends Controller
{
    public function advertise()
    {
        $pageTitle = 'Advertise Types';
        $ads       = AdType::enable()->paginate(getPaginate());
        return view('Template::publisher.advertise.index', compact('ads', 'pageTitle'));
    }

    public function publishedAd()
    {
        $pageTitle    = 'Published Ads';
        $publishedAds = PublisherAd::where('publisher_id', auth()->guard('publisher')->id())->with('advertise')->paginate(getPaginate());
        return view('Template::publisher.advertise.published', compact('pageTitle', 'publishedAds'));
    }

    public function details($id)
    {
        $pageTitle = 'Published Ad Details';
        $publisher = auth()->guard('publisher')->user();
        $advertise = Advertise::findOrFail($id);
        $count     = PublisherAd::where('publisher_id', $publisher->id)->where('advertise_id', $advertise->id)->first();
        if (!$count) {
            $notify[] = ['error', 'Sorry Advertise couldn\'t found'];
            return back()->withNotify($notify);
        }
        return view('Template::publisher.advertise.details', compact('advertise', 'pageTitle', 'count'));
    }
}
