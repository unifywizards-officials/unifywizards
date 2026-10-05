@props(['page'])

@php
    $testimonials = is_array($page->s5_testimonials)
        ? $page->s5_testimonials
        : json_decode($page->s5_testimonials, true);
@endphp

@if (!empty($testimonials) && ($testimonials['status'] ?? '') === 'active')

    @php
        $items = $testimonials['items'] ?? [];
    @endphp

    <section class="h9-testimonial bg-white section-gap">
        <div class="container">

            <div class="svc-test-header">

                @if (!empty($testimonials['sub_title']))
                    <span class="svc-test-eyebrow">
                        {{ $testimonials['sub_title'] }}
                    </span>
                @endif

                @if (!empty($testimonials['heading']))
                    <h2 class="svc-test-heading">
                        {{ $testimonials['heading'] }}
                    </h2>
                @endif

            </div>

            <div class="swiper svc-test-slider">
                <div class="swiper-wrapper">

                    @foreach ($items as $item)

                        <div class="swiper-slide">

                            <div class="svc-test-card">

                                <span class="svc-test-quote-icon">
                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M7.17 6C4.87 8.06 3.5 10.85 3.5 14.03c0 3.31 2.14 5.47 4.66 5.47 2.14 0 3.7-1.66 3.7-3.7 0-1.94-1.36-3.4-3.1-3.4-.34 0-.68.06-.86.12.3-2.1 2.1-4.56 4.1-5.78L7.17 6zm10 0c-2.3 2.06-3.67 4.85-3.67 8.03 0 3.31 2.14 5.47 4.66 5.47 2.14 0 3.7-1.66 3.7-3.7 0-1.94-1.36-3.4-3.1-3.4-.34 0-.68.06-.86.12.3-2.1 2.1-4.56 4.1-5.78L17.17 6z" />
                                    </svg>
                                </span>

                                <div class="star-ratings">
                                    <div class="fill-ratings" style="width: {{ (($item['stars'] ?? 5) / 5) * 100 }}%">
                                        <span>★★★★★</span>
                                    </div>

                                    <div class="empty-ratings">
                                        <span>★★★★★</span>
                                    </div>
                                </div>

                                <p class="svc-test-desc">
                                    "{{ $item['description'] ?? '' }}"
                                </p>

                                <div class="svc-test-divider"></div>

                                <div class="svc-test-author">

                                    @if (!empty($item['avatar_path']))
                                        <img class="svc-test-avatar" src="{{ asset('storage/' . $item['avatar_path']) }}"
                                            alt="{{ $item['name'] ?? '' }}">
                                    @else
                                        <span class="svc-test-avatar-fallback">
                                            {{ strtoupper(substr($item['name'] ?? '?', 0, 1)) }}
                                        </span>
                                    @endif

                                    <div>
                                        <span class="svc-test-name">
                                            {{ $item['name'] ?? '' }}
                                        </span>

                                        <span class="svc-test-role">
                                            {{ $item['designation'] ?? '' }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

                <div class="svc-test-nav-wrap">
                    <button type="button" class="svc-test-nav svc-test-prev" aria-label="Previous testimonial">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>

                    <div class="swiper-pagination svc-test-pagination"></div>

                    <button type="button" class="svc-test-nav svc-test-next" aria-label="Next testimonial">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </button>
                </div>

            </div>

        </div>
    </section>

@endif
