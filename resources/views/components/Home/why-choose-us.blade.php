@php
    $section = $getwhychoose ?? null;

    $rawItems = $section->items ?? [];

    if (!is_array($rawItems)) {
        $rawItems = json_decode($rawItems, true) ?? [];
    }

    $items = collect($rawItems)->filter(function ($item) {
        return !empty($item['title']) || !empty($item['description']);
    })->values();

    $half = (int) ceil($items->count() / 2);
    $leftItems = $items->slice(0, $half);
    $rightItems = $items->slice($half);
@endphp

@if ($section && $section->status && $items->isNotEmpty())

    <section class="tj-why-choose-section section-gap">
        <div class="container">

            <div class="sec-heading sec-heading-centered wcu-heading-wrap">

                <span class="sub-title">
                    <span class="wcu-badge-dot"></span>
                    {{ $section->sub_title ?: 'Why Choose Us' }}
                </span>

                <h3 class="sec-title">
                    {{ $section->title }}
                </h3>

                @if ($section->description)
                    <p class="wcu-desc">
                        {{ $section->description }}
                    </p>
                @endif

            </div>

            <div class="wcu-columns">

                <div class="wcu-column">
                    @foreach ($leftItems as $item)
                        @include('components.Home.partials.why-choose-item', [
                            'item' => $item,
                            'index' => $loop->index,
                            'isFirstOverall' => $loop->index === 0,
                        ])
                    @endforeach
                </div>

                <div class="wcu-column">
                    @foreach ($rightItems as $item)
                        @include('components.Home.partials.why-choose-item', [
                            'item' => $item,
                            'index' => $half + $loop->index,
                            'isFirstOverall' => false,
                        ])
                    @endforeach
                </div>

            </div>

        </div>
    </section>

@endif
