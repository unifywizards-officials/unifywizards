@props(['companyOverview'])

@php
    $customerImages = [];

    if (!empty($companyOverview?->customer_images)) {
        $customerImages = is_string($companyOverview->customer_images)
            ? json_decode($companyOverview->customer_images, true)
            : $companyOverview->customer_images;
    }

    $counters = [];

    if (!empty($companyOverview?->counters)) {
        $counters = is_string($companyOverview->counters)
            ? json_decode($companyOverview->counters, true)
            : $companyOverview->counters;
    }
@endphp

<section class="tj-about-section section-gap  ">
    <div class="container">
        <div class="row row-gap-4">

            {{-- Counter 1 --}}
            @if (isset($counters[0]))
                @php
                    preg_match('/([\d\.]+)/', $counters[0]['number'], $numMatch);
                    preg_match('/([A-Za-z]+)/', $counters[0]['number'], $suffixMatch);

                    $countNumber = $numMatch[1] ?? 0;
                    $countSuffix = $suffixMatch[1] ?? '';
                @endphp

                <div class="col-lg-4 col-md-6 order-lg-1 order-3">
                    <div class="countup-item style-2 wow fadeInUp" data-wow-delay=".1s">
                        <span class="count-icon">
                            {!! $counters[0]['icon'] ?? '' !!}
                        </span>

                        <span class="steps">01.</span>

                        <div class="count-inner">
                            <span class="count-text">
                                {{ $counters[0]['title'] ?? '' }}
                            </span>

                            <div class="inline-content google-red-text">
                                <span class="odometer countup-number" data-count="{{ $countNumber }}">
                                </span>

                                <span class="count-plus">
                                    {{ $countSuffix }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            {{-- Main Content --}}
            <div class="col-lg-8 col-sm-12 order-lg-2 order-1">
                <div class="about-content-area-2 wow fadeInUp" data-wow-delay=".3s">

                    <div class="about-content">
                        <div class="sec-heading style-2">

                            <span class="sub-title">
                                {{ $companyOverview->sub_title ?? '' }}
                            </span>

                            <h3 class="sec-title">
                                {{ $companyOverview->title ?? '' }}
                            </h3>

                        </div>

                        <div class="wow fadeInUp" data-wow-delay=".3s">
                            <a class="text-btn" href="{{ $companyOverview->button_link ?? '#' }}">

                                <span class="btn-text">
                                    <span>
                                        {{ $companyOverview->button_text ?? 'Learn More' }}
                                    </span>
                                </span>

                                <span class="btn-icon">
                                    <i class="tji-arrow-right-long"></i>
                                </span>

                            </a>
                        </div>
                    </div>

                    <div class="video-img wow fadeInRight" data-wow-delay=".7s">

                        <img src="{{ asset($companyOverview->main_image) }}" alt="Company Overview" />

                        @if (!empty($companyOverview->video_url))
                            <a class="video-btn video-popup" data-autoplay="true" data-vbtype="video"
                                data-maxwidth="1200px" href="{{ $companyOverview->video_url }}">

                                <span>
                                    <i class="tji-play"></i>
                                </span>

                            </a>
                        @endif

                    </div>

                </div>
            </div>


            {{-- Customer Box --}}
            <div class="col-lg-4 col-md-6 order-lg-3 order-2">
                <div class="customers-box style-2 wow fadeInUp" data-wow-delay=".3s">

                    <div class="customers-bg"
                        style="background-image:url('{{ asset($companyOverview->customer_bg) }}');">
                    </div>

                    <div class="customers">
                        <ul>

                            @foreach ($customerImages as $key => $image)
                                <li class="wow fadeInLeft" data-wow-delay=".{{ $key + 3 }}s">

                                    <img src="{{ asset($image) }}" alt="Customer">

                                </li>
                            @endforeach

                            <li class="wow fadeInLeft" data-wow-delay=".6s">
                                <span>
                                    <i class="tji-plus"></i>
                                </span>
                            </li>

                        </ul>
                    </div>

                    <span class="customers-text wow fadeInLeft" data-wow-delay=".6s">
                        {{ $companyOverview->customer_text ?? '' }}
                    </span>

                    <div class="star-icon zoomInOut">
                        <img src="{{ asset('home_assets/images/shape/star.svg') }}" alt="">
                    </div>

                </div>
            </div>


            {{-- Counter 2 --}}
            @if (isset($counters[1]))
                @php
                    preg_match('/([\d\.]+)/', $counters[1]['number'], $numMatch);
                    preg_match('/([A-Za-z]+)/', $counters[1]['number'], $suffixMatch);

                    $countNumber = $numMatch[1] ?? 0;
                    $countSuffix = $suffixMatch[1] ?? '';
                @endphp

                <div class="col-lg-4 col-md-6 order-lg-4 order-4">
                    <div class="countup-item style-2 wow fadeInUp" data-wow-delay=".5s">

                        <span class="count-icon">
                            {!! $counters[1]['icon'] ?? '' !!}
                        </span>

                        <span class="steps">02.</span>

                        <div class="count-inner">

                            <span class="count-text">
                                {{ $counters[1]['title'] ?? '' }}
                            </span>

                            <div class="inline-content">

                                <span class="odometer countup-number" data-count="{{ $countNumber }}">
                                </span>

                                <span class="count-plus">
                                    {{ $countSuffix }}
                                </span>

                            </div>

                        </div>

                    </div>
                </div>
            @endif


            {{-- Counter 3 --}}
            @if (isset($counters[2]))
                @php
                    preg_match('/([\d\.]+)/', $counters[2]['number'], $numMatch);
                    preg_match('/([A-Za-z]+)/', $counters[2]['number'], $suffixMatch);

                    $countNumber = $numMatch[1] ?? 0;
                    $countSuffix = $suffixMatch[1] ?? '';
                @endphp

                <div class="col-lg-4 col-md-6 order-lg-5 order-5">
                    <div class="countup-item style-2 wow fadeInUp" data-wow-delay=".7s">

                        <span class="count-icon">
                            {!! $counters[2]['icon'] ?? '' !!}
                        </span>

                        <span class="steps">03.</span>

                        <div class="count-inner">

                            <span class="count-text">
                                {{ $counters[2]['title'] ?? '' }}
                            </span>

                            <div class="inline-content">

                                <span class="odometer countup-number" data-count="{{ $countNumber }}">
                                </span>

                                <span class="count-plus">
                                    {{ $countSuffix }}
                                </span>

                            </div>

                        </div>

                    </div>
                </div>
            @endif

        </div>
    </div>
</section>
