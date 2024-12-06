<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertiserPasswordReset extends Model
{
    protected $table = "advertiser_password_resets";
    protected $guarded = ['id'];
    public $timestamps = false;
}
