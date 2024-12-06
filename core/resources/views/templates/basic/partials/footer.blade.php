@php
    $socialIcons = getContent('footer.element');
    $footer = getContent('footer.content', true);
    $policyPages = getContent('policy_pages.element', false, null, true);
@endphp

<footer class="footer-area">
    <div class="footer-shape">
        <img src="{{ frontendImage('footer', $footer->data_values->shape, '380x385') }}" alt="" class="one">
    </div>
    <div class="py-50">
        <div class="container">
            <div class="row justify-content-center gy-5">
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <div class="footer-item__logo">
                            <a href="{{ route('home') }}"> <img src="{{ siteLogo('dark') }}" alt="image"></a>
                        </div>
                        <p class="footer-item__desc">{{ __($footer->data_values->description) }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 ps-xl-5">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Quick Links')</h5>
                        <ul class="footer-menu">
                            <li class="footer-menu__item"><a class="footer-menu__link"
                                    href="{{ route('home') }}">@lang('Home')</a></li>
                            <li class="footer-menu__item"><a class="footer-menu__link"
                                    href="{{ route('blogs') }}">@lang('Blogs')</a></li>
                            <li class="footer-menu__item"><a class="footer-menu__link"
                                    href="{{ route('contact') }}">@lang('Contact')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Policy Links')</h5>
                        <ul class="footer-menu">
                            @foreach ($policyPages as $policy)
                                <li class="footer-menu__item">
                                    <a class="footer-menu__link" href="{{ route('policy.pages', $policy->slug) }}">
                                        {{ __($policy->data_values->title) }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 wow fadeInUp" data-wow-duration="4s">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Newsletter')</h5>
                        <p class="footer-item__text">
                            {{ __($footer->data_values->newsletter_description) }}
                        </p>
                        <form class="footer-contact-form">
                            <input class="form--control form-two" type="email" name="email" id="subscriber"
                                placeholder="@lang('Email Address')" required>
                            <button class="btn btn--base subscribe-btn" type="button">@lang('Subscribe')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-footer">
        <div class="container">
            <div class="bottom-footer__inner">
                <div
                    class="d-flex justify-content-center justify-content-md-between flex-wrap gap-2 align-content-center">
                    <div class="bottom-footer-text fs-14 text-dark">
                        &copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ __(gs('site_name')) }}</a>.
                        @lang('All Rights Reserved.')
                    </div>
                    <ul class="social-list">
                        @foreach ($socialIcons as $socialIcon)
                            <li class="social-list__item">
                                <a class="social-list__link flex-center" href="{{ @$socialIcon->data_values->url }}"
                                    target="_blank">
                                    @php echo @$socialIcon->data_values->social_icon @endphp
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


@push('script')
    <script>
        'use strict';
        (function($) {
            $('.subscribe-btn').on('click', function() {
                var email = $('#subscriber').val();
                var csrf = '{{ csrf_token() }}';
                $.ajax({
                    type: 'post',
                    url: '{{ route('subscriber.store') }}',
                    data: {
                        email: email,
                        _token: csrf
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            notify('success', response.success);
                            $('#subscriber').val('');
                        } else {
                            notify('error', response.error);
                        }
                    }
                });
            });

            //has cta section
            if (!$('section').last().hasClass("cta-section")) {
                $(".footer-area").addClass("section-bg");
            }
        })(jQuery);
    </script>
@endpush
