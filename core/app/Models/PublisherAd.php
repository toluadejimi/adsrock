<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PublisherAd extends Model
{

    protected $guarded = ['id'];
    public function advertise()
    {
        return $this->belongsTo(Advertise::class);
    }
}
