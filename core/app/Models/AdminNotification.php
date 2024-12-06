<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }
   
}
