@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="notice mb-3"></div>
    <div class="row gy-3  justify-content-center">
        @if ($publisher->kv == Status::KYC_UNVERIFIED && $publisher->kyc_rejection_reason)
            <div class="col-12">
                <div class="custom--card card">
                    <div class="card-body">
                        <h5 class="text--danger mb-2">@lang('KYC Documents Rejected')</h5>
                        <p class="mb-0">
                            {{ __(@$kyc->data_values->reject) }}
                            <a href="{{ route('publisher.kyc.form') }}">@lang('Click Here to Re-submit Documents')</a>,
                            <a href="{{ route('publisher.kyc.data') }}">@lang('See Your KYC Data')</a>,
                            <button type="button" class="text--base" data-bs-toggle="modal"
                                data-bs-target="#kycRejectionReason">
                                @lang('Show Reject Reason.')
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        @elseif($publisher->kv == Status::KYC_UNVERIFIED)
            <div class="col-12">
                <div class="custom--card card">
                    <div class="card-body">
                        <h5 class="text--info mb-2">@lang('KYC Verification required')</h5>
                        <p class="mb-0">
                            {{ __(@$kyc->data_values->required) }}
                            <a href="{{ route('publisher.kyc.form') }}">@lang('Click Here to Submit Documents')</a>
                        </p>
                    </div>
                </div>
            </div>
        @elseif($publisher->kv == Status::KYC_PENDING)
            <div class="col-12">
                <div class="custom--card card">
                    <div class="card-body">
                        <h5 class="text--warning mb-2">@lang('KYC Verification pending')</h5>
                        <p class="mb-0">
                            {{ __(@$kyc->data_values->pending) }}
                            <a href="{{ route('publisher.kyc.data') }}">@lang('See Your KYC Data')
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-xxl-3 col-sm-6">
            <div class="dashboard-widget">
                <div class="content">
                    <h4 class="dashboard-widget__number">{{ collect($publisherAd)->sum('impression_count') }}</h4>
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
                    <h4 class="dashboard-widget__number">{{ collect($publisherAd)->sum('click_count') }}</h4>
                    <span class="dashboard-widget__title">@lang('Total Click')</span>
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
                        {{ gs('cur_sym') }}{{ showAmount($publisher->earning, currencyFormat: false) }}
                    </h4>
                    <a href="{{ route('publisher.report.perDay') }}" class="dashboard-widget__title">
                        @lang('Balance') <i class="fas fa-angle-right"></i>
                    </a>
                </div>
                <div class="dashboard-widget__icon">
                    <i class="las la-money-bill-wave"></i>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <div class="dashboard-widget">
                <div class="content">
                    <h4 class="dashboard-widget__number">
                        {{ gs('cur_sym') }}{{ showAmount($totalWithdraw, currencyFormat: false) }}
                    </h4>
                    <a href="{{ route('publisher.withdraw.history') }}" class="dashboard-widget__title">
                        @lang('Total Withdraw') <i class="fas fa-angle-right"></i>
                    </a>
                </div>
                <div class="dashboard-widget__icon">
                    <i class="las la-hand-holding-usd"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card custom--card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Monthly  Earning  Reports')</h5>
                    <div id="apex-bar-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card custom--card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Monthly  Withdraw   Report')</h5>
                    <div id="apex-bar-chart-w"></div>
                </div>
            </div>
        </div>

    </div>


    @if ($publisher->kv == Status::KYC_UNVERIFIED && $publisher->kyc_rejection_reason)
        <div class="modal fade" id="kycRejectionReason">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('KYC Document Rejection Reason')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $publisher->kyc_rejection_reason }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>
@endpush

@push('script')
    <script>
        'use strict'


        var options = {
            series: [{
                    name: 'Total Earning',
                    data: @json($report['trx_month_amount']->flatten())
                },

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

        var chart = new ApexCharts(document.querySelector("#apex-bar-chart"), options);
        chart.render();
    </script>
    <script>
        'use strict'
        var options = {
            series: [{
                    name: '@lang('Total Withdraw')',
                    data: @json($withdrawData['amount']->flatten())
                },


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
                categories: @json($withdrawData['date']->flatten()),
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

        var chart = new ApexCharts(document.querySelector("#apex-bar-chart-w"), options);
        chart.render();
    </script>
@endpush
