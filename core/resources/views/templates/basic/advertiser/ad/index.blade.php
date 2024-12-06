@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-table ">
        <div class="table-responsive">
            <table class="table table--responsive--lg table-style-two table-style-two--custom">
                <thead>
                    <tr>
                        <th>@lang('Avertise')</th>
                        <th>@lang('Type')</th>
                        <th>@lang('Dimension')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Impression')| @lang('Click')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($advertises as $ad)
                        <tr>
                            <td>
                                <div class="d-flex gap-2 flex-wrap align-items-center auhtor-item">
                                    <div class="customer__thumb">
                                        <img src="{{ getImage(getFilePath('advertise') . '/' . $ad->image) }}"
                                            class="fit-image" alt="@lang('Image')" />
                                    </div>
                                    <div>
                                        <span>{{ strLimit(__($ad->ad_title),30) }}</span> <br>
                                        <span class="fs-13 text--base">{{ __($ad->ad_name) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>@php echo $ad->typeBadge; @endphp</td>
                            <td>{{ __($ad->resolution) }}</td>
                            <td> @php echo $ad->statusBadge; @endphp </td>
                            <td>
                                <div>
                                    <span class="badge text--info">{{ shortNumberFormat(@$ad->impression) }}</span>|
                                    <span class="badge text--success">{{ shortNumberFormat(@$ad->clicked) }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown action-drop">
                                    <a class="btn btn-outline--base btn--sm dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        @lang('Action')
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item">
                                            <a href="{{ route('advertiser.ad.edit', $ad->id) }}" class="text--base">
                                                <i class="la la-pencil"></i> @lang('Edit')
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{ route('advertiser.ad.details', $ad->id) }}" class=" text--info">
                                                <i class="la la-desktop"></i> @lang('Details')
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            @if ($ad->status == Status::DISABLE)
                                                <button type="button" class=" text--success confirmationBtn"
                                                    data-action="{{ route('advertiser.ad.status', $ad->id) }}"
                                                    data-question="@lang('Are you sure to active this ad')?">
                                                    <i class="la la-eye"></i> @lang('Active')
                                                </button>
                                            @else
                                                <button type="button" class=" text--warning confirmationBtn"
                                                    data-action="{{ route('advertiser.ad.status', $ad->id) }}"
                                                    data-question="@lang('Are you sure to inactive this ad')?">
                                                    <i class="la la-eye-slash"></i> @lang('InActive')
                                                </button>
                                            @endif
                                        </li>
                                    </ul>
                                </div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center ">
                                <img src="{{ asset('assets/images/empty_list.png') }}" alt="empty">
                                <p>{{ __($emptyMessage) }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($advertises->hasPages())
        <div class="mt-3">
            {{ paginateLinks($advertises) }}
        </div>
    @endif
    <x-confirmation-modal size="btn--sm" btnDark="btn-dark" btnPrimary="btn--base" />
@endsection

@push('breadcrumb-plugins')
    <div class="d-flex gap-3 flex-wrap align-items-center breadcrumb-wrapper">
        <x-search-form placeholder="Search by Title/Resulation" isNotAdmin="true" />
        <a href="{{ route('advertiser.ad.create') }}" class="btn btn-outline--base btn--sm">
            <i class="las la-plus"></i> @lang('New Ad')
        </a>
    </div>
@endpush

@push('style')
    <style>
        .dashboard .action-btn__icon {
            width: unset;
            height: unset;
        }

        .breadcrumb-wrapper .btn--sm {
            padding: 12px 10px !important;
        }

        .customer__thumb {
            width: 50px;
            height: 50px;
        }
    </style>
@endpush
