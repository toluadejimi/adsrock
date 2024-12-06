@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="dashboard-table">
        <table class="table table--responsive--lg table-style-two table-style-two--custom">

            <thead>
                <tr>
                    <th>@lang('Avertise')</th>
                    <th>@lang('Advertise Type')</th>
                    <th>@lang('Date')</th>
                    <th>@lang('Impression')| @lang('Click')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                    <tr>
                        <td>
                            <div class="d-flex gap-2 flex-wrap align-items-center auhtor-item">
                                <div class="customer__thumb">
                                    <img src="{{ getImage(getFilePath('advertise') . '/' . @$report->advertise->image) }}"
                                        class="fit-image" alt="@lang('Image')" />
                                </div>
                                <div>
                                    <a
                                        href="{{ route('publisher.published.ad.details', @$report->advertise_id) }}">{{ __(@$report->advertise->ad_title) }}</a>
                                    <br>
                                    <span class="fs-13">{{ __(@$report->advertise->ad_name) }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span
                                class="badge {{ $report->advertise->ad_type == 'click' ? 'badge--warning' : 'badge--primary' }}">{{ $report->advertise->ad_type }}</span>
                        </td>
                        <td>{{ showDateTime($report->date, 'd M Y') }}</td>
                        <td>
                            <div>
                                <span class="badge text--info">{{ getAmount(@$report->impression_count) }}</span>|
                                <span class="badge text--success">{{ getAmount(@$report->click_count) }}</span>
                            </div>
                        </td>
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

    @if ($reports->hasPages())
        <div class="mt-3">
            {{ paginateLinks($reports) }}
        </div>
    @endif
@endsection

@push('breadcrumb-plugins')
    <div class=" d-flex gap-2">

        <x-search-form placeholder="Search.." isNotAdmin="true" />

        <form action="" method="GET">
            <div class="form-group search-form mb-0 ">
                <input name="date" type="search" class="datepicker-here form--control  pe-2 date-range"
                    placeholder="@lang('Start Date - End Date')" autocomplete="off" value="{{ request()->date }}">
                <button type="submit" class="icon">
                    <span><i class="fas fa-search"></i></span>
                </button>
            </div>
        </form>
    </div>
@endpush

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
