@php
    $counter    = getContent('counter.content', true);
    $valueOne   = separateNumberAndString($counter->data_values->counter_value_one);
    $valueTwo   = separateNumberAndString($counter->data_values->counter_value_two);
    $valueThree = separateNumberAndString($counter->data_values->counter_value_three);
    $valueFour  = separateNumberAndString($counter->data_values->counter_value_four);
@endphp

<div class="counter-up-section py-100">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="counter-up-wrapper">
                <div class="counterup-main-wrapper">
                    <div class="counter-up-heading">
                        <h2 class="counter-up-heading__title" data-s-break="-2"> {{ __(@$counter->data_values->heading) }}</h2>
                        <p class="counter-up-heading__desc">{{ __(@$counter->data_values->description) }}</p>
                    </div>
                    <div class="counterup-item-wrapper">
                        <div class="counterup-item ">
                            <div class="counterup-item__content">
                                <div class="content">
                                    <div class="counterup-item__number">
                                        <h3 class="counterup-item__title">
                                            <span class="odometer"
                                                data-odometer-final="{{ $valueOne['number'] }}"></span>{{ __($valueOne['text']) }}
                                        </h3>
                                    </div>
                                    <span class="counterup-item__text mb-0">
                                        {{ __(@$counter->data_values->counter_text_one) }} </span>
                                </div>
                            </div>
                            <div class="counterup-item__content">
                                <div class="content">
                                    <div class="counterup-item__number">
                                        <h3 class="counterup-item__title">
                                            <span class="odometer"
                                                data-odometer-final="{{ $valueTwo['number'] }}"></span>{{ __($valueTwo['text']) }}
                                        </h3>
                                    </div>
                                    <span class="counterup-item__text mb-0">
                                        {{ __(@$counter->data_values->counter_text_two) }} </span>
                                </div>
                            </div>
                            <div class="counterup-item__content">
                                <div class="content">
                                    <div class="counterup-item__number">
                                        <h3 class="counterup-item__title">
                                            <span class="odometer"
                                                data-odometer-final="{{ $valueThree['number'] }}"></span>{{ __($valueThree['text']) }}
                                        </h3>
                                    </div>
                                    <span class="counterup-item__text ">
                                        {{ __(@$counter->data_values->counter_text_three) }} </span>
                                </div>
                            </div>
                            <div class="counterup-item__content">
                                <div class="content">
                                    <div class="counterup-item__number">
                                        <h3 class="counterup-item__title">
                                            <span class="odometer"
                                                data-odometer-final="{{ $valueFour['number'] }}"></span>{{ __($valueFour['text']) }}
                                        </h3>
                                    </div>
                                    <span class="counterup-item__text ">
                                        {{ __(@$counter->data_values->counter_text_four) }} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="counterup-thumb">
                    <img src="{{ frontendImage('counter', @$counter->data_values->image, '640x630') }}"
                        alt="image">
                </div>
            </div>
        </div>
    </div>
</div>

@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/odometer.css') }} ">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/odometer.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/viewport.jquery.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {
                $('.counterup-item').each(function() {
                    $(this).isInViewport(function(status) {
                        if (status === 'entered') {
                            for (var i = 0; i < document.querySelectorAll('.odometer')
                                .length; i++) {
                                var el = document.querySelectorAll('.odometer')[i];
                                el.innerHTML = el.getAttribute('data-odometer-final');
                            }
                        }
                    });
                });
            });

        })(jQuery);
    </script>
@endpush
