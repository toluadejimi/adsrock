@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="py-100">
        <div class="container">
            <div class="row gy-4 gy-md-5 justify-content-center">
                @include($activeTemplate . '.partials.blogs')
            </div>
            @if ($blogs->hasPages())
                <div class="mt-4">
                    {{ paginateLinks($blogs) }}
                </div>
            @endif
        </div>
    </section>
    @if ($sections != null)
        @foreach (json_decode($sections) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
