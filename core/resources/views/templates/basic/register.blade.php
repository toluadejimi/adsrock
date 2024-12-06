@extends($activeTemplate . 'layouts.app')


@section('panel')
@php
$content = getContent('register.content', true);
$authContent = getContent('auth.content', true);
$policyPages = getContent('policy_pages.element', false, null, true);
@endphp


<section class="account">
    <div class="account-inner">
        <div class="account-inner__left">
            <div class="account-form-wrapper">
                <div class="text-center">
                    <a href="{{route('home')}}" class="account-form__logo">
                        <img src="{{siteLogo('dark')}} " alt="image" >
                    </a>
                    <p class="account-form__text">
                        {{__(@$content->data_values->title)}}
                    </p>
                </div>

                <div class="account-form-wrapper__tab">
                    <ul class="nav nav-pills custom--tab account-tab" id="pills-tab" role="tablist">
                        <li class="item-bg"></li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link navBtn" data-type="publisher" id="pills-publisher-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-publisher" type="button" role="tab"
                                aria-controls="pills-publisher" aria-selected="false">
                                @lang('Publisher')
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link navBtn active" data-type="advertiser" id="pills-advertis-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-advertis" type="button" role="tab"
                                aria-controls="pills-advertis" aria-selected="true">
                                @lang('Advertisers')
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContent">


                    <div class="tab-pane fade @if (!gs('registration')) form-disabled  @endif" id="pills-publisher" role="tabpanel"
                        aria-labelledby="pills-publisher-tab" tabindex="0">

                        @if (!gs('registration'))
                        <span class="form-disabled-text">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80" x="0" y="0"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                                xml:space="preserve" class="">
                                <g>
                                    <path
                                        d="M255.999 0c-79.044 0-143.352 64.308-143.352 143.353v70.193c0 4.78 3.879 8.656 8.659 8.656h48.057a8.657 8.657 0 0 0 8.656-8.656v-70.193c0-42.998 34.981-77.98 77.979-77.98s77.979 34.982 77.979 77.98v70.193c0 4.78 3.88 8.656 8.661 8.656h48.057a8.657 8.657 0 0 0 8.656-8.656v-70.193C399.352 64.308 335.044 0 255.999 0zM382.04 204.89h-30.748v-61.537c0-52.544-42.748-95.292-95.291-95.292s-95.291 42.748-95.291 95.292v61.537h-30.748v-61.537c0-69.499 56.54-126.04 126.038-126.04 69.499 0 126.04 56.541 126.04 126.04v61.537z"
                                        fill="#ff7149" opacity="1" data-original="#ff7149" class=""></path>
                                    <path
                                        d="M410.63 204.89H101.371c-20.505 0-37.188 16.683-37.188 37.188v232.734c0 20.505 16.683 37.188 37.188 37.188H410.63c20.505 0 37.187-16.683 37.187-37.189V242.078c0-20.505-16.682-37.188-37.187-37.188zm19.875 269.921c0 10.96-8.916 19.876-19.875 19.876H101.371c-10.96 0-19.876-8.916-19.876-19.876V242.078c0-10.96 8.916-19.876 19.876-19.876H410.63c10.959 0 19.875 8.916 19.875 19.876v232.733z"
                                        fill="#ff7149" opacity="1" data-original="#ff7149" class=""></path>
                                    <path
                                        d="M285.11 369.781c10.113-8.521 15.998-20.978 15.998-34.365 0-24.873-20.236-45.109-45.109-45.109-24.874 0-45.11 20.236-45.11 45.109 0 13.387 5.885 25.844 16 34.367l-9.731 46.362a8.66 8.66 0 0 0 8.472 10.436h60.738a8.654 8.654 0 0 0 8.47-10.434l-9.728-46.366zm-14.259-10.961a8.658 8.658 0 0 0-3.824 9.081l8.68 41.366h-39.415l8.682-41.363a8.655 8.655 0 0 0-3.824-9.081c-8.108-5.16-12.948-13.911-12.948-23.406 0-15.327 12.469-27.796 27.797-27.796 15.327 0 27.796 12.469 27.796 27.796.002 9.497-4.838 18.246-12.944 23.403z"
                                        fill="#ff7149" opacity="1" data-original="#ff7149" class=""></path>
                                </g>
                            </svg>
                        </span>
                        @endif
                        @include($activeTemplate.'partials.social_login',[$register = true])

                        <form action="{{ route('publisher.register') }}" class="verify-gcaptcha1 " method="post">
                            @csrf
                            <div class="account-form ">

                                <div class="row">
                                    <div class="col-xl-6 col-lg-12 col-sm-6 form-group">
                                        <label class="form--label">@lang('First Name')</label>
                                        <input type="text" name="firstname" class="form--control" required
                                            placeholder="@lang('First Name')" />
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-sm-6 form-group">
                                        <label class="form--label">@lang('Last Name')</label>
                                        <input type="text" name="lastname" class="form--control" required
                                            placeholder="@lang('Last Name')" />
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-sm-6 form-group">
                                        <label class="form--label">
                                            @lang('Email') </label>
                                        <input type="email" class="form--control checkPublisher" required
                                            placeholder="@lang('Email')" name="email" />
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form--label">
                                            @lang('Password')
                                        </label>
                                        <div class="position-relative">
                                            <span class="password-show-hide fas fa-eye-slash toggle-password"></span>
                                            <input type="password" name="password" required
                                                placeholder="@lang('Password')"
                                                class="form-control form--control form-three  @if(gs('secure_password')) secure-password @endif"
                                                value="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form--label">
                                            @lang('Confirm Password')
                                        </label>
                                        <div class="position-relative">
                                            <span class="password-show-hide fas fa-eye-slash toggle-password"></span>
                                            <input type="password" name="password_confirmation" required
                                                placeholder="@lang('Confrim Password')"
                                                class="form-control form--control form-three" value="" />
                                        </div>
                                    </div>

                                    @if (gs('agree'))
                                    @php
                                    $policyPages = getContent('policy_pages.element', false, orderById:true);
                                    @endphp
                                    <div class="form--check form-group">
                                        <input class="form-check-input" type="checkbox" name="agree"
                                            @checked(old('agree')) />
                                        <label class="form-check-label check-label-two">
                                            @lang('I agree with') @foreach ($policyPages as $policy)
                                            <a href="{{ route('policy.pages', $policy->slug) }}" class="link"
                                                target="_blank">{{
                                                __($policy->data_values->title) }}</a>
                                            @if (!$loop->last)
                                            ,
                                            @endif
                                            @endforeach
                                        </label>
                                    </div>

                                    @endif

                                    @php
                                    $placeholder=true;
                                    @endphp
                                    <x-captcha :placeholder='$placeholder' />

                                    <div class="col-sm-12 form-group">
                                        <button type="submit" class="btn btn--base w-100">
                                            @lang('Register')
                                        </button>
                                    </div>
                                
                                </div>
                            </div>
                        </form>
                        <div class="loginText">
                            <div class="have-account text-center">
                                <p class="have-account__text">
                                    @lang('Already Have An Account')?
                                    <a href="{{route('publisher.login')}}"
                                        class="have-account__link text--base">
                                        @lang("Login")
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade show active  @if (!gs('ad_registration')) form-disabled  @endif" id="pills-advertis" role="tabpanel"
                        aria-labelledby="pills-advertis-tab" tabindex="0">
                        @if (!gs('ad_registration'))
                        <span class="form-disabled-text">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80" x="0" y="0"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                                xml:space="preserve" class="">
                                <g>
                                    <path
                                        d="M255.999 0c-79.044 0-143.352 64.308-143.352 143.353v70.193c0 4.78 3.879 8.656 8.659 8.656h48.057a8.657 8.657 0 0 0 8.656-8.656v-70.193c0-42.998 34.981-77.98 77.979-77.98s77.979 34.982 77.979 77.98v70.193c0 4.78 3.88 8.656 8.661 8.656h48.057a8.657 8.657 0 0 0 8.656-8.656v-70.193C399.352 64.308 335.044 0 255.999 0zM382.04 204.89h-30.748v-61.537c0-52.544-42.748-95.292-95.291-95.292s-95.291 42.748-95.291 95.292v61.537h-30.748v-61.537c0-69.499 56.54-126.04 126.038-126.04 69.499 0 126.04 56.541 126.04 126.04v61.537z"
                                        fill="#ff7149" opacity="1" data-original="#ff7149" class=""></path>
                                    <path
                                        d="M410.63 204.89H101.371c-20.505 0-37.188 16.683-37.188 37.188v232.734c0 20.505 16.683 37.188 37.188 37.188H410.63c20.505 0 37.187-16.683 37.187-37.189V242.078c0-20.505-16.682-37.188-37.187-37.188zm19.875 269.921c0 10.96-8.916 19.876-19.875 19.876H101.371c-10.96 0-19.876-8.916-19.876-19.876V242.078c0-10.96 8.916-19.876 19.876-19.876H410.63c10.959 0 19.875 8.916 19.875 19.876v232.733z"
                                        fill="#ff7149" opacity="1" data-original="#ff7149" class=""></path>
                                    <path
                                        d="M285.11 369.781c10.113-8.521 15.998-20.978 15.998-34.365 0-24.873-20.236-45.109-45.109-45.109-24.874 0-45.11 20.236-45.11 45.109 0 13.387 5.885 25.844 16 34.367l-9.731 46.362a8.66 8.66 0 0 0 8.472 10.436h60.738a8.654 8.654 0 0 0 8.47-10.434l-9.728-46.366zm-14.259-10.961a8.658 8.658 0 0 0-3.824 9.081l8.68 41.366h-39.415l8.682-41.363a8.655 8.655 0 0 0-3.824-9.081c-8.108-5.16-12.948-13.911-12.948-23.406 0-15.327 12.469-27.796 27.797-27.796 15.327 0 27.796 12.469 27.796 27.796.002 9.497-4.838 18.246-12.944 23.403z"
                                        fill="#ff7149" opacity="1" data-original="#ff7149" class=""></path>
                                </g>
                            </svg>
                        </span>
                        @endif

                        @include($activeTemplate.'partials.social_login',[$userType=true,$register = true])
                        <form action="{{ route('advertiser.register') }}" class="verify-gcaptcha2 " method="post">
                            @csrf
                            <div class="account-form ">
                            

                                <div class="row">
                                    <div class="col-xl-6 col-lg-12 col-sm-6 form-group">
                                        <label class="form--label">@lang('First Name')</label>
                                        <input type="text" name="firstname" class="form--control" required
                                            placeholder="@lang('First Name')" />
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-sm-6 form-group">
                                        <label class="form--label">@lang('Last Name')</label>
                                        <input type="text" name="lastname" class="form--control" required
                                            placeholder="@lang('Last Name')" />
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-sm-6 form-group">
                                        <label class="form--label">
                                            @lang('Email') </label>
                                        <input type="email" class="form--control checkAdvertiser" required
                                            placeholder="@lang('Email')" name="email" />
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form--label">
                                            @lang('Password')
                                        </label>
                                        <div class="position-relative">
                                            <span class="password-show-hide fas fa-eye-slash toggle-password"></span>
                                            <input type="password" name="password" required
                                                placeholder="@lang('Password')"
                                                class="form-control form--control form-three  @if(gs('secure_password')) secure-password @endif"
                                                value="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form--label">
                                            @lang('Confirm Password')
                                        </label>
                                        <div class="position-relative">
                                            <span class="password-show-hide fas fa-eye-slash toggle-password"></span>
                                            <input type="password" name="password_confirmation" required
                                                placeholder="@lang('Confrim Password')"
                                                class="form-control form--control form-three" value="" />
                                        </div>
                                    </div>

                                    @if (gs('agree'))
                                    @php
                                    $policyPages = getContent('policy_pages.element', false, orderById:true);
                                    @endphp
                                    <div class="form--check form-group">
                                        <input class="form-check-input" type="checkbox" name="agree"
                                            @checked(old('agree')) />
                                        <label class="form-check-label check-label-two">
                                            @lang('I agree with') @foreach ($policyPages as $policy)
                                            <a href="{{ route('policy.pages', $policy->slug) }}" class="link"
                                                target="_blank">{{
                                                __($policy->data_values->title) }}</a>
                                            @if (!$loop->last)
                                            ,
                                            @endif
                                            @endforeach
                                        </label>
                                    </div>

                                    @endif

                                    @php
                                    $placeholder=true;
                                    @endphp
                                    <x-captcha :placeholder='$placeholder' />

                                    <div class="col-sm-12 form-group">
                                        <button type="submit" class="btn btn--base w-100">
                                            @lang('Register')
                                        </button>
                                    </div>
                                 
                                </div>
                            </div>
                        </form>

                        <div class="loginText">
                            <div class="have-account text-center">
                                <p class="have-account__text">
                                    @lang('Already Have An Account')?
                                    <a href="{{route('advertiser.login')}}"
                                        class="have-account__link text--base">
                                        @lang("Login")
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="account-inner__right">
            <div class="account-thumb">
                <img src="{{frontendImage('auth',  $authContent->data_values->image, '1150x945')}}" alt="image" >
            </div>
            <h1 class="account-inner__right-title">
                {{__(@$authContent->data_values->title)}}
            </h1>
        </div>
    </div>
