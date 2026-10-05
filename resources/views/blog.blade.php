<x-layouts.app>
    <div class="space-for-header"></div>


    <section class="tj-page-header section-gap-x" data-bg-image="assets/images/bg/pheader-bg.webp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tj-page-header-content text-center">
                        <h1 class="tj-page-title">Blog</h1>
                        <div class="tj-page-link">
                            <span><i class="tji-home"></i></span>
                            <span>
                                <a href="index.html">Home</a>
                            </span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>
                                <span>Blog</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div>
    </section>
    <!-- end: Breadcrumb Section -->


    <!-- start: Blog Section -->
    <section class="tj-blog-section section-gap">

        <div class="row mb-5">
            <div class="col-lg-6 mx-auto" style="">
                <input type="text" id="blog-search" class="form-control" placeholder="Search Blog..."
                    autocomplete="off">
            </div>
        </div>
        <div class="container">

            <div class="row row-gap-4" id="blog-list"
                data-next-page-url="{{ $blogs->hasMorePages() ? $blogs->nextPageUrl() : '' }}"
                data-search-url="{{ route('blogs.show') }}">

                @forelse($blogs as $blog)
                    @include('partials.blog-card', ['blogs' => [$blog]])
                @empty
                    <div class="col-12 text-center" id="blog-no-results">
                        <h4>No Blogs Found</h4>
                    </div>
                @endforelse

            </div>

            {{-- Infinite scroll loader --}}
            <div id="blog-loader" class="text-center mt-5" style="display:none;">
                <span class="spinner-border" role="status" aria-hidden="true"></span>
                <p class="mt-2 mb-0">Loading more posts...</p>
            </div>

            {{-- Sentinel element - triggers loading more when it enters viewport --}}
            <div id="blog-scroll-sentinel" style="width:100%; height:20px;"></div>

            <div id="blog-end-message" class="text-center mt-5" style="display:none;">
                <p class="mb-0">You've reached the end.</p>
            </div>

        </div>

    </section>

    <!-- start: Cta Section -->
    <section class="tj-cta-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-area">
                        <div class="cta-content">
                            <h2 class="title title-anim">
                                Let’s Build Future Together.
                            </h2>
                            <div class="cta-btn wow fadeInUp" data-wow-delay=".6s">
                                <a class="tj-primary-btn btn-dark" href="{{'/contact'}}">
                                    <span class="btn-text"><span>Get Started Now</span></span>
                                    <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                </a>
                            </div>
                        </div>
                        <div class="cta-img">
                            <img src="{{ asset('assets/img/cta-bg.webp') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <script src="{{ asset('home_assets/js/blog.js') }}"></script>

</x-layouts.app>
