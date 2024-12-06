@php
    $userType = isset($userType) ? 'advertiser' : 'publisher';
@endphp
<div class="d-flex gap-3 mb-4 flex-wrap w-100">
    @if (@gs('socialite_credentials')->google->status == Status::ENABLE)
        <div class="continue-google flex-grow-1">
            <a href="{{ route($userType . '.social.login', 'google') }}" class="btn w-100 social-login-btn">
                <span class="google-icon">
                    <img src="{{ asset($activeTemplateTrue . 'images/google.svg') }}" alt="Google">
                </span> @lang('Google')
            </a>
        </div>
    @endif
    @if (@gs('socialite_credentials')->facebook->status == Status::ENABLE)
        <div class="continue-facebook flex-grow-1">
            <a href="{{ route($userType . '.social.login', 'facebook') }}" class="btn w-100 social-login-btn">
                <span class="facebook-icon">
                    <img src="{{ asset($activeTemplateTrue . 'images/facebook.svg') }}" alt="Facebook">
                </span> @lang('Facebook')
            </a>
        </div>
    @endif
    @if (@gs('socialite_credentials')->linkedin->status == Status::ENABLE)
        <div class="continue-facebook flex-grow-1">
            <a href="{{ route($userType . '.social.login', 'linkedin') }}" class="btn w-100 social-login-btn">
                <span class="facebook-icon">
                    <img src="{{ asset($activeTemplateTrue . 'images/linkdin.svg') }}" alt="Linkedin">
                </span> @lang('Linkedin')
            </a>
        </div>
    @endif
</div>

@if (
    @gs('socialite_credentials')->linkedin->status ||
        @gs('socialite_credentials')->facebook->status == Status::ENABLE ||
        @gs('socialite_credentials')->google->status == Status::ENABLE)
    <div class="text-center mb-4 w-100 another-login">
        <span class="another-login__or">@lang('OR')</span>
    </div>
@endif
@push('style')
    <style>
        .social-login-btn {
            border: 1px solid #cbc4c4;
        }

        .another-login {
            position: relative;
            z-index: 1;
        }

        .another-login__or {
            background-color: hsl(var(--white));
            padding: 0 7px;
        }

        .another-login::after {
            position: absolute;
            content: '';
            top: 50%;
            left: 0;
            width: 100%;
            border-bottom: 1px dashed hsl(var(--black)/.2);
            z-index: -1;
        }
    </style>
@endpush
