@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-4 justify-content-center">
        <div class="col-12">
            <div class="notice mb-4"></div>
            <div class="row  mb-4 gy-4 justify-content-center dashboard-widget-wrapper">
                <div class="col-xxl-3 col-sm-6">
                    <div class="dashboard-widget">
                        <div class="content">
                            <h4 class="dashboard-widget__number">
                                {{ getAmount($totalAd->sum('impression')) }}
                            </h4>
                            <span class="dashboard-widget__title">@lang('Total Impression')</span>
                        </div>
                        <div class="dashboard-widget__icon">
                            <i class="las la-eye"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-sm-6">
                    <div class="dashboard-widget">
                        <div class="content">
                            <h4 class="dashboard-widget__number">
                                {{ getAmount($totalAd->sum('clicked')) }}
                            </h4>
                            <span class="dashboard-widget__title">@lang('Total Clicked')</span>
                        </div>
                        <div class="dashboard-widget__icon">
                            <i class="las la-mouse"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-sm-6">
                    <div class="dashboard-widget">
                        <div class="content">
                            <h4 class="dashboard-widget__number">
                                {{ getAmount($advertiser->impression_credit) }}
                            </h4>
                            <span class="dashboard-widget__title">@lang('Remaining Impression Credit')</span>
                        </div>
                        <div class="dashboard-widget__icon">
                            <i class="las la-credit-card"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-sm-6">
                    <div class="dashboard-widget">
                        <div class="content">
                            <h4 class="dashboard-widget__number">{{ getAmount($advertiser->click_credit) }}</h4>
                            <span class="dashboard-widget__title">@lang('Remaining Click Credit')</span>
                        </div>
                        <span class="dashboard-widget__icon">
                            <i class="las la-caret-square-right"></i>
                        </span>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="dashboard-widget">
                        <div class="content">
                            <h4 class="dashboard-widget__number">{{ $advertiser->ads->count() }}</h4>
                            <a href="{{ route('advertiser.ad.index') }}" class="dashboard-widget__title">
                                @lang('Total Advertises') <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                        <div class="dashboard-widget__icon">
                            <i class="la la-ad"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-sm-6">
                    <div class="dashboard-widget">
                        <div class="content">
                            <h4 class="dashboard-widget__number">
                                {{ showAmount($advertiser->balance) }}
                            </h4>
                            <a href="{{ route('advertiser.transactions') }}" class="dashboard-widget__title">
                                @lang('Balance') <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                        <div class="dashboard-widget__icon">
                            <i class="las la-dollar-sign"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-sm-6">
                    <div class="dashboard-widget">
                        <div class="content">
                            <h4 class="dashboard-widget__number">
                                {{ gs('cur_sym') }}{{ showAmount($totalDeposit, currencyFormat: false) }}
                            </h4>
                            <a href="{{ route('advertiser.deposit.history') }}" class="dashboard-widget__title">
                                @lang('Total Deposited') <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                        <div class="dashboard-widget__icon">
                            <i class="las la-wallet"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-sm-6">
                    <div class="dashboard-widget">
                        <div class="content">
                            <h4 class="dashboard-widget__number">
                                {{ getAmount($totalTrx) }}
                            </h4>
                            <a href="{{ route('advertiser.transactions') }}" class="dashboard-widget__title">
                                @lang('Total Transaction') <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                        <div class="dashboard-widget__icon">
                            <i class="las la-exchange-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 mb-30">
            <div class="card custom--card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Monthly Transaction Report')</h5>
                    <div id="apex-bar-chart-trx"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-30">
            <div class="card custom--card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Monthly Deposit Report')</h5>
                    <div id="apex-bar-chart-depo"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>
@endpush

@push('script')
    <script>
        'use strict'
        var options = {
            series: [{
                    name: 'Total Transaction',
                    data: @json($report['trx_month_amount']->flatten())
                }

            ],
            chart: {
                type: 'bar',
                height: 400,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '5%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: @json($report['trx_months']->flatten()),
            },
            yaxis: {
                title: {
                    text: "{{ gs('cur_sym') }}",
                    style: {
                        color: '#7c97bb'
                    }
                }
            },
            grid: {
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                },
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "{{ gs('cur_sym') }}" + val + " "
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#apex-bar-chart-trx"), options);
        chart.render();
    </script>

    <script>
        'use strict'
        var options = {
            series: [{
                    name: 'Total Deposit',
                    data: @json($report['deposit_month_amount']->flatten())
                }

            ],
            chart: {
                type: 'bar',
                height: 400,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '5%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: @json($report['deposit_months']->flatten()),
            },
            yaxis: {
                title: {
                    text: "{{ gs('cur_sym') }}",
                    style: {
                        color: '#7c97bb'
                    }
                }
            },
            grid: {
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                },
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "{{ gs('cur_sym') }}" + val + " "
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#apex-bar-chart-depo"), options);
        chart.render();
    </script>
@endpush
