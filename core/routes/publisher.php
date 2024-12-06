<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Auth')->group(function () {

    Route::middleware('publisher.guest')->group(function () {
        Route::controller('LoginController')->group(function () {
            Route::get('/login', 'showLoginForm')->name('login');
            Route::post('/login', 'login')->name('login.submit');
            Route::get('logout', 'logout')->middleware('publisher')->withoutMiddleware('publisher.guest')->name('logout');
        });

        Route::controller('RegisterController')->group(function () {
            Route::get('register', 'showRegistrationForm')->name('register');
            Route::post('register', 'register');
            Route::post('check-user', 'checkUser')->name('checkUser')->withoutMiddleware('publisher.guest');
        });

        Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function () {
            Route::get('reset', 'showLinkRequestForm')->name('request');
            Route::post('email', 'sendResetCodeEmail')->name('email');
            Route::get('code-verify', 'codeVerify')->name('code.verify');
            Route::post('verify-code', 'verifyCode')->name('verify.code');
        });
        Route::controller('ResetPasswordController')->group(function () {
            Route::post('password/reset', 'reset')->name('password.update');
            Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
        });

        Route::controller('SocialiteController')->group(function () {
            Route::get('social-login/{provider}', 'socialLogin')->name('social.login');
            Route::get('social-login/callback/{provider}', 'callback')->name('social.login.callback');
        });
    });
});


Route::middleware(['check.status:publisher', 'registration.complete:publisher'])->group(function () {

    Route::controller('PublisherController')->group(function () {
        Route::get('dashboard', 'home')->name('dashboard');

        //report
        Route::get('report/day-to-day', 'perDay')->name('report.perDay');
        Route::get('ad/report/', 'adReport')->name('report.ad');

        //2FA
        Route::get('twofactor', 'show2faForm')->name('twofactor');
        Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
        Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

        //KYC
        Route::get('kyc-form', 'kycForm')->name('kyc.form');
        Route::get('kyc-data', 'kycData')->name('kyc.data');
        Route::post('kyc-submit', 'kycSubmit')->name('kyc.submit');

        //Report
        Route::any('deposit/history', 'depositHistory')->name('deposit.history');
        Route::get('transactions', 'transactions')->name('transactions');

        Route::get('attachment-download/{fil_hash}', 'downloadAttachment')->name('attachment.download');

        Route::post('add-device-token', 'addDeviceToken')->name('add.device.token');
    });


    Route::controller('DomainController')->name('domain.')->prefix('domain')->group(function(){
        Route::get('/', 'all')->name('all');
        Route::post('store/{id?}', 'storeDomainVerify')->name('verify.store');
        Route::post('remove/{tracker}', 'domainRemove')->name('remove');
        Route::get('{tracker}/verification', 'domainVerifyAct')->name('verify.action');
        Route::get('check/{tracker}', 'domainCheck')->name('check');
    });

    //Advertise Manage
    Route::controller('AdvertiseController')->group(function () {
        Route::get('advertisements', 'advertise')->name('advertises');
        Route::get('published/ads', 'publishedAd')->name('published.ad');
        Route::get('published/ads/details/{id}', 'details')->name('published.ad.details');
    });

    //Profile setting
    Route::controller('ProfileController')->group(function () {
        Route::get('profile-setting', 'profile')->name('profile.setting');
        Route::post('profile-setting', 'submitProfile');
        Route::get('change-password', 'changePassword')->name('change.password');
        Route::post('change-password', 'submitPassword');
    });


    // Withdraw
    Route::controller('WithdrawController')->prefix('withdraw')->name('withdraw.')->group(function () {
        Route::middleware('kyc')->group(function () {
            Route::get('/', 'withdrawMoney')->name('money');
            Route::post('/', 'withdrawStore')->name('money');
            Route::get('preview', 'withdrawPreview')->name('preview');
            Route::post('preview', 'withdrawSubmit')->name('submit');
        });
        Route::get('history', 'withdrawLog')->name('history');
    });
});



Route::get('publisher-data', 'PublisherController@publisherData')->name('data');
Route::post('publisher-data-submit', 'PublisherController@publisherDataSubmit')->name('data.submit');


Route::controller('AuthorizationController')->middleware(['registration.complete:publisher'])->group(function () {
    Route::get('authorization', 'authorizeForm')->name('authorization');
    Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
    Route::post('verify-email', 'emailVerification')->name('verify.email');
    Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
    Route::post('verify-g2fa', 'g2faVerification')->name('2fa.verify');
});
