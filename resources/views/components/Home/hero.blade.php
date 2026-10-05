@php
    $hero = $hero ?? null;

    $customerImages = is_string($hero->customer_images ?? null)
        ? json_decode($hero->customer_images, true)
        : $hero->customer_images ?? [];

    $awardImages = is_string($hero->award_images ?? null)
        ? json_decode($hero->award_images, true)
        : $hero->award_images ?? [];
@endphp

@if ($hero)

    <section class="tj-banner-section section-gap-x">
        <div class="banner-area">

            {{-- LEFT --}}
            <div class="banner-left-box">
                <div class="banner-content">

                    <span class="sub-title">
                        <i class="tji-excellence"></i>
                        {{ $hero->sub_title }}
                    </span>

                    <h1 class="banner-title">
                        {!! str_replace($hero->highlight_text, "<span>{$hero->highlight_text}</span>", e($hero->title)) !!}
                    </h1>

                    <div class="banner-desc-area">
                        <div class="banner-desc">
                            {{ $hero->description }}
                        </div>
                    </div>

                    {{-- AWARDS --}}
                    <div class="row">
                        @foreach ($awardImages as $img)
                            <div class="col-6 col-lg-3 d-flex justify-content-center">
                                <img src="{{ asset($img) }}" class="award-width">
                            </div>
                        @endforeach
                    </div>

                </div>

                <div class="banner-shape">
                    <img src="{{ asset('home_assets/images/shape/pattern-bg.webp') }}">
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="banner-right-box">

                <div class="banner-img">
                    <img data-speed="0.8" src="{{ asset($hero->hero_image) }}">
                </div>

                <div class="box-area">
                    <div class="customers-box">

                        <div class="customers">
                            <ul>

                                @foreach ($customerImages as $img)
                                    <li>
                                        <img src="{{ asset($img) }}">
                                    </li>
                                @endforeach

                                <li><span><i class="tji-plus"></i></span></li>

                            </ul>
                        </div>

                        <div class="customers-number google-text">
                            {{ $hero->customer_count }}K
                        </div>

                        <span class="customers-text">
                            {{ $hero->customer_text }}
                        </span>

                    </div>
                </div>

            </div>

        </div>

        @if ($hero->scroll_button_link)
            <div class="banner-scroll">
                <a href="{{ $hero->scroll_button_link }}">
                    {{ $hero->scroll_button_text ?? 'Scroll Down' }}
                </a>
            </div>
        @endif

    </section>

@endif
