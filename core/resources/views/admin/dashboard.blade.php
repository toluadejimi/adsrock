@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4">
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="6" link="{{ route('admin.publisher.all') }}" icon="las la-users f-size--56"
                title="Total Publishers" value="{{ $widget['total_publishers'] }}" bg="primary" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="6" link="{{ route('admin.publisher.active') }}" icon="las la-user-check f-size--56"
                title="Active Publishers" value="{{ $widget['verified_publishers'] }}" bg="success" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="6" link="{{ route('admin.publisher.email.unverified') }}"
                icon="lar la-envelope f-size--56" title="Email Unverified Publishers"
                value="{{ $widget['email_unverified_publishers'] }}" bg="danger" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="6" link="{{ route('admin.publisher.mobile.unverified') }}"
                icon="las la-comment-slash f-size--56" title="Mobile Unverified Publishers"
                value="{{ $widget['mobile_unverified_publishers'] }}" bg="warning" />
        </div>
    </div>

    <div class="row gy-4 mt-2">
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="6" link="{{ route('admin.advertiser.all') }}" icon="las la-users f-size--56"
                title="Total Advertisers" value="{{ $widget['total_advertisers'] }}" bg="primary" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="6" link="{{ route('admin.advertiser.active') }}" icon="las la-user-check f-size--56"
                title="Active Advertiser" value="{{ $widget['verified_advertisers'] }}" bg="success" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="6" link="{{ route('admin.advertiser.email.unverified') }}"
                icon="lar la-envelope f-size--56" title="Email Unverified Advertiser"
                value="{{ $widget['email_unverified_advertisers'] }}" bg="danger" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="6" link="{{ route('admin.advertiser.mobile.unverified') }}"
                icon="las la-comment-slash f-size--56" title="Mobile Unverified Advertiser"
                value="{{ $widget['mobile_unverified_advertisers'] }}" bg="red" />
        </div>
    </div>
    <div class="row mt-2 gy-4">
        <div class="col-xxl-6">
            <div class="card box-shadow3 h-100">
                <div class="card-body">
                    <h5 class="card-title">@lang('Deposits')</h5>
                    <div class="widget-card-wrapper">

                        <div class="widget-card bg--success">
                            <a href="{{ route('admin.deposit.list') }}" class="widget-card-link"></a>
                            <div class="widget-card-left">
                                <div class="widget-card-icon">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <div class="widget-card-content">
                                    <h6 class="widget-card-amount">{{ showAmount($deposit['total_deposit_amount']) }}</h6>
                                    <p class="widget-card-title">@lang('Total Deposited')</p>
                                </div>
                            </div>
                            <span class="widget-card-arrow">
                                <i class="las la-angle-right"></i>
                            </span>
                        </div>

                        <div class="widget-card bg--warning">
                            <a href="{{ route('admin.deposit.pending') }}" class="widget-card-link"></a>
                            <div class="widget-card-left">
                                <div class="widget-card-icon">
                                    <i class="fas fa-spinner"></i>
                                </div>
                                <div class="widget-card-content">
                                    <h6 class="widget-card-amount">{{ $deposit['total_deposit_pending'] }}</h6>
                                    <p class="widget-card-title">@lang('Pending Deposits')</p>
                                </div>
                            </div>
                            <span class="widget-card-arrow">
                                <i class="las la-angle-right"></i>
                            </span>
                        </div>

                        <div class="widget-card bg--danger">
                            <a href="{{ route('admin.deposit.rejected') }}" class="widget-card-link"></a>
                            <div class="widget-card-left">
                                <div class="widget-card-icon">
                                    <i class="fas fa-ban"></i>
                                </div>
                                <div class="widget-card-content">
                                    <h6 class="widget-card-amount">{{ $deposit['total_deposit_rejected'] }}</h6>
                                    <p class="widget-card-title">@lang('Rejected Deposits')</p>
                                </div>
                            </div>
                            <span class="widget-card-arrow">
                                <i class="las la-angle-right"></i>
                            </span>
                        </div>

                        <div class="widget-card bg--primary">
                            <a href="{{ route('admin.deposit.list') }}" class="widget-card-link"></a>
                            <div class="widget-card-left">
                                <div class="widget-card-icon">
                                    <i class="fas fa-percentage"></i>
                                </div>
                                <div class="widget-card-content">
                                    <h6 class="widget-card-amount">{{ showAmount($deposit['total_deposit_charge']) }}</h6>
                                    <p class="widget-card-title">@lang('Deposited Charge')</p>
                                </div>
                            </div>
                            <span class="widget-card-arrow">
                                <i class="las la-angle-right"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6">
            <div class="card box-shadow3 h-100">
                <div class="card-body">
                    <h5 class="card-title">@lang('Withdrawals')</h5>
                    <div class="widget-card-wrapper">
                        <div class="widget-card bg--success">
                            <a href="{{ route('admin.withdraw.data.all') }}" class="widget-card-link"></a>
                            <div class="widget-card-left">
                                <div class="widget-card-icon">
                                    <i class="lar la-credit-card"></i>
                                </div>
                                <div class="widget-card-content">
                                    <h6 class="widget-card-amount">{{ showAmount($withdrawals['total_withdraw_amount']) }}
                                    </h6>
                                    <p class="widget-card-title">@lang('Total Withdrawn')</p>
                                </div>
                            </div>
                            <span class="widget-card-arrow">
                                <i class="las la-angle-right"></i>
                            </span>
                        </div>

                        <div class="widget-card bg--warning">
                            <a href="{{ route('admin.withdraw.data.pending') }}" class="widget-card-link"></a>
                            <div class="widget-card-left">
                                <div class="widget-card-icon">
                                    <i class="fas fa-spinner"></i>
                                </div>
                                <div class="widget-card-content">
                                    <h6 class="widget-card-amount">{{ $withdrawals['total_withdraw_pending'] }}</h6>
                                    <p class="widget-card-title">@lang('Pending Withdrawals')</p>
                                </div>
                            </div>
                            <span class="widget-card-arrow">
                                <i class="las la-angle-right"></i>
                            </span>
                        </div>

                        <div class="widget-card bg--danger">
                            <a href="{{ route('admin.withdraw.data.rejected') }}" class="widget-card-link"></a>
                            <div class="widget-card-left">
                                <div class="widget-card-icon">
                                    <i class="las la-times-circle"></i>
                                </div>
                                <div class="widget-card-content">
                                    <h6 class="widget-card-amount">{{ $withdrawals['total_withdraw_rejected'] }}</h6>
                                    <p class="widget-card-title">@lang('Rejected Withdrawals')</p>
                                </div>
                            </div>
                            <span class="widget-card-arrow">
                                <i class="las la-angle-right"></i>
                            </span>
                        </div>
                        <div class="widget-card bg--primary">
                            <a href="{{ route('admin.withdraw.data.all') }}" class="widget-card-link"></a>
                            <div class="widget-card-left">
                                <div class="widget-card-icon">
                                    <i class="las la-percent"></i>
                                </div>
                                <div class="widget-card-content">
                                    <h6 class="widget-card-amount">{{ showAmount($withdrawals['total_withdraw_charge']) }}
                                    </h6>
                                    <p class="widget-card-title">@lang('Withdrawal Charge')</p>
                                </div>
                            </div>
                            <span class="widget-card-arrow">
                                <i class="las la-angle-right"></i>
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-4 mt-2">
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="7" type="2" link="{{ route('admin.advertise.index') }}" icon="las la-ad"
                title="Total Advertises" value="{{ $widget['total_ads'] }}" bg="primary" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="7" type="2" link="{{ route('admin.advertise.type') }}"
                icon="las la-layer-group" title="Total AD Types" value="{{ $widget['ad_type'] }}" bg="1" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="7" type="2" link="{{ route('admin.advertise.plan.price') }}" icon="las la-tags"
                title="Total Plan Price" value="{{ $widget['total_plan'] }}" bg="14" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="7" type="2" link="{{ route('admin.domain.verified') }}" icon="las la-globe"
                title="Total Verified Domains" value="{{ $widget['approved_domain'] }}" bg="19" />
        </div>
    </div>

    <div class="row gy-4 mt-2">
        <div class="col-xxl-4 col-lg-4 col-sm-6">
            <x-widget style="7" link="{{ route('admin.domain.pending') }}" icon="las la-globe"
                title="Total Pending Domains" value="{{ $widget['pending_domain'] }}" bg="primary" />
        </div>
        <div class="col-xxl-4 col-lg-4 col-sm-6">
            <x-widget style="7" link="{{ route('admin.advertise.index') }}" icon="las la-hand-point-up"
                title="Total Clicks" value="{{ shortNumberFormat($widget['total_click']) }}" bg="1" />
        </div>
        <div class="col-xxl-4 col-lg-4 col-sm-6">
            <x-widget style="7" link="{{ route('admin.advertise.index') }}" icon="las la-globe"
                title="Total Impression" value="{{ shortNumberFormat($widget['total_impression']) }}" bg="2" />
        </div>

    </div>

    <div class="row mb-none-30 mt-30">
        <div class="col-xl-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h5 class="card-title">@lang('Deposit & Withdraw Report')</h5>

                        <div id="dwDatePicker" class="border p-1 cursor-pointer rounded">
                            <i class="la la-calendar"></i>&nbsp;
                            <span></span> <i class="la la-caret-down"></i>
                        </div>
                    </div>
                    <div id="dwChartArea"> </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h5 class="card-title">@lang('Transactions Report')</h5>

                        <div id="trxDatePicker" class="border p-1 cursor-pointer rounded">
                            <i class="la la-calendar"></i>&nbsp;
                            <span></span> <i class="la la-caret-down"></i>
                        </div>
                    </div>

                    <div id="transactionChartArea"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-none-30 mt-5">
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <h5 class="card-title">@lang('Login By Browser') (@lang('Last 30 days'))</h5>
                    <canvas id="userBrowserChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Login By OS') (@lang('Last 30 days'))</h5>
                    <canvas id="userOsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Login By Country') (@lang('Last 30 days'))</h5>
                    <canvas id="userCountryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/chart.js.2.8.0.js') }}"></script>
    <script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/charts.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/daterangepicker.css') }}">
