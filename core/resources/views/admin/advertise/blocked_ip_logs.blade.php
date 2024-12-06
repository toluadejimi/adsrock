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
                                    <th>@lang('Date')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $log)
                                    <tr>
                                        <td>{{ $log->ip }}</td>
                                        <td>{{ showDateTime($log->created_at, 'd M Y') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline--success confirmationBtn"
                                                data-action="{{ route('admin.advertise.ip.unblock', $log->id) }}"
                                                data-question="@lang('Are you sure to unblock this IP')?">
                                                <i class="la la-check-circle"></i> @lang('Unblock')
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ $emptyMessage }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                    @if ($logs->hasPages())
                        <div class="card-footer py-4">
                            @php echo paginateLinks($logs) @endphp
                        </div>
                    @endif
                </div>
            </div><!-- card end -->
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="IP::" />
@endpush
