@php
    $section = $page->s9_who_should_invest ?? null;

    if (is_string($section)) {
        $section = json_decode($section, true);
    }
@endphp

@if (!empty($section) && ($section['status'] ?? '') === 'active')

    <section class="wsi__section">
        <div class="container">

            <!-- Background blobs -->
            <div class="wsi__blob wsi__blob--1"></div>
            <div class="wsi__blob wsi__blob--2"></div>
            <div class="wsi__blob wsi__blob--3"></div>

            <div class="wsi__center">

                @if (!empty($section['chip_label']))
                    <div class="wsi__chip">
                        <div class="wsi__chip-dot"></div>
                        {{ $section['chip_label'] }}
                    </div>
                @endif

                @if (!empty($section['heading']))
                    <h3 class="wsi__title">
                        {!! nl2br(e($section['heading'])) !!}
                    </h3>
                @endif

                @if (!empty($section['description']))
                    <p class="wsi__intro">
                        {{ $section['description'] }}
                    </p>
                @endif

                @if (!empty($section['questions_label']))
                    <p class="wsi__sub-label">
                        {{ $section['questions_label'] }}
                    </p>
                @elseif(!empty($section['questions']))
                    <p class="wsi__sub-label">
                        Quick questions to ask yourself:
                    </p>
                @endif

            </div>

            {{-- Questions --}}
            @if (!empty($section['questions']) && is_array($section['questions']))
                <div class="wsi__cards-grid">

                    @foreach ($section['questions'] as $question)
                        @php
                            $colorClass = $question['color_class'] ?? 'wsi__q-card--blue';

                            $iconColorClass = str_replace('wsi__q-card--', 'wsi__q-icon--', $colorClass);
                        @endphp

                        <div class="wsi__q-card {{ $colorClass }}">
                            <div class="wsi__q-icon {{ $iconColorClass }}">
                                {!! $question['icon'] ?: '✓' !!}
                            </div>

                            <p class="wsi__q-text">
                                {{ $question['heading'] ?? '' }}
                            </p>
                        </div>
                    @endforeach

                </div>
            @endif

            {{-- Divider --}}
            @if (!empty($section['divider_label']))
                <div class="wsi__divider-row">
                    <div class="wsi__divider-line"></div>

                    <span class="wsi__divider-label">
                        {{ $section['divider_label'] }}
                    </span>

                    <div class="wsi__divider-line"></div>
                </div>
            @endif

            {{-- Answers --}}
            @if (!empty($section['answers']) && is_array($section['answers']))
                <div class="wsi__bottom-grid">

                    @foreach ($section['answers'] as $answer)
                        @php
                            $accent = strtolower($answer['accent_color'] ?? 'green');

                            $allowedColors = ['green', 'blue', 'red', 'yellow'];

                            if (!in_array($accent, $allowedColors)) {
                                $accent = 'green';
                            }
                        @endphp

                        <div class="wsi__info-card">

                            <div class="wsi__info-accent wsi__info-accent--{{ $accent }}"></div>

                            <div class="wsi__info-body">

                                <strong class="wsi__info-title">
                                    {{ $answer['heading'] ?? '' }}
                                </strong>

                                <p class="wsi__info-text">
                                    {{ $answer['description'] ?? '' }}
                                </p>

                            </div>

                        </div>
                    @endforeach

                </div>
            @endif

            <!--{{-- CTA Button --}}-->
            <!--@if (!empty($section['button_text']) && !empty($section['button_url']))-->
            <!--    <div class="wsi__cta-row">-->
            <!--        <a href="{{ $section['button_url'] }}" class="wsi__cta-btn">-->
            <!--            {{ $section['button_text'] }}-->
            <!--            <span class="wsi__cta-arrow">↗</span>-->
            <!--        </a>-->
            <!--    </div>-->
            <!--@endif-->

        </div>
    </section>

@endif
