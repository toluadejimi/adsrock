@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="show-filter">
                <button type="button" class="filter-btn">
                    <span class="icon"><i class="fa-solid fa-bars-staggered"></i></span>
                    @lang('Filter')
                </button>
            </div>
            <div class="transaction-top">
                <span class="filter__close d-sm-none d-block"><i class="fas fa-times"></i>
                </span>
                <form action="#">
                    <div class="transaction-form">
                        <div class="form-group flex-grow-1">
                            <label class="form--label">
                                @lang('Transaction Number')
                            </label>

                            <input type="text" placeholder="@lang('Trx')" name="search"
                                value="{{ request()->search }}" class="form--control">
                        </div>
                        <div class="form-group flex-grow-1">
                            <label class="form--label">@lang('Type')</label>
                            <select class="form-select form--control select2" data-minimum-results-for-search="-1"
                                name="trx_type">
                                <option value="">@lang('All')</option>
                                <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                                <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                            </select>
                        </div>
                        <div class="form-group flex-grow-1">
                            <label class="form--label">@lang('Remark')</label>
                            <select class="form-select form--control select2" data-minimum-results-for-search="-1"
                                name="remark">
                                <option value="">@lang('Any')</option>
                                @foreach ($remarks as $remark)
                                    <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>
                                        {{ __(keyToTitle($remark->remark)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group flex-grow-1">
                            <label class="form--label">@lang('Date')</label>
                            <input name="date" type="search" class="datepicker-here form--control date-range"
                                placeholder="@lang('Start Date - End Date')" autocomplete="off" value="{{ request()->date }}">
                        </div>
                        <div class="flex-grow-1 align-self-end">
                            <button class="btn btn--base w-100">
                                <span class="btn-icon"><i class="las la-filter"></i></span>
                                @lang('Filter')
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="transaction-table">
                <table class="table table--responsive--xl table-style-two table-style-two--custom">
                    <thead>
                        <tr>
                            <th>@lang('Trx')</th>
                            <th>@lang('Transacted')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Post Balance')</th>
                            <th>@lang('Detail')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                            <tr>
                                <td>
                                    <strong>{{ $trx->trx }}</strong>
                                </td>

                                <td>
                                    {{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                                </td>

                                <td class="budget">
                                    <span
                                        class="fw-bold @if ($trx->trx_type == '+') text--success @else text--danger @endif">
                                        {{ showAmount($trx->amount) }}
                                    </span>
                                </td>

                                <td class="budget">
                                    {{ showAmount($trx->post_balance) }}
                                </td>

                                <td>{{ __($trx->details) }}</td>
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
        </div>
    </div>
@endsection


@push('style')
    <style>
        .daterangepicker select.yearselect {
            width: unset;
        }

        select {
            padding: 0px !important;
        }

        .select2-container {
            width: 100% !important;
        }
    </style>
@endpush



@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/daterangepicker.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
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
