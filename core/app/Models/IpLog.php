<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpLog extends Model
{
   

    public function advertise()
    {
        return $this->belongsTo(Advertise::class);
    }
   
    public function ipChart()
    {
        return $this->belongsTo(IpChart::class);
    }
}
