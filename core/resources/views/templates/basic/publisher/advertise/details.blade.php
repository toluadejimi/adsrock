@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-4">
        <div class="col-lg-4 col-sm-6">
            <div class="dashboard-widget">
                <div class="content">
                    <div class="flex-between">
                        <h6 class="dashboard-widget__title">
                            @lang('Total Impression')
                        </h6>
                    </div>
                    <div class="flex-between gap-2">
                        <h4 class="dashboard-widget__number">{{ shortNumberFormat($count->impression_count) }}
                        </h4>
                    </div>
                </div>
                <span class="dashboard-widget__icon">
                    <i class="las la-eye"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="dashboard-widget">
                <div class="content">
                    <div class="flex-between">
                        <h6 class="dashboard-widget__title">
                            @lang('Total Clicked')
                        </h6>
                    </div>
                    <div class="flex-between gap-2">
                        <h4 class="dashboard-widget__number">{{ shortNumberFormat($count->click_count) }}
                        </h4>
                    </div>
                </div>
                <span class="dashboard-widget__icon">
                    <i class="las la-mouse"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="dashboard-widget">
                <div class="content">
                    <div class="flex-between">
                        <h6 class="dashboard-widget__title">
                            @lang('Add Type')
                        </h6>
                    </div>
                    <div class="flex-between gap-2">
                        <h4 class="dashboard-widget__number">{{ ucfirst($advertise->ad_type) }}
                        </h4>
                    </div>
                </div>
                <span class="dashboard-widget__icon">
                    <i class="las la-random"></i>
                </span>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="card  custom--card">
                <div class="card-header py-3">
                    <h4 class="fs-20 mb-0">
                        {{ __($advertise->ad_name) }} @lang('Information')
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush pt-0">
                        <li class=" list-group-item d-flex justify-content-between gap-2 flex-wrap">
                            <span>@lang('Advertiser')</span>
                            <span>{{ $advertise->advertiser->fullname }}</span>
                        </li>
                        <li class=" list-group-item d-flex justify-content-between gap-2 flex-wrap">
                            <span>@lang('Ad Name')</span>
                            <span>{{ __($advertise->ad_name) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="card custom--card">
                <div class="card-body">
                    <img class="thumb" src="{{ getImage(getFilePath('advertise') . '/' . $advertise->image) }}"
                        width="{{ $advertise->type->width }}" height="{{ $advertise->type->height }}" />
                    <div class="mt-3">
                        <h6 class="mb-2">
                            {{ __($advertise->ad_name) }}
                            <small class="text--danger">({{ @$advertise->resolution }})@lang('px') </small>
                        </h6>
                        <small class="text-black">@lang('Created At')
                            <strong>{{ date('d M, Y h:i A', strtotime($advertise->created_at)) }} </strong>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('publisher.published.ad') }}" />
@endpush
