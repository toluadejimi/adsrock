@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-table">
        <table class="table table--responsive--xxl table-style-two table-style-two--custom">
            <thead>
                <tr>
                    <th>@lang('Domain Name')</th>
                    <th>@lang('Keywords')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Action')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($domains as $domain)
                    <tr>
                        <td>
                            <a href="https://{{ $domain->domain_name }}" target="_blank">
                                {{ $domain->domain_name }} <i class="las la-external-link-alt"></i>
                            </a>
                        </td>
                        <td>
                            <div class="domain-content">
                                @foreach ($domain->keywords as $key)
                                    <span class="badge badge--dark">{{ __($key) }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td> @php echo $domain->statusBadge @endphp </td>
                        <td>
                            <div class="button--group">
                                <button type="button" class="btn btn-outline--primary btn--sm editBtn cuModalBtn"
                                    data-modal_title="@lang('Edit Domain')" data-resource="{{ $domain }}"
                                    data-keyword='@json($domain->keywords)'>
                                    <i class="las la-pen"></i>@lang('Edit')
                                </button>
                                @if ($domain->status == Status::DOMAIN_UNVERIFIED)
                                    <a href="{{ route('publisher.domain.verify.action', $domain->tracker) }}"
                                        class="btn btn-outline--success btn--sm" data-original-title="Verify domain">
                                        <i class="las la-check-circle"></i>@lang('Verify')
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-outline--danger btn--sm confirmationBtn"
                                    data-action="{{ route('publisher.domain.remove', $domain->tracker) }}"
                                    data-question="@lang('Are you sure to remove this domain')?">
                                    <i class="las la-trash"></i>@lang('Remove')
                                </button>
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


    <div id="cuModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('publisher.domain.verify.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Domain Name')</label>
                            <input type="url" name="domain_name" placeholder="@lang('e.g.(example.com)')" class="form--control"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Keywords')<span class="text-danger">*</span></label>
                            <span class="fs-12">(@lang('Please use the suggested keywords only'))</span>
                            <select name="keywords[]" class="form--control select2 domain-keyword" multiple="multiple">
                                @if (@$keywords)
                                    @foreach (@$keywords as $keyword)
                                        <option value="{{ $keyword }}">{{ __($keyword) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--base h-45 w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Kewword View Modal --}}
    <div id="keywordDModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tags d-flex justify-content-center flex-wrap"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
    <x-confirmation-modal size="btn--sm" btnPrimary="btn--base" btnDark="btn-dark" />
@endsection


@push('breadcrumb-plugins')
    <div class="flex-between gap-3">
        <x-search-form placeholder="Search...." isNotAdmin=true />
        <button type="button" class="btn btn-outline--base btn--sm cuModalBtn h-45 addBtn"
            data-modal_title="@lang('Add Domain')"><i class="las la-plus"></i>
            @lang('Add New')
        </button>
    </div>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/cu-modal.js') }}"></script>
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush

@push('script')
    <script>
        'use strict';
        $('.editBtn').on('click', function() {
            $("[name=domain_name]").attr('disabled', true);
            var keywords = $(this).data('keyword');
            $(".domain-keyword").val(keywords || []).change();
        });

        $('.addBtn').on('click', function() {
            $("[name=domain_name]").attr('disabled', false);
            $(".domain-keyword").val([]).change();
        });
    </script>
@endpush

@push('style')
    <style>
        .select2-container,
        .select2-container--default.select2-container--focus .select2-selection--multiple,
        .select2 .selection {
            height: unset !important;
        }
    </style>
@endpush
