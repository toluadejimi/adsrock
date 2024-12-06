@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-md-12">
            <div class="card  ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Ip')</th>
                                    <th>@lang('Advertise')</th>
                                    <th>@lang('Ad Type')</th>
                                    <th>@lang('Country')</th>
                                    <th>@lang('Time')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $log)
                                    <tr>
                                        <td>{{ $log->ipChart->ip }}</td>
                                        <td><a
                                                href="{{ route('admin.advertise.detail', $log->advertise_id) }}">{{ $log->advertise->ad_title }}</a>
                                        </td>
                                        <td>{{ __($log->advertise->type->ad_name) }}</td>
                                        <td><small class="badge badge--primary">{{ $log->country ?? "N/A" }}</small></td>
                                        <td>{{showDateTime($log->time,'g:i A')}}
                                           </td>
                                        <td>{{ showDateTime($log->created_at, 'd M Y') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline--danger confirmationBtn"
                                                data-action="{{ route('admin.advertise.ip.block', $log->ipChart->id) }}"
                                                data-question="@lang('Are you sure to block this IP')?">
                                                <i class="la la-ban"></i> @lang('Block')
                                            </button>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ $emptyMessage }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    @if ($logs->hasPages())
                        <div class="card-footer py-4">
                            @php echo paginateLinks($logs) @endphp
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
@endpush

