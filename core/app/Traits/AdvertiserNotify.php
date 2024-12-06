<?php
namespace App\Traits;

use App\Constants\Status;

trait AdvertiserNotify
{
    public static function notifyToAdvertiser(){
        return [
            'allAdvertisers'              => 'All Advertisers',
            'selectedAdvertisers'         => 'Selected Advertisers',
            'withBalance'           => 'With Balance Advertisers',
            'emptyBalanceAdvertisers'     => 'Empty Balance Advertisers',
            'twoFaDisableAdvertisers'     => '2FA Disable User',
            'twoFaEnableAdvertisers'      => '2FA Enable User',
            'hasDepositedAdvertisers'       => 'Deposited Advertisers',
            'notDepositedAdvertisers'       => 'Not Deposited Advertisers',
            'pendingDepositedAdvertisers'   => 'Pending Deposited Advertisers',
            'rejectedDepositedAdvertisers'  => 'Rejected Deposited Advertisers',
            'topDepositedAdvertisers'     => 'Top Deposited Advertisers',
            'hasWithdrawAdvertisers'      => 'Withdraw Advertisers',
            'pendingWithdrawAdvertisers'  => 'Pending Withdraw Advertisers',
            'rejectedWithdrawAdvertisers' => 'Rejected Withdraw Advertisers',
            'pendingTicketUser'     => 'Pending Ticket Advertisers',
            'answerTicketUser'      => 'Answer Ticket Advertisers',
            'closedTicketUser'      => 'Closed Ticket Advertisers',
            'notLoginAdvertisers'         => 'Last Few Days Not Login Advertisers',
        ];
    }

    public function scopeSelectedAdvertisers($query)
    {
        return $query->whereIn('id', request()->user ?? []);
    }

    public function scopeAllAdvertisers($query)
    {
        return $query;
    }

    public function scopeEmptyBalanceAdvertisers($query)
    {
        return $query->where('balance', '<=', 0);
    }

    public function scopeTwoFaDisableAdvertisers($query)
    {
        return $query->where('ts', Status::DISABLE);
    }

    public function scopeTwoFaEnableAdvertisers($query)
    {
        return $query->where('ts', Status::ENABLE);
    }

    public function scopeHasDepositedAdvertisers($query)
    {
        return $query->whereHas('deposits', function ($deposit) {
            $deposit->successful();
        });
    }

    public function scopeNotDepositedAdvertisers($query)
    {
        return $query->whereDoesntHave('deposits', function ($q) {
            $q->successful();
        });
    }

    public function scopePendingDepositedAdvertisers($query)
    {
        return $query->whereHas('deposits', function ($deposit) {
            $deposit->pending();
        });
    }

    public function scopeRejectedDepositedAdvertisers($query)
    {
        return $query->whereHas('deposits', function ($deposit) {
            $deposit->rejected();
        });
    }

    public function scopeTopDepositedAdvertisers($query)
    {
        return $query->whereHas('deposits', function ($deposit) {
            $deposit->successful();
        })->withSum(['deposits'=>function($q){
            $q->successful();
        }], 'amount')->orderBy('deposits_sum_amount', 'desc')->take(request()->number_of_top_deposited_user ?? 10);
    }

    public function scopeHasWithdrawAdvertisers($query)
    {
        return $query->whereHas('withdrawals', function ($q) {
            $q->approved();
        });
    }

    public function scopePendingWithdrawAdvertisers($query)
    {
        return $query->whereHas('withdrawals', function ($q) {
            $q->pending();
        });
    }

    public function scopeRejectedWithdrawAdvertisers($query)
    {
        return $query->whereHas('withdrawals', function ($q) {
            $q->rejected();
        });
    }

    public function scopePendingTicketAdvertiser($query)
    {
        return $query->whereHas('tickets', function ($q) {
            $q->whereIn('status', [Status::TICKET_OPEN, Status::TICKET_REPLY]);
        });
    }

    public function scopeClosedTicketAdvertiser($query)
    {
        return $query->whereHas('tickets', function ($q) {
            $q->where('status', Status::TICKET_CLOSE);
        });
    }

    public function scopeAnswerTicketAdvertiser($query)
    {
        return $query->whereHas('tickets', function ($q) {

            $q->where('status', Status::TICKET_ANSWER);
        });
    }

    public function scopeNotLoginAdvertisers($query)
    {
        return $query->whereDoesntHave('loginLogs', function ($q) {
            $q->whereDate('created_at', '>=', now()->subDays(request()->number_of_days ?? 10));
        });
    }

 

}
