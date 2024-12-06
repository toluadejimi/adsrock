<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{


 
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }
    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class, 'advertiser_id');
    }
}
