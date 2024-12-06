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
                                    <th>@lang('Credit Per Click')</th>
                                    <th>@lang('Credit Per Impression')</th>
                                    <th>@lang('Earn Per Click')</th>
                                    <th>@lang('Earn Per Impression')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($costs as $cost)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb">
                                                    <img src="{{ getImage('assets/images/country/' . strtolower(@$cost->country->country_code) . '.svg') }}"
                                                        class="plugin_bg">
                                                </div>
                                                <span class="name">
                                                    @if (@$cost->country)
                                                        {{ __(@$cost->country->country_name) }} <br>
                                                        <small>{{ __(@$cost->country->country_code) }}</small>
                                                    @else
                                                        @lang('N/A')
                                                    @endif
                                                </span>
                                            </div>
                                        </td>
                                        <td>{{ showAmount($cost->cpc) }}</td>
                                        <td>{{ showAmount($cost->cpm) }}</td>
                                        <td>{{ showAmount($cost->epc) }}</td>
                                        <td>{{ showAmount($cost->epm) }}</td>
                                        <td>
                                            <div class="button--group">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline--primary editBtn cuModalBtn"
                                                    data-resource="{{ $cost }}" data-modal_title="@lang('Edit Cost')"
                                                    data-has_status="1">
                                                    <i class="la la-pencil"></i>@lang('Edit')
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
                    @if ($costs->hasPages())
                        <div class="card-footer py-4">
                            @php echo paginateLinks($costs) @endphp
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="cuModal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.advertise.per.cost.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group ">
                            <label>@lang('Country')</label>
                            <x-country-select name=country_id :countries=$countries :isJson=false />
                        </div>
                        <div class="form-group">
                            <label>
                                @lang('Credit Per Click') <span data-bs-toggle="tooltip" data-bs-title="@lang('Every click cuts credit from the advertiser')"><i
                                        class="las la-info-circle text--warning"></i></span>
                            </label>
                            <div class="input-group">
                                <input type="number" name="cpc" value="{{ old('cpc') }}" class="form-control"
                                    required step="any">
                                <span class="input-group-text"><i class="las la-coins"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>
                                @lang('Credit Per Impression') <span data-bs-toggle="tooltip" data-bs-title="@lang('Every impression cuts credit from the advertiser')"><i
                                        class="las la-info-circle text--warning"></i></span>
                            </label>
                            <div class="input-group">
                                <input type="number" name="cpm" value="{{ old('cpm') }}" class="form-control"
                                    required step="any">
                                <span class="input-group-text"><i class="las la-coins"></i></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>@lang('Earn Per Click') <span data-bs-toggle="tooltip" data-bs-title="@lang('Publishers earn per click.')"><i
                                        class="las la-info-circle text--warning"></i></span></label>
                            <div class="input-group">
                                <input type="number" name="epc" value="{{ old('epc') }}" step="any"
                                    class="form-control" required>
                                <span class="input-group-text">{{ __(gs('cur_text')) }}</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>
                                @lang('Earn Per Impression') <span data-bs-toggle="tooltip" data-bs-title="@lang('Publishers earn per impression.')"><i
                                        class="las la-info-circle text--warning"></i></span></label>
                            <div class="input-group">
                                <input type="number" name="epm" value="{{ old('epm') }}" step="any"
                                    class="form-control" required>
                                <span class="input-group-text">{{ __(gs('cur_text')) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script-lib')
    <script src="{{ asset('assets/global/js/cu-modal.js') }}"></script>
@endpush

@push('breadcrumb-plugins')
    <button type="button" class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add Cost')">
        <i class="las la-plus"></i>@lang('Add New')
    </button>
@endpush
