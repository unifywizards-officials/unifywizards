
<style>
    .tab-section-44__nav {
        height: 400px;
        overflow: auto;
    }
</style>

@props(['getmarketingsection'])

@php
    // ── Parse tabs JSON ──────────────────────────────────────
    $tabs = [];
    if (!empty($getmarketingsection->tabs)) {
        $raw = $getmarketingsection->tabs;
        $tabs = is_array($raw) ? $raw : json_decode($raw, true) ?? [];
    }

    // ── Title HTML: inject highlight_text as <span> ──────────
    $rawTitle = $getmarketingsection->title ?? '';
    $highlightText = $getmarketingsection->highlight_text ?? '';
    $description = $getmarketingsection->description ?? '';
    $linkText = $getmarketingsection->link_text ?? '';
    $linkUrl = $getmarketingsection->link_url ?? '#';

    if ($highlightText && str_contains($rawTitle, $highlightText)) {
        // Split on highlight_text, wrap it
        $parts = explode($highlightText, $rawTitle, 2);
        $titleHtml =
            e($parts[0]) .
            '<span class="tab-section-44__title-accent">' .
            e($highlightText) .
            '</span>' .
            e($parts[1] ?? '');
    } else {
        $titleHtml = e($rawTitle);
    }

    // ── Description: optionally wrap link_text in <a> ────────
    $descHtml = e($description);
    if ($linkText && str_contains($description, $linkText)) {
        $descHtml = str_replace(
            e($linkText),
            '<a href="' . e($linkUrl) . '" class="tab-section-44__link">' . e($linkText) . '</a>',
            e($description),
        );
    }
@endphp

<section class="tab-section-44 section-gap-x" >
    <div class="container">

        {{-- ── Section Header ────────────────────────────────── --}}
        <div class="tab-section-44__header">
            <h3 class="tab-section-44__title">
                {!! $titleHtml !!}
            </h3>
            <p class="tab-section-44__subtitle">
                {!! $descHtml !!}
            </p>
        </div>

        @if (count($tabs))
            <div class="tab-section-44__container">

                {{-- ── Left Tab Nav ────────────────────────────────── --}}
                <nav class="tab-section-44__nav" role="tablist" aria-label="Digital Marketing Services">
                    @foreach ($tabs as $i => $tab)
                        @php $slug = $tab['tab_slug'] ?? 'tab-' . $i; @endphp
                        <button class="tab-section-44__nav-item{{ $i === 0 ? ' tab-section-44__nav-item--active' : '' }}"
                            role="tab" aria-selected="{{ $i === 0 ? 'true' : 'false' }}"
                            aria-controls="tab-panel-44-{{ $slug }}" data-tab="{{ $slug }}"
                            type="button">
                            {{ $tab['tab_title'] ?? '' }}
                        </button>
                    @endforeach
                </nav>

                {{-- ── Right Content Panels ───────────────────────── --}}
                <div class="tab-section-44__content">
                    @foreach ($tabs as $i => $tab)
                        @php
                            $slug = $tab['tab_slug'] ?? 'tab-' . $i;
                            $points = $tab['points'] ?? [];
                            $tags = $tab['tags'] ?? [];
                        @endphp

                        <div class="tab-section-44__panel{{ $i === 0 ? ' tab-section-44__panel--active' : '' }}"
                            id="tab-panel-44-{{ $slug }}" role="tabpanel"
                            aria-labelledby="tab-44-{{ $slug }}"
                            @if ($i !== 0) hidden @endif>

                            {{-- Points --}}
                            @if (count($points))
                                <ul class="tab-section-44__list">
                                    @foreach ($points as $point)
                                        <li class="tab-section-44__list-item">
                                            <span class="tab-section-44__point-title">
                                                {{ $point['title'] ?? '' }}
                                            </span>
                                            <p class="tab-section-44__point-text">
                                                {{ $point['description'] ?? '' }}
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            {{-- Tags --}}
                            @if (count($tags))
                                <div class="tab-section-44__tags">
                                    @foreach ($tags as $tag)
                                        @php
                                            $tagLink = $tag['link'] ?? '#';
                                            // Strip trailing ↗ from stored text — we always render it fresh
                                            $tagText = trim(str_replace('↗', '', $tag['text'] ?? ''));
                                            $isGoogle = str_contains(strtolower($tagText), 'google');
                                        @endphp

                                        @if ($isGoogle)
                                            <a href="{{ $tagLink }}"
                                                class="tab-section-44__tag tab-section-44__tag--google">
                                                <span class="tab-section-44__google-dots">
                                                    <span
                                                        class="tab-section-44__gdot tab-section-44__gdot--blue"></span>
                                                    <span class="tab-section-44__gdot tab-section-44__gdot--red"></span>
                                                    <span
                                                        class="tab-section-44__gdot tab-section-44__gdot--yellow"></span>
                                                    <span
                                                        class="tab-section-44__gdot tab-section-44__gdot--green"></span>
                                                </span>
                                                {{ $tagText }}
                                                <span class="tab-section-44__tag-arrow">↗</span>
                                            </a>
                                        @else
                                            <a href="{{ $tagLink }}" class="tab-section-44__tag">
                                                {{ $tagText }}
                                                <span class="tab-section-44__tag-arrow">↗</span>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                        </div>{{-- /.panel --}}
                    @endforeach
                </div>{{-- /.content --}}

            </div>{{-- /.tab-section-44__container --}}
        @endif

    </div>
</section>

@once
    @push('scripts')
        <script>
            (function() {
                'use strict';

                var nav = document.querySelector('.tab-section-44__nav');
                if (!nav) return;

                var btns = nav.querySelectorAll('.tab-section-44__nav-item');
                var panels = document.querySelectorAll('.tab-section-44__panel');

                function activate(slug) {
                    btns.forEach(function(b) {
                        var active = b.getAttribute('data-tab') === slug;
                        b.classList.toggle('tab-section-44__nav-item--active', active);
                        b.setAttribute('aria-selected', active ? 'true' : 'false');
                    });
                    panels.forEach(function(p) {
                        var active = p.id === 'tab-panel-44-' + slug;
                        p.classList.toggle('tab-section-44__panel--active', active);
                        active ? p.removeAttribute('hidden') : p.setAttribute('hidden', '');
                    });
                }

                // Click
                btns.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        activate(btn.getAttribute('data-tab'));
                    });
                });

                // Keyboard (Arrow keys for accessibility)
                btns.forEach(function(btn, i) {
                    btn.addEventListener('keydown', function(e) {
                        var n = btns.length;
                        if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
                            e.preventDefault();
                            var next = btns[(i + 1) % n];
                            next.focus();
                            activate(next.getAttribute('data-tab'));
                        }
                        if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') {
                            e.preventDefault();
                            var prev = btns[(i - 1 + n) % n];
                            prev.focus();
                            activate(prev.getAttribute('data-tab'));
                        }
                    });
                });

            }());
        </script>
    @endpush
@endonce
