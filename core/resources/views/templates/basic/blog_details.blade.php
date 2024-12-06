@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="py-100">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-xl-8 col-lg-7 pe-lg-4">
                    <div class="blog-details">
                        <div class="blog-details__body">
                            <div class="blog-details__thumb">
                                <img src="{{ frontendImage('blog', @$blog->data_values->image, '728x465') }}" alt="image"
                                    class="fit-image" />
                            </div>
                            <div class="blog-details__content pb-0">
                                <ul class="text-list inline">
                                    <li class="text-list__item">
                                        <span class="text-list__item-icon"><i class="fas fa-calendar-alt"></i> </span>
                                        {{ showDateTime($blog->created_at, 'd F y') }}
                                    </li>
                                </ul>
                                <h4 class="blog-details__title">
                                    {{ __(@$blog->data_values->title) }}
                                </h4>
                                <div class="blog-details__desc">
                                    @php echo $blog->data_values->description @endphp
                                </div>
                            </div>
                        </div>
                        <div class="blog-details__footer">
                            <h5 class="blog-sidebar__title">@lang('Share This Post')</h5>
                            <ul class="social__links">
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                        target="_blank"><i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}"
                                        target="_blank"><i class=" fa-brands fa-x-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}"
                                        target="_blank"><i class="fab fa-pinterest-p"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.linkedin.com/shareArticle?url={{ urlencode(url()->current()) }}"
                                        target="_blank"><i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="blog-sidebar-wrapper">
                        <div class="blog-sidebar">
                            <h5 class="blog-sidebar__title">@lang('Latest Blog')</h5>
                            <div class="blog-sidebar__content">
                                @foreach ($latestBlogs as $blog)
                                    <div class="latest-blog">
                                        <div class="latest-blog__thumb">
                                            <a href="{{ route('blog.details', $blog->slug) }}">
                                                <img src="{{ frontendImage('blog', 'thumb_' . @$blog->data_values->image, '385x255') }}"
                                                    alt="image">
                                            </a>
                                        </div>
                                        <div class="latest-blog__content">
                                            <h6 class="latest-blog__title">
                                                <a href="{{ route('blog.details', $blog->slug) }}">
                                                    {{ __(@$blog->data_values->title) }}
                                                </a>
                                            </h6>
                                            <span class="latest-blog__date">
                                                <i class="fa-regular fa-calendar-days"></i>
                                                {{ showDateTime($blog->created_at, 'd F y') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5"></div>
            </div>
        </div>
    </section>
@endsection

@push('fbComment')
    @php echo loadExtension('fb-comment') @endphp
@endpush


@push('style')
    <style>
        .social__links {
            justify-content: start;
        }
    </style>
@endpush
