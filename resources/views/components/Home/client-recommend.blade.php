@php
    $clients = $getclientrecommend->clients ?? [];

    if (!is_array($clients)) {
        $clients = json_decode($clients, true) ?? [];
    }

    /* Drop rows with neither an image nor a video to show */
    $clients = array_values(array_filter($clients, function ($c) {
        return !empty($c['image']) || !empty($c['video']);
    }));
@endphp

@if ($getclientrecommend && $getclientrecommend->status && !empty($clients))

    <section class="tj-video-testimonial-section section-gap">
        <div class="container">

            <div class="cr-heading-wrap">

                <span class="cr-badge">
                    <span class="cr-badge-dot"></span>
                    Video Testimonials
                </span>

                <h3 class="sec-title">
                    {{ $getclientrecommend->title ?: 'Clients Recommend Us' }}
                </h3>

                @if ($getclientrecommend->description)
                    <p class="desc">
                        {{ $getclientrecommend->description }}
                    </p>
                @endif

            </div>

            <div class="cr-slider">

                <button type="button" class="cr-nav cr-nav-prev" aria-label="Previous testimonials">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                </button>

                <div class="cr-viewport">
                    <div class="cr-track">

                        @foreach ($clients as $client)
                            <div class="cr-card">

                                <div class="cr-media">

                                    @if (!empty($client['video']))

                                        <video class="cr-video" preload="none" playsinline
                                            @if (!empty($client['image'])) poster="{{ asset('storage/' . $client['image']) }}" @endif>
                                            <source src="{{ asset('storage/' . $client['video']) }}" type="video/mp4">
                                        </video>

                                        <div class="cr-overlay"></div>

                                        <svg class="cr-quote-icon" width="30" height="24" viewBox="0 0 40 32">
                                            <path
                                                d="M0 32V19.2C0 8.6 6.4 1.6 17.3 0l2 5.3C13 7 9.6 10.7 9.1 15.5H17V32H0zm23 0V19.2C23 8.6 29.4 1.6 40.3 0l2 5.3C36 7 32.6 10.7 32.1 15.5H40V32H23z"
                                                fill="#FFFFFF" fill-opacity="0.85" />
                                        </svg>

                                        <button type="button" class="cr-play-btn"
                                            aria-label="Play video testimonial">
                                            <svg width="18" height="20" viewBox="0 0 16 18">
                                                <path d="M0 0 L16 9 L0 18 Z" fill="var(--tj-color-theme-primary)" />
                                            </svg>
                                        </button>

                                    @elseif (!empty($client['image']))

                                        <img src="{{ asset('storage/' . $client['image']) }}"
                                            alt="{{ $client['name'] ?? 'Client' }}" class="cr-image">

                                        <div class="cr-overlay"></div>

                                    @endif

                                    @if (!empty($client['name']) || !empty($client['designation']))
                                        <div class="cr-caption">

                                            @if (!empty($client['name']))
                                                <div class="cr-name">
                                                    {{ $client['name'] }}
                                                </div>
                                            @endif

                                            @if (!empty($client['designation']))
                                                <div class="cr-role">
                                                    {{ $client['designation'] }}
                                                </div>
                                            @endif

                                        </div>
                                    @endif

                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>

                <button type="button" class="cr-nav cr-nav-next" aria-label="Next testimonials">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18l6-6-6-6" />
                    </svg>
                </button>

            </div>

            <div class="cr-dots"></div>

        </div>
    </section>

@endif