</section>
<!-- account section end -->

<div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </span>
            </div>
            <div class="modal-body">
                <h6 class="text-center m-0">@lang('You already have an account please Login ')</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn--sm" data-bs-dismiss="modal">@lang('Close')</button>
                <a href="{{ route('publisher.login') }}" class="btn btn--base btn--sm">@lang('Login')</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="existAdvertiserModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="existModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </span>
            </div>
            <div class="modal-body">
                <h6 class="text-center m-0">@lang('You already have an account please Login ')</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn--sm" data-bs-dismiss="modal">@lang('Close')</button>
                <a href="{{ route('advertiser.login') }}" class="btn btn--base btn--sm">@lang('Login')</a>
            </div>
        </div>
    </div>
</div>


@endsection

@if (gs('secure_password'))
@push('script-lib')
<script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
@endif




@push('style')
<style>
    .form-disabled {
        overflow: hidden;
        position: relative;
    }

    .form-disabled-text svg path {
        fill: hsl(var(--base));
    }


    .form-disabled::after {
        content: "";
        position: absolute;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        top: 0;
        left: 0;
        backdrop-filter: blur(3px);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        z-index: 99;
    }

    .form-disabled .account-logo-area {
        z-index: 999;
    }

    .form-disabled-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 991;
        font-size: 24px;
        height: auto;
        width: 100%;
        text-align: center;
        color: hsl(var(--dark-600));
        font-weight: 800;
        line-height: 1.2;
    }

    .loginText {
        position: relative;
        z-index: 999;
        padding-top: 5px;
        background:white;
    }
