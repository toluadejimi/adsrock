@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="pricing-plan-wrapper">
        <div class="row gy-4">
            @include('Template::partials.plan',['coloumnClass' => "col-xxl-6  col-sm-6 col-md-12"])
        </div>
    </div>
@endsection
