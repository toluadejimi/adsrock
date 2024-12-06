@php
    $pages = App\Models\Page::where('tempname', $activeTemplate)
        ->where('is_default', Status::NO)
        ->get();
@endphp

<header class="header @if (!request()->routeIs('home')) header-two @endif" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo" href="{{ route('home') }}"><img src="{{ siteLogo('dark') }}" alt="image"></a>
            <button class="navbar-toggler header-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span id="hiddenNav"><i class="las la-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu m-auto align-items-lg-center">
                    <li class="nav-item d-block d-lg-none">
                        <div class="top-button d-flex flex-wrap justify-content-between align-items-center">
                            <ul
                                class="login-registration-list d-flex flex-wrap justify-content-between align-items-center">
                                @if (auth()->guard('publisher')->check() || auth()->guard('advertiser')->check())
                                    @if (auth()->guard('publisher')->check())
                                        <li>
                                            <a href="{{ route('publisher.dashboard') }}" class="link">
                                                @lang('Dashboard')
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('advertiser.dashboard') }}" class="link">
                                                @lang('Dashboard')</a>
                                        </li>
                                    @endif
                                @else
                                    <li>
                                        <a href="{{ route('advertiser.login') }}" class="link"> @lang('Login')</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('advertiser.register') }}"
                                            class="btn btn--base btn--sm">@lang('Join Now')
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            @if (gs('multi_language'))
                                @php
                                    $langs = App\Models\Language::all();
                                    $defaultLanguage = App\Models\Language::where(
                                        'code',
                                        config('app.locale'),
                                    )->first();

                                @endphp
                                <div class="custom--dropdown">
                                    @if (session('lang'))
                                        <div class="custom--dropdown__selected dropdown-list__item">
                                            <a href="#" class="thumb">
                                                <img src="{{ getImage(getFilePath('language') . '/' . $langs->where('code', session('lang'))->first()->image, getFileSize('language')) }}"
                                                    alt="image">
                                            </a>
                                            <span class="text"> {{ strtoupper(session('lang')) }} </span>
                                        </div>
                                    @else
                                        @php $default = $langs->where('is_default',Status::YES)->first() @endphp
                                        <div class="custom--dropdown__selected dropdown-list__item">
                                            <a href="#" class="thumb">
                                                <img src="{{ getImage(getFilePath('language') . '/' . @$default->image, getFileSize('language')) }}"
                                                    alt="image">
                                            </a>
                                            <span class="text"> {{ strtoupper(@$default->code) }} </span>
                                        </div>
                                    @endif
                                    <ul class="dropdown-list">
                                        @foreach ($langs as $item)
                                            <li class="dropdown-list__item " data-value="en">
                                                <a href="{{ route('lang', @$item->code) }}" class=" thumb d-flex">
                                                    <img src="{{ getImage(getFilePath('language') . '/' . $item->image, getFileSize('language')) }}"
                                                        alt="image">
                                                    <span class="text"> {{ strtoupper($item->code) }} </span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">@lang('Home')</a>
                    </li>
                    @foreach ($pages as $k => $data)
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page"
                                href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}
                            </a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('blogs') }}">@lang('Blog')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('contact') }}">@lang('Contact')</a>
                    </li>
                </ul>

                <div class="nav-item d-lg-block d-none ms-auto">
                    <div class="top-button d-flex flex-wrap justify-content-between align-items-center">
                        <ul class="login-registration-list d-flex flex-wrap align-items-center">
                            @if (auth()->guard('publisher')->check() || auth()->guard('advertiser')->check())
                                @if (auth()->guard('publisher')->check())
                                    <li>
                                        <a href="{{ route('publisher.dashboard') }}" class="link">
                                            @lang('Dashboard')
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('advertiser.dashboard') }}" class="link">
                                            @lang('Dashboard')
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li>
                                    <a href="{{ route('advertiser.login') }}" class="link"> @lang('Login')</a>
                                </li>
                                <li>
                                    <a href="{{ route('advertiser.register') }}"
                                        class="btn btn--base btn--sm">@lang('Join Now')
                                    </a>
                                </li>
                            @endif
                        </ul>

                        @if (gs('multi_language'))
                            @php
                                $langs           = App\Models\Language::all();
                                $defaultLanguage = App\Models\Language::where('code', config('app.locale'))->first();
                            @endphp
                            <div class="custom--dropdown">
                                @if (session('lang'))
                                    <div class="custom--dropdown__selected dropdown-list__item">
                                        <a href="#" class="thumb">
                                            <img src="{{ getImage(getFilePath('language') . '/' . $langs->where('code', session('lang'))->first()->image, getFileSize('language')) }}"
                                                alt="image"></a>
                                        <span class="text"> {{ strtoupper(session('lang')) }} </span>
                                    </div>
                                @else
                                    @php $default = $langs->where('is_default',Status::YES)->first() @endphp
                                    <div class="custom--dropdown__selected dropdown-list__item">
                                        <a href="#" class="thumb">
                                            <img src="{{ getImage(getFilePath('language') . '/' . @$default->image, getFileSize('language')) }}"
                                                alt="image"></a>
                                        <span class="text"> {{ strtoupper(@$default->code) }} </span>
                                    </div>
                                @endif
                                <ul class="dropdown-list">
                                    @foreach ($langs as $item)
                                        <li class="dropdown-list__item " data-value="en">
                                            <a href="{{ route('lang', @$item->code) }}" class=" thumb d-flex">
                                                <img src="{{ getImage(getFilePath('language') . '/' . $item->image, getFileSize('language')) }}"
                                                    alt="image">
                                                <span class="text"> {{ strtoupper($item->code) }} </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

@push('style')
    <style>
        .header.header-two {
            position: relative;
        }
    </style>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";

            function formatState(state) {
                if (!state.id) return state.text;
                let gatewayData = $(state.element).data();
                return $(
                    `<div class="d-flex gap-2">${gatewayData.imageSrc ? `<div class="select2-image-wrapper"><img class="select2-image" src="${gatewayData.imageSrc}"></div>` : '' }<div class="select2-content"> <p class="select2-title">${gatewayData.title}</p><p class="select2-subtitle">${gatewayData.subtitle}</p></div></div>`
                );
            }

            $('.select2').each(function(index, element) {
                $(element).select2({
                    templateResult: formatState,
                    minimumResultsForSearch: "-1"
                });
            });

            $('.select2-searchable').each(function(index, element) {
                $(element).select2({
                    templateResult: formatState,
                    minimumResultsForSearch: "1"
                });
            });

            $('.select2-basic').each(function(index, element) {
                $(element).select2({
                    dropdownParent: $(element).closest('.select2-parent')
                });
            });


        })(jQuery);
    </script>
@endpush
