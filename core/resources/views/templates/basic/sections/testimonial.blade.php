@php
    $testimonialContent = getContent('testimonial.content', true);
    $testimonialSliders = getContent('testimonial.element', false, orderById: true);
@endphp

<section class="testimonials py-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section-heading__title text-dark" data-s-break="-2"> {{ __(@$testimonialContent->data_values->title) }}</h2>
                    <p class="section-heading__desc">
                        {{ __(@$testimonialContent->data_values->description) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-10">
                <div class="testimonial-slider">
                    @foreach ($testimonialSliders as $item)
                        <div class="testimonial-item">
                            <img src="{{ frontendImage('testimonial', @$item->data_values->image, '80x80') }}"
                                alt="image">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="testimonial-details__wrapper">
                    @foreach ($testimonialSliders as $item)
                        <div class="testimonial-item__content">
                            <h5 class="title">{{ __(@$item->data_values->name) }}</h5>
                            <p class="desc">
                                {{ __(@$item->data_values->description) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@if (!app()->offsetExists('slick_script'))
    @push('style-lib')
        <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
    @endpush

    @push('script-lib')
        <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
    @endpush

    @php app()->offsetSet('slick_script',true) @endphp
@endif

@push('script')
    <script>
        (function($) {
            "use strict";

            $(".testimonial-slider").slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                centerMode: true,
                autoplay: true,
                centerPadding: "60px",
                arrows: false,
                dots: false,
                asNavFor: ".testimonial-details__wrapper",
                responsive: [{
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 424,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                ],
            });
            $(".testimonial-details__wrapper").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                asNavFor: ".testimonial-slider",
                dots: true,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev gig-details-arrow"><i class="las la-angle-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next gig-details-arrow"><i class="las la-angle-right"></i></button>',
                responsive: [{
                    breakpoint: 767,
                    settings: {
                        arrows: false,
                    },
                }, ],
            });

        })(jQuery);
    </script>
@endpush
