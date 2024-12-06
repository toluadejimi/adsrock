@php
    $ctaContent = @getContent('cta.content', true)->data_values;
@endphp

<section class="cta-section  py-100 section-bg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cta-wrapper">
                    <div class="row">
                        <div class="col-md-6 px-md-0 d-none d-md-block">
                            <div class="cta-thumb">
                                <img src="{{ frontendImage('cta', @$ctaContent->image, '660x485') }}" alt="cta-image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cta-content">
                                <div class="cta-content__inner">
                                    <h2 class="cta-content__title mb-4" data-s-break="-2">
                                        {{ __(@$ctaContent->heading) }}</h2>
                                    <p class="cta-content__desc mb-4">{{ __(@$ctaContent->subheading) }}</p>
                                    <div class="d-flex gap-3 flex-wrap align-items-center">
                                        <a href="{{ @$ctaContent->button_one_url }}"
                                            class="btn btn--base">{{ __(@$ctaContent->button_one_text) }}
                                        </a>
                                        <a href="{{ @$ctaContent->button_two_url }}"
                                            class="btn btn-outline--base">{{ __(@$ctaContent->button_two_text) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
