@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card  ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Publisher')</th>
                                    <th>@lang('Ad Title')</th>
                                    <th>@lang('Ad Type')</th>
                                    <th>@lang('Amount')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($earningLogs as $log)
                                    <tr>
                                        <td>
                                            {{ showDateTime($log->date) }}<br>{{ diffForHumans($log->date) }}
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ __($log->publisher->name) }}</span>
                                            <br>
                                            <span class="small"> <a
                                                    href="{{ appendQuery('search', $log->publisher->username) }}"><span>@</span>{{ $log->publisher->username }}</a>
                                            </span>
                                        </td>

                                        <td> {{ __(@$log->advertise->ad_name) }} </td>

                                        <td> {{ __(@$log->advertise->ad_type) }} </td>

                                        <td> <span class="fw-bold"> {{ showAmount($log->amount) }} 
                                            </span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($earningLogs->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($earningLogs) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <x-search-form />
    <form action="" method="GET" class="d-flex flex-wrap gap-2">
        <div class="input-group w-auto flex-fill">
            <input name="date" type="search" data-range="true" data-multiple-dates-separator=" - " data-language="en"
                data-format="Y-m-d" class="datepicker-here form-control bg--white pe-2  date-range" data-position='bottom right'
                placeholder="@lang('Start Date - End Date')" autocomplete="off" value="{{ request()->date }}">
            <button class="btn btn--primary input-group-text"><i class="las la-search"></i></button>
        </div>
    </form>
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
        (function($){
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
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'Last 6 Months': [moment().subtract(6, 'months').startOf('month'), moment().endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                },
                maxDate: moment()
            });
            const changeDatePickerText = (event, startDate, endDate) => {
                $(event.target).val(startDate.format('MMMM DD, YYYY') + ' - ' + endDate.format('MMMM DD, YYYY'));
            }


            $('.date-range').on('apply.daterangepicker', (event, picker) => changeDatePickerText(event, picker.startDate, picker.endDate));


            if ($('.date-range').val()) {
                let dateRange = $('.date-range').val().split(' - ');
                $('.date-range').data('daterangepicker').setStartDate(new Date(dateRange[0]));
                $('.date-range').data('daterangepicker').setEndDate(new Date(dateRange[1]));
            }

        })(jQuery)
    </script>
@endpush