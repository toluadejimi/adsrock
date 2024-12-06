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
                                    <th>@lang('Name') | @lang('Type')</th>
                                    <th>@lang('Dimension')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($types as $type)
                                    <tr>
                                        <td>
                                            <div>
                                                {{ __($type->ad_name) }} <br />
                                                <strong>{{ __($type->type) }}</strong>
                                            </div>
                                        </td>
                                        <td>{{ __($type->slug) }}@lang('px')</td>
                                        <td> @php echo $type->statusBadge; @endphp </td>
                                        <td>
                                            <div class="button--group">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline--primary editBtn cuModalBtn"
                                                    data-resource="{{ $type }}" data-modal_title="@lang('Edit Ad Type')"
                                                    data-has_status="1">
                                                    <i class="la la-pencil"></i>@lang('Edit')
                                                </button>
                                                @if ($type->status == Status::DISABLE)
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--success ms-1 confirmationBtn"
                                                        data-action="{{ route('admin.advertise.type.status', $type->id) }}"
                                                        data-question="@lang('Are you sure to enable this advertisement type')?">
                                                        <i class="la la-eye"></i> @lang('Enable')
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--danger confirmationBtn"
                                                        data-action="{{ route('admin.advertise.type.status', $type->id) }}"
                                                        data-question="@lang('Are you sure to disable this advertisement type')?">
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
                    @if ($types->hasPages())
                        <div class="card-footer py-4">
                            @php echo paginateLinks($types) @endphp
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
                <form action="{{ route('admin.advertise.type.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Ad Name')</label>
                            <input type="text" name="ad_name" value="{{ old('ad_name') }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Ad Type')</label>
                            <input type="text" name="type" value="image" class="form-control" readonly required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Width')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" name="width" value="{{ old('width') }}"
                                            class="form-control" required>
                                        <span class="input-group-text">@lang('px')</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Height')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" name="height" value="{{ old('height') }}"
                                            class="form-control" required>
                                        <span class="input-group-text">@lang('px')</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('Slug')</label>
                            <input type="text" name="slug" class="form-control" readonly required>
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
    <button type="button" class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('New Ad Type')">
        <i class="las la-plus"></i>@lang('Add New')
    </button>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/cu-modal.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            var input, input2;
            $('[name=width]').on('keyup', function() {
                input = $(this).val();
                $('[name=slug]').val(input);
                if (input == '') {
                    $('[name=slug]').val('');
                }
            });
            $('[name=height]').on('keyup', function() {
                input2 = $(this).val();
                $('[name=slug]').val(input + 'x' + input2);
                if (input2 == '') {
                    $('[name=slug]').val('');
                }
            })

        })(jQuery);
    </script>
@endpush
