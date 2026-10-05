@props(['pricing'])

@php
    $pricingCards = [];

    if (!empty($pricing->pricing_cards)) {
        $pricingCards = is_string($pricing->pricing_cards)
            ? json_decode($pricing->pricing_cards, true)
            : $pricing->pricing_cards;
    }

    /*
    |--------------------------------------------------------------------------
    | Safety Check
    |--------------------------------------------------------------------------
    */

    if (!is_array($pricingCards)) {
        $pricingCards = [];
    }
@endphp


{{-- =========================================================
     PRICING SECTION
========================================================= --}}

<section class="container pricing-section section-gap">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="ps-header" >

        <div class="ps-label">
            <span class="ps-label-dot"></span>
            Pricing
        </div>

        <h2 class="ps-title">

            {{ $pricing->title ?? 'Our' }}

            @if (!empty($pricing->highlight_text))
                <span class="ps-title-accent">
                    {{ $pricing->highlight_text }}
                </span>
            @endif

        </h2>

    </div>


    {{-- =====================================================
         PRICING GRID
    ====================================================== --}}

    <div class="ps-grid">

        @foreach ($pricingCards as $card)

            @php

                $icon = trim($card['icon'] ?? '');

                $featured = !empty($card['featured']);

                $tags = $card['tags'] ?? [];

            @endphp


            {{-- =================================================
                 PRICING CARD
            ================================================== --}}

            <div class="ps-card {{ $featured ? 'ps-card--featured' : '' }}">

                @if ($featured)
                    <span class="ps-featured-badge">Most Popular</span>
                @endif

                <div class="ps-icon">
                    @if (!empty($icon))
                        <i class="{{ $icon }}" aria-hidden="true"></i>
                    @endif
                </div>

                <div class="ps-card-name">{{ $card['title'] ?? '' }}</div>

                <div class="ps-card-sub">{{ $card['subtitle'] ?? '' }}</div>

                <div class="ps-card-price">

                    {{ $card['price'] ?? '' }}

                    @if (!empty($card['price_unit']))
                        <span class="ps-price-unit">{{ $card['price_unit'] }}</span>
                    @endif

                </div>

                @if (!empty($tags))

                    <div class="ps-card-divider"></div>

                    <ul class="ps-features">
                        @foreach ($tags as $tag)
                            @if (!empty($tag['text']))
                                <li class="ps-feature-item">
                                    <span class="ps-feature-icon">
                                        <i class="{{ !empty($tag['icon']) ? $tag['icon'] : 'fa-solid fa-check' }}" aria-hidden="true"></i>
                                    </span>
                                    {{ $tag['text'] }}
                                </li>
                            @endif
                        @endforeach
                    </ul>

                @endif

                <div class="ps-card-actions">

                    @if (!empty($card['explore_button_text']))
                        <a href="{{ $card['explore_button_link'] ?? 'javascript:void(0)' }}" class="ps-btn-primary">
                            {{ $card['explore_button_text'] }}
                        </a>
                    @endif

                    @if (!empty($card['contact_button_text']))
                        <a href="{{ $card['contact_button_link'] ?? 'javascript:void(0)' }}" class="ps-btn-outline">
                            {{ $card['contact_button_text'] }}
                        </a>
                    @endif

                </div>

            </div>

        @endforeach

    </div>

</section>
