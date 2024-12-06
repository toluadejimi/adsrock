@if (!request()->routeIs('home'))
    @php
        $breadcrumb = getContent('breadcrumb.content', true);
    @endphp
    <section class="breadcrumb bg-img"
        data-background-image="{{ frontendImage('breadcrumb', $breadcrumb->data_values->shape) }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="breadcrumb__wrapper">
                        <h3 class="breadcrumb__title">{{ __($pageTitle) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
