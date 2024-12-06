@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label> @lang('Site Title')</label>
                                    <input class="form-control" type="text" name="site_name" required
                                        value="{{ gs('site_name') }}">
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="required"> @lang('Timezone')</label>
                                <select class="select2 form-control" name="timezone">
                                    @foreach ($timezones as $key => $timezone)
                                        <option value="{{ @$key }}" @selected(@$key == $currentTimezone)>{{ __($timezone) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Currency')</label>
                                    <input class="form-control" type="text" name="cur_text" required
                                        value="{{ gs('cur_text') }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Currency Symbol')</label>
                                    <input class="form-control" type="text" name="cur_sym" required
                                        value="{{ gs('cur_sym') }}">
                                </div>
                            </div>

                            <div class="form-group col-lg-4 col-sm-6">
                                <label class="required"> @lang('Site Base Color')</label>
                                <div class="input-group">
                                    <span class="input-group-text p-0 border-0">
                                        <input type='text' class="form-control colorPicker"
                                            value="{{ gs('base_color') }}">
                                    </span>
                                    <input type="text" class="form-control colorCode" name="base_color"
                                        value="{{ gs('base_color') }}">
                                </div>
                            </div>
                            <div class="form-group col-lg-4 col-sm-6">
                                <label class="required"> @lang('Site Secondary Color')</label>
                                <div class="input-group">
                                    <span class="input-group-text p-0 border-0">
                                        <input type='text' class="form-control colorPicker"
                                            value="{{ gs('secondary_color') }}">
                                    </span>
                                    <input type="text" class="form-control colorCode" name="secondary_color"
                                        value="{{ gs('secondary_color') }}">
                                </div>
                            </div>
                            <div class="form-group col-lg-4 col-sm-6">
                                <label> @lang('Record to Display Per page')</label>
                                <select class="select2 form-control" name="paginate_number"
                                    data-minimum-results-for-search="-1">
                                    <option value="20" @selected(gs('paginate_number') == 20)>@lang('20 items per page')
                                    </option>
                                    <option value="50" @selected(gs('paginate_number') == 50)>@lang('50 items per page')
                                    </option>
                                    <option value="100" @selected(gs('paginate_number') == 100)>@lang('100 items per page')
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-lg-4 col-sm-6 ">
                                <label class="required"> @lang('Currency Showing Format')</label>
                                <select class="select2 form-control" name="currency_format"
                                    data-minimum-results-for-search="-1">
                                    <option value="1" @selected(gs('currency_format') == Status::CUR_BOTH)>@lang('Show Currency Text and Symbol Both')</option>
                                    <option value="2" @selected(gs('currency_format') == Status::CUR_TEXT)>@lang('Show Currency Text Only')</option>
                                    <option value="3" @selected(gs('currency_format') == Status::CUR_SYM)>@lang('Show Currency Symbol Only')</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6 col-lg-4">
                                <label> @lang('Banner Video') </label>
                                <input type="file" class="form-control" name="banner_video" value="" />
                            </div>
                            <div class="form-group col-sm-6 col-lg-4">
                                <label> @lang('Fraud Time Interval')</label>
                                <div class="input-group">
                                    <span class="input-group-text"> @lang('Minute')</span>
                                    <input type="text" class="form-control" name="intervals"
                                        value="{{ getAmount(gs('intervals')) }}" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>@lang('Manage Cost') <span>@lang('(Rest of the world)')</span></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6">
                                <label> @lang('Credit Per Click')</label>
                                <input type="text" class="form-control" name="cpc"
                                    value="{{ getAmount(gs('cpc')) }}" required />
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label> @lang('Credit Per Impression')</label>
                                <input type="text" class="form-control" name="cpm"
                                    value="{{ getAmount(gs('cpm')) }}" required />
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label> @lang('Earn Per Click')</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="epc" step="any"
                                        value="{{ getAmount(gs('epc')) }}" required />
                                    <span class="input-group-text">{{ __(gs('cur_text')) }}</span>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label> @lang('Earn Per Impression')</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="epm" step="any"
                                        value="{{ getAmount(gs('epm')) }}" required />
                                    <span class="input-group-text">{{ __(gs('cur_text')) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('script-lib')
    <script src="{{ asset('assets/admin/js/spectrum.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/spectrum.css') }}">
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function(color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });
            $('.colorCode').on('input', function() {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });
        })(jQuery);
    </script>
@endpush
