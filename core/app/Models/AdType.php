<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Constants\Status;
use App\Traits\GlobalStatus;

class AdType extends Model
{
    use GlobalStatus;

    public function advertises()
    {
        return $this->hasMany(Advertise::class, 'ad_type_id');
    }

    public function scopeEnable($query)
    {
        return $query->where('status', Status::ENABLE);
    }
}
