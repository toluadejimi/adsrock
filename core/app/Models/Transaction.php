<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
 

    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }


}
