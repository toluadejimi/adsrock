<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use GlobalStatus;    

    public function advertises()
    {
        return $this->belongsToMany(Advertise::class, 'advertise_country','country_id');
    }

    public function cost(){
        return $this->hasOne(Cost::class);
    }

}
