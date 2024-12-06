@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card  ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Publisher')</th>
                                    <th>@lang('Domain Name') | @lang('Tracker')</th>
                                    <th>@lang('Keywords')</th>
                                    @if (request()->routeIs('admin.domain.pending'))
                                        <th>@lang('Check Domain')</th>
                                    @endif
                                    @if (request()->routeIs('admin.domain.all'))
                                        <th>@lang('Status')</th>
                                    @endif
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($domains as $domain)
                                    <tr>
                                        <td>
                                            <div>
                                                <span class="fw-bold">{{ $domain->publisher->fullname }}</span>
                                                <br>
                                                <span class="small">
                                                    <a
                                                        href="{{ route('admin.publisher.detail', $domain->publisher->id) }}"><span>@</span>{{ $domain->publisher->username }}</a>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="http://{{ $domain->domain_name }}"
                                                    target="_blank">{{ __($domain->domain_name) }}</a>
                                                <br>
                                                {{ $domain->tracker }}
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline--primary btn-sm view"
                                                data-keyword='@json(@$domain->keywords)'
                                                data-domain="{{ $domain->domain_name }}">
                                                <i class="las la-eye"></i>
                                                @lang('View')
                                            </button>
                                        </td>
                                        @if (request()->routeIs('admin.domain.pending'))
                                            <td>
                                                <a href="{{ 'http://' . $domain->domain_name . '/' . titleToKey(gs('site_name')) . '.txt' }}"
                                                    target="_blank" class="btn btn-outline--success btn-sm"
                                                    data-toggle="tooltip" data-original-title="{{ trans('Check Domain') }}">
                                                    <i class="las la-check"></i> @lang('Check Domain')
                                                </a>
                                            </td>
                                        @endif

                                        @if (request()->routeIs('admin.domain.all'))
                                            <td> @php echo $domain->statusBadge @endphp </td>
                                        @endif
                                        <td>
                                            <div class="button--group">
                                                @if ($domain->status == Status::DOMAIN_PENDING)
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--success ms-1 mb-2 confirmationBtn"
                                                        data-action="{{ route('admin.domain.verify', $domain->id) }}"
                                                        data-question="@lang('Are you sure to verified this domain?')">
                                                        <i class="las la-check-circle"></i> @lang('Verified')
                                                    </button>
                                                @elseif($domain->status == Status::DOMAIN_VERIFIED)
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--warning mb-2 confirmationBtn"
                                                        data-action="{{ route('admin.domain.unverify', $domain->id) }}"
                                                        data-question="@lang('Are you sure to unverify this domain?')">
                                                        <i class="la la-ban"></i> @lang('Unverify')
                                                    </button>
                                                @endif
                                                <button type="button"
                                                    class="btn btn-sm btn-outline--danger ms-1 mb-2 confirmationBtn"
                                                    data-action="{{ route('admin.domain.remove', $domain->id) }}"
                                                    data-question="@lang('Are you sure to remove this domain?')">
                                                    <i class="la la-trash"></i> @lang('Remove')
                                                </button>
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
                </div>
                @if ($domains->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($domains) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
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
                </div>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
@endpush

@push('script')
    <script>
        'use strict'
        $('.view').on('click', function() {
            let modal = $('#keywordDModal');
            modal.find('.tags').children().remove();
            var keywords = $(this).data('keyword')
            var domain = $(this).data('domain');
            modal.find('.modal-title').text(`${domain}: @lang('Keywords')`);
            if (keywords != null) {
                keywords.forEach(element => {
                    $('.tags').append(`<span class="single-tag fw-bold">${element}</span>`)

                });
            }
            modal.modal('show');
        })
    </script>
@endpush

@push('style')
    <style>
        .tags {
            margin: -3px -7px;
        }

        .tags .single-tag {
            margin: 3px 7px;
            font-size: 14px;
            padding: 2px 10px;
            border: 1px solid #e5e5e5;
            border-radius: 3px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            -ms-border-radius: 3px;
            -o-border-radius: 3px;
        }
    </style>
@endpush
