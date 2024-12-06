<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
   
    
     protected $guarded = ['id'];


    public function scopeIncrease()
    {
        return $this->count += 1;
    }

    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }

    public function advertise()
    {
        return $this->belongsTo(Advertise::class);
    }
}
