@php
    $authContent = getContent('auth.content', true);
@endphp

<div class="account-inner__right bg-img"
    data-background-image="{{ frontendImage('auth', $authContent->data_values->image, '1150x945') }}">
    <div class="account-inner__right-content">
        <h2 class="account-inner__right-title" data-s-break="-3">{{ __(@$authContent->data_values->heading) }}</h2>
        <p class="account-inner__right-desc">{{ __(@$authContent->data_values->short_description) }}</p>
    </div>
</div>
