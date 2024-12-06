@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card custom--card">
                    <div class="card-header py-3 d-flex justify-content-between gap-2 flex-wrap">
                        <h5 class="card-title fs-20 text-muted">@lang('KYC Documents')</h5>
                        <a href="{{ route('publisher.dashboard') }}" class="btn btn-outline--base btn--sm">
                           <i class="las la-home"></i> @lang('Back to Dashboard')
                        </a>
                    </div>
                    <div class="card-body">
                        @if ($user->kyc_data)
                            <ul class="list-group list-group-flush">
                                @foreach ($user->kyc_data as $val)
                                    @continue(!$val->value)
                                    <li class="list-group-item d-flex justify-content-between align-items-center ps-0">
                                        {{ __($val->name) }}
                                        <span>
                                            @if ($val->type == 'checkbox')
                                                {{ implode(',', $val->value) }}
                                            @elseif($val->type == 'file')
                                                <a
                                                    href="{{ route('publisher.attachment.download', encrypt(getFilePath('verify') . '/' . $val->value)) }}"><i
                                                        class="fa-regular fa-file"></i> @lang('Attachment') </a>
                                            @else
                                                <p>{{ __($val->value) }}</p>
                                            @endif
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <h5 class="text-center">@lang('KYC data not found')</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
