@extends($activeTemplate . '.layouts.master')
@section('content')
    <div class="row gy-4">
        <div class="col-xxl-4 col-sm-6">
            <div class="dashboard-widget">
                <div class="content">
                    <h4 class="dashboard-widget__number">
                        {{ shortNumberFormat($advertise->clicked) }}
                    </h4>
                    <span>@lang('Total Click')</span>
                </div>
                <div class="dashboard-widget__icon">
                    <i class="las la-mouse"></i>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-sm-6">
            <div class="dashboard-widget">
                <div class="content">
                    <h4 class="dashboard-widget__number">
                        {{ shortNumberFormat($advertise->impression) }}
                    </h4>
                    <span>@lang('Total Impression')</span>
                </div>
                <div class="dashboard-widget__icon">
                    <i class="las la-eye"></i>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-sm-12">
            <div class="dashboard-widget">
                <div class="content">
                    <h4 class="dashboard-widget__number">
                        {{ __(ucfirst($advertise->ad_type)) }}
                    </h4>
                    <span>@lang('Ad Type')</span>
                </div>
                <div class="dashboard-widget__icon">
                    @if ($advertise->ad_type == 'impression')
                        <i class="las la-globe"></i>
                    @else
                        <i class="las la-mouse"></i>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class=" card custom--card h-100">
                <div class="card-header py-3">
                    <h4 class="mb-0 fs-20">@lang('Ad Information')</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex flex-wrap justify-content-between gap-2 ps-0">
                            <span>@lang('Type')</span>
                            <span>{{ __($advertise->ad_name) }}</span>
                        </li>
                        <li class="list-group-item d-flex flex-wrap justify-content-between gap-2 ps-0">
                            <span>@lang('Ad title')</span>
                            <span>{{ __($advertise->ad_title) }}</span>
                        </li>
                        <li class="list-group-item d-flex flex-wrap justify-content-between gap-2 ps-0">
                            <span>@lang('Redirect URL')</span>
                            <span>
                                <a target="_blank" href="{{ $advertise->redirect_url }}">{{ $advertise->redirect_url }}
                                    <i class="las la-external-link-alt"></i>
                                </a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex flex-wrap justify-content-between gap-2 ps-0">
                            <span>@lang('Created Date')</span>
                            <span>{{ showDateTime($advertise->created_at, 'd M, Y h:i A') }}</span>
                        </li>
                        <li class="list-group-item d-flex flex-wrap justify-content-between gap-2 ps-0">
                            <span>@lang('Keywords')</span>
                            <span>
                                @foreach (@$advertise->keywords ?? [] as $keyword)
                                    <span class="badge bg-dark">{{ @$keyword }}
                                    </span>
                                @endforeach
                            </span>
                        </li>
                        <li class="list-group-item d-flex flex-wrap justify-content-between gap-2 ps-0">
                            <span>@lang('Target Country')</span>
                            <span>
                                @if (@$advertise->global)
                                    <span class="text--success">@lang('All countries of the world')</span>
                                @else
                                    @foreach (@$advertise->countries ?? [] as $country)
                                        <span class="badge bg-dark">{{ __(@$country->country_name) }}
                                        </span>
                                    @endforeach
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card custom--card h-100">
                <div class="card-header py-3">
                    <h4 class="mb-0 fs-20">@lang('Ad Image')</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <img class="thumb rounded" src="{{ getImage(getFilePath('advertise') . '/' . $advertise->image) }}"
                            width="{{ $advertise->type->width }}" height="{{ $advertise->type->height }}" />
                    </div>
                    <div class="mb-3">
                        <h6 class="mb-1">
                            {{ __(ucfirst($advertise->ad_name)) }}
                            <small class="text--danger">
                                ({{ @$advertise->resolution }})@lang('px')
                            </small>
                        </h6>
                        <small class="text-black">
                            @lang('Created At')
                            <span>{{ date('d M, Y h:i A', strtotime($advertise->created_at)) }} </span>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <div class="d-flex gap-2 flex-wrap">
        <div>
            <a href="{{ route('advertiser.ad.edit', @$advertise->id) }}" class="btn btn--sm btn-outline--base">
                <span class="icon"> <i class="las la-pencil-alt"></i> </span>
                @lang('Edit')
            </a>
        </div>
        <div>
            <a href="{{ route('advertiser.ad.index') }}" class="btn btn--sm btn-outline-dark">
                <i class="la la-undo"></i> @lang('Back')
            </a>
        </div>
    </div>
@endpush
@push('style')
    <style>
        .btn-outline-dark {
            color: #000000 !important;
            border-color: #000000;
        }

        .btn-outline-dark:hover {
            color: #ffffff !important;
        }
    </style>
@endpush