@endpush

@push('script')
    <script>
        "use strict";

        const start = moment().subtract(14, 'days');
        const end = moment();

        const dateRangeOptions = {
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 15 Days': [moment().subtract(14, 'days'), moment()],
                'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                    'month')],
                'Last 6 Months': [moment().subtract(6, 'months').startOf('month'), moment().endOf('month')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
            },
            maxDate: moment()
        }

        const changeDatePickerText = (element, startDate, endDate) => {
            $(element).html(startDate.format('MMMM D, YYYY') + ' - ' + endDate.format('MMMM D, YYYY'));
        }

        let dwChart = barChart(
            document.querySelector("#dwChartArea"),
            @json(__(gs('cur_text'))),
            [{
                    name: 'Deposited',
                    data: []
                },
                {
                    name: 'Withdrawn',
                    data: []
                }
            ],
            [],
        );

        let trxChart = lineChart(
            document.querySelector("#transactionChartArea"),
            [{
                    name: "Plus Transactions",
                    data: []
                },
                {
                    name: "Minus Transactions",
                    data: []
                }
            ],
            []
        );


        const depositWithdrawChart = (startDate, endDate) => {

            const data = {
                start_date: startDate.format('YYYY-MM-DD'),
                end_date: endDate.format('YYYY-MM-DD')
            }

            const url = @json(route('admin.chart.deposit.withdraw'));

            $.get(url, data,
                function(data, status) {
                    if (status == 'success') {
                        dwChart.updateSeries(data.data);
                        dwChart.updateOptions({
                            xaxis: {
                                categories: data.created_on,
                            }
                        });
                    }
                }
            );
        }

        const transactionChart = (startDate, endDate) => {

            const data = {
                start_date: startDate.format('YYYY-MM-DD'),
                end_date: endDate.format('YYYY-MM-DD')
            }

            const url = @json(route('admin.chart.transaction'));


            $.get(url, data,
                function(data, status) {
                    if (status == 'success') {


                        trxChart.updateSeries(data.data);
                        trxChart.updateOptions({
                            xaxis: {
                                categories: data.created_on,
                            }
                        });
                    }
                }
            );
        }



        $('#dwDatePicker').daterangepicker(dateRangeOptions, (start, end) => changeDatePickerText('#dwDatePicker span',
            start, end));
        $('#trxDatePicker').daterangepicker(dateRangeOptions, (start, end) => changeDatePickerText('#trxDatePicker span',
            start, end));

        changeDatePickerText('#dwDatePicker span', start, end);
        changeDatePickerText('#trxDatePicker span', start, end);

        depositWithdrawChart(start, end);
        transactionChart(start, end);

        $('#dwDatePicker').on('apply.daterangepicker', (event, picker) => depositWithdrawChart(picker.startDate, picker
            .endDate));
        $('#trxDatePicker').on('apply.daterangepicker', (event, picker) => transactionChart(picker.startDate, picker
            .endDate));

        piChart(
            document.getElementById('userBrowserChart'),
            @json(@$chart['user_browser_counter']->keys()),
            @json(@$chart['user_browser_counter']->flatten())
        );

        piChart(
            document.getElementById('userOsChart'),
            @json(@$chart['user_os_counter']->keys()),
            @json(@$chart['user_os_counter']->flatten())
        );

        piChart(
            document.getElementById('userCountryChart'),
            @json(@$chart['user_country_counter']->keys()),
            @json(@$chart['user_country_counter']->flatten())
        );
    </script>
@endpush
@push('style')
    <style>
        .apexcharts-menu {
            min-width: 120px !important;
        }
    </style>
@endpush
