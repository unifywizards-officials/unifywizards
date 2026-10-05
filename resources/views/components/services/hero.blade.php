@php
    // s1_banner JSON already cast to array/object via model $casts
    $banner = $page->s1_banner;

    // Safety: agar status null ya inactive ho to section skip
    // (remove this check if you always want to show the section)
    $show = !empty($banner) && ($banner['status'] ?? null) === 'active';
@endphp

@if ($show)
    <section class="tj-banner-section-2 section-gap-x top-space-30">
        <div class="container">
            <div class="row align-items-center">

                {{-- ── LEFT: Text Content ── --}}
                <div class="col-lg-6">
                    <div class="banner-content-2">

                        {{-- Sub Title --}}
                        @if (!empty($banner['sub_title']))
                            <span class="sub-title" data-wow-delay=".2s">
                                <i class="tji-box"></i> {{ $banner['sub_title'] }}
                            </span>
                        @endif

                        {{-- Banner Title --}}
                        @if (!empty($banner['banner_title']))
                            <h1 class="banner-title">
                                {{ $banner['banner_title'] }}
                            </h1><br>
                        @endif

                        {{-- Description --}}
                        @if (!empty($banner['description']))
                            <div class="desc">
                                <p>{{ $banner['description'] }}</p>
                            </div>
                        @endif

                        {{-- Buttons --}}
                        <div class="btn-area mb-40" data-wow-delay=".8s">

                            @if (!empty($banner['button_text']))
                                <a class="tj-primary-btn" href="{{ $banner['button_url'] ?? '#' }}">
                                    <span class="btn-text">
                                        <span>{{ $banner['button_text'] }}</span>
                                    </span>
                                    <span class="btn-icon">
                                        <i class="tji-arrow-right-long"></i>
                                    </span>
                                </a>
                            @endif

                            @if (!empty($banner['phone_number']))
                                <a class="number"
                                    href="tel:{{ preg_replace('/[^0-9]/', '', $banner['phone_number']) }}">
                                    <i class="tji-phone"></i>
                                    <span>{{ $banner['phone_number'] }}</span>
                                </a>
                            @endif

                        </div>

                        {{-- Logos --}}
                        @if (!empty($banner['logos']) && count($banner['logos']) > 0)
                            <div class="row">
                                @foreach ($banner['logos'] as $logo)
                                    @if (!empty($logo['image']))
                                        <div class="col-6 col-lg-3 justify-content-center d-flex">
                                            <img src="{{ asset('storage/' . $logo['image']) }}" alt="Logo"
                                                class="award-width" />
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>

                {{-- ── RIGHT: Form + Marquee ── --}}
                <div class="col-lg-6">
                    <div class="banner-img-area wow fadeInUp" data-wow-delay=".3s">
                        <div class="banner-img">
                            <div class="uw2-wrap" id="uw2Container">
                                <div class="uw2-accent-bar"></div>

                                {{-- Proposal Form --}}
                                <x-Proposal />

                                {{-- Success State --}}
                                <div class="uw2-success text-white" id="uw2Success">
                                    <div class="uw2-success-icon">
                                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                                            <path d="M5 12L10 17L19 7" stroke="#22c55e" stroke-width="2.2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <span>Proposal Request Sent!</span>
                                    <p>Our team will review your project and get back to you within 24 hours.</p>
                                </div>
                            </div>

                            {{-- Marquee — page_name dynamic --}}
                            <div class="brand-name wow fadeIn" data-wow-delay="2.2s">
                                <div class="marquee-vr">
                                    @for ($i = 0; $i < 7; $i++)
                                        <span class="text">
                                            {{ $page->page_name }}
                                            <span class="icon">/</span>
                                        </span>
                                    @endfor
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="bg-shape-1">
            <img src="{{ asset('home_assets/images/shape/pattern-2.svg') }}" alt="" />
        </div>
        <div class="bg-shape-2">
            <img src="{{ asset('home_assets/images/shape/pattern-3.svg') }}" alt="" />
        </div>

        <div class="banner-scroll wow fadeInDown" data-wow-delay="2.5s">
            <a href="#choose" class="scroll-down tj-scroll-btn">
                <span><i class="tji-arrow-down-long"></i></span>
                Scroll Down
            </a>
        </div>
    </section>
@endif
