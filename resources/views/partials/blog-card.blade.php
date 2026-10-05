@foreach ($blogs as $blog)
    <div class="col-xl-4 col-md-6 blog-grid-item">
        <div class="blog-item wow fadeInUp" data-wow-delay=".1s">
            <div class="blog-thumb">
                <a href="{{ route('blog.details', $blog->slug) }}"><img
                        src="{{ asset('storage/' . $blog->featured_image) }}" alt=""></a>
                <div class="blog-date">
                    <span class="date">
                        {{ \Carbon\Carbon::parse($blog->published_at)->format('d') }}
                    </span>
                    <span class="month">
                        {{ \Carbon\Carbon::parse($blog->published_at)->format('M') }}
                    </span>
                </div>
            </div>
            <div class="blog-content">
                <div class="blog-meta">
                    <span>
                        By
                        <a href="{{ route('blog.details', $blog->slug) }}">
                            {{ $blog->user->name ?? 'Admin' }}
                        </a>
                    </span>
                </div>
                <span class="span-title-black"><a href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title }}</a>
                </span>
                <a class="text-btn" href="{{ route('blog.details', $blog->slug) }}">
                    <span class="btn-text"><span>Read More</span></span>
                    <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                </a>
            </div>
        </div>
    </div>
@endforeach
