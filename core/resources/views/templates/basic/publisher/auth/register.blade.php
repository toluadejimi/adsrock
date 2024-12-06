@extends($activeTemplate . 'layouts.app')
@section('panel')
    @php
        $policyPages = getContent('policy_pages.element', false, null, true);
    @endphp
    @if (gs('registration'))
        <section class="account">
            <div class="account-inner">
                <div class="account-inner__left">
                    <div class="account-form-wrapper">
                        <div class="text-center mb-5">
                            <a href="{{ route('home') }}" class="account-form__logo">
                                <img src="{{ siteLogo('dark') }} " alt="site_logo" />
                            </a>
                        </div>
                        @include($activeTemplate . 'partials.register_tab')
                        @include($activeTemplate . 'partials.social_login', [($register = true)])
                        <form action="{{ route('publisher.register') }}" class="verify-gcaptcha" method="post">
                            @csrf
                            <div class="account-form">
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label class="form--label">@lang('First Name')</label>
                                        <input type="text" name="firstname" class="form--control"
                                            placeholder="@lang('First Name')" required />
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form--label">@lang('Last Name')</label>
                                        <input type="text" name="lastname" class="form--control"
                                            placeholder="@lang('Last Name')" required />
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label class="form--label">@lang('Email') </label>
                                        <input type="email" class="form--control checkUser"
                                            placeholder="@lang('Email')" name="email" required />
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form--label">@lang('Password')</label>
                                        <div class="position-relative">
                                            <span class="password-show-hide fas fa-eye-slash toggle-password"></span>
                                            <input type="password" name="password" placeholder="@lang('Password')"
                                                class="form--control form-three  @if (gs('secure_password')) secure-password @endif"
                                                value="" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form--label">@lang('Confirm Password')</label>
                                        <div class="position-relative">
                                            <span class="password-show-hide fas fa-eye-slash toggle-password"></span>
                                            <input type="password" name="password_confirmation"
                                                placeholder="@lang('Confrim Password')" class="form--control form-three"
                                                required />
                                        </div>
                                    </div>

                                    @if (gs('agree'))
                                        @php
                                            $policyPages = getContent('policy_pages.element', false, orderById: true);
                                        @endphp
                                        <div class="form--check form-group">
                                            <input class="form-check-input" type="checkbox" name="agree"
                                                @checked(old('agree')) id="agree" />
                                            <label class="form-check-label check-label-two" for="agree">
                                                @lang('I agree with') @foreach ($policyPages as $policy)
                                                    <a href="{{ route('policy.pages', $policy->slug) }}" class="link"
                                                        target="_blank">{{ __($policy->data_values->title) }}</a>
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </label>
                                        </div>
                                    @endif
                                    @php $placeholder = true @endphp
                                    <x-captcha :placeholder='$placeholder' />
                                    <div class="col-sm-12 form-group">
                                        <button type="submit" class="btn btn--base w-100">
                                            @lang('Register')
                                        </button>
                                    </div>
                                    <div class="col-sm-12">
                                        @lang('Already have an account')?
                                        <a href="{{ route('publisher.login') }}" class="have-account__link text--base">
                                            @lang('Login')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @include($activeTemplate . 'partials.auth_section')
            </div>
        </section>

        <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                        <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </span>
                    </div>
                    <div class="modal-body">
                        <h6 class="text-center">@lang('You already have an account please Login ')</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark btn--sm" data-bs-dismiss="modal">
                            @lang('Close')
                        </button>
                        <a href="{{ route('publisher.login') }}" class="btn btn--base btn--sm">@lang('Login')</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include($activeTemplate . 'partials.registration_disabled')
    @endif
@endsection

@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('script')
    <script>
        "use strict";
        (function($) {
            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('publisher.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';

                var data = {
                    email: value,
                    _token: token
                }

                $.post(url, data, function(response) {
                    if (response.data != false) {
                        $('#existModalCenter').modal('show');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
