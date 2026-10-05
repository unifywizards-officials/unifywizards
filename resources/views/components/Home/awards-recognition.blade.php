@php
    $awards = $getawardsrecognition->award_items ?? [];

    $cardClasses = [
        ['card' => 'accent-mixed', 'badge' => 'g-mixed'],
        ['card' => 'accent-green', 'badge' => 'g-green'],
        ['card' => 'accent-red', 'badge' => 'g-red'],
        ['card' => 'accent-blue', 'badge' => 'g-blue'],
        ['card' => 'accent-yellow', 'badge' => 'g-yellow'],
    ];
@endphp

<section class="awd-section">
    <div class="container">

        {{-- Header --}}
        <div class="awd-header">
            <div class="awd-header-left">
                <div class="awd-eyebrow">
                    <span class="awd-eyebrow-dot"></span>
                    {{ $getawardsrecognition->sub_title }}
                </div>

                <h3 class="awd-heading">
                    {!! nl2br(e($getawardsrecognition->title)) !!}
                </h3>

                <p class="awd-desc">
                    {{ $getawardsrecognition->description }}
                </p>
            </div>

            @if ($getawardsrecognition->button_text)
                <a class="awd-view-btn" href="{{ $getawardsrecognition->button_link ?: '#' }}">
                    {{ $getawardsrecognition->button_text }}

                    <svg viewBox="0 0 24 24">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </a>
            @endif
        </div>

        {{-- Cards: every card uses the same layout/size for a symmetric grid --}}
        <div class="awd-grid awd-grid-symmetric">

            @foreach ($awards as $index => $award)
                @php
                    $style = $cardClasses[$index % count($cardClasses)];
                @endphp

                <div class="awd-card {{ $style['card'] }}">

                    <div class="awd-card-top">

                        <div class="awd-icon-wrap {{ $style['badge'] }}">
                            {!! $award['icon_class'] ?? '' !!}
                        </div>

                        <span class="awd-year-badge">
                            {{ $award['year'] ?? '' }}
                        </span>

                    </div>

                    <p class="awd-card-name">
                        {{ $award['award_name'] ?? '' }}
                    </p>

                    <p class="awd-card-by">
                        {{ $award['award_by'] ?? '' }}
                    </p>

                    <div class="awd-card-divider"></div>

                    <div class="awd-card-footer">

                        <div class="awd-location">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>

                            {{ $award['location'] ?? '' }}
                        </div>

                        <span class="awd-category {{ $style['badge'] }}">
                            {{ $award['category'] ?? '' }}
                        </span>

                    </div>

                </div>
            @endforeach

        </div>

        {{-- Bottom Strip --}}
        <div class="awd-bottom">

            <p class="awd-bottom-text">
                {!! $getawardsrecognition->bottom_text !!}
            </p>

            <div class="awd-logos">
                <div class="awd-logo-dot dot-blue"></div>
                <div class="awd-logo-dot dot-red"></div>
                <div class="awd-logo-dot dot-yellow"></div>
                <div class="awd-logo-dot dot-green"></div>
            </div>

        </div>

    </div>
</section>
