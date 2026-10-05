<x-layouts.app>

      <link rel="stylesheet" href="{{ asset('home_assets/css/blogdetails.css') }}">
    <div class="space-for-header"></div>

    {{-- ── Breadcrumb ── --}}
<section class="tj-page-header-sm" data-bg-image="assets/images/bg/pheader-bg.webp" style="background-color:#2d3a80;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10">
                <div class="tj-page-header-content">

                  

                    {{-- Title --}}
                    @php
                    $words = explode(' ', strip_tags($blog->title));
                    $firstLine = implode(' ', array_slice($words, 0, 8));
                    $secondLine = implode(' ', array_slice($words, 8));
                @endphp
                
                <h2 class="tj-page-title mb-2">
                    {{ $firstLine }}
                    @if($secondLine)
                        <br>{{ $secondLine }}
                    @endif
                </h2>
                    {{-- Meta --}}
                    @php
                        $wordCount = str_word_count(strip_tags($blog->content));
                        $readMin   = max(1, (int) round($wordCount / 200));
                    @endphp
                    <ul class="list-unstyled d-flex flex-wrap justify-content-center gap-3 mb-0"
                        style="font-size:.875rem; color:#ffffffcc;">
                        @if ($blog->published_at)
                            <li>
                                <i class="fa fa-calendar me-1"></i>
                                {{ \Carbon\Carbon::parse($blog->published_at)->format('d M Y') }}
                            </li>
                        @endif
                        <li>
                            <i class="fa fa-clock me-1"></i>
                            {{ $readMin }} min read
                        </li>
                        @if ($blog->focus_keyword)
                            <li>
                                <i class="fa fa-tag me-1"></i>
                                {{ $blog->focus_keyword }}
                            </li>
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div>
</section>

    {{-- ── Blog Detail Section ── --}}
    <section class="tj-blog-section section-gap slidebar-stickiy-container">
        <div class="container">
            <div class="row row-gap-5">

                {{-- ════════ LEFT: Main Content ════════ --}}
                <div class="col-lg-8">
                    <div class="post-details-wrapper">

                        {{-- Featured Image --}}
                        @if ($blog->featured_image)
                            <div class="blog-images wow fadeInUp" data-wow-delay=".1s">
                                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}">
                            </div>
                        @endif

                        {{-- Meta --}}
                        @php
                            $wordCount = str_word_count(strip_tags($blog->content));
                            $readMin = max(1, (int) round($wordCount / 200));
                        @endphp
                 

                      

                        <div class="blog-text">

                          

                            {{-- ★ PHP se content mein h2/h3 par id inject karo ★ --}}
                            @php
                                $counter = 0;
                                $tocItems = [];

                                $processedContent = preg_replace_callback(
                                '/<(h[23])(\s[^>]*)@endphp(.+?)<\/h[23]>/is',
    function ($m) use (&$counter, &$tocItems) {
        $tag = strtolower($m[1]);
        $attrs = $m[2] ?? '';
        $inner = $m[3];
        $plainText = trim(strip_tags($inner));
        $id = 'toc-' . ++$counter;

        // id already hai to replace karo, nahi hai to add karo
        if (preg_match('/\bid\s*=/i', $attrs)) {
            $attrs = preg_replace(
                '/\bid\s*=\s*["\'][^"\']*["\']/i',
                'id="' . $id . '"',
                $attrs,
            );
        } else {
            $attrs = ' id="' . $id . '"' . $attrs;
        }

        $tocItems[] = [
            'id' => $id,
            'text' => $plainText,
            'tag' => $tag,
        ];

        return "<{$tag}{$attrs}>{$inner}</{$tag}>";
    },
    $blog->content,
);
?>

                            <div id="blog-content-area" class="wow fadeInUp" data-wow-delay=".3s">
                                {!! $processedContent !!}
                            </div>

                        </div>

                        <br>
                        <div class="row">
                            <div class="col-12">
                                <x-faq-schemas />
                            </div>
                        </div>
                        <br>

                        {{-- Prev / Next --}}
                        @php
                            $prevBlog = \App\Models\Blog::where('status', 'published')
                                ->where('id', '<', $blog->id)
                                ->latest('id')
                                ->first();
                            $nextBlog = \App\Models\Blog::where('status', 'published')
                                ->where('id', '>', $blog->id)
                                ->oldest('id')
                                ->first();
                        @endphp
                        <div class="tj-post__navigation wow fadeInUp" data-wow-delay=".3s">
                            <div class="tj-nav__post previous">
                                <div class="tj-nav-post__nav prev_post">
                                    @if ($prevBlog)
                                        <a href="{{ route('blog.details', $prevBlog->slug) }}">
                                            <span><i class="tji-arrow-left"></i></span>Previous
                                        </a>
                                    @else
                                        <span style="opacity:.4;"><i class="tji-arrow-left"></i> Previous</span>
                                    @endif
                                </div>
                            </div>
                            <div class="tj-nav__post next">
                                <div class="tj-nav-post__nav next_post">
                                    @if ($nextBlog)
                                        <a href="{{ route('blog.details', $nextBlog->slug) }}">
                                            Next <span><i class="tji-arrow-right"></i></span>
                                        </a>
                                    @else
                                        <span style="opacity:.4;">Next <i class="tji-arrow-right"></i></span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ════════ RIGHT: Sidebar ════════ --}}
                <div class="col-lg-4">
                    <div class="tj-main-sidebar slidebar-stickiy">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        {{-- ★ Dynamic Table of Contents ★ --}}
                        @if (!empty($tocItems))
                            <div class="tj-sidebar-widget widget-search wow fadeInUp headings-main"
                                data-wow-delay=".1s">
                                <span class="blog-title">Table of Contents</span>
                                <ul class="list-unstyled blog-content-list" id="toc-list">
                                   @foreach ($tocItems as $item)
                                    <li>
                                        <a href="#{{ $item['id'] }}"
                                            class="hover-font-1-1x toc-link {{ $item['tag'] === 'h3' ? 'toc-h3' : '' }}"
                                            data-id="{{ $item['id'] }}">

                                            {{ trim(str_replace('&nbsp;', '', html_entity_decode($item['text']))) }}

                                        </a>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Contact Form --}}
                        <div class="blog-side-form wow fadeInUp" data-wow-delay=".7s">
                            <div class="bg-white p-4 rounded shadow-lg">
                                <span>Connect for Your Service</span>
                                <p>Fill out the form below and we will reach out to you with a custom proposal for
                                    your service needs.</p>
                                <form class="blog-copy-connect-form" action="{{ route('blog.form.submit') }}"
                                    method="POST">
                                    @csrf
                                    <div class="blog-copy-connect-field">
                                        <label for="bcc-name">Full Name</label>
                                        <input id="bcc-name" name="name" type="text" placeholder="Your full name"
                                            required>
                                    </div>
                                    <div class="blog-copy-connect-field">
                                        <label for="bcc-email">Email Address</label>
                                        <input id="bcc-email" name="email" type="email"
                                            placeholder="you@example.com" required>
                                    </div>
                                    <div class="blog-copy-connect-field">
                                        <label for="bcc-phone">Phone Number</label>
                                        <input id="bcc-phone" name="phone" type="tel"
                                            placeholder="(123) 456-7890">
                                    </div>
                                    <div class="blog-copy-connect-field">
                                        <label for="bcc-service">Service Interested In</label>
                                        <select id="bcc-service" name="service" required>
                                            <option value="">Choose a service</option>
                                            <option value="digital-marketing">Digital Marketing</option>
                                            <option value="web-development">Web Development</option>
                                            <option value="branding-design">Branding &amp; Design</option>
                                            <option value="ai-solutions">AI Solutions</option>
                                            <option value="other">Other Service</option>
                                        </select>
                                    </div>
                                    <div class="blog-copy-connect-field">
                                        <label for="bcc-message">Tell Us About Your Project</label>
                                        <textarea id="bcc-message" name="message" rows="5" placeholder="Briefly describe your needs"></textarea>
                                    </div>
                                    <input type="hidden" name="blog_ref" value="{{ $blog->title }}">
                                    <button type="submit" class="blog-copy-connect-btn">
                                        Request a Consultation
                                    </button>
                                    <div class="blog-copy-connect-note">
                                        We typically respond within 24 hours. Your details are safe with us.
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Related Posts --}}
                        @if ($relatedBlogs->count())
                            <div class="tj-sidebar-widget tj-recent-posts wow fadeInUp" data-wow-delay=".3s"
                                style="margin-top:45px;">
                                <span class="blog-title">Related Posts</span>
                                <ul>
                                    @foreach ($relatedBlogs as $related)
                                        <li>
                                            <div class="post-thumb">
                                                <a href="{{ route('blog.details', $related->slug) }}">
                                                    @if ($related->featured_image)
                                                        <img src="{{ asset('storage/' . $related->featured_image) }}"
                                                            alt="{{ $related->title }}"
                                                            style="width:80px;height:60px;object-fit:cover;border-radius:8px;">
                                                    @else
                                                        <img src="assets/images/blog/post-1.webp"
                                                            alt="{{ $related->title }}">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <span class="post-title">
                                                    <a href="{{ route('blog.details', $related->slug) }}" style="color:#000;">
                                                        {{ Str::limit($related->title, 55) }}
                                                    </a>
                                                </span>
                                                <div class="blog-meta">
                                                    <ul>
                                                        @if ($related->published_at)
                                                            <li>
                                                                {{ \Carbon\Carbon::parse($related->published_at)->format('d M Y') }}
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── CTA Section ── --}}
    <section class="tj-cta-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-area">
                        <div class="cta-content">
                            <h2 class="title title-anim">Let's Build Future Together.</h2>
                            <div class="cta-btn wow fadeInUp" data-wow-delay=".6s">
                                <a class="tj-primary-btn btn-dark" href="{{ url('contact') }}">
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

    {{-- ════ TOC Scroll Script ════ --}}
<script src="{{ asset('home_assets/js/blog.js') }}"></script>

</x-layouts.app>
