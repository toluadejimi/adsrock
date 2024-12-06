@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="dashboard-table">
        <table class="table table--responsive--lg table-style-two table-style-two--custom">
            <thead>
                <tr>
                    <th>@lang('Avertise')</th>
                    <th>@lang('Advertise Type')</th>
                    <th>@lang('Date')</th>
                    <th>@lang('Amount')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>
                            <div class="d-flex gap-2 flex-wrap align-items-center auhtor-item">
                                <div class="customer__thumb">
                                    <img src="{{ getImage(getFilePath('advertise') . '/' . @$log->advertise->image) }}"
                                        class="fit-image" alt="@lang('Image')" />
                                </div>
                                <div>
                                    <a href="{{ route('publisher.published.ad.details', @$log->advertise_id) }}">
                                        {{ __(strLimit(@$log->advertise->ad_title, 50)) }}
                                    </a>
                                    <br>
                                    <span class="fs-13">{{ __(@$log->advertise->ad_name) }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span
                                class="badge {{ $log->advertise->ad_type == 'click' ? 'badge--warning' : 'badge--primary' }}">{{ $log->advertise->ad_type }}</span>
                        </td>
                        <td>{{ showDateTime($log->date, 'd F, Y') }}</td>
                        <td>{{ showAmount($log->amount) }}</td>
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

    @if ($logs->hasPages())
        <div class="mt-3">
            {{ paginateLinks($logs) }}
        </div>
    @endif
@endsection

@push('breadcrumb-plugins')
    <form action="" method="GET" class="d-flex flex-wrap gap-2">
        <div class="flex-between gap-3">
            <div class="form-group search-form mb-0">

                <input name="date" type="search" class="datepicker-here form--control pe-2  date-range"
                    placeholder="@lang('Start Date - End Date')" autocomplete="off" value="{{ request()->date }}">

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

@push('script-lib')
    @push('script-lib')
        <script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/daterangepicker.min.js') }}"></script>
    @endpush

    @push('style-lib')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/daterangepicker.css') }}">
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


    @push('style')
        <style>
            .customer__thumb {
                width: 50px;
                height: 50px;
            }
        </style>
    @endpush
