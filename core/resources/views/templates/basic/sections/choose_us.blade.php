@php
    $chooseUsContent  = getContent('choose_us.content', true);
    $chooseUsElements = getContent('choose_us.element', false, orderById: true);
@endphp

<div class="why-choose-section py-100 section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section-heading__title" data-s-break="-1"> {{ __(@$chooseUsContent->data_values->heading) }}</h2>
                    <p class="section-heading__desc">{{ __(@$chooseUsContent->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="row gy-4 align-items-center">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="choose-item__left">
                    @foreach ($chooseUsElements->take(3) as $chooseUsElement)
                        <div class="choose-item">
                            <div class="choose-item__thumb">
                                <img src="{{ frontendImage('choose_us', @$chooseUsElement->data_values->image, '55x55') }}"
                                    alt="image">
                            </div>
                            <h5 class="choose-item__title"> {{ __(@$chooseUsElement->data_values->title) }} </h5>
                            <p class="choose-item__desc">
                                {{ __(@$chooseUsElement->data_values->description) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-xl-6 col-lg-4 d-lg-block d-none">
                <div class="choose-thumb">
                    <img src="{{ frontendImage('choose_us', @$chooseUsContent->data_values->image, '575x550') }}"
                        alt="image">
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-sm-6">
                @foreach ($chooseUsElements->take(6)->slice(3) as $chooseUsElement)
                    <div class="choose-item">
                        <div class="choose-item__thumb">
                            <img src="{{ frontendImage('choose_us', @$chooseUsElement->data_values->image, '55x55') }}"
                                alt="image">
                        </div>
                        <h5 class="choose-item__title"> {{ __(@$chooseUsElement->data_values->title) }} </h5>
                        <p class="choose-item__desc">
                            {{ __(@$chooseUsElement->data_values->description) }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
