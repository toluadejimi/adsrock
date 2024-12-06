@extends($activeTemplate . 'layouts.app')
@section('panel')
    
    <section class="account">
        <div class="account-inner">
            <div class="account-inner__left">
                <div class="account-form-wrapper">
                    <div class="mb-5 text-center">
                        <a href="{{ route('home') }}" class="account-form__logo">
                            <img src="{{ siteLogo('dark') }}" alt="image">
                        </a>
                    </div>
                    <div class="alert alert-primary mb-4 text-start" role="alert">
                        <strong> @lang('Complete your profile')</strong>
                        <p class="text-dark">@lang('You need to complete your profile by providing below information').</p>
                    </div>
                    <form method="POST" action="{{ route('publisher.data.submit') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form--label">@lang('Username')</label>
                                    <input type="text" class=" form--control checkUser" required
                                        placeholder="@lang('Username')" name="username" value="{{ old('username') }}">
                                    <small class="text--danger usernameExist"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form--label">@lang('Country')</label>
                                    <select name="country" class="form--control  select2" required>
                                        @foreach ($countries as $key => $country)
                                            <option data-mobile_code="{{ $country->dial_code }}"
                                                value="{{ $country->country }}" data-code="{{ $key }}">
                                                {{ __($country->country) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form--label">@lang('Mobile')</label>
                                    <div class="input-group ">
                                        <span class="input-group-text mobile-code">
                                        </span>
                                        <input type="hidden" name="mobile_code">
                                        <input type="hidden" name="country_code">
                                        <input type="number" name="mobile" placeholder="@lang('Mobile')"
                                            value="{{ old('mobile') }}" class="form--control form-control  checkUser"
                                            required>
                                    </div>
                                    <small class="text--danger mobileExist"></small>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form--label">@lang('Address')</label>
                                <input type="text" class="form--control" name="address" placeholder="@lang('Address')"
                                    value="{{ old('address') }}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form--label">@lang('State')</label>
                                <input type="text" class="form--control" name="state" placeholder="@lang('State')"
                                    value="{{ old('state') }}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form--label">@lang('Zip Code')</label>
                                <input type="text" class="form--control" name="zip" placeholder="@lang('Zip')"
                                    value="{{ old('zip') }}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form--label">@lang('City')</label>
                                <input type="text" class="form--control" name="city" placeholder="@lang('City')"
                                    value="{{ old('city') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn--base w-100">
                                @lang('Submit')
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            @include($activeTemplate . 'partials.auth_section')
        </div>
    </section>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush



@push('script')
    <script>
        "use strict";
        (function($) {

            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('select[name=country]').on('change', function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
                var value = $('[name=mobile]').val();
                var name = 'mobile';
                checkUser(value, name);
            });

            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));


            $('.checkUser').on('focusout', function(e) {
                var value = $(this).val();
                var name = $(this).attr('name')
                checkUser(value, name);
            });

            function checkUser(value, name) {
                var url = '{{ route('publisher.checkUser') }}';
                var token = '{{ csrf_token() }}';

                if (name == 'mobile') {
                    var mobile = `${value}`;
                    var data = {
                        mobile: mobile,
                        mobile_code: $('.mobile-code').text().substr(1),
                        _token: token
                    }
                }
                if (name == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }

                $.post(url, data, function(response) {

                    if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.field} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            }

        })(jQuery);
    </script>
@endpush
