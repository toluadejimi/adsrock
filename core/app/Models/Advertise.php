<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Advertise extends Model
{
    use GlobalStatus;

    protected $casts = [
        'keywords' => 'object'
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'advertise_country', 'advertise_id');
    }

    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }

    public function type()
    {
        return $this->belongsTo(AdType::class, 'ad_type_id');
    }

    public function publishers()
    {
        return $this->belongsToMany(Publisher::class, 'publisher_ads');
    }

    public function analytic()
    {
        return $this->hasMany(Analytic::class, 'advertise_id');
    }

    public function scopeAd($adType)
    {
        return $this->where('ad_type_id', $adType)->where("status", Status::ENABLE)->where("global", Status::YES)->inRandomOrder()->first();
    }

    public function publisherAd()
    {
        return $this->hasMany(PublisherAd::class, 'advertise_id');
    }


    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE_ADVERTISE);
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->status == Status::ACTIVE_ADVERTISE) {
                $html = '<span class="badge badge--success">' . trans("Active") . '</span>';
            } elseif ($this->status == Status::INACTIVATE_ADVERTISE) {
                $html = '<span class="badge badge--danger">' . trans("InActive") . '</span>';
            } elseif ($this->status == Status::PENDING_ADVERTISE) {
                $html = '<span class="badge badge--warning">' . trans("Pending") . '</span>';
            }
            return $html;
        });
    }

    public function typeBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->ad_type == "impression") {
                $html = '<span class="badge badge--warning">' . trans("Impression") . '</span>';
            } elseif ($this->ad_type == "click") {
                $html = '<span class="badge badge--primary">' . trans("Click") . '</span>';
            }
            return $html;
        });
    }
}
