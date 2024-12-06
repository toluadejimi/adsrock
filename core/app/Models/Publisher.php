<?php


namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Constants\Status;
use App\Traits\PublisherNotify;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Publisher extends Authenticatable
{
   use PublisherNotify;

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'ver_code_send_at' => 'datetime',
        'kyc_data'=>'object'
    ];

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class, 'publisher_id')->where('status', '!=', Status::DISABLE); //disable=deactive
    }
    public  function transactions()
    {
        return $this->hasMany(Transaction::class, 'publisher_id')->orderBy('id', 'desc');
    }
    public function login_logs()
    {
        return $this->hasMany(UserLogin::class, 'publisher_id');
    }

  

    
    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }


    public function domain()
    {
        return $this->hasMany(Domain::class);
    }

    public function tickets()
    {
        return $this->hasMany(SupportTicket::class);
    }


    public function scopeSmsUnverified()
    {
        return $this->where('sv', 0);
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
        return $query->where('status', Status::PUBLISHER_ACTIVE)->where('ev', Status::VERIFIED)->where('sv', Status::VERIFIED);
    }

    public function scopeBanned($query)
    {
        return $query->where('status', Status::PUBLISHER_BAN);
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

    public function scopeKycUnverified($query)
    {
        return $query->where('kv', Status::KYC_UNVERIFIED);
    }

    public function scopeKycPending($query)
    {
        return $query->where('kv', Status::KYC_PENDING);
    }
}
