@php
    $section = $page->s10_why_choose ?? null;

    if (is_string($section)) {
        $section = json_decode($section, true);
    }
@endphp

@if (!empty($section) && ($section['status'] ?? '') === 'active')

    <section id="choose" class="uw-choose-section section-gap">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-10 text-center mb-4">

                    @if (!empty($section['title']))
                        <h3 class="sec-title mb-2" style="font-size: 42px;">
                            {{ $section['title'] }}
                        </h3>
                    @endif

                    @if (!empty($section['sub_title']))
                        <div class="uw-choose-subtitle mb-2">
                            {{ $section['sub_title'] }}
                        </div>
                    @endif

                    @if (!empty($section['description']))
                        <p class="uw-choose-intro mb-4">
                            {{ $section['description'] }}
                        </p>
                    @endif

                </div>
            </div>

            @if (!empty($section['items']) && is_array($section['items']))
                <div class="row uw-choose-cards g-4">

                    @foreach ($section['items'] as $item)
                        @php
                            $cardColor = $item['color_class'] ?? 'uw-blue';
                        @endphp

                        <div class="col-md-6 col-lg-4">
                            <div class="uw-choose-card {{ $cardColor }}">

                                @if (!empty($item['icon_svg']))
                                    <div class="uw-choose-icon">
                                        {!! $item['icon_svg'] !!}
                                    </div>
                                @endif

                                @if (!empty($item['heading']))
                                    <span class="span-title-choose">
                                        {{ $item['heading'] }}
                                    </span><br><br>
                                @endif

                                @if (!empty($item['description']))
                                    <p>
                                        {{ $item['description'] }}
                                    </p>
                                @endif

                            </div>
                        </div>
                    @endforeach

                </div>
            @endif

        </div>
    </section>

@endif
