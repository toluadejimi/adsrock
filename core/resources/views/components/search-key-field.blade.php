@props([
    'placeholder' => 'Search...',
    'isNotAdmin' =>false,
 'btn' => 'btn--primary'
 ])

@if(!$isNotAdmin)

    <div class="input-group w-auto flex-fill">
        <input type="search" name="search" class="form-control bg--white" placeholder="{{ __($placeholder) }}" value="{{ request()->search }}">
        <button class="btn {{ $btn }}" type="submit"><i class="la la-search"></i></button>
    </div>
@else
    <div class="form-group search-form mb-0">
        <input type="search" name="search" class="form--control" placeholder="{{ __($placeholder) }}" value="{{ request()->search }}" />
        <button type="button" class="icon">
            <span><i class="fas fa-search"></i></span>
        </button>
    </div>
@endif