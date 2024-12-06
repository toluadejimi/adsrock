@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-xxl-8 col-lg-10">
            <div class="campaign-wrapper">
                <form action="{{ route('advertiser.ad.store', @$ad->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ad_name" value="{{ $adType->ad_name }}">
                    <input type="hidden" name="type_id" value="{{ $adType->id }}">
                    <div class="mb-4 text-center">
                        <div class="profile-setting__wrapper m-auto mb-3">
                            <div class="file-upload">
                                <label for="profile" class="edit"><i class="fas fa-camera"></i></label>
                            </div>
                            <div class="thumb" style="width:{{ $adType->width }}px;height:{{ $adType->height }}px">

                                <img class="preview"
                                    src="{{ getImage(getFilePath('advertise') . '/' . @$ad->image, $adType->slug) }}" />
                            </div>
                        </div>
                        <input type="file" name="image" class="form-control form--control" id="profile"
                            accept=".jpg,.jpeg,.png" hidden />
                        <div class="mt-2">
                            <small>
                                @lang('Supported Files'): @lang('.jpg'), @lang('.jpeg'), @lang('.png').
                                @lang('Image must be') {{ $adType->slug }}@lang('px')
                            </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form--label">@lang('Ad Title')</label>
                        <input type="text" class="form--control" name="title"
                            value="{{ old('title', @$ad->ad_title) }}" required />
                    </div>
                    <div class="form-group">
                        <label class="form--label">@lang('Campaign Type')</label>
                        <select id="my-select" class="form--control select2" data-minimum-results-for-search="-1"
                            name="type" required>
                            <option value="impression" @selected(old('type', @$ad->ad_type) == 'impression')>@lang('Impression')
                            </option>
                            <option value="click" @selected(old('type', @$ad->ad_type) == 'click')>@lang('Click')
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form--label">@lang('Redirect URL')</label>
                        <input type="url" name="redirect_url" value="{{ old('redirect_url', @$ad->redirect_url) }}"
                            required placeholder="e.g (https://demo.com)" class="form--control" />
                    </div>
                    <div class="form-group">
                        <label class="form--label">@lang('Keywords')
                            <small>(@lang('Please use only suggested keywords'))</small> </label>
                        <select class="form-select form--control select2" name="add_keywords[]" multiple>
                            @foreach (@$keywords as $keyword)
                                <option value="{{ $keyword }}" @selected(in_array($keyword, @$ad->keywords ?? old('add_keywords', [])))>{{ __($keyword) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="d-flex gap-2 align-content-center justify-content-between mb-1">
                            <label class="form--label">@lang('Target Country')</label>
                            <div>
                                <input type="checkbox" name="is_global" class="custom-control-input"
                                    @checked(@$ad->global) id="is_global">
                                <label class="custom-control-label" for="is_global">@lang('Target for Global')?</label>
                            </div>
                        </div>
                        <select class="form-select form--control select2" name="target_country[]" multiple>
                            @foreach (@$countries as $country)
                                <option value="{{ $country->country_code }}" @selected(in_array($country->country_code, $adCountries ?? [])  && !@$ad->global )>
                                    {{ __($country->country_name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn--base btn--lg w-100">
                        @if (@$ad)
                            @lang('Update')
                        @else
                            @lang('Submit')
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('advertiser.ad.index') }}" class="btn  btn-outline--base btn--sm">
        <i class="las la-list"></i> @lang('My Ads')
    </a>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('#profile').on('change', function() {
                const file = this.files[0];
                if (file) {
                    $('.preview').attr('src', URL.createObjectURL(file));
                }
            });
        });
        $('[name=is_global]').on('change', function() {
            if ($(this).is(":checked")) {
                $('[name="target_country[]"]').attr('disabled', true)
            } else {
                $('[name="target_country[]"]').attr('disabled', false)
            }
        }).change()
    </script>
@endpush


@push('style')
    <style>
        .dashboard .profile-setting__wrapper {
            width: 100% !important;
            max-width: 100% !important;
        }

        .dashboard .profile-setting__wrapper .thumb {
            margin: 0 auto;
            max-width: 100% !important;
            max-height: 100% !important;

        }

        .dashboard .profile-setting__wrapper .edit {
            left: 50%;
            bottom: -10px;
            right: unset;
            width: 25px;
            height: 25px;
        }

        .select2-container,
        .select2-container--default.select2-container--focus .select2-selection--multiple,
        .select2 .selection {
            height: unset !important;
        }
    </style>
@endpush

