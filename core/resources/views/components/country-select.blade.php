@props(['name' => $name, 'countries' => $countries, 'isJson' => true])

<select name="{{ $name }}" class="form-control country-select2">
    <option value="">@lang('Select One')</option>
    @foreach ($countries as $code => $country)
    @php
@endphp
        @if ($isJson)
            <option value="{{ $code }}"
                data-image="{{ getImage('assets/images/country/' . strtolower($code) . '.svg') }}">
                {{ __($country->country) }}
            </option>
        @else
            <option value="{{ $country->id }}"
                data-image="{{ getImage('assets/images/country/' . strtolower($country->country_code) . '.svg') }}">
                {{ __($country->country_name) }}
            </option>
        @endif
    @endforeach
</select>

@push('script')
    <script>
        "use strict";
        (function($) {
            const formatState = (state) => {
                if (!state.id) return state.text;
                return $('<img class="ms-1 country-image"   src="' + $(state.element).data('image') +
                    '"/> <span class="ms-2">' +
                    state.text + '</span>');
            }

            $.each($('.country-select2'), function() {
                $(this)
                    .wrap(`<div class="position-relative"></div>`)
                    .select2({
                        dropdownParent: $(this).parent(),
                        templateResult: formatState
                    });
            });

        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .country-image {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
@endpush
