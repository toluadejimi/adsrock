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
                        <p class="account-form__text">@lang('Your account is verified successfully. Now you can change your
                                                password. Please enter a strong password and don\'t share it with anyone.')</p>
                    </div>

                    <form method="POST" action="{{ route('advertiser.password.update') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="account-form">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label class="form-label">@lang('Password')</label>
                                    <input type="password"
                                        class="form-control form--control @if (gs('secure_password')) secure-password @endif"
                                        name="password" required placeholder="@lang('Password')">
                                </div>
                                <div class="col-sm-12  form-group">
                                    <label class="form-label">@lang('Confirm Password')</label>
                                    <input type="password" class="form-control form--control"
                                        placeholder="@lang('Confrim Passwird')" name="password_confirmation" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn--base w-100"> @lang('Submit')</button>
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

@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
