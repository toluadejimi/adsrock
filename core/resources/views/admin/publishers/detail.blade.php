@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-12">
            <div class="row gy-4">
        
                
                <div class="col-xxl-3 col-sm-6">
                    <x-widget
                        style="7"
                      link="javacript:void(0)"
                        title="Earning"
                        icon="las la-money-bill-wave-alt"
                        value="{{ showAmount($publisher->earning) }}"
                        bg="indigo"
                        type="2"
                    />
                </div>


                <div class="col-xxl-3 col-sm-6">
                    <x-widget
                        style="7"
                        link="javacript:void(0)"
                        title="Withdraws"
                        icon="las la-wallet"
                        value="{{ showAmount($totalWithdraw) }}"
                        bg="8"
                        type="2"
                    />
                </div>

                <div class="col-xxl-3 col-sm-6">
                    <x-widget
                        style="7"
                  link="javacript:void(0)"
                        title="Total Click"
                        icon="las la-hand-point-up"
                        value="{{ collect($totalAdvertise)->sum('click_count') }}"
                        bg="6"
                        type="2"
                    />
                </div>

                <div class="col-xxl-3 col-sm-6">
                    <x-widget
                        style="7"
                 link="javacript:void(0)"
                        title="Total Impression"
                        icon="las fa-globe-asia"
                        value="{{ collect($totalAdvertise)->sum('impression_count') }}"
                        bg="17"
                        type="2"
                    />
                </div>

                <!-- dashboard-w1 end -->

            </div>

            <div class="d-flex flex-wrap gap-3 mt-4">
        

                <div class="flex-fill">
                    <a href="{{ route('admin.report.login.history.publisher') }}?search={{ $publisher->username }}"
                        class="btn btn--primary btn--shadow w-100 btn-lg">
                        <i class="las la-list-alt"></i>@lang('Logins')
                    </a>
                </div>

                <div class="flex-fill">
                    <a href="{{ route('admin.publisher.notification.log', $publisher->id) }}"
                        class="btn btn--secondary btn--shadow w-100 btn-lg">
                        <i class="las la-bell"></i>@lang('Notifications')
                    </a>
                </div>

                <div class="flex-fill">
                    @if ($publisher->status == Status::ADVERTISER_ACTIVE)
                        <button type="button" class="btn btn--warning btn--shadow w-100 btn-lg userStatus"
                            data-bs-toggle="modal" data-bs-target="#userStatusModal">
                            <i class="las la-ban"></i>@lang('Ban Publisher')
                        </button>
                    @else
                        <button type="button" class="btn btn--success btn--shadow w-100 btn-lg userStatus"
                            data-bs-toggle="modal" data-bs-target="#userStatusModal">
                            <i class="las la-undo"></i>@lang('Unban Publisher')
                        </button>
                    @endif
                </div>
                
                @if($publisher->kyc_data)
                <div class="flex-fill">
                    <a href="{{ route('admin.publisher.kyc.details', $publisher->id) }}" target="_blank" class="btn btn--dark btn--shadow w-100 btn-lg">
                        <i class="las la-user-check"></i>@lang('KYC Data')
                    </a>
                </div>
                @endif
            </div>

           
            <div class="card mt-30">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('Information of') {{$publisher->fullname}}</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.publisher.update',[$publisher->id])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('First Name')</label>
                                    <input class="form-control" type="text" name="firstname" required value="{{$publisher->firstname}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">@lang('Last Name')</label>
                                    <input class="form-control" type="text" name="lastname" required value="{{$publisher->lastname}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Email') </label>
                                    <input class="form-control" type="email" name="email" value="{{$publisher->email}}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Mobile Number') </label>
                                    <div class="input-group ">
                                        <span class="input-group-text mobile-code">+{{ $publisher->dial_code }}</span>
                                        <input type="number" name="mobile" value="{{ $publisher->mobile }}" id="mobile" class="form-control checkUser" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label>@lang('Address')</label>
                                    <input class="form-control" type="text" name="address" value="{{@$publisher->address}}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label>@lang('City')</label>
                                    <input class="form-control" type="text" name="city" value="{{@$publisher->city}}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label>@lang('State')</label>
                                    <input class="form-control" type="text" name="state" value="{{@$publisher->state}}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label>@lang('Zip/Postal')</label>
                                    <input class="form-control" type="text" name="zip" value="{{@$publisher->zip}}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label>@lang('Country') <span class="text--danger">*</span></label>
                                    <select name="country" class="form-control select2">
                                        @foreach($countries as $key => $country)
                                            <option data-mobile_code="{{ $country->dial_code }}" value="{{ $key }}" @selected($publisher->country_code == $key)>{{ __($country->country) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="form-group">
                                    <label>@lang('Email Verification')</label>
                                    <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                           data-bs-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')" name="ev"
                                           @if($publisher->ev) checked @endif>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="form-group">
                                    <label>@lang('Mobile Verification')</label>
                                    <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                           data-bs-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')" name="sv"
                                           @if($publisher->sv) checked @endif>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md- col-12">
                                <div class="form-group">
                                    <label>@lang('2FA Verification') </label>
                                    <input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="ts" @if($publisher->ts) checked @endif>
                                </div>
                            </div>
                            <div class="col-xl-3 col-12">
                                <div class="form-group">
                                    <label>@lang('KYC') </label>
                                    <input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')" name="kv" @if($publisher->kv == Status::KYC_VERIFIED) checked @endif>
                                </div>
                            </div>
                       
                            <div class="col-md-12">
                                <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <div id="userStatusModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if ($publisher->status == Status::ADVERTISER_ACTIVE)
                            <span>@lang('Ban Advertiser')</span>
                        @else
                            <span>@lang('Unban Advertiser')</span>
                        @endif
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.publisher.status', $publisher->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @if ($publisher->status == Status::ADVERTISER_ACTIVE)
                            <h6 class="mb-2">@lang('If you ban this publisher he/she won\'t able to access his/her dashboard.')</h6>
                            <div class="form-group">
                                <label>@lang('Reason')</label>
                                <textarea class="form-control" name="reason" rows="4" required></textarea>
                            </div>
                        @else
                            <p><span>@lang('Ban reason was'):</span></p>
                            <p>{{ $publisher->ban_reason }}</p>
                            <h4 class="text-center mt-3">@lang('Are you sure to unban this publisher?')</h4>
                        @endif
                    </div>
                    <div class="modal-footer">
                        @if ($publisher->status == Status::ADVERTISER_ACTIVE)
                            <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                        @else
                            <button type="button" class="btn btn--dark"
                                data-bs-dismiss="modal">@lang('No')</button>
                            <button type="submit" class="btn btn--primary">@lang('Yes')</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
    <a href="{{route('admin.publisher.login',$publisher->id)}}" target="_blank" class="btn btn-sm btn-outline--primary" ><i class="las la-sign-in-alt"></i>@lang('Login as Publisher')</a>
@endpush

@push('script')
<script>
    (function($){
    "use strict"



        let mobileElement = $('.mobile-code');
        $('select[name=country]').on('change',function(){
            mobileElement.text(`+${$('select[name=country] :selected').data('mobile_code')}`);
        });

    })(jQuery);
</script>
@endpush