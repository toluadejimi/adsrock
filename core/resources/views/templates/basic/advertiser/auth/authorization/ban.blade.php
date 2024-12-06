@extends($activeTemplate . 'layouts.frontend')
@section('panel')
    @php
        $banned = getContent('banned.content', true);
    @endphp
    <section>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center min-vh-100">
                <div class="col-lg-6 text-center ">
                    <img src="{{ frontendImage('banned', @$banned->data_values->image, '700x400') }}" alt="@lang('image')"
                        class="img-fluid mx-auto">
                    <h4 class="text-danger">{{ __(@$banned->data_values->heading) }}</h4>
                    <div class=" mb-3">
                        <h5>@lang('Ban Reason')</h5>
                        <span class="text-danger mb-3"> {{ __($user->ban_reason) }}</span>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn--base">@lang('Browse') {{ __(gs('site_name')) }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        body {
            background: unset !important;
        }
    </style>
@endpush


