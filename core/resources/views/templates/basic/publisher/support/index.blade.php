@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-table">
        <table class="table table--responsive--lg table-style-two table-style-two--custom">
            <thead>
                <tr>
                    <th>@lang('Subject')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Priority')</th>
                    <th>@lang('Last Reply')</th>
                    <th>@lang('Action')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($supports as $support)
                    <tr>
                        <td> <a href="{{ route('ticket.view', $support->ticket) }}" class="fw-bold">
                                [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a></td>
                        <td>
                            @php echo $support->statusBadge; @endphp
                        </td>
                        <td>
                            @if ($support->priority == Status::PRIORITY_LOW)
                                <span class="badge badge--dark">@lang('Low')</span>
                            @elseif($support->priority == Status::PRIORITY_MEDIUM)
                                <span class="badge  badge--warning">@lang('Medium')</span>
                            @elseif($support->priority == Status::PRIORITY_HIGH)
                                <span class="badge badge--danger">@lang('High')</span>
                            @endif
                        </td>
                        <td>{{ diffForHumans($support->last_reply) }} </td>
                        <td>
                            <a href="{{ route('ticket.view', $support->ticket) }}" class="btn btn-outline--success btn--sm ">
                                <i class="las la-desktop"></i> @lang('Detail')
                            </a>
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
    @if ($supports->hasPages())
        <div class="mt-4">
            {{ paginateLinks($supports) }}
        </div>
    @endif
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('ticket.open') }}" class="btn btn--sm btn-outline--base">
        <i class="las la-plus"></i> @lang('New Ticket')
    </a>
@endpush
