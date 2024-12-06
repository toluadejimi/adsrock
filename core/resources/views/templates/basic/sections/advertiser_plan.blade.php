@php
    $adsContent = getContent('advertiser_plan.content', true);
    $plans = App\Models\PlanPrice::orderBy('price')
        ->searchable(['name', 'credit', 'type'])
        ->paginate(getPaginate());
@endphp

<section class="ad-section py-100 ">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" data-s-break="-1"> {{ __(@$adsContent->data_values->heading) }}</h2>
            <p class="section-heading__desc">{{ __(@$adsContent->data_values->title) }}</p>
        </div>
        <div class="pricing-plan-wrapper">
            <div class="row gy-4 gx-2">
                @include('Template::partials.plan', [
                    'coloumnClass' => 'col-lg-6 col-md-12 col-sm-6 col-xsm-6',
                ])
            </div>
        </div>
    </div>
</section>
@push('style')
    <style>
        .pricing-card {
            grid-template-columns: 1.5fr 2fr 2fr;
            border: 1px solid hsl(var(--border-color))
        }
    </style>
@endpush
