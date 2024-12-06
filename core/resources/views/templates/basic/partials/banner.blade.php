@php
    $bannerContent = getContent('banner.content', true);
    $bannerSliders = getContent('banner.element', false, orderById: true);
@endphp

<section class="banner-section">
    <div class="banner-section__shape">
        <img src="{{ getImage($activeTemplateTrue . 'images/shapes/bs.png') }}" alt="image">
    </div>
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-7 pe-lg-5">
                <div class="banner-content">
                    <h1 class="banner-content__title" data-s-break="-3">{{ __(@$bannerContent->data_values->title) }}</h1>
                    <p class="banner-content__desc">
                        {{ __(@$bannerContent->data_values->description) }}
                    </p>
                    <div class="banner-content__button">
                        <a href="{{ @$bannerContent->data_values->button_one_url }}"
                            class="btn btn--base btn--lg flex-grow-1">
                            {{ __(@$bannerContent->data_values->button_one_text) }}
                        </a>
                        <a href="{{ @$bannerContent->data_values->button_two_url }}"
                            class="btn btn-outline--base btn--lg flex-grow-1">
                            {{ __(@$bannerContent->data_values->button_two_text) }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 ps-xl-5 d-none d-sm-block">
                <div class="banner-thumb-wrapper">
                    <div class="row gy-4">
                        <div class="col-sm-6 col-xsm-6">
                            <div class="banner-thumb">
                                <img src="{{ frontendImage('banner', @$bannerContent->data_values->banner_image_one, '250x345') }}"
                                    alt="image">
                            </div>
                        </div>
                        <div class="col-sm-6 col-xsm-6">
                            <div class="counter-up">
                                <div class="thumb">
                                    <img src="{{ frontendImage('banner', @$bannerContent->data_values->banner_image_two, '250x345') }}"
                                        alt="image">
                                </div>
                                <div class="counterup-wrapper">
                                    <div class="counterup-item__number">
                                        <h3 class="text-white">
                                            {{ __(@$bannerContent->data_values->banner_image_two_heading) }}
                                        </h3>
                                    </div>
                                    <span
                                        class="counterup-wrapper__text">{{ __(@$bannerContent->data_values->banner_image_two_description) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="banner-video">
                                <video class="video" autoplay muted loop>
                                    <source src="{{ frontendImage('banner', gs('banner_video')) }}" />
                                </video>
                                <div class="content-wrapper">
                                    <div class="banner-video__content">
                                        <span
                                            class="subtitle">{{ __(@$bannerContent->data_values->banner_video_title) }}</span>
                                        <h4 class="title">
                                            {{ __(@$bannerContent->data_values->banner_video_heading) }} </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="brand-wrapper">
            <div class="brand-slider">
                @foreach ($bannerSliders as $slider)
                    <div class="brand-slider__thumb">
                        <img src="{{ frontendImage('banner', @$slider->data_values->slider_image, '145x50') }}"
                            alt="image">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
@endpush
@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
@endpush


@push('script')
    <script>
        (function($) {
            "use strict";

            $(".brand-slider").slick({
                arrows: false,
                infinite: true,
                slidesToShow: 6,
                slidesToScroll: 1,
                speed: 2000,
                cssEase: "linear",
                autoplay: true,
                autoplaySpeed: 0,
                adaptiveHeight: false,
                autoplay: true,
                pauseOnDotsHover: false,
                pauseOnHover: true,
                pauseOnFocus: true,
                responsive: [{
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 5,
                        },
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 4,
                        },
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                ],
            });

        })(jQuery);
    </script>
@endpush
