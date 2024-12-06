@extends($activeTemplate . 'layouts.app')
@section('panel')
    <section class="account">
        <div class="account-inner">
            <div class="account-inner__left">
                <div class="account-form-wrapper">
                    <div class="text-center">
                        <a href="{{ route('home') }}" class="account-form__logo">
                            <img src="{{ siteLogo('dark') }}" alt="site_logo" />
                        </a>
                        <p class="account-form__text">@lang('To recover your account please provide your email or username
                                                                                                to find your account.')</p>
                    </div>

                    <form method="POST" action="{{ route('advertiser.password.email') }}" class="verify-gcaptcha">
                        @csrf
                        <div class="account-form">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label class="form--label">@lang('Email or Username')</label>
                                    <input type="text" class=" form--control" name="value" value="{{ old('value') }}"
                                        placeholder="@lang('Email or Username')" required autofocus="off">
                                </div>
                                @php
                                    $placeholder = true;
                                @endphp
                                <x-captcha :placeholder='$placeholder' />
                                <div class="form-group">
                                    <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            @include($activeTemplate . 'partials.auth_section')
        </div>
    </section>
@endsection
