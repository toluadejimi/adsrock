<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalStatus;

use Illuminate\Database\Eloquent\Casts\Attribute;

class PlanPrice extends Model
{
    use GlobalStatus;

    public function advertiser()
    {
        return $this->belongsToMany(Advertiser::class, 'advertiser_plans');
    }

    public function typeBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->type == "impression") {
                $html = '<span class="badge badge--warning">' . trans("Impression") . '</span>';
            } elseif ($this->type == "click") {
                $html = '<span class="badge badge--primary">' . trans("Click") . '</span>';
            }
            return $html;
        });
    }
}
