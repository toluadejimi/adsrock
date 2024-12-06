@foreach ($blogs as $blog)
    <div class="col-lg-4 col-md-6">
        <div class="blog-item">
            <div class="blog-item__thumb">
                <a href="{{ route('blog.details', $blog->slug) }}" class="blog-item__thumb-link">
                    <img src="{{ frontendImage('blog', 'thumb_' . @$blog->data_values->image, '385x255') }}"
                        class="fit-image" alt="image">
                </a>
            </div>
            <div class="blog-item__content">
                <ul class="text-list flex-align gap-3">
                    <li class="text-list__item">
                        <div class="badge badge--solid badge--base d-flex align-items-center gap-1">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ showDateTime($blog->created_at, 'd M Y') }}</span>
                        </div>
                    </li>
                </ul>
                <h5 class="blog-item__title">
                    <a href="{{ route('blog.details', $blog->slug) }}" class="blog-item__title-link">
                        <span class="border-effect">
                            {{ __(strLimit(@$blog->data_values->title, 80)) }}
                        </span>
                    </a>
                </h5>
                <p class="blog-item__desc">
                    {{ __(strLimit(strip_tags(@$blog->data_values->description), 200)) }}
                </p>
                <a class="blog-item__readmore" href="{{ route('blog.details', $blog->slug) }}">
                    <span>@lang('Read more')</span>
                    <i class="las la-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
@endforeach
