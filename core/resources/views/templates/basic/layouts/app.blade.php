<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ gs()->siteName(__($pageTitle)) }}</title>
    @include('partials.seo')

    <link href="{{ asset('assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/global/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/global/css/line-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/main.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/custom.css') }}">

    @stack('style-lib')
    @stack('style')

    <link rel="stylesheet"
        href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color={{ gs('base_color') }}&secondColor={{ gs('secondary_color') }}">

</head>
@php echo loadExtension('google-analytics') @endphp

<body>
    <div class="preloader">
        <div class="loader-p"></div>
    </div>

    <div class="body-overlay"></div>
    <div class="sidebar-overlay"></div>

    <a class="scroll-top"><i class="fas fa-angle-double-up"></i></a>

    @stack('fbComment')
    @yield('panel')

    @stack('modal')

    <script src="{{ asset('assets/global/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset($activeTemplateTrue . 'js/viewport.jquery.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/main.js') }}"></script>


    @stack('script-lib')

    @php echo loadExtension('tawk-chat') @endphp
    @include('partials.notify')

    @if (gs('pn'))
        @if (@auth()->guard('publisher')->user())
            @include('partials.publisher_push_script')
        @else
            @include('partials.advertiser_push_script')
        @endif
    @endif
    @stack('script')

    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "{{ route('home') }}/change/" + $(this).val();
            });

            let disableSubmission = false;
            $('.disableSubmission').on('submit', function(e) {
                if (disableSubmission) {
                    e.preventDefault()
                } else {
                    disableSubmission = true;
                }
            });

            $.each($('.select2'), function() {
                $(this)
                    .wrap(`<div class="position-relative"></div>`)
                    .select2({
                        dropdownParent: $(this).parent()
                    });
            });

            let elements = document.querySelectorAll('[data-s-break]');
            Array.from(elements).forEach(element => {
                let html = element.innerHTML;
                if (typeof html != 'string') {
                    return false;
                }
                let breakLength = parseInt(element.getAttribute('data-s-break'));
                html = html.split(" ");
                var colorText = [];
                if (breakLength < 0) {
                    colorText = html.slice(breakLength);
                } else {
                    colorText = html.slice(0, breakLength);
                }
                let solidText = [];
                html.filter(ele => {
                    if (!colorText.includes(ele)) {
                        solidText.push(ele);
                    }
                });
                var color = element.getAttribute('s-color') || "text--base";
                colorText = `<span class="${color}">${colorText.toString().replaceAll(',', ' ')}</span>`;
                solidText = solidText.toString().replaceAll(',', ' ');
                breakLength < 0 ? element.innerHTML = `${solidText} ${colorText}` : element.innerHTML =
                    `${colorText} ${solidText}`
            });

        })(jQuery);
    </script>
</body>

</html>
