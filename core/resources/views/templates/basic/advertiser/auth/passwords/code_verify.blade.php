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
                        <p class="account-form__text">@lang('A 6 digit verification code sent to your email address') : {{ showEmailAddress($email) }}</p>
                    </div>

                    <div class="verification-code-wrapper">
                        <div class="verification-area">
                            <form action="{{ route('advertiser.password.verify.code') }}" method="POST"
                                class="submit-form">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                @include($activeTemplate . 'partials.verification_code')
                                <div class="form-group">
                                    <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                                </div>
                                <div class="form-group">
                                    @lang('Please check including your Junk/Spam Folder. if not found, you can')
                                    <a href="{{ route('advertiser.password.request') }}">@lang('Try to send again')</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include($activeTemplate . 'partials.auth_section')
        </div>
    </section>
@endsection
