@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-table">
        <table class="table--responsive--xxl table-style-two table-style-two--custom table">
            <thead>
                <tr>
                    <th>@lang('Gateway | Transaction')</th>
                    <th class="text-center">@lang('Initiated')</th>
                    <th class="text-center">@lang('Amount')</th>
                    <th class="text-center">@lang('Conversion')</th>
                    <th class="text-center">@lang('Status')</th>
                    <th>@lang('Action')</th>
                </tr>
            </thead>
            <tbody>

                @forelse($withdraws as $withdraw)
                    @php
                        $details = [];
                        foreach ($withdraw->withdraw_information as $key => $info) {
                            $details[] = $info;
                            if ($info->type == 'file') {
                                $details[$key]->value = route(
                                    'user.download.attachment',
                                    encrypt(getFilePath('verify') . '/' . $info->value),
                                );
                            }
                        }
                    @endphp
                    <tr>
                        <td>
                            <div>
                                <span class="fw-bold"><span class="text-primary">
                                        {{ __(@$withdraw->method->name) }}</span></span>
                                <br>
                                <small>{{ $withdraw->trx }}</small>
                            </div>
                        </td>
                        <td>
                            {{ showDateTime($withdraw->created_at) }} <br> {{ diffForHumans($withdraw->created_at) }}
                        </td>
                        <td>
                            <div>
                                {{ showAmount($withdraw->amount) }} - <span class="text--danger" data-bs-toggle="tooltip"
                                    title="@lang('Processing Charge')">{{ showAmount($withdraw->charge) }} </span>
                                <br>
                                <strong data-bs-toggle="tooltip" title="@lang('Amount after charge')">
                                    {{ showAmount($withdraw->amount - $withdraw->charge) }}
                                </strong>
                            </div>

                        </td>
                        <td>
                            <div>
                                {{ showAmount(1) }} = {{ showAmount($withdraw->rate, currencyFormat: false) }}
                                {{ __($withdraw->currency) }}
                                <br>
                                <strong>{{ showAmount($withdraw->final_amount, currencyFormat: false) }}
                                    {{ __($withdraw->currency) }}</strong>
                            </div>
                        </td>
                        <td>
                            <div>
                                @php echo $withdraw->statusBadge @endphp
                            </div>
                        </td>
                        <td>
                            <button class="btn btn--sm btn-outline--base detailBtn"
                                data-user_data="{{ json_encode($details) }}"
                                @if ($withdraw->status == Status::PAYMENT_REJECT) data-admin_feedback="{{ $withdraw->admin_feedback }}" @endif>
                                <i class="la la-desktop"></i> @lang('Detail')
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="100%" class="text-center ">
                            <img src="{{ asset('assets/images/empty_list.png') }}" alt="empty">
                            <p>{{ __($emptyMessage) }}</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($withdraws->hasPages())
        <div class="card-footer">
            {{ paginateLinks($withdraws) }}
        </div>
    @endif

    {{-- APPROVE MODAL --}}
    <div class="modal fade" id="detailModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>
                    <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <ul class="list-group userData list-group-flush">

                    </ul>
                    <div class="feedback"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Search.." isNotAdmin="true" />
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');
                var userData = $(this).data('user_data');
                var html = ``;
                userData.forEach(element => {
                    if (element.type != 'file') {
                        html += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>${element.name}</span>
                            <span">${element.value}</span>
                        </li>`;
                    } else {
                        html += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>${element.name}</span>
                            <span"><a href="${element.value}"><i class="fa-regular fa-file"></i> @lang('Attachment')</a></span>
                        </li>`;
                    }
                });
                modal.find('.userData').html(html);

                if ($(this).data('admin_feedback') != undefined) {
                    var adminFeedback = `
                        <div class="my-3">
                            <strong>@lang('Admin Feedback')</strong>
                            <p>${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                } else {
                    var adminFeedback = '';
                }

                modal.find('.feedback').html(adminFeedback);

                modal.modal('show');
            });

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title], [data-title], [data-bs-title]'))
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        })(jQuery);
    </script>
@endpush
