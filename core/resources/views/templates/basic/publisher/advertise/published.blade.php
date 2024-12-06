@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-table">
        <table class="table table--responsive--lg table-style-two table-style-two--custom">
            <thead>
                <tr>
                    <th>@lang('Avertise')</th>
                    <th>@lang('Advertise Type')</th>
                    <th>@lang('Impression')| @lang('Click')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($publishedAds as $ad)
                    <tr>
                        <td>
                            <div class="d-flex gap-2 flex-wrap align-items-center auhtor-item">
                                <div class="customer__thumb">
                                    <img src="{{ getImage(getFilePath('advertise') . '/' . @$ad->advertise->image) }}"
                                        class="fit-image" alt="@lang('Image')" />
                                </div>
                                <div>
                                    <a href="{{ route('publisher.published.ad.details', @$ad->advertise_id) }}">
                                        {{ __(strLimit(@$ad->advertise->ad_title, 50)) }}
                                    </a>
                                    <br>
                                    <span class="fs-13">{{ __(@$ad->advertise->ad_name) }}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ __(ucfirst(@$ad->advertise->ad_type)) }}</td>
                        <td>
                            <div>
                                <span class="badge text--info">{{ getAmount(@$ad->impression_count) }}</span>|
                                <span class="badge text--success">{{ getAmount(@$ad->click_count) }}</span>
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

    @if ($publishedAds->hasPages())
        <div class="mt-3">
            {{ paginateLinks($publishedAds) }}
        </div>
    @endif
@endsection

@push('style')
    <style>
        .customer__thumb {
            width: 50px;
            height: 50px;
        }
    </style>
@endpush
