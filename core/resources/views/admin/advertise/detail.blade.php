@extends('admin.layouts.app')
@section('panel')
    <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
        <div class="row gy-3">
            <div class="col-xxl-4 col-sm-6">
                <x-widget style="7" type="2" link="javascript:void(0)" icon="las la-hand-point-up"
                    title="Total Clicked" value="{{ __($advertise->clicked) }}" bg="primary" />
            </div>
            <div class="col-xxl-4 col-sm-6">
                <x-widget style="7" type="2" link="javascript:void(0)" icon="las  la-globe"
                    title="Total Impression" value="{{ __($advertise->impression) }}" bg="1" />
            </div>
            <div class="col-xxl-4 col-sm-6">
                <x-widget style="7" type="2" link="javascript:void(0)" icon="las la-layer-group"
                    title="Advertise Type" value="{{ ucfirst(__($advertise->ad_type)) }}" bg="14" />
            </div>
        </div>
        <form action="{{ route('admin.advertise.update', $advertise->id) }}" method="POST" class="mt-3">
            @csrf
            <div class="row gy-3">
                <div class="col-xl-7 col-lg-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4 class="card-title">@lang('Information of') {{ __($advertise->ad_name) }} </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>@lang('Advertiser')</label>
                                        <input class="form-control" type="text"
                                            value="{{ $advertise->advertiser->fullname }}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>@lang('AD Name')</label>
                                        <input class="form-control" type="text" value="{{ $advertise->ad_name }}"
                                            disabled>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label>@lang('Redirect Url ')</label>
                                        <input class="form-control" type="text" name="redirect_url"
                                            value="{{ $advertise->redirect_url }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label>@lang('Keywords')</label>
                                        <select name="keywords[]" class="form-control select2-auto-tokenize"
                                            data-keyword="{{ json_encode(@$advertise->keywords) }}" id="keyword"
                                            multiple="multiple" required>
                                            @foreach (@$keywords as $keyword)
                                                <option value="{{ $keyword }}" @selected(in_array($keyword, @$advertise->keywords ?? []))>
                                                    {{ __($keyword) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label>@lang('Target Countries')</label>
                                        <select name="target_country[]" class="form-control select2-auto-tokenize"
                                            id="country" data-country="{{ json_encode($advertise->target_country) }}"
                                            multiple="multiple" placeholder="@lang('Select your targeted country')" required>
                                            @foreach (@$countries as $country)
                                                <option value="{{ $country->country_code }}" @selected(in_array($country->country_code, $adCountries ?? []))>
                                                    {{ __($country->country_name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="targer">@lang('Target for Global')</label>
                                        <input type="checkbox" class="global" id="customCheck21" data-width="100%"
                                            data-size="large" data-onstyle="-success" data-offstyle="-danger"
                                            data-bs-toggle="toggle" data-height="35" data-on="@lang('Yes')"
                                            data-off="@lang('No')" name="global"
                                            {{ $advertise->global == Status::YES ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                @lang('Size of '){{ __($advertise->ad_name) }}
                                <small class="text-danger">({{ @$advertise->resolution }})@lang('px') </small>
                            </h4>
                            <p>
                                @lang('Created Date') :
                                <strong>{{ showDateTime($advertise->created_at, 'd M, Y h:i A') }}</strong>
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="py-3 bg--white">
                                <div class="rounded">
                                    <img src="{{ getImage(getFilePath('advertise') . '/' . $advertise->image) }}"
                                        width="{{ $advertise->type->width }}" height="{{ $advertise->type->height }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn--primary w-100 h-45">@lang('Update')</button>
                </div>
            </div>
        </form>
    @endsection

    @push('breadcrumb-plugins')
        <x-back route="{{ route('admin.advertise.index') }}" />
    @endpush

    @push('script')
        <script>
            'use strict';
            (function($) {

                function checkIsGlobal() {
                    if ($(".global").is(':checked')) {
                        $("#country").attr('disabled', true);
                    } else {
                        $("#country").attr('disabled', false);
                    }
                }
                $(".global").on('change', function() {
                    checkIsGlobal();
                })

            })(jQuery);
        </script>
    @endpush
