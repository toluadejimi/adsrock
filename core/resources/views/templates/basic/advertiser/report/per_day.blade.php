@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-table">
        <table class="table table--responsive--lg table-style-two table-style-two--custom">
            <thead>
                <tr>
                    <th>@lang('Date')</th>
                    <th>@lang('Trx.')</th>
                    <th>@lang('Credit Cuts')</th>
                    <th>@lang('Detail')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                    <tr>
                        <td>
                            <div>
                                {{ showDateTime($trx->date, 'd F, Y') }} <br />
                                <small>{{ diffForHumans($trx->date) }}</small>
                            </div>
                        </td>
                        <td>{{ $trx->trx }}</td>

                        <td>
                            <strong
                                @if ($trx->trx_type == '+') class="text--success" @else class="text--danger" @endif>
                                {{ $trx->trx_type == '+' ? '+' : '-' }}
                                {{ showAmount($trx->amount, 4, currencyFormat: false) }}</strong>
                        </td>
                        <td>{{ $trx->details }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="text-center ">
                            <img src="{{ asset('assets/images/empty_list.png') }}" alt="empty">
                            <p>{{ __($emptyMessage) }}</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table><!-- table end -->
    </div>

    @if ($transactions->hasPages())
        <div class="mt-3">

            {{ paginateLinks($transactions) }}
        </div>
    @endif
@endsection

@push('breadcrumb-plugins')
    <form action="" method="GET" class="d-flex flex-wrap gap-2">
        <div class="flex-between gap-3">
            <div class="form-group search-form mb-0">

                <input name="date" type="search" data-range="true" data-multiple-dates-separator=" - "
                    data-language="en" data-format="Y-m-d" class="datepicker-here form--control bg--white pe-2  date-range"
                    data-position='bottom right' placeholder="@lang('Start Date - End Date')" autocomplete="off"
                    value="{{ request()->date }}">

                <button type="submit" class="icon">
                    <span><i class="fas fa-search"></i></span>
                </button>
            </div>
        </div>
    </form>
@endpush

@push('style')
    <style>
        [class*="bg"] {
            color: #000000;
        }
    </style>
@endpush
@push('style-lib')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/daterangepicker.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/daterangepicker.min.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict"

            const datePicker = $('.date-range').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                },
                showDropdowns: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 15 Days': [moment().subtract(14, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                        .endOf('month')
                    ],
                    'Last 6 Months': [moment().subtract(6, 'months').startOf('month'), moment().endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                },
                maxDate: moment()
            });
            const changeDatePickerText = (event, startDate, endDate) => {
                $(event.target).val(startDate.format('MMMM DD, YYYY') + ' - ' + endDate.format('MMMM DD, YYYY'));
            }


            $('.date-range').on('apply.daterangepicker', (event, picker) => changeDatePickerText(event, picker
                .startDate, picker.endDate));


            if ($('.date-range').val()) {
                let dateRange = $('.date-range').val().split(' - ');
                $('.date-range').data('daterangepicker').setStartDate(new Date(dateRange[0]));
                $('.date-range').data('daterangepicker').setEndDate(new Date(dateRange[1]));
            }

        })(jQuery)
    </script>
@endpush
