@if ($relatedBlogs->count())

    <section class="tj-blog-section section-gap">

        <div class="container">

            <div class="sec-heading text-center mb-5">

                <span class="sub-title">
                    Related Blogs
                </span>

               

            </div>

            <div class="row row-gap-4">

                @foreach ($relatedBlogs as $blog)
                    <div class="col-xl-4 col-md-6">

                        <div class="blog-item">

                            <div class="blog-thumb">

                                <a href="{{ route('blog.details', $blog->slug) }}">

                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}">

                                </a>

                            </div>

                            <div class="blog-content">

                                <div class="blog-meta">

                                    <span>

                                        By

                                        {{ $blog->user->name ?? 'Admin' }}

                                    </span>

                                </div>

                                <span class="span-title-black">

                                    <a href="{{ route('blog.details', $blog->slug) }}">

                                        {{ $blog->title }}

                                    </a>

                                </span>

                                <a class="text-btn" href="{{ route('blog.details', $blog->slug) }}">

                                    Read More

                                </a>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </section>

@endif
