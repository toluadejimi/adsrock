<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Advertiser')->group(function () {
    Route::namespace('Auth')->middleware('advertiser.guest')->group(function () {
        Route::controller('LoginController')->group(function () {
            Route::get('/login', 'showLoginForm')->name('login');
            Route::post('/login', 'login')->name('login.submit');
            Route::get('logout', 'logout')->middleware('advertiser')->withoutMiddleware('advertiser.guest')->name('logout');
        });
        Route::controller('RegisterController')->group(function () {
            Route::get('register', 'showRegistrationForm')->name('register');
            Route::post('register', 'register');
            Route::post('check-user', 'checkUser')->name('checkUser')->withoutMiddleware('advertiser.guest');
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

    Route::get('advertiser-data', 'AdvertiserController@advertiserData')->name('data');
    Route::post('advertiser-data-submit', 'AdvertiserController@advertiserDataSubmit')->name('data.submit');


    //authorization
    Route::controller('AuthorizationController')->middleware('registration.complete:advertiser')->group(function () {
        Route::get('authorization', 'authorizeForm')->name('authorization');
        Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
        Route::post('verify-email', 'emailVerification')->name('verify.email');
        Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
    });

    Route::middleware(['check.status:advertiser', 'registration.complete:advertiser'])->group(function () {

        Route::controller('AdvertiserController')->group(function () {

            Route::get('dashboard', 'home')->name('dashboard');

            //Transactions
            Route::get('day-to-day/spent/logs/search', 'perDaySearch')->name('day.search');
            Route::get('date-to-date/spent/logs/search', 'perDateSearch')->name('date.search');

            Route::get('transaction/logs', 'trxLogs')->name('trx.logs');
            Route::get('transaction/search', 'trxSearch')->name('trx.search');

            //Report
            Route::any('deposit/history', 'depositHistory')->name('deposit.history');
            Route::get('transactions', 'transactions')->name('transactions');
            Route::get('attachment-download/{fil_hash}', 'downloadAttachment')->name('attachment.download');


            Route::post('add-device-token', 'addDeviceToken')->name('add.device.token');
        });

        //Profile setting
        Route::controller('ProfileController')->group(function () {
            Route::get('profile-setting', 'profile')->name('profile.setting');
            Route::post('profile-setting', 'submitProfile');
            Route::get('change-password', 'changePassword')->name('change.password');
            Route::post('change-password', 'submitPassword');
        });

        //advertise 
        Route::controller('AdController')->prefix('ad')->name('ad.')->group(function () {
            Route::get('all', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::get('ad-create/{id}', 'adCreate')->name('create.form');
            Route::post('store/{id?}', 'store')->name('store');
            Route::get('edit/{id?}', 'edit')->name('edit');
            Route::get('target-audience/{id?}', 'targetAudience')->name('target.audience');
            Route::post('target-audience-store/{id?}', 'targetAudienceStore')->name('target.audience.store');

            Route::post('status/{id?}', 'status')->name('status');
            Route::get('report/', 'report')->name('report');
            Route::get('details/{id}', 'details')->name('details');

            //price plans
            Route::get('price-plans', 'pricePlans')->name('price.plan');
            Route::get('purchase/plans/{id}', 'purchasePlan')->name('purchase.plan');
            Route::post('purchase/plans/', 'confirmPurchasePlan')->name('purchase.plan.confirm');
        });

        //Profile setting
        Route::controller('ProfileController')->group(function () {
            Route::get('profile-setting', 'profile')->name('profile.setting');
            Route::post('profile-setting', 'submitProfile');
            Route::get('change-password', 'changePassword')->name('change.password');
            Route::post('change-password', 'submitPassword');
        });
    });
});


// Payment
Route::middleware(['check.status:advertiser', 'registration.complete:advertiser'])->controller('Gateway\PaymentController')->prefix('deposit')->name('deposit.')->group(function () {
    Route::post('insert', 'depositInsert')->name('insert');
    Route::get('confirm', 'depositConfirm')->name('confirm');
    Route::get('manual', 'manualDepositConfirm')->name('manual.confirm');
    Route::post('manual', 'manualDepositUpdate')->name('manual.update');
    Route::any('index/{id?}', 'deposit')->name('index');
});
