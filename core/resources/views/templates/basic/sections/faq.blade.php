@php
    $faqContent = getContent('faq.content', true);
    $faqs = getContent('faq.element', false);
@endphp

<div class="faq-section py-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-heading">
                    <h2 class="section-heading__title" data-s-break="-1"> {{ __(@$faqContent->data_values->heading) }}</h2>
                    <p class="section-heading__desc">{{ __(@$faqContent->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <div class="accordion custom--accordion" id="accordionExample">
                            @foreach ($faqs as $index => $faq)
                                @if ($index % 2 == 0)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqHeading{{ $index }}">
                                            <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}" data-bs-toggle="collapse"
                                                data-bs-target="#faqCollapse{{ $index }}" type="button"
                                                aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="faqCollapse{{ $index }}">
                                                {{ __(@$faq->data_values->question) }}
                                            </button>
                                        </h2>
                                        <div class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" id="faqCollapse{{ $index }}"
                                            data-bs-parent="#accordionExample" aria-labelledby="faqHeading{{ $index }}">
                                            <div class="accordion-body">
                                                <p class="desc">{{ __(@$faq->data_values->answer) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion custom--accordion" id="accordionExampletwo">
                            @foreach ($faqs as $index => $faq)
                                @if ($index % 2 != 0)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqHeadingOdd{{ $index }}">
                                            <button class="accordion-button {{ $index == 1 ? '' : 'collapsed' }}" data-bs-toggle="collapse"
                                                data-bs-target="#faqCollapseOdd{{ $index }}" type="button" aria-expanded="{{ $index == 1 ? 'true' : 'false' }}"
                                                aria-controls="faqCollapseOdd{{ $index }}">
                                                {{ __(@$faq->data_values->question) }}
                                            </button>
                                        </h2>
                                        <div class="accordion-collapse collapse  {{ $index == 1 ? 'show' : '' }}" id="faqCollapseOdd{{ $index }}"
                                            data-bs-parent="#accordionExampletwo" aria-labelledby="faqHeadingOdd{{ $index }}">
                                            <div class="accordion-body">
                                                <p class="desc">{{ __(@$faq->data_values->answer) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
