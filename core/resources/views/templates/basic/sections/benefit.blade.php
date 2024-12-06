@php
    $benefitContent = @getContent('benefit.content', true)->data_values;
    $benefitElements = getContent('benefit.element', false,orderById:true);
@endphp

<div class="account-system pb-100">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" data-s-break="-1">{{ __(@$benefitContent->heading) }}</h2>
            <p class="section-heading__desc">{{ __(@$benefitContent->subheading) }}</p>
        </div>
        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="account-item text-center">
                    <h4 class="mb-5">@lang('Advertiser')</h4>
                    <div class="account-item__thumb">
                        <img src="{{ frontendImage('benefit', @$benefitContent->advertiser_image, '450x300') }}"
                            alt="image">
                    </div>
                    <ul class="account-system-list">
                        @foreach ($benefitElements->where('data_values.benefit_for', 'advertiser') as $advertiserBenefit)
                            <li class="item">
                                <span class="icon"><i class="fas fa-check"></i></span>
                                {{ __(@$advertiserBenefit->data_values->benefit_title) }}
                            </li>
                        @endforeach
                    </ul>
                    <div class="account-system__btn">
                        <a href="{{ url(@$benefitContent->advertiser_button_url) }}" class="btn btn-outline--base">
                            <span class="btn-icon"><i class="las la-user-circle"></i></span>
                            {{ __(@$benefitContent->advertiser_button_text) }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="account-item text-center">
                    <h4 class="mb-5">@lang('Publisher')</h4>
                    <div class="account-item__thumb">
                        <img src="{{ frontendImage('benefit', @$benefitContent->publisher_image, '450x300') }}"
                            alt="image">
                    </div>
                    <ul class="account-system-list">
                        @foreach ($benefitElements->where('data_values.benefit_for', 'publisher') as $publisherBenefit)
                            <li class="item">
                                <span class="icon"><i class="fas fa-check"></i></span>
                                {{ __(@$publisherBenefit->data_values->benefit_title) }}
                            </li>
                        @endforeach
                    </ul>
                    <div class="account-system__btn">
                        <a href="{{ url(@$benefitContent->publisher_button_url) }}" class="btn btn-outline--base">
                            <span class="btn-icon"><i class="las la-check-square"></i></span>
                            {{ __(@$benefitContent->publisher_button_text) }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
