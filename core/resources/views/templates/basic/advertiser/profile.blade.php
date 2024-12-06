@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card custom--card">
                <div class="card-header py-3">
                    <h5 class="mb-0 ">@lang('Update your profile')</h5>
                </div>
                <div class="card-body">
                    <form class="register" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-setting__header text-center">
                            <div class="file-upload">
                                <label for="profile" class="edit"><i class="fas fa-camera"></i></label>
                                <input type="file" name="image" class=" form--control" id="profile"
                                    accept=".jpg,.jpeg,.png" hidden />

                            </div>
                            <div class="thumb">
                                <img class="preview fit-image"
                                    src="{{ getImage(getFilePath('advertiserProfile') . '/' . auth()->guard('advertiser')->user()->image) }}"
                                    alt="image">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="form--label">@lang('First Name')</label>
                                <input type="text" class="form--control" name="firstname" placeholder="@lang('First Name')"
                                    value="{{ @$user->firstname }}" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form--label">@lang('Last Name')</label>
                                <input type="text" class=" form--control" name="lastname" placeholder="@lang('Last Name')"
                                    value="{{ @$user->lastname }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="form--label">@lang('Email')</label>
                                <input class=" form--control" placeholder="@lang('Email')" value="{{ @$user->email }}"
                                    readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form--label">@lang('Mobile')</label>
                                <input class=" form--control" placeholder="@lang('Mobile')" value="{{ @$user->mobile }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="form--label">@lang('Address')</label>
                                <input type="text" class=" form--control" placeholder="@lang('Address')" name="address"
                                    value="{{ @$user->address }}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form--label">@lang('State')</label>
                                <input type="text" class=" form--control" name="state" placeholder="@lang('State')"
                                    value="{{ @$user->state }}">
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="form--label">@lang('Zip Code')</label>
                                <input type="text" class="form--control" name="zip" placeholder="@lang('Zip')"
                                    value="{{ @$user->zip }}">
                            </div>

                            <div class="form-group col-sm-4">
                                <label class="form--label">@lang('City')</label>
                                <input type="text" class=" form--control" name="city" placeholder="@lang('City')"
                                    value="{{ @$user->city }}">
                            </div>

                            <div class="form-group col-sm-4">
                                <label class="form--label">@lang('Country')</label>
                                <input class="l form--control" value="{{ @$user->country_name }}"
                                    placeholder="@lang('Country')" disabled>
                            </div>
                        </div>
                        <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#profile').on('change', function() {
                const file = this.files[0];
                if (file) {
                    $('.preview').attr('src', URL.createObjectURL(file));
                }
            });
        });
    </script>
@endpush
