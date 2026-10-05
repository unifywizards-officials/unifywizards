@php
    $section = $page->s11_wizards_spell ?? null;

    if (is_string($section)) {
        $section = json_decode($section, true);
    }
@endphp

@if (!empty($section) && ($section['status'] ?? '') === 'active')

    <div class="atm-wrap container">
        <span class="atm-dot"></span>

        {{-- Heading --}}
        @if (!empty($section['heading']))
            <h4 class="atm-main-title">
                {{ $section['heading'] }}
            </h4>
        @endif

        {{-- Description --}}
        @if (!empty($section['description']))
            <p class="atm-sub-text">
                {{ $section['description'] }}
            </p>
        @endif

        {{-- Button --}}
        @if (!empty($section['button_text']))
            <a href="{{ $section['button_url'] ?? '#' }}" class="atm-learn-btn">
                {{ $section['button_text'] }}
            </a>
        @endif

        {{-- Cards --}}
        @if (!empty($section['cards']) && is_array($section['cards']))
            <div class="atm-cards-row" id="atm-deck">

                @foreach ($section['cards'] as $card)
                    <div class="atm-card {{ $card['color_class'] ?? 'atm-card-0' }}">

                        @if (!empty($card['name']))
                            <div class="atm-card-label">
                                {{ $card['name'] }}
                            </div>
                        @endif

                        @if (!empty($card['icon_svg']))
                            <div class="atm-icon-wrap">
                                {!! $card['icon_svg'] !!}
                            </div>
                        @endif

                        @if (!empty($card['description']))
                            <p class="atm-card-desc">
                                {{ $card['description'] }}
                            </p>
                        @endif

                    </div>
                @endforeach

            </div>
        @endif

    </div>

@endif
