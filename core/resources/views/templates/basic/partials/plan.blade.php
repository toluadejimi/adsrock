@forelse ($plans as $plan)
    <div class="{{ $coloumnClass }}">
        <div class="pricing-card">
            <div class="pricing-card__header">
                <h5 class="pricing-card__title mb-0">
                    {{ __(strtoupper($plan->name)) }}
                    @if ($plan->id == @$advertiserPlanId)
                        <span class="d-block fs-12 bg-white  p-1 rounded-1 rounded text-dark">@lang('Active Plan')</span>
                    @endif
                </h5>
            </div>
            <ul class="pricing-item__list">
                <li class="pricing-item__item">
                    @lang('Type:') <span>{{ __(ucfirst($plan->type)) }}</span>
                </li>
                <li class="pricing-item__item">
                    @lang('Credit:') <span>{{ number_format($plan->credit) }}</span>
                </li>
            </ul>
            <div class="pricing-card__right">
                <h4 class="pricing-item__price">
                    {{ showAmount($plan->price) }}
                </h4>
                <div>
                    @auth('advertiser')
                        <button type="button" class="btn btn-outline--base btn--sm purchase"
                            data-plan_route="{{ route('advertiser.ad.purchase.plan', $plan->id) }}"
                            data-route="{{ route('advertiser.deposit.index', $plan->id) }}">
                            <i class="las la-shopping-bag"></i> @lang('Purchase Now')
                        </button>
                    @else
                        <a class="btn btn-outline--base btn--sm" href="{{ route('advertiser.login') }}">
                            <i class="las la-shopping-bag"></i> @lang('Purchase Now')
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="text-center">
        <img class="empty-image" src="{{ asset('assets/images/empty_list.png') }}" alt="empty">
        <p class="mt-0">@lang('No pricing plans are available')</p>
    </div>
@endforelse

@auth('advertiser')
    @push('modal')
        <div class="modal fade" id="purchaseModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-end  flex-wrap gap-2">
                        <h4 class="modal-title fs-20">@lang('Payment Option')</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center py-3">
                        <h1 class="mb-0"><i class="fas fa-hand-holding-usd text--base"></i></h1>
                        <strong class="text--secondary mb-15">@lang('Please choose your payment option!')</strong>
                    </div>
                    <div class=" modal-footer d-flex flex-wrap justify-content-between gap-2 py-3">
                        <a class="btn btn--primary planpurchase flex-fill">@lang('Balance/Wallet')</a>
                        <a class="btn btn--base gateway flex-fill">@lang('Payment Gateway')</a>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('script')
        <script>
            'use strict';
            $('.purchase').on('click', function() {
                var gateway = $(this).data('route')
                var account = $(this).data('plan_route')
                var modal = $('#purchaseModal');
                $('.gateway').attr('href', gateway)
                $('.planpurchase').attr('href', account)
                modal.modal('show');
            })
        </script>
    @endpush
@endauth

@push('style')
    <style>
        .empty-image {
            max-width: 100px;
        }
    </style>
@endpush
