@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-table">
        <table class="table table--responsive--lg table-style-two table-style-two--custom">
            <thead>
                <tr>
                    <th>@lang('Avertise')</th>
                    <th>@lang('Visit From')</th>
                    <th>@lang('Ad Type')</th>
                    <th>@lang('Impression')| @lang('Click')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                    <tr>
                        <td>
                            <div class="d-flex gap-2 flex-wrap align-items-center auhtor-item">
                                <div class="customer__thumb">
                                    <img src="{{ getImage(getFilePath('advertise') . '/' . @$report->advertise->image) }}"
                                        class="fit-image" alt="@lang('Image')" />
                                </div>
                                <div>
                                    <a
                                        href="{{ route('advertiser.ad.details', @$report->advertise->id) }}">
                                        {{ __(strLimit(@$report->advertise->ad_title,40)) }}
                                        
                                    </a>
                                    <br>
                                    <span class="fs-13">{{ __(@$report->advertise->ad_name) }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span>{{ __(@$report->country ?? 'N/A') }}</span>
                        </td>
                        <td>
                            {{ __(ucfirst(@$report->advertise->ad_type)) }}
                        </td>
                        <td>
                            <div>
                                <span class="badge text--info">{{ shortNumberFormat(@$report->impression_count) }}</span>|
                                <span class="badge text--success">{{ shortNumberFormat(@$report->click_count) }}</span>
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
        </table><!-- table end -->
    </div>

    @if ($reports->hasPages())
        <div class="mt-3">
            {{ paginateLinks($reports) }}
        </div>
    @endif


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Image Preview')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">

                    <div class="card  overflow-hidden box--shadow1 mt-1 d-inline-block">
                        <div class="card-body p-0">
                            <div class="p-3 bg--white">
                                <div>
                                    <h4 id="adname"><small class="text--danger " id="res"></small></h4>
                                </div>
                                <div><img id="img" src="" /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Search by Title/Country" isNotAdmin="true" />
@endpush

@push('style')
    <style>
        .customer__thumb {
            width: 50px;
            height: 50px;
        }
    </style>
@endpush
