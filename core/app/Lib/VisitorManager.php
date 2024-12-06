<?php

namespace App\Lib;

use App\Models\IpLog;
use App\Models\AdType;
use App\Models\IpChart;
use App\Models\Analytic;
use App\Models\Advertise;
use App\Models\Publisher;
use App\Models\Advertiser;
use App\Models\EarningLog;
use App\Models\PublisherAd;
use App\Models\Domain;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Constants\Status;
use Exception;
use stdClass;


class VisitorManager
{

    /**
     * Selects and returns the appropriate advertisement based on the publisher ID, ad type, 
     * and the visitor's location. If no suitable ad is found or certain checks fail, 
     * a default ad is returned.
     *
     * @param string $pubId Encrypted publisher ID.
     * @param string $slug The ad type slug.
     * @param string $currentUrl The current URL of the request.
     * @return string HTML for the selected advertisement or a default ad.
     */

    public function ad($pubId, $slug, $currentUrl)
    {



        $adType = AdType::where('slug', $slug)->enable()->first();

        if (!$adType) return 0;

        $adWidth  = $adType->width;
        $adHeight = $adType->height;

        try {
            $publisherId = Crypt::decryptString($pubId);
        } catch (Exception $ex) {
            return $this->defaultAd($slug, $adWidth, $adHeight, gs('site_name'));
        }


        $publisher = Publisher::find($publisherId);
        if (!$publisher) {
            return $this->defaultAd($slug, $adWidth, $adHeight, gs('site_name'));
        }

        $ip         = getRealIP();
        $existingIp = IpChart::where('ip',  $ip)->first();

        if ($existingIp) {
            if ($existingIp->blocked == Status::YES) {
                return $this->defaultAd($slug, $adWidth, $adHeight, gs('site_name'));
            }
        } else {
            $existingIp     = new IpChart();
            $existingIp->ip = $ip;
            $existingIp->save();
        }

        $domain = Domain::where('domain_name', $currentUrl)->where('publisher_id', $publisherId)->where('status', Status::DOMAIN_VERIFIED)->first();

        if (!$domain) {
            return $this->defaultAd($slug, $adWidth, $adHeight, gs('site_name'));
        }


        $queryAd = Advertise::where('ad_type_id', $adType->id)->where('status', Status::ACTIVE_ADVERTISE);
        if (gs('check_country')) {

            $ipInfo      = $this->countryDetector($ip);
            $countryName = $ipInfo->country_name;

            if ($countryName) {
                $queryAd->whereHas('countries', function ($query) use ($countryName) {
                    $query->active()->where('country_name', $countryName);
                });
            }
        } else {
            $ipInfo          = new stdClass;
            $ipInfo->success = true;
            $countryName     = null;
        }

        if (!$ipInfo->success) {
            return $this->defaultAd($slug, $adWidth, $adHeight, gs('site_name'));
        }

        if (gs('check_domain_keyword')) {
            $queryAd->where(function ($q) use ($domain) {
                foreach ($domain->keywords as $keyword) {
                    $q->orWhere('keywords', 'LIKE', "%$keyword%");
                }
            });
        }

        $ad         = $queryAd->with(['countries.cost', 'advertiser'])->inRandomOrder()->first();
        if (!$ad) {
            return $this->defaultAd($slug, $adWidth, $adHeight, gs('site_name'));
        }
        $advertiser = $ad->advertiser;
        $cost       = null;



        if ($ad->ad_type == 'impression' &&  $advertiser->impression_credit <= 0) {
            return $this->defaultAd($slug, $adWidth, $adHeight, gs('site_name'));
        }


        if (gs('check_country')  && $ad->countries->isNotEmpty()) {
            $cost = @$ad->countries()->active()->where('country_name', $countryName)->first()->cost;
        }



        $existIpLog = $existingIp->iplogs()->where('advertise_id', $ad->id)->where('time', '>=', Carbon::now()->subMinutes(gs('intervals'))->format('H:i:s'))->first();

        $publisherAd                    = PublisherAd::firstOrNew(['advertise_id' => $ad->id, 'publisher_id' => $publisher->id, 'date' => Carbon::now()->toDateString()]);
        $publisherAd->advertiser_id     = $ad->advertiser_id;
        $publisherAd->impression_count += 1;
        $publisherAd->save();

        if ($ad->ad_type == 'impression') {

            if (!$existIpLog) {
                $ipLog               = new IpLog();
                $ipLog->ip_chart_id  = $existingIp->id;
                $ipLog->country      = $countryName;
                $ipLog->advertise_id = $ad->id;
                $ipLog->ad_type      = $ad->ad_type;
                $ipLog->time         = Carbon::now()->toTimeString();
                $ipLog->save();
            }

            $advertiser->impression_credit -= @$cost->cpm ?? gs('cpm');
            $advertiser->save();

            $earningAmount = @$cost->epm ?? gs('epm');

            $publisher->earning = $publisher->earning + $earningAmount;
            $publisher->save();

            $earningLog           = EarningLog::firstOrNew(['publisher_id' => $publisher->id, 'advertise_id' => $ad->id, 'date' => Carbon::now()->toDateString()]);
            $earningLog->amount  += $earningAmount;
            $earningLog->ad_type  = $ad->ad_type;
            $earningLog->save();
        }

        $redirectUrl = route('adClicked', [encrypt($publisherId), $ad->track_id, $existingIp]);
        $adImage     = getImage(getFilePath('advertise') . '/' . $ad->image);

        $ad->impression += 1;
        $ad->save();

        $analytic                    = Analytic::firstOrNew(['country' => @$countryName, 'advertiser_id' => $ad->advertiser_id, 'advertise_id' => $ad->id]);
        $analytic->ad_title          = $ad->ad_title;
        $analytic->impression_count += 1;
        $analytic->save();



        return $this->randomAd($redirectUrl, $adImage, $adWidth, $adHeight, gs('site_name'));
    }

