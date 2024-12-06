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
                                    <th>@lang('Name')</th>
                                    <th>@lang('Price')</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Credit')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($plans as $plan)
                                    <tr>
                                        <td> {{ __($plan->name) }}</td>
                                        <td>{{ showAmount($plan->price) }}</td>
                                        <td> @php echo $plan->typeBadge;@endphp </td>
                                        <td>{{ getAmount($plan->credit) }}</td>
                                        <td> @php echo $plan->statusBadge; @endphp </td>
                                        <td>
                                            <div class="button--group">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline--primary editBtn cuModalBtn"
                                                    data-resource="{{ $plan }}" data-modal_title="@lang('Edit Plan')"
                                                    data-has_status="1">
                                                    <i class="la la-pencil"></i>@lang('Edit')
                                                </button>
                                                @if ($plan->status == Status::DISABLE)
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--success ms-1 confirmationBtn"
                                                        data-action="{{ route('admin.advertise.plan.price.status', $plan->id) }}"
                                                        data-question="@lang('Are you sure to enable this plan price')?">
                                                        <i class="la la-eye"></i>@lang('Enable')
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--danger confirmationBtn"
                                                        data-action="{{ route('admin.advertise.plan.price.status', $plan->id) }}"
                                                        data-question="@lang('Are you sure to disable this plan price')?">
                                                        <i class="la la-eye-slash"></i>@lang('Disable')
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
                    @if ($plans->hasPages())
                        <div class="card-footer py-4">
                            @php echo paginateLinks($plans) @endphp
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
                <form action="{{ route('admin.advertise.plan.price.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Plan Name')</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Price')</label>
                            <div class="input-group">
                                <span class="input-group-text">{{ gs('cur_sym') }}</span>
                                <input type="number" step="any" name="price" value="{{ old('price') }}"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('Type')</label>
                            <select name="type" class="form-control select2" data-minimum-results-for-search="-1"
                                required>
                                <option>@lang('Select Type')</option>
                                <option value="impression" @if (old('type') == 'impression') selected @endif>
                                    @lang('Impression')</option>
                                <option value="click" @if (old('type') == 'click') selected @endif>@lang('Click')
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>@lang('Credit')</label>
                            <input type="number" name="credit" value="{{ old('credit') }}" class="form-control" required>
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


@push('script-lib')
    <script src="{{ asset('assets/global/js/cu-modal.js') }}"></script>
@endpush

@push('breadcrumb-plugins')
    <x-search-form />

    <button type="button" class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('New Plan')">
        <i class="las la-plus"></i>@lang('Add New')
    </button>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('[name="type"]').on('change', function() {
                let $this = $(this).val();
                if ($this == "impression") {
                    $('.perCredit').text(`@lang('Impression')`);
                } else {
                    $('.perCredit').text(`@lang('Click')`);
                }
            });

            $('#cuModal').on('show.bs.modal', function() {
                let $this = $('[name="type"] option:selected').val();
                if ($this == "impression") {
                    $('.perCredit').text(`@lang('Impression')`);
                } else if ($this == "click") {
                    $('.perCredit').text(`@lang('Click')`);
                } else {
                    $('.perCredit').text('');
                }
            });

        })(jQuery);
    </script>
@endpush
