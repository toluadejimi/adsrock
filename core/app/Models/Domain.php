<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Domain extends Model
{

    protected $casts = [
        'keywords' => 'object'
    ];

    public function statusBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->status == Status::DOMAIN_VERIFIED) {
                $html = '<span class="badge badge--success">' . trans("Verified") . '</span>';
            } elseif ($this->status == Status::DOMAIN_PENDING) {
                $html = '<span class="badge badge--warning">' . trans("Pending") . '</span>';
            } elseif ($this->status == Status::DOMAIN_UNVERIFIED) {
                $html = '<span class="badge badge--danger">' . trans("Unverified") . '</span>';
            }
            return $html;
        });
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
    public function scopePending($query)
    {
        return $query->where('status', Status::DOMAIN_PENDING);
    }
}
