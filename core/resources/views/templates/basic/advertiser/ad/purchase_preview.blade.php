@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card custom--card">
                <div class="card-header py-3">
                    <h4 class="card-title mb-0 fs-20">@lang('Plan Information')</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('advertiser.ad.purchase.plan.confirm') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $plan->id }}" name="plan_id">
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between gap-2 flex-wrap ps-0">
                                <span>@lang('Plan Name')</span>
                                <span>{{ __($plan->name) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between gap-2 flex-wrap ps-0">
                                <span> @lang('Plan Type')</span>
                                <span>{{ __($plan->type) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between gap-2 flex-wrap ps-0">
                                <span>@lang('Plan Credit')</span>
                                <span>{{ $plan->credit }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between gap-2 flex-wrap ps-0">
                                <span>@lang('Plan Price')</span>
                                <span>{{ showAmount($plan->price) }} </span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between gap-2 flex-wrap ps-0">
                                <span>@lang('Total Payable')</span>
                                <span>{{ showAmount($plan->price) }}</span>
                            </li>
                        </ul>
                        <div class="alert alert-info">
                            @lang('NB: Remember')
                            <span class="fw-bold">{{ showAmount($plan->price) }}</span>
                            @lang('will be deducted from your balance. Your current balance is ')
                            <span class="fw-bold">{{ showAmount(auth()->guard('advertiser')->user()->balance) }}</span>
                        </div>
                        <div class="d -flex justify-content-between gap-2 align-content-center flex-wrap">
                            <a href="{{ route('advertiser.ad.price.plan') }}"
                                class="btn btn-dark flex-fill">@lang('Cancel')
                            </a>
                            <button type="submit" class="btn btn--base flex-fill">@lang('Confirm')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
