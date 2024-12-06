<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class IpChart extends Model
{
 

    public function iplogs()
    {
        return $this->hasMany(IpLog::class);
    }
}
