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
                                    <th>@lang('S.N')</th>
                                    <th>@lang('Keyword')</th>
                                    <th>@lang('Created Date')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($keywords as $keyword)
                                    <tr>
                                        <td> {{ $keywords->firstItem() + $loop->index }}</td>
                                        <td><span>{{ $keyword->keywords }}</span></td>
                                        <td>{{ showDateTime($keyword->created_at, 'd-M-Y') }}
                                        </td>

                                        <td>
                                            <div class="button--group">
                                                <button type="button" class="btn btn-sm btn-outline--primary editBtn"
                                                    data-resource="{{ $keyword->keywords }}"
                                                    data-modal_title="@lang('Edit Keyword')"
                                                    data-route="{{ route('admin.advertise.keyword.store', $keyword->id) }}">
                                                    <i class="la la-pencil"></i>@lang('Edit')
                                                </button>
                                                <button type="button"
                                                    class="btn btn-sm btn-outline--danger ms-1 confirmationBtn"
                                                    data-action="{{ route('admin.advertise.keyword.remove', $keyword->id) }}"
                                                    data-question="@lang('Are you sure to remove this keyword')?">
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
                @if ($keywords->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($keywords) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!--add modal-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('Add Keywords')</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    @php
                        $placeholder = "keyword one\nkeyword two\nkeyword three";
                    @endphp

                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Keywords')</label>
                            <textarea name="keywords" class="form-control textareaKey" rows="3" placeholder="{{ __($placeholder) }}"></textarea>
                            <input type="text" class="form-control inputKey" name="keywords">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
    <button type="button" class="btn btn-sm btn-outline--primary addBtn">
        <i class="las la-plus"></i>@lang('Add New')
    </button>
@endpush

@push('script')
    <script>
        'use strict'
        $(function() {

            $('.addBtn').on('click', function() {
                const $modal = $("#addModal");
                $modal.find('[name=keywords]').val('');
                $modal.find('.textareaKey').attr('disabled', false)
                $modal.find('.textareaKey').removeClass('d-none');
                $modal.find('.inputKey').attr('disabled', true)
                $modal.find('.inputKey').addClass('d-none');

                $modal.find('.modal-title').text(`@lang('Add Keyword')`);

                let form = $modal.find("form");
                let route = `{{ route('admin.advertise.keyword.store', '') }}`;
                form.attr('action', route)
                $modal.modal("show");
            });

            $('.editBtn').on('click', function() {
                const $modal = $("#addModal");
                $modal.find('.textareaKey').attr('disabled', true)
                $modal.find('.textareaKey').addClass('d-none');
                $modal.find('.inputKey').attr('disabled', false)
                $modal.find('.inputKey').removeClass('d-none');

                var route = $(this).data('route');
                $modal.find('form').attr('action', route)
                $modal.find('[name=keywords]').val($(this).data('resource'));
                $modal.find('.modal-title').text(`@lang('Edit Keyword')`);
                $modal.modal("show");
            })

            $('.delete').on('click', function() {
                var route = $(this).data('route')
                const $modal = $('#deleteModal');
                $('#deleteModal').find('form').attr('action', route)
                $modal.modal('show');
            });
        });
    </script>
@endpush
