@extends($activeTemplate . 'layouts.app')
@section('panel')
    @php
        $content = getContent('login.content', true);
        $authContent = getContent('auth.content', true);
    @endphp
    <section class="account">
        <div class="account-inner">
            <div class="account-inner__left">
                <div class="account-form-wrapper">
                    <div class="text-center mb-5">
                        <a href="{{ route('home') }}" class="account-form__logo">
                            <img src="{{ siteLogo('dark') }}" alt="site_logo" />
                        </a>
                    </div>
                    @include($activeTemplate . 'partials.login_tab')
                    @include($activeTemplate . 'partials.social_login')
                    <form class="verify-gcaptcha w-100" method="post">
                        @csrf
                        <div class="account-form">
                            <div class="form-group">
                                <label class="form--label">@lang('Username')</label>
                                <input type="text" class="form--control" placeholder="@lang('Username')" name="username"
                                    required />
                            </div>
                            <div class="form-group">
                                <label class="form--label">@lang('Password')</label>
                                <input type="password" name="password" class="form--control form-three"
                                    placeholder="@lang('Password')" required />
                            </div>
                            <div class="capctha">
                                @php $placeholder = true; @endphp
                                <x-captcha :placeholder='$placeholder' />
                            </div>
                            <div class="form-group d-flex justify-content-between gap-2 align-content-center">
                                <div class="form--check mb-0">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }} />
                                    <label class="form-check-label check-label-two" for="remember">
                                        @lang('Remember Me')</label>
                                </div>
                                <a href="{{ route('advertiser.password.request') }}" class="text--danger">@lang('Forgot Password')?
                                </a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn--base w-100">
                                    @lang('Login')
                                </button>
                            </div>
                            <div class="form-group">
                                @lang("Don't have an account")?
                                <a href="{{ route('advertiser.register') }}" class="have-account__link text--base">
                                    @lang('Register Here')
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @include($activeTemplate . 'partials.auth_section')
        </div>
    </section>
@endsection
