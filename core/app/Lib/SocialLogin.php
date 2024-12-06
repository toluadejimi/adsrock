<?php

namespace App\Lib;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\Advertiser;
use App\Models\Publisher;
use App\Models\UserLogin;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Socialite;

class SocialLogin
{
    private $provider;
    private $userType;
    private $fromApi;

    public function __construct($provider, $userType, $fromApi = false)
    {
        $this->provider = $provider;
        $this->userType = $userType;
        $this->fromApi = $fromApi;
        $this->configuration();
    }

    public function redirectDriver()
    {
        return Socialite::driver($this->provider)->redirect();
    }

    private function configuration()
    {
        $provider      = $this->provider;
        $configuration = gs('socialite_credentials')->$provider;
        $provider    = $this->fromApi && $provider == 'linkedin' ? 'linkedin-openid' : $provider;

        Config::set('services.' . $provider, [
            'client_id'     => $configuration->client_id,
            'client_secret' => $configuration->client_secret,
            'redirect'      => route($this->userType . '.social.login.callback', $provider),
        ]);
    }

    public function login()
    {
        $provider      = $this->provider;
        $provider    = $this->fromApi && $provider == 'linkedin' ? 'linkedin-openid' : $provider;
        $driver     = Socialite::driver($provider);
        if ($this->fromApi) {
            try {
                $user = (object)$driver->userFromToken(request()->token)->user;
            } catch (\Throwable $th) {
                throw new Exception('Something went wrong');
            }
        } else {
            $user = $driver->user();
        }

        if ($provider == 'linkedin-openid') {
            $user->id = $user->sub;
        }

        if ($this->userType == 'publisher') {

            $userData = Publisher::where('provider_id', $user->id)->first();
        } else {
            $userData = Advertiser::where('provider_id', $user->id)->first();
        }

        if (!$userData) {
            if (!gs('registration') || !gs('ad_registration')) {
                throw new Exception('New account registration is currently disabled');
            }
            if ($this->userType == 'publisher') {
                $emailExists = Publisher::where('email', @$user->email)->exists();
            } else {
                $emailExists = Advertiser::where('email', @$user->email)->exists();
            }

            if ($emailExists) {
                throw new Exception('Email already exists');
            }

            $userData = $this->createUser($user, $this->provider);
        }
        if ($this->fromApi) {
            $tokenResult = $userData->createToken('auth_token')->plainTextToken;
            $this->loginLog($userData);
            return [
                'user'         => $userData,
                'access_token' => $tokenResult,
                'token_type'   => 'Bearer',
            ];
        }
        Auth::guard($this->userType)->login($userData);
        $this->loginLog($userData);
        $redirection = Intended::getRedirection();
        return $redirection ? $redirection : to_route($this->userType . '.dashboard');
    }

    private function createUser($user, $provider)
    {

        $password = getTrx(8);

        $firstName = null;
        $lastName = null;

        if (@$user->first_name) {
            $firstName = $user->first_name;
        }
        if (@$user->last_name) {
            $lastName = $user->last_name;
        }

        if ((!$firstName || !$lastName) && @$user->name) {
            $firstName = preg_replace('/\W\w+\s*(\W*)$/', '$1', $user->name);
            $pieces    = explode(' ', $user->name);
            $lastName  = array_pop($pieces);
        }

        if ($this->userType == 'publisher') {
            $newUser  = new Publisher();
            $user->kv = gs('kv') ? Status::NO : Status::YES;
        } else {
            $newUser = new Advertiser();
        }


        $newUser->provider_id = $user->id;

        $newUser->email = $user->email;

        $newUser->password = Hash::make($password);
        $newUser->firstname = $firstName;
        $newUser->lastname = $lastName;


        $newUser->status = Status::VERIFIED;

        $newUser->ev = Status::VERIFIED;
        $newUser->sv = gs('sv') ? Status::UNVERIFIED : Status::VERIFIED;
        $newUser->provider = $provider;
        $newUser->save();

        $adminNotification = new AdminNotification();

        if ($this->userType == "publisher") {
            $adminNotification->publisher_id = $newUser->id;
        } else {

            $adminNotification->advertiser_id = $newUser->id;
        }
        $adminNotification->title = 'New member registered';
        $adminNotification->click_url = urlPath("admin." . $this->userType . ".detail", $newUser->id);
        $adminNotification->save();

        $user = $this->userType == 'publisher' ? Publisher::find($newUser->id) : Advertiser::find($newUser->id);

        return $user;
    }

    private function loginLog($user)
    {
        //Login Log Create
        $ip = getRealIP();
        $exist = UserLogin::where('user_ip', $ip)->first();
        $userLogin = new UserLogin();

        //Check exist or not
        if ($exist) {
            $userLogin->longitude =  $exist->longitude;
            $userLogin->latitude =  $exist->latitude;
            $userLogin->city =  $exist->city;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country =  $exist->country;
        } else {
            $info = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude =  @implode(',', $info['long']);
            $userLogin->latitude =  @implode(',', $info['lat']);
            $userLogin->city =  @implode(',', $info['city']);
            $userLogin->country_code = @implode(',', $info['code']);
            $userLogin->country =  @implode(',', $info['country']);
        }

        $userAgent = osBrowser();
        if ($this->userType == "publisher") {
            $userLogin->publisher_id = $user->id;
        } else {

            $userLogin->advertiser_id = $user->id;
        }

        $userLogin->user_ip =  $ip;

        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os = @$userAgent['os_platform'];
        $userLogin->save();
    }
}
