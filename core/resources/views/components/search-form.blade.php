@props([
    'placeholder' => 'Search...',
    'btn' => 'btn--primary',
    'dateSearch' => 'no',
    'keySearch' => 'yes',
    'isNotAdmin'=>false
])

<form class="@if(!$isNotAdmin)  d-flex flex-wrap gap-2   @endif ">
    @if ($keySearch == 'yes')
        <x-search-key-field placeholder="{{ $placeholder }}" btn="{{ $btn }}" isNotAdmin={{$isNotAdmin}} />
    @endif
    @if ($dateSearch == 'yes')
        <x-search-date-field />
    @endif

</form>

