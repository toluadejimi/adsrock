@extends($activeTemplate . 'layouts.master')
@section('content')
    @php
        $user = auth()->guard('advertiser')->user();
    @endphp
    <div class="pricing-plan-wrapper">
        <div class="row gy-3">
            @if (!$user->impression_credit && !$user->click_credit)
                <div class="col-12">
                    <div class="alert  alert-info">
                        <p class="mb-0">
                            @lang('Please choose a plan from our offerings before proceeding. Please take a moment to explore the various plans we have')
                            <a href="{{ route('advertiser.ad.price.plan') }}">@lang('available').</a>
                        </p>
                    </div>
                </div>
            @endif
            @forelse ($types as $type)
                <div class="col-xxl-3 col-lg-4 col-sm-6 col-xsm-6">
                    <div class="card custom--card">
                        <div class="card-header py-3">
                            <h4 class="card-title mb-0 fs-20 text-center">
                                {{ __($type->ad_name) }}
                            </h4>
                        </div>
                        <div class="card-body py-3">
                            <ul class=" list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex align-items-center gap-2 flex-wrap justify-content-between ps-0">
                                    @lang('Type') <span class="fw-bold">{{ __(ucfirst($type->type)) }}</span>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center gap-2 flex-wrap justify-content-between ps-0">
                                    @lang('Width') <span>{{ $type->width }}@lang('px')</span>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center gap-2 flex-wrap justify-content-between ps-0">
                                    @lang('Height') <span>{{ $type->height }}@lang('px')</span>
                                </li>
                            </ul>
                        </div>
                        @if ($user->impression_credit || $user->click_credit)
                            <div class="card-footer py-3 mt-0">
                                <a class="btn btn--base w-100 " href="{{ route('advertiser.ad.create.form', $type->id) }}">
                                    @lang('CREATE AD')
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('advertiser.ad.index') }}" class="btn btn-outline--base btn--sm">
        <i class="las la-list"></i> @lang('My Ads')
    </a>
@endpush
