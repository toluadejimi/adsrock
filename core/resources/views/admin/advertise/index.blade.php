@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-md-12">
            <div class="card  ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                                <tr>
                                    <th>@lang('Advertiser')</th>
                                    <th>@lang('Name') | @lang('Title')</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Impression') | @lang('Click')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($advertises as $ad)
                                    <tr>
                                        <td>
                                            {{ __($ad->advertiser->fullname) }}
                                            <a class="d-block"
                                                href="{{ route('admin.advertiser.detail', $ad->advertiser->id) }}">{{ $ad->advertiser->username }}
                                            </a>
                                        </td>
                                        <td>
                                            <div>
                                                {{ __($ad->ad_name) }} <br>
                                                {{ strLimit(__($ad->ad_title), 40) }}
                                            </div>
                                        </td>
                                        <td> @php echo $ad->typeBadge;@endphp </td>
                                        <td>
                                            <div>
                                                <span class="text-primary">{{ $ad->impression }}</span>
                                                |<span class="text--success"> {{ $ad->clicked }}</span>
                                            </div>
                                        </td>
                                        <td> @php echo $ad->statusBadge; @endphp </td>
                                        <td>
                                            <div class="button--group">
                                                <a href="{{ route('admin.advertise.detail', $ad->id) }}"
                                                    class="btn btn-sm btn-outline--primary">
                                                    <i class="la la-desktop"></i>@lang('Detail')
                                                </a>
                                                @if ($ad->status == Status::DISABLE)
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--success ms-1 confirmationBtn"
                                                        data-action="{{ route('admin.advertise.status', $ad->id) }}"
                                                        data-question="@lang('Are you sure to active this advertise')?">
                                                        <i class="la la-eye"></i> @lang('Active')
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--danger confirmationBtn"
                                                        data-action="{{ route('admin.advertise.status', $ad->id) }}"
                                                        data-question="@lang('Are you sure to deactive this advertise')?">
                                                        <i class="la la-eye-slash"></i> @lang('Deactive')
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($advertises->hasPages())
                        <div class="card-footer py-4">
                            @php echo paginateLinks($advertises) @endphp
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
@endpush
