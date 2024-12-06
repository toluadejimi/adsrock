<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\AdvertiserNotify;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Advertiser extends Authenticatable
{
    use AdvertiserNotify;

    protected $hidden = [
        'password', 'remember_token', 'balance', 'ver_code'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'ver_code_send_at' => 'datetime'
    ];

    public function ads()
    {
        return $this->hasMany(Advertise::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class, 'advertiser_id')->where('status', '!=', Status::DISABLE); //disable=deactive
    }

    public function login_logs()
    {
        return $this->hasMany(UserLogin::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'advertiser_id')->orderBy('id', 'desc');
    }

    public function analytics()
    {
        return $this->hasMany(Analytic::class);
    }

    public function tickets()
    {
        return $this->hasMany(SupportTicket::class, 'advertiser_id');
    }

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class, 'advertiser_id');
    }

    public function fullname(): Attribute
    {
        return new Attribute(
            get: fn () => $this->firstname . ' ' . $this->lastname,
        );
    }

    public function mobileNumber(): Attribute
    {
        return new Attribute(
            get: fn () => $this->dial_code . $this->mobile,
        );
    }



    // SCOPES
    public function scopeActive($query)
    {
        return $query->where('status', Status::ADVERTISER_ACTIVE)->where('ev', Status::VERIFIED)->where('sv', Status::VERIFIED);
    }

    public function scopeBanned($query)
    {
        return $query->where('status', Status::ADVERTISER_BAN);
    }

    public function scopeEmailUnverified($query)
    {
        return $query->where('ev', Status::UNVERIFIED);
    }

    public function scopeMobileUnverified($query)
    {
        return $query->where('sv', Status::UNVERIFIED);
    }

    public function scopeEmailVerified($query)
    {
        return $query->where('ev', Status::VERIFIED);
    }

    public function scopeMobileVerified($query)
    {
        return $query->where('sv', Status::VERIFIED);
    }
}
