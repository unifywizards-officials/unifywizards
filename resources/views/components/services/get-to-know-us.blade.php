@props(['page'])

@php
    $about = is_array($page->s4_about) ? $page->s4_about : json_decode($page->s4_about, true);

    $hasImage = !empty($about['image_path']);
    $hasStat = !empty($about['counter_number']);
@endphp

@if (!empty($about) && ($about['status'] ?? '') === 'active')

    <section class="tj-gtku-section section-gap">
        <div class="container">

            <div class="gtku-grid {{ $hasImage ? '' : 'gtku-no-image' }}">

                @if ($hasImage)
                    <div class="gtku-image-col">

                        <div class="gtku-image-frame">

                            <img src="{{ asset('storage/' . $about['image_path']) }}"
                                alt="{{ $about['title'] ?? 'About us' }}" class="gtku-img">

                            @if ($hasStat)
                                <div class="gtku-stat-badge">

                                    <div class="gtku-stat-number">
                                        <span class="odometer countup-number"
                                            data-count="{{ $about['counter_number'] }}">
                                            {{ $about['counter_number'] }}
                                        </span>

                                        @if (!empty($about['counter_suffix']))
                                            <sup>{{ $about['counter_suffix'] }}</sup>
                                        @endif
                                    </div>

                                    @if (!empty($about['counter_label']))
                                        <div class="gtku-stat-label">
                                            {{ $about['counter_label'] }}
                                        </div>
                                    @endif

                                </div>
                            @endif

                        </div>

                    </div>
                @endif

                <div class="gtku-content-col">

                    @if (!empty($about['sub_title']))
                        <span class="sub-title">
                            <i class="tji-box"></i>
                            {{ $about['sub_title'] }}
                        </span>
                    @endif

                    <h2 class="sec-title">
                        {{ $about['title'] ?? '' }}
                    </h2>

                    @if (!empty($about['description_1']))
                        <p class="desc">
                            {{ $about['description_1'] }}
                        </p>
                    @endif

                    @if (!empty($about['description_2']))
                        <p class="desc">
                            {{ $about['description_2'] }}
                        </p>
                    @endif

                    {{-- No image to overlay the stat on: show it inline instead --}}
                    @if (!$hasImage && $hasStat)
                        <div class="gtku-stat-inline">

                            <div class="gtku-stat-number">
                                <span class="odometer countup-number" data-count="{{ $about['counter_number'] }}">
                                    {{ $about['counter_number'] }}
                                </span>

                                @if (!empty($about['counter_suffix']))
                                    <sup>{{ $about['counter_suffix'] }}</sup>
                                @endif
                            </div>

                            @if (!empty($about['counter_label']))
                                <div class="gtku-stat-label">
                                    {{ $about['counter_label'] }}
                                </div>
                            @endif

                        </div>
                    @endif

                    @if (!empty($about['button_text']))
                        <div class="gtku-btn-wrap">

                            <a class="tj-primary-btn" href="{{ $about['button_url'] ?? '#' }}">

                                <span class="btn-text">
                                    <span>
                                        {{ $about['button_text'] }}
                                    </span>
                                </span>

                                <span class="btn-icon">
                                    <i class="tji-arrow-right-long"></i>
                                </span>

                            </a>

                        </div>
                    @endif

                </div>

            </div>

        </div>
    </section>

@endif
