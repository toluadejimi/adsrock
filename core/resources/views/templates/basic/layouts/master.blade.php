@extends($activeTemplate . 'layouts.app')
@section('panel')
    <!-- ==================== Dashboard Start Here ==================== -->
    <div class="dashboard position-relative">
        <div class="dashboard__inner flex-wrap">


            @if (auth()->guard('publisher')->check())
                @include($activeTemplate . 'partials.publisher_sidebar')
            @else
                @include($activeTemplate . 'partials.advertiser_sidebar')
            @endif


            <div class="dashboard__right">
                @if (auth()->guard('publisher')->check())
                    @include($activeTemplate . 'partials.publisher_header')
                @else
                    @include($activeTemplate . 'partials.advertiser_header')
                @endif

                <div class="dashboard-body">
                    
                    <div class="dashboard-body__top d-flex gap-2 align-content-center mb-4 justify-content-between">
                        <div class="d-flex gap-2 flex-wrap align-items-center">
                            <div class="dashboard-body__bar d-lg-none d-block">
                                <span class="dashboard-body__bar-icon"><i class="fas fa-bars"></i></span>
                            </div>
                            <h5 class="title mb-0">{{ @$pageTitle }}</h5>
                        </div>
                        <div>
                            @stack('breadcrumb-plugins')
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";


            $('.showFilterBtn').on('click', function() {
                $('.responsive-filter-card').slideToggle();
            });

            Array.from(document.querySelectorAll('table')).forEach(table => {
                let heading = table.querySelectorAll('thead tr th');
                Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                    Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                        colum.setAttribute('data-label', heading[i].innerText)
                    });
                });
            });


            var inputElements = $('[type=text],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').first().attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input, select, textarea'), function(i, element) {
                var elementType = $(element);
                if (elementType.attr('type') != 'checkbox') {
                    if (element.hasAttribute('required')) {
                        $(element).closest('.form-group').find('label').addClass('required');
                    }
                }

            });

        })(jQuery);
    </script>
@endpush
