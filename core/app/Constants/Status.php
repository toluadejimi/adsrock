<?php

namespace App\Constants;

class Status{

    const ENABLE = 1;
    const DISABLE = 0;

    const YES = 1;
    const NO = 0;

    const VERIFIED = 1;
    const UNVERIFIED = 0;

    const PAYMENT_INITIATE = 0;
    const PAYMENT_SUCCESS = 1;
    const PAYMENT_PENDING = 2;
    const PAYMENT_REJECT = 3;

    CONST TICKET_OPEN = 0;
    CONST TICKET_ANSWER = 1;
    CONST TICKET_REPLY = 2;
    CONST TICKET_CLOSE = 3;

    CONST PRIORITY_LOW = 1;
    CONST PRIORITY_MEDIUM = 2;
    CONST PRIORITY_HIGH = 3;

    const USER_ACTIVE = 1;
    const USER_BAN = 0;

    const KYC_UNVERIFIED = 0;
    const KYC_PENDING = 2;
    const KYC_VERIFIED = 1;

    const GOOGLE_PAY = 5001;

    const CUR_BOTH = 1;
    const CUR_TEXT = 2;
    const CUR_SYM = 3;


    const ADVERTISER_ACTIVE = 1;
    const ADVERTISER_BAN = 0;

    const PUBLISHER_ACTIVE = 1;
    const PUBLISHER_BAN = 0;

    const ACTIVE_ADVERTISE = 1;
    const INACTIVATE_ADVERTISE = 0;
    const PENDING_ADVERTISE = 2;

    const ACTIVE = 1;
    const DEACTIVE = 0;

    const WITHDRAW_SUCCESS = 1;

    const DOMAIN_UNVERIFIED = 0;
    const DOMAIN_PENDING = 2;
    const DOMAIN_VERIFIED = 1;

    const IP_NOT_BLOCKED = 0;
    const IP_BLOCKED = 1;
}