</style>
@endpush


@push('script')
<script>
    (function($) {
            "use strict";
            $(document).ready(function () {
     
        var user = localStorage.getItem('userType');

            if(user=='publisher'){

                $('#pills-advertis-tab').removeClass('active');
                $('#pills-advertis').removeClass('show active');
                $('#pills-publisher-tab').addClass('active');
                $('#pills-publisher').addClass('show active');
            }else{
                $('#pills-publisher-tab').removeClass('active');
                $('#pills-publisher').removeClass('show active');
                $('#pills-advertis-tab').addClass('active');
                $('#pills-advertis').addClass('show active');
            }   



        $('.navBtn').on('click', function () {
            var type = $(this).data('type');
            console.log(type);
         
            localStorage.setItem('userType', type);
        });
        /* pricing tab js start here */
        $(".account-tab button").on('click',function () {
          var position = $(this).parent().position();
          var width = $(this).parent().width();
          $(".item-bg").css({
            left: +position.left,
            width: width,
          });
        });
    
        var actWidth = $(".account-tab").find(".active").parent("li").width();
        var actPosition = $(".account-tab .active").position();
        $(".item-bg").css({
          left: +actPosition.left,
          width: actWidth,
        });
        /* pricing tab js end here */
    });




            $('.checkPublisher').on('focusout', function(e) {
              
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


            $('.checkAdvertiser').on('focusout', function(e) {
                var url = '{{ route('advertiser.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';

                var data = {
                    email: value,
                    _token: token
                }

                $.post(url, data, function(response) {
                    if (response.data != false) {
                        $('#existAdvertiserModalCenter').modal('show');
                    }
                });
            });

 

            var captchaCallback = function() {
        grecaptcha.render('verify-gcaptcha1');
        grecaptcha.render('verify-gcaptcha2');
   
    };
        })(jQuery);
</script>
@endpush