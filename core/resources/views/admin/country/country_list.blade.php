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
                                    <th>@lang('Country')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($countries as $country)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb">
                                                    <img src="{{ getImage('assets/images/country/' . strtolower($country->country_code) . '.svg') }}"
                                                        class="plugin_bg">
                                                </div>
                                                <span class="name">{{ __($country->country_name) }}</span>
                                            </div>
                                        </td>
                                        <td> @php echo $country->statusBadge @endphp</td>
                                        <td>
                                            <div class="button--group">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline--primary editBtn cuModalBtn"
                                                    data-resource="{{ $country }}" data-modal_title="@lang('Edit Country')"
                                                    data-has_status="1">
                                                    <i class="la la-pencil"></i>@lang('Edit')
                                                </button>
                                                @if ($country->status == Status::DISABLE)
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--success ms-1 confirmationBtn"
                                                        data-action="{{ route('admin.country.status', $country->id) }}"
                                                        data-question="@lang('Are you sure to enable this Country')?">
                                                        <i class="la la-eye"></i> @lang('Enable')
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--danger confirmationBtn"
                                                        data-action="{{ route('admin.country.status', $country->id) }}"
                                                        data-question="@lang('Are you sure to disbale this country')?">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
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
                    @if ($countries->hasPages())
                        <div class="card-footer py-4">
                            @php echo paginateLinks($countries) @endphp
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!--Cu Modal -->
    <div id="cuModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.country.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group position-relative">
                            <label>@lang('Country Name')</label>
                            <x-country-select name=country :countries=$countriesJson />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection


@push('breadcrumb-plugins')
    <x-search-form />

    <button type="button" class="btn btn-sm btn-outline--primary cuModalBtn adBtn" data-modal_title="@lang('Add New Country')">
        <i class="las la-plus"></i>@lang('Add New')
    </button>
@endpush


@push('script-lib')
    <script src="{{ asset('assets/global/js/cu-modal.js') }}"></script>
@endpush


@push('script')
    <script>
        (function($) {
            'use strict';

            $('.editBtn').on('click', function(e) {
                const resource = $(this).data('resource');
                $(`select[name=country]`).val(resource.country_code).change();
            });

            $('.adBtn').on('click', function(e) {
                $(`select[name=country]`).val("").change();
            });

        })(jQuery);
    </script>
@endpush
