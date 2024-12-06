@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card custom--card">
                <div class="card-header py-3">
                    <h5 class="mb-0 ">@lang('Change your password')</h5>
                </div>
                <div class="card-body">
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label class="form--label">@lang('Current Password')</label>
                            <input type="password" class=" form--control" name="current_password"
                                placeholder="@lang('Current Password')" required autocomplete="current-password">
                        </div>
                        <div class="form-group">
                            <label class="form--label">@lang('Password')</label>
                            <input type="password"
                                class=" form--control @if (gs('secure_password')) secure-password @endif"
                                placeholder="@lang('Password')" name="password" required autocomplete="current-password">
                        </div>
                        <div class="form-group">
                            <label class="form--label">@lang('Confirm Password')</label>
                            <input type="password" class=" form--control" name="password_confirmation"
                                placeholder="@lang('Confirm Password')" required autocomplete="current-password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