    /**
     * Handles the logic when an advertisement is clicked by a user.
     *
     * @param string $publisherId The encrypted ID of the publisher.
     * @param string $trackId The tracking ID of the advertisement.
     * @return \Illuminate\Http\RedirectResponse Redirects to the ad's target URL or back to the previous page if an error occurs.
     */
    public function adClicked($publisherId, $trackId)
    {
        $ad = Advertise::active()->where('track_id', $trackId)->first();
        if (!$ad) {
            $notify[] = ['error', 'The ad not found.'];
            return to_route('home')->withNotify($notify);
        }

        $publisher  = Publisher::findOrFail(decrypt($publisherId));
        $advertiser = Advertiser::findOrFail($ad->advertiser_id);

        if (!$publisher) {
            $notify[] = ['error', 'The ad publisher not found'];
            return to_route('home')->withNotify($notify);
        }

        if (!$advertiser) {
            $notify[] = ['error', 'The ad advertiser not found'];
            return to_route('home')->withNotify($notify);
        }


        if ($ad->ad_type == 'click' && $advertiser->click_credit <= 0) {
            $notify[] = ['error', 'The ad advertiser does not have enough click-credit'];
            return to_route('home')->withNotify($notify);
        }

        $ip = getRealIP();

        if (gs('check_country')) {

            $ipInfo = $this->countryDetector($ip);
            if (!$ipInfo->success) {
                return to_route('home');
            }

            $countryName = $ipInfo->country_name;
            $country     = $ad->countries()->active()->where('country_name', $countryName)->first();

            if (!$country) {
                return to_route('home');
            }
            $cost = @$country->cost;
        } else {
            $ipInfo          = new stdClass;
            $ipInfo->success = true;
            $countryName     = null;
            $cost            = null;
        }

        $existingIp = IpChart::where('ip',  $ip)->first();

        if (!$existingIp) {
            $notify[] = ['error', 'IP address not found.'];
            return to_route('home')->withNotify($notify);
        }

        $existIpLog = $existingIp->iplogs()->where('advertise_id', $ad->id)->where('time', '>=', Carbon::now()->subMinutes(gs('intervals')))->first();

        $publisherAd                 = PublisherAd::firstOrNew(['advertise_id' => $ad->id, 'publisher_id' => $publisher->id, 'date' => Carbon::now()->toDateString()]);
        $publisherAd->advertiser_id  = $ad->advertiser_id;
        $publisherAd->click_count   += 1;
        $publisherAd->save();

        if ($ad->ad_type == 'click') {

            if (!$existIpLog) {
                $ipLog               = new IpLog();
                $ipLog->ip_chart_id  = $existingIp->id;
                $ipLog->country      = $countryName;
                $ipLog->advertise_id = $ad->id;
                $ipLog->ad_type      = $ad->ad_type;
                $ipLog->time         = Carbon::now()->toTimeString();
                $ipLog->save();
            }

            $advertiser->click_credit -= @$cost->cpc ?? gs('cpc');
            $advertiser->save();

            $publisher->earning += @$cost->epc ?? gs('epc');
            $publisher->save();

            $earningLog          = EarningLog::firstOrNew(['publisher_id' => $publisher->id, 'advertise_id' => $ad->id, 'date' => Carbon::now()->toDateString()]);
            $earningLog->amount += @$cost->epc ?? gs('epc');

            $earningLog->ad_type = $ad->ad_type;
            $earningLog->save();
        }

        $ad->clicked += 1;
        $ad->save();

        $analytic               = Analytic::firstOrNew(['country' => @$countryName, 'advertiser_id' => $ad->advertiser_id, 'advertise_id' => $ad->id]);
        $analytic->ad_title     = $ad->ad_title;
        $analytic->click_count += 1;
        $analytic->save();

        return redirect($ad->redirect_url);
    }

