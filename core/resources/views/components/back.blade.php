@props([
    'route' => '',
    'btn'=>'btn-outline--dark'
])

<a href="{{ $route }}" class="btn btn--sm {{$btn}}">
    <i class="la la-undo"></i> @lang('Back')
</a>
