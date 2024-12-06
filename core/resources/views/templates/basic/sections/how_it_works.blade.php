@php
    $howItWorksContent            = getContent('how_it_works.content', true);
    $howItWorksAdvertiserElements = getContent('how_it_works_advertiser.element', false, orderById: true);
    $howItWorksPublisherElements  = getContent('how_it_works_publisher.element', false, orderById: true);
@endphp

<div class="how-work-section py-100 section-bg">
    <div class="shape">
        <img src="{{ getImage($activeTemplateTrue . 'images/shapes/h-1.png') }}" alt="image">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section-heading__title" data-s-break="-1"> {{ __(@$howItWorksContent->data_values->heading) }}</h2>
                    <p class="section-heading__desc">{{ __(@$howItWorksContent->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="how-work-wrapper">
            <ul class="nav nav-pills custom--tab pricing-tabs" id="pills-tab" role="tablist">
                <li class="nav-item-background"></li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-ad-tab" data-bs-toggle="pill" data-bs-target="#pills-ad" type="button" role="tab"
                        aria-controls="pills-ad" aria-selected="true"> @lang('Advertisers')
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-pub-tab" data-bs-toggle="pill" data-bs-target="#pills-pub" type="button" role="tab"
                        aria-controls="pills-pub" aria-selected="false"> @lang('Publishers')
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-ad" role="tabpanel" aria-labelledby="pills-ad-tab" tabindex="0">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="how-work">
                            @foreach ($howItWorksAdvertiserElements as $item)
                                <div class="how-work__item @if ($loop->first) active @endif">
                                    <span class="how-work__icon">
                                        <img src="{{ frontendImage('how_it_works_advertiser', $item->data_values->image, '150x150') }}" alt="">
                                    </span>
                                    <div class="how-work__content">
                                        <span class="how-work__number">{{ $loop->iteration }}</span>
                                        <h5 class="how-work__title">
                                            {{ __(@$item->data_values->title) }}
                                        </h5>
                                        <p class="how-work__desc">
                                            {{ __(@$item->data_values->description) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-pub" role="tabpanel" aria-labelledby="pills-pub-tab" tabindex="0">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="how-work">
                            @foreach ($howItWorksPublisherElements as $item)
                                <div class="how-work__item @if ($loop->first) active @endif">
                                    <span class="how-work__icon">

                                        <img src="{{ frontendImage('how_it_works_publisher', $item->data_values->image, '150x150') }}" alt="">

                                    </span>
                                    <div class="how-work__content">
                                        <span class="how-work__number">{{ $loop->iteration }}</span>
                                        <h5 class="how-work__title">
                                            {{ __(@$item->data_values->title) }}
                                        </h5>
                                        <p class="how-work__desc">
                                            {{ __(@$item->data_values->description) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('script')
    <script>
        (function($) {
            "use strict";
            $(".how-work__item").on("mouseover", function() {
                $(".how-work__item").removeClass("active");
                $(this).addClass("active");
            });


            $(".pricing-tabs button").on('click', function() {
                var position = $(this).parent().position();
                var width = $(this).parent().width();
                $(".nav-item-background").css({
                    left: +position.left,
                    width: width,
                });
            });

            var actWidth = $(".pricing-tabs").find(".active").parent("li").width();
            var actPosition = $(".pricing-tabs .active").position();
            $(".nav-item-background").css({
                left: +actPosition.left,
                width: actWidth,
            });

        })(jQuery);
    </script>
@endpush
