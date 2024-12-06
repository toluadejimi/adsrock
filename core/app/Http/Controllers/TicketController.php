<?php

namespace App\Http\Controllers;

use App\Traits\SupportTicketManager;

class TicketController extends Controller
{
    use SupportTicketManager;

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'frontend';
        $this->redirectLink = 'ticket.view';
        $this->userType     = 'publisher';
        $this->column       = 'publisher_id';
        
      if(auth()->guard('publisher')->check()){
            $this->userType     = 'publisher';
            $this->column       = 'publisher_id';
            $this->user = auth()->guard('publisher')->user();
        }else if(auth()->guard('advertiser')->check()){
            $this->userType     = 'advertiser';
            $this->column       = 'advertiser_id';
            $this->user = auth()->guard('advertiser')->user();
        }
        if ($this->user) {
            $this->layout = 'master';
        }
    }
}
