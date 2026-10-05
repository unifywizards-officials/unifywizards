@php
    $heroDesc = json_decode($hero->description ?? '{}', true);
@endphp

<section class="au-hero">

    <div class="au-hero-grid"></div>

    <div class="au-orb au-orb-1"></div>
    <div class="au-orb au-orb-2"></div>
    <div class="au-orb au-orb-3"></div>

    <div class="au-hero-content">

        <div class="au-g-pill">
            <span class="au-g-dot au-g-dot-b"></span>
            <span class="au-g-dot au-g-dot-r"></span>
            <span class="au-g-dot au-g-dot-y"></span>
            <span class="au-g-dot au-g-dot-g"></span>

            <span>{{ $hero->subtitle ?? '' }}</span>
        </div>

        <h1>
            {{ $hero->title ?? '' }}

            @if (!empty($heroDesc['highlight_text']))
                <br>
                <em>{{ $heroDesc['highlight_text'] }}</em>
            @endif
        </h1>

        <p class="au-hero-sub">
            {{ $heroDesc['description'] ?? '' }}
        </p>

        <div class="au-hero-btns">

            @if (!empty($hero->button_text))
                <a href="{{ $hero->button_link ?? '#' }}" class="au-btn au-btn-green">
                    {{ $hero->button_text }}
                </a>
            @endif

            @if (!empty($hero->button_text2))
                <a href="{{ $hero->button_link2 ?? '#' }}" class="au-btn au-btn-ghost">
                    {{ $hero->button_text2 }}
                </a>
            @endif

        </div>

    </div>

    <div class="au-gbar"></div>

</section>
