@php
    $platforms = [
        'clutch' => ['name' => 'Clutch', 'color' => '#EE3423', 'glyph' => 'letter', 'letter' => 'C'],
        'trustpilot' => ['name' => 'Trustpilot', 'color' => '#00B67A', 'glyph' => 'star', 'letter' => ''],
        'google' => ['name' => 'Google Reviews', 'color' => '#4285F4', 'glyph' => 'letter', 'letter' => 'G'],
    ];

    $images = $getreviewscreenshot->images ?? [];

    if (!is_array($images)) {
        $images = json_decode($images, true) ?? [];
    }
@endphp

@if ($getreviewscreenshot && $getreviewscreenshot->status)

    <section class="tj-client-reviews-section section-gap">
        <div class="container">

            <div class="crv-heading-wrap">

                <h3 class="sec-title">
                    {!! $getreviewscreenshot->highlight_text
                        ? str_replace(
                            $getreviewscreenshot->highlight_text,
                            '<span>' . e($getreviewscreenshot->highlight_text) . '</span>',
                            e($getreviewscreenshot->heading),
                        )
                        : e($getreviewscreenshot->heading) !!}
                </h3>

                @if ($getreviewscreenshot->description)
                    <p class="desc">
                        {{ $getreviewscreenshot->description }}
                    </p>
                @endif

            </div>

            <div class="crv-slider">

                <div class="crv-card-wrap">

                    @foreach ($platforms as $key => $platform)

                        @php
                            $screenshot = $images[$key] ?? null;
                        @endphp

                        <div class="crv-card" data-platform="{{ $key }}"
                            style="--crv-color: {{ $platform['color'] }};">

                            <div class="crv-card-head">

                                <span class="crv-platform-icon">
                                    @if ($platform['glyph'] === 'star')
                                        <svg width="30" height="30" viewBox="0 0 24 24" fill="{{ $platform['color'] }}">
                                            <path
                                                d="M12 2l2.9 6.6 7.1.6-5.4 4.7 1.7 7-6.3-3.9-6.3 3.9 1.7-7L2 9.2l7.1-.6z" />
                                        </svg>
                                    @else
                                        <span class="crv-platform-letter">
                                            {{ $platform['letter'] }}
                                        </span>
                                    @endif
                                </span>

                                <span class="crv-platform-name">
                                    {{ $platform['name'] }}
                                </span>

                                <span class="crv-verified">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 6L9 17l-5-5" />
                                    </svg>
                                    Verified Reviews
                                </span>

                            </div>

                            <div class="crv-screenshot">
                                @if ($screenshot)
                                    <img src="{{ asset('storage/' . $screenshot) }}"
                                        alt="{{ $platform['name'] }} reviews screenshot">
                                @else
                                    <div class="crv-screenshot-empty">
                                        {{ $platform['name'] }} screenshot coming soon
                                    </div>
                                @endif
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </div>
    </section>

@endif
