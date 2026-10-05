<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @php
        $currentPage = request()->path() == '/' ? '/' : '/' . request()->path();
        $seo = \App\Models\SeoSetting::where('page_slug', $currentPage)->first();
    @endphp
    <title>{{ $seo?->meta_title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $seo?->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $seo?->meta_keywords ?? '' }}">
    <meta name="robots" content="{{ $seo?->robots ?? 'index,follow' }}">
    <link rel="canonical" href="{{ $seo?->canonical_url ?? url()->current() }}">
    <!-- Open Graph Tags -->
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:title" content="{{ $seo?->og_title ?? '' }}">
    <meta property="og:description" content="{{ $seo?->og_description ?? '' }}">
    <meta property="og:url" content="{{ $seo?->canonical_url ?? url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ $seo?->og_image ?? '' }}">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo?->meta_title ?? '' }}">
    <meta name="twitter:site" content="@UnifyWizards">
    <meta name="twitter:description" content="{{ $seo?->og_description ?? '' }}">
    <meta name="twitter:image" content="{{ $seo?->og_image ?? '' }}">
    @php
        $settings = \App\Models\Setting::first();
     
    @endphp
    @if ($settings && $settings->favicon)
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/'.$settings->favicon) }}" />
    @else
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('home_assets/images/fav.png') }}" />
    @endif
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('home_assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('home_assets/css/font-awesome-pro.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('home_assets/css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('home_assets/css/bexon-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('home_assets/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('home_assets/css/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('home_assets/css/venobox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('home_assets/css/odometer-theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('home_assets/css/meanmenu.css') }}" />
    <link rel="stylesheet" href="{{ asset('home_assets/css/main.css?v=1.3') }}" />
    <link rel="stylesheet" href="{{ asset('home_assets/css/navbar.css?v=1.1') }}" />
    <link rel="stylesheet" href="{{ asset('home_assets/css/service-form.css') }}" />
    <link rel="stylesheet" href="{{ asset('home_assets/css/custom.css?v=1.1') }}" />
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @php
        $currentPage = request()->path() == '/' ? '/' : '/' . request()->path();
        $schemas = \App\Models\Schema::where('status', 1)->where('page', $currentPage)->get();
    @endphp
    @if ($schemas->count())
        @foreach ($schemas as $schema)
            @php
                $items = json_decode($schema->json_data, true);
            @endphp
            @if (is_array($items))
                @foreach ($items as $item)
                    <script type="application/ld+json">
                    {!! json_encode($item, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
                    </script>
                @endforeach
            @endif
        @endforeach
    @endif
</head>

<body>

    <div class="body-overlay"></div>
    <div id="tj-back-to-top">
        <span id="tj-back-to-top-percentage"></span>
    </div>
    <div class="search-popup-overlay"></div>

    <!-- Header -->
    <x-header />
 
    <div id="smooth-wrapper">
        <div id="smooth-content">

            <main id="primary" class="site-main">
                 {{ $slot }}
              <!-- Footer -->
                <x-footer />
            </main>

        </div>
    </div>

    <!-- SEO Audit Popup -->
    <x-seo-audit-popup />

    <!-- Core JS — order important hai -->
    <script src="{{ asset('home_assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('home_assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('home_assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('home_assets/js/ScrollSmoother.js') }}"></script>
    <script src="{{ asset('home_assets/js/gsap-scroll-to-plugin.min.js') }}"></script>
    <script src="{{ asset('home_assets/js/gsap-scroll-trigger.min.js') }}"></script>
    <script src="{{ asset('home_assets/js/gsap-split-text.min.js') }}"></script>
    <script src="{{ asset('home_assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('home_assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('home_assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('home_assets/js/venobox.min.js') }}"></script>
    <script src="{{ asset('home_assets/js/appear.min.js') }}"></script>
    <script src="{{ asset('home_assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('home_assets/js/meanmenu.js') }}"></script>
    <script src="{{ asset('home_assets/js/main.js?v=1.1') }}"></script>
    <script src="{{ asset('home_assets/js/navbar.js?v=1.1') }}"></script>
    <script src="{{ asset('home_assets/js/proposal.js') }}"></script>
    <script src="{{ asset('home_assets/js/seo-audit-popup.js') }}"></script>

</body>

</html>
