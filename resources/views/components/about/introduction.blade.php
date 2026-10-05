@php
    $intro = $introductions->first();
    $stats = $intro?->stats_items ?? [];
@endphp

@if ($intro)

    <section style="background:var(--white)">
        <div class="au-intro-wrap">

            <div class="au-intro-body sr left">

                <div class="au-label">
                    {{ $intro->name }}
                </div>

                <h2 class="au-h2">
                    {!! nl2br(e($intro->title)) !!}
                </h2>

                <div class="au-gstripe">
                    <span class="s1"></span>
                    <span class="s2"></span>
                    <span class="s3"></span>
                    <span class="s4"></span>
                </div>

                @php
                    $paragraphs = preg_split('/\r\n|\r|\n/', $intro->long_description);
                @endphp

                @foreach ($paragraphs as $paragraph)
                    @if (trim($paragraph))
                        <p class="au-p">
                            {{ $paragraph }}
                        </p>
                    @endif
                @endforeach

            </div>

            <div class="au-intro-img-wrap sr right">

                @if (!empty($stats) && isset($stats[0]))
                    <div class="au-float-card">

                        <div class="au-float-num">
                            {{ $stats[0]['number'] ?? '' }}
                            <sup style="font-size:14px">
                                {{ $stats[0]['icon'] ?? '+' }}
                            </sup>
                        </div>

                        <div class="au-float-lbl">
                            {{ $stats[0]['heading'] ?? '' }}
                        </div>

                    </div>
                @endif

                <div class="au-intro-img">

                    <img src="{{ asset($intro->image) }}" alt="{{ $intro->title }}">

                    <div class="au-intro-img-overlay"></div>

                    <div class="au-intro-badge">

                        <div class="au-intro-badge-icon">
                            🏆
                        </div>

                        <div>
                            <div class="au-intro-badge-text">
                                Award-Winning IT Company
                            </div>

                            <div class="au-intro-badge-sub">
                                Clutch Global Leader · Google Partner
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

    {{-- Stats Section --}}

    @if (!empty($stats))

        <div class="au-stats-section">

            <div class="au-stats-inner">

                @foreach ($stats as $index => $item)
                    <div class="au-stat-box sr scale sr-d{{ ($index % 4) + 1 }}">

                        <div class="au-stat-top-bar"></div>

                        <div class="au-stat-num">

                            <span class="au-counter" data-target="{{ $item['number'] ?? 0 }}">
                                0
                            </span>

                            <span class="au-stat-sup">
                                {{ $item['icon'] ?? '+' }}
                            </span>

                        </div>

                        <div class="au-stat-label">
                            {{ $item['heading'] ?? '' }}
                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    @endif

@endif
