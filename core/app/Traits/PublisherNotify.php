<?php
namespace App\Traits;

use App\Constants\Status;

trait PublisherNotify
{
    public static function notifyToPublisher(){
        return [
            'allPublishers'              => 'All Publishers',
            'selectedPublishers'         => 'Selected Publishers',
            'kycUnverified'         => 'Kyc Unverified Publishers',
            'kycPending'            => 'Kyc Pending Publishers',
            'twoFaDisablePublishers'     => '2FA Disable Publisher',
            'twoFaEnablePublishers'      => '2FA Enable Publisher',
            'hasWithdrawPublishers'      => 'Withdraw Publishers',
            'pendingWithdrawPublishers'  => 'Pending Withdraw Publishers',
            'rejectedWithdrawPublishers' => 'Rejected Withdraw Publishers',
            'pendingTicketPublisher'     => 'Pending Ticket Publishers',
            'answerTicketPublisher'      => 'Answer Ticket Publishers',
            'closedTicketPublisher'      => 'Closed Ticket Publishers',
            'notLoginPublishers'         => 'Last Few Days Not Login Publishers',
        ];
    }

    public function scopeSelectedPublishers($query)
    {
        return $query->whereIn('id', request()->publisher ?? []);
    }

    public function scopeAllPublishers($query)
    {
        return $query;
    }


    public function scopeTwoFaDisablePublishers($query)
    {
        return $query->where('ts', Status::DISABLE);
    }

    public function scopeTwoFaEnablePublishers($query)
    {
        return $query->where('ts', Status::ENABLE);
    }


    public function scopeHasWithdrawPublishers($query)
    {
        return $query->whereHas('withdrawals', function ($q) {
            $q->approved();
        });
    }

    public function scopePendingWithdrawPublishers($query)
    {
        return $query->whereHas('withdrawals', function ($q) {
            $q->pending();
        });
    }

    public function scopeRejectedWithdrawPublishers($query)
    {
        return $query->whereHas('withdrawals', function ($q) {
            $q->rejected();
        });
    }

    public function scopePendingTicketPublisher($query)
    {
        return $query->whereHas('tickets', function ($q) {
            $q->whereIn('status', [Status::TICKET_OPEN, Status::TICKET_REPLY]);
        });
    }

    public function scopeClosedTicketPublisher($query)
    {
        return $query->whereHas('tickets', function ($q) {
            $q->where('status', Status::TICKET_CLOSE);
        });
    }

    public function scopeAnswerTicketPublisher($query)
    {
        return $query->whereHas('tickets', function ($q) {

            $q->where('status', Status::TICKET_ANSWER);
        });
    }

    public function scopeNotLoginPublishers($query)
    {
        return $query->whereDoesntHave('loginLogs', function ($q) {
            $q->whereDate('created_at', '>=', now()->subDays(request()->number_of_days ?? 10));
        });
    }



}
