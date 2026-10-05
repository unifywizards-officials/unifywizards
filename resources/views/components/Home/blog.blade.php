<section class="tj-blog-section section-gap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sec-heading text-center">
                    <span class="sub-title wow fadeInUp google-red-text" data-wow-delay=".3s">
                        <i class="tji-box google-red-text"></i>
                        Insights & Ideas
                    </span>

                    <h3 class="sec-title title-anim">
                        The Ultimate <span>Resource.</span>
                    </h3>
                </div>
            </div>
        </div>

        <div class="row row-gap-4">

            @forelse($getblogs as $blog)
                <div class="col-xl-4 col-md-6">
                    <div class="blog-item wow fadeInUp" data-wow-delay=".4s">

                        <div class="blog-thumb">
                            <a href="{{route('blog.details',$blog->slug)}}">
                                <img src="{{ asset('storage/'.$blog->featured_image) }}" alt="{{ $blog->title }}">
                            </a>

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
                                <span class="categories">
                                    <a href="#">
                                        Blog
                                    </a>
                                </span>

                                <span>
                                    By
                                    <a href="#">
                                        Admin
                                    </a>
                                </span>
                            </div>

                            <span class="span-title-black">
                                <a href="{{route('blog.details',$blog->slug)}}">
                                    {{ $blog->title }}
                                </a>
                            </span>

                            <a class="text-btn" href="{{route('blog.details',$blog->slug)}}">
                                <span class="btn-text">
                                    <span>Read More</span>
                                </span>

                                <span class="btn-icon">
                                    <i class="tji-arrow-right-long"></i>
                                </span>
                            </a>

                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No blogs found.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>
