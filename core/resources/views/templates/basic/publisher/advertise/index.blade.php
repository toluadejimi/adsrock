@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-table">
        <table class="table table--responsive--lg table-style-two table-style-two--custom">
            <thead>
                <tr>
                    <th>@lang('Advertise')</th>
                    <th>@lang('Dimension')</th>
                    <th>@lang('Action')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ads as $ad)
                    <tr>
                        <td>
                            <div>
                                <span>{{ __($ad->ad_name) }}</span> <br />
                                <span class="text--base">{{ __(ucfirst($ad->type)) }}</span> <br />
                            </div>
                        </td>
                        <td>{{ __($ad->slug) }}@lang('px')</td>
                        <td>
                            <textarea class="d-none" id="advertScript{{ $ad->id }}" class="form--control" rows="3" readonly><div class='MainAdverTiseMentDiv' data-publisher="{{ Crypt::encryptString(auth()->guard('publisher')->user()->id) }}" data-adsize="{{ $ad->slug }}"></div><script class="adScriptClass" src="{{ url('/') }}/assets/ads/ad.js"></script></textarea>
                            <button class="btn btn-outline--base copyButton btn--sm">
                                <i class="las la-copy"></i> @lang('Copy Script')
                            </button>
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
    @if ($ads->hasPages())
        <div class="mt-4">
            {{ paginateLinks($ads) }}
        </div>
    @endif
@endsection

@push('script')
    <script>
        "use strict";
        (function($) {
            $(".copyButton").on("click", function(e) {
                const copyText = $(this).siblings('textarea').text();

                navigator.clipboard.writeText(copyText).then(() => {
                    console.log('Text copied to clipboard');
                }).catch(err => {
                    console.error('Failed to copy text: ', err);
                });
                this.classList.add('copied');
                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
@endpush



@push('style')
    <style>
        .customer__thumb {
            width: 50px;
            height: 50px;
        }

        .copied::after {
            background-color: #{{ gs('base_color') }};
        }
    </style>
@endpush
