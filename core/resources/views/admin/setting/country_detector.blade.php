@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>@lang('Country Detector Methods')</label>
                            <select name="country_detector_method" class="select2 form-control"
                                data-minimum-results-for-search="-1">
                                <option value="">@lang('Select One')</option>
                                <option value="geoplugin" @if (@gs('country_detector_config')->name == 'geoplugin') selected @endif>
                                    @lang('Geoplugin')
                                </option>
                                <option value="cloudflare" @if (@gs('country_detector_config')->name == 'cloudflare') selected @endif>
                                    @lang('Cloudflare')</option>
                                <option value="proxycheck" @if (@gs('country_detector_config')->name == 'proxycheck') selected @endif>
                                    @lang('Proxycheck')</option>
                                <option value="ipstack" @if (@gs('country_detector_config')->name == 'ipstack') selected @endif>@lang('Ipstack')
                                </option>
                            </select>
                        </div>
                        <div class="row mt-4 d-none configForm proxycheck">
                            <div class="col-md-12">
                                <h6 class="mb-2">@lang('Proxycheck Configuration')</h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('Api Key') </label>
                                    <input type="text" class="form-control" placeholder="@lang('Api Key')"
                                        name="proxycheck_api_key"
                                        value="{{ gs('country_detector_config')->proxycheck_api_key ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 d-none configForm ipstack">
                            <div class="col-md-12">
                                <h6 class="mb-2">@lang('Ipstack Configuration')</h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('Api Key') </label>
                                    <input type="text" class="form-control" placeholder="@lang('Api Key')"
                                        name="ipstack_api_key"
                                        value="{{ gs('country_detector_config')->ipstack_api_key ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 d-none configForm cloudflare">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <span class="text--warning"><i class="las la-exclamation-circle"></i>
                                        @lang('If you enable Cloudflare, your proxy settings should be turned ON in Cloudflare.')
                                    </span>
                                </div>
                            </div>
                        </div>
                        @if (gs('check_country'))
                            <div class="row mt-4 d-none configForm disable">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <span class="text--warning"><i class="las la-exclamation-circle"></i>
                                            @lang('If you enable this module, the country detector is disabled when visitors are shown advertisements.')
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div><!-- card end -->
        </div>
    </div>

    @if (!@$ipInfo->proxy && gs('check_country'))
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>@lang('IP and Country Check Verification')</h4>
                    </div>
                    <div class="card-body">
                        @if ($ipInfo->success && @$ipInfo->country_name)
                            <h6>
                                <i class="las la-check-circle text--success"></i>
                                @lang('Your country detector methode successfully work.')
                            </h6>
                            <h6>
                                <i class="las la-check-circle text--success"></i>
                                @lang('IP Address'): {{ $ip }}
                            </h6>
                            <h6>
                                <i class="las la-check-circle text--success"></i> @lang('Country'):
                                {{ @$ipInfo->country_name }}
                            </h6>
                        @elseif($ip == '127.0.0.1')
                            <h6>
                                <i class="las la-exclamation-circle  text--warning"></i>
                                @lang('You are using a localhost IP. Please make your site live.')
                            </h6>
                        @else
                            <h6>
                                <i class="las la-times-circle text--danger"></i>
                                @lang('Your country detector methode not work.')
                            </h6>
                            @if (!@$ipInfo->proxy && @gs('country_detector_config')->name == 'proxycheck')
                                <h6>
                                    <i class="las la-exclamation-circle  text--warning"></i>
                                    @lang('Please provide valid api key. For Api key visit :') <a href="https://proxycheck.io">@lang('proxycheck.io')</a>
                                </h6>
                            @elseif(@gs('country_detector_config')->name == 'ipstack')
                                <h6>
                                    <i class="las la-exclamation-circle  text--warning"></i>
                                    @lang('Please provide valid api key. For Api key visit :') <a href="https://ipstack.com/">@lang('ipstack.com')</a>
                                </h6>
                            @elseif(@gs('country_detector_config')->name == 'cloudflare')
                                <h6><i class="las la-exclamation-circle  text--warning"></i>
                                    @lang('Please turn ON your proxy settings in Cloudflare.')
                                </h6>
                            @endif
                            <h6>
                                <i
                                    class="las  @if (@$ipInfo->proxy) la-times-circle  text--danger @else la-check-circle  text--success @endif"></i>
                                @lang('IP Address'):
                                {{ $ip }}
                            </h6>

                            @if (@$ipInfo->proxy)
                                <h6>
                                    <i
                                        class="las  @if (@$ipInfo->proxy) la-times-circle  text--danger @else la-check-circle  text--success @endif"></i>@lang('Proxy'):
                                    {{ $ipInfo->proxy ? 'Yes' : 'No' }}
                                </h6>
                            @endif
                            <h6>
                                <i class="las la-times-circle text--danger"></i>@lang('Country'):
                                {{ $ipInfo->country_name ? $ipInfo->country_name : 'N/A' }}
                            </h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('select[name=country_detector_method]').on('change', function() {
                var method = $(this).val();
                trackerMethod(method);
            }).change();

            function trackerMethod(method) {
                $('.configForm').addClass('d-none');
                if ((method != 'geoplugin' && method != 'cloudflare' && method != 'disable') && method) {
                    $(`.${method}`).removeClass('d-none');
                }
            }
        })(jQuery);
    </script>
@endpush
