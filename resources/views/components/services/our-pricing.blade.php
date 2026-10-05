@php
    $pricing = is_array($page->s15_development_items)
        ? $page->s15_development_items
        : json_decode($page->s15_development_items, true);
@endphp

@if (!empty($pricing) && ($pricing['status'] ?? '') === 'active')

    <section class="section-gap container">

        <!-- Header -->
        <div class="pt-header">
            <div class="pt-label">
                <span class="pt-dot pt-dot--blue"></span>
                <span class="pt-dot pt-dot--red"></span>
                <span class="pt-dot pt-dot--yellow"></span>
                <span class="pt-dot pt-dot--green"></span>

                {{ $pricing['sub_title'] ?? '' }}
            </div>

            <h2 class="pt-title">
                {{ $pricing['heading'] ?? '' }}
            </h2>
        </div>

        <!-- Table -->
        <div class="pt-table-wrapper">

            <!-- Head -->
            <div class="pt-table-head">
                <div class="pt-table-head__cell">Service</div>
                <div class="pt-table-head__cell pt-table-head__cell--center">
                    Price / mo
                </div>
                <div class="pt-table-head__cell pt-table-head__cell--center">
                    Category
                </div>
                <div class="pt-table-head__cell pt-table-head__cell--center">
                    Action
                </div>
            </div>

            @php
                $colors = ['blue', 'red', 'green', 'yellow'];

                $icons = [
                    'ti ti-search',
                    'ti ti-chart-line',
                    'ti ti-world',
                    'ti ti-speakerphone',
                    'ti ti-link',
                    'ti ti-stack-2',
                ];
            @endphp

            @foreach ($pricing['items'] ?? [] as $index => $item)
                @php
                    $color = $colors[$index % count($colors)];
                    $icon = $icons[$index % count($icons)];
                @endphp

                <div class="pt-row">

                    <div class="pt-service">

                        <div class="pt-icon pt-icon--{{ $color }}">
                            <i class="{{ $icon }}" aria-hidden="true"></i>
                        </div>

                        <div class="pt-service__info">

                            <div class="pt-service__name-row">
                                <span class="pt-service__name">
                                    {{ $item['title'] ?? '' }}
                                </span>
                            </div>

                            <div class="pt-service__sub">
                                {{ $item['heading'] ?? '' }}
                            </div>

                        </div>

                    </div>

                    <div class="pt-price">
                        {{ $item['price'] ?? '' }}
                    </div>

                    <div class="pt-chip-cell">
                        <span class="pt-chip pt-chip--{{ $color }}">
                            {{ $item['category'] ?? '' }}
                        </span>
                    </div>

                     <div class="pt-actions">

                        @if (!empty($item['btn_one']))
                            <a href="/contact" class="pt-btn-primary">
                                {{ $item['btn_one'] }}
                            </a>
                        @endif

                        @if (!empty($item['btn_two']))
                            <a href="/contact" class="pt-btn-secondary">
                                {{ $item['btn_two'] }}
                            </a>
                        @endif

                    </div>

                </div>
            @endforeach

        </div>

    </section>

@endif
