@php
    $blogContent = getContent('blog.content', true);
    $blogs       = getContent('blog.element', false, orderById: true, limit: 3);
@endphp

<section class="py-100 section-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section-heading__title" data-s-break="-1"> {{ __(@$blogContent->data_values->heading) }}</h2>
                    <p class="section-heading__desc">{{ __(@$blogContent->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @include($activeTemplate . '.partials.blogs')
        </div>
    </div>
</section>