    /**
     * Returns a default advertisement when no suitable ad is found or certain checks fail.
     *
     * @param string $slug The ad type slug.
     * @param int $width The width of the ad.
     * @param int $height The height of the ad.
     * @param string $title The title to display on the ad.
     * @return string HTML for the default advertisement.
     */
    protected function defaultAd($slug, $width, $height, $title)
    {
        $logo = route('placeholder.image', $slug);
        return "<a href='" . url('/') . "' target='_blank'><img src='" . $logo . "' width='" . $width . "' height='" . $height . "'/></a><strong style='background-color:#e6e6e6;position:absolute;right:0;top:0;font-size: 10px;color: #666666; padding:4px; margin-right:15px;'>Ad by " . $title . "</strong><span onclick='hideAdverTiseMent(this)' style='position:absolute;right:0;top:0;width:15px;height:23px;background-color:#f00;font-size:15px;color:#fff;border-radius:1px;cursor:pointer;'>x</span>";
    }

    /**
     * Returns the HTML for displaying a randomly selected advertisement.
     * This method generates the ad's image, sets the redirection URL for clicks, 
     * and includes a small label indicating the advertisement is served by the site.
     *
     * @param string $redirectUrl The URL to redirect to when the ad is clicked.
     * @param string $adImage The URL of the ad image.
     * @param int $width The width of the ad.
     * @param int $height The height of the ad.
     * @param string $siteName The name of the site serving the ad.
     * @return string HTML for the selected advertisement.
     */
    public function randomAd($redirectUrl, $adImage, $width, $height, $siteName)
    {
        return "<a href='" . $redirectUrl . "' target='_blank'><img src='" . $adImage . "' width='" . $width . "' height='" . $height . "'/></a><strong style='background-color:#e6e6e6;position:absolute;right:0;top:0;font-size:10px;color:#666666;padding:4px; margin-right:15px;'>Ad by " . $siteName . "</strong><span onclick='hideAdverTiseMent(this)' style='position:absolute; right:0;top:0;width:15px;height:23px;background-color:#f00;font-size: 15px;color: #fff;border-radius:1px;cursor:pointer;'>x</span>";
    }

    /**
     * 
     * Detects the country based on the provided IP address using various services.
     * The method supports multiple services for IP-based country detection, such as:
     * - **ipstack**
     * - **proxycheck**
     * - **geoplugin**
     * - **cloudflare**
     *
     * @param string $ip The IP address to detect the country for.
     * @return stdClass An object containing the detection status and the country name.
     */

    public function countryDetector($ip)
    {
        $ipInfo               = new stdClass;
        $ipInfo->success      = false;
        $ipInfo->country_name = "";

        $config = gs('country_detector_config');

        if ($config->name == 'ipstack') {
            $query = json_decode(file_get_contents('http://api.ipstack.com/' .   $ip . '?access_key=' . $config->ipstack_api_key));
            if (@$query->error) {
                $ipInfo->success = false;
            } else {
                $ipInfo->success      = true;
                $ipInfo->country_name = $query->country_name;
            }
        } else if ($config->name == 'proxycheck') {

            $query = json_decode(CurlRequest::curlContent('https://proxycheck.io/v2/' . $ip . '?key=' .  $config->proxycheck_api_key . '&vpn=1&asn=1'));
            if (@$query->status  == "error") {
                $ipInfo->success = false;
            } else {
                $ipInfo->success      = true;
                $ipInfo->country_name = $query->{$ip}->country;
                if (@$query->{$ip}->proxy  == "yes") {
                    $ipInfo->proxy   = true;
                    $ipInfo->success = false;
                };
            }
        } else if ($config->name == 'geoplugin') {

            $query = json_decode(json_encode(getIpInfo()), true);

            if (!@implode(',', @$query['country'])) {
                $ipInfo->success = false;
            } else {
                $ipInfo->success      = true;
                $ipInfo->country_name = @implode(',', @$query['country']);
            }
        } else if ($config->name == 'cloudflare') {

            $country = @$_SERVER["HTTP_CF_IPCOUNTRY"];

            if (!$country) {
                $ipInfo->success = false;
            } else {
                $ipInfo->success      = true;
                $ipInfo->country_name = $country;
            }
        }

        return $ipInfo;
    }
}
