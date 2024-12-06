
@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card custom--card">
                    <div class="card-header py-3">
                        <h4  class="mb-0 fs-20 text-muted">@lang('Please Fill Up The Kyc Form')</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('publisher.kyc.submit')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <x-viser-form identifier="act" identifierValue="kyc" />

                            <div class="form-group">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection