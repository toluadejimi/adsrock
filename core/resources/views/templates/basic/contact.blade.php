@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $contact = getContent('contact_us.content', true);
    @endphp
    <div class="py-100">
        <div class="container">
            <div class="row mb-5 gy-4">
                <div class="col-lg-6">
                    <div class="contact-wrapper">
                        <h3 class="contact-wrapper__title mb-2">{{ __(@$contact->data_values->heading) }}</h3>
                        <p class="contact-wrapper__desc">
                            {{ __(@$contact->data_values->subheading) }}
                        </p>
                        <form method="post" class="verify-gcaptcha">
                            @csrf
                            <div class=" form-group">
                                <label for="name" class="form--label">@lang('Name')</label>
                                <input type="text" class="form--control" id="name" placeholder="@lang('Name')"
                                    name="name" value="{{ old('name', @$user->fullname) }}"
                                    @if (@$user && $user->profile_complete) readonly @endif required />
                            </div>

                            <div class=" form-group">
                                <label for="mail" class="form--label"> @lang('Email') </label>
                                <input type="email" class="form--control" id="mail" placeholder="@lang('Email')"
                                    name="email" value="{{ old('email', @$user->email) }}"
                                    @if ($user) readonly @endif required />
                            </div>

                            <div class=" form-group">
                                <label for="mail" class="form--label">@lang('Subject')</label>
                                <input type="text" class="form--control" placeholder="@lang('Subject')" id="mail"
                                    name="subject" value="{{ old('subject') }}" required />
                            </div>

                            <div class=" form-group">
                                <label for="message" class="form--label">@lang('Message')</label>
                                <textarea name="message" class="form--control" cols="30" rows="10" placeholder="@lang('Message')" required>{{ old('message') }}</textarea>
                            </div>
                            @php
                                $placeholder = true;
                            @endphp
                            <x-captcha :placeholder='$placeholder' />

                            <button type="submit" class="btn btn--base btn--lg">
                                @lang('Submit')
                            </button>

                        </form>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="contact-thumb">
                        <img src="{{ frontendImage('contact_us', @$contact->data_values->image, '670x700') }}"
                            alt="image" class="fit-image" />
                    </div>
                </div>
            </div>
            <div class="contact-map pt-50">
                <iframe src="{{ @$contact->data_values->map_url }}" frameborder="0"></iframe>
            </div>
        </div>
    </div>

    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
