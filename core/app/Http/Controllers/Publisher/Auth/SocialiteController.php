<?php

namespace App\Http\Controllers\Publisher\Auth;

use App\Http\Controllers\Controller;
use App\Lib\SocialLogin;

class SocialiteController extends Controller
{


    public function socialLogin($provider)
    {   
        $userType = 'publisher';

        $socialLogin = new SocialLogin($provider, $userType );
        return $socialLogin->redirectDriver();
    }


    public function callback($provider)
    {
        $userType = 'publisher';
        $socialLogin = new SocialLogin($provider,$userType );
        try {
            return $socialLogin->login();
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return to_route('home')->withNotify($notify);
        }
    }
}
