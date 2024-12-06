<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EarningLog extends Model
{
   
    protected $guarded = ['id'];
    public function advertise()
    {
        return $this->belongsTo(Advertise::class);
    }
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
