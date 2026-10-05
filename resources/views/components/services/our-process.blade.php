@php
    $section = $page->s14_our_process ?? null;

    if (is_string($section)) {
        $section = json_decode($section, true);
    }
@endphp

@if (!empty($section) && ($section['status'] ?? '') === 'active')

    <section class="h5-working-process section-gap section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading sec-heading-centered style-3">

                        @if (!empty($section['heading']))
                            <span class="sub-title wow fadeInUp" data-wow-delay=".3s">
                                <i class="tji-box"></i>
                                {{ $section['heading'] }}
                            </span>
                        @endif

                        @if (!empty($section['description']))
                            <h2 class="sec-title text-anim text-white">
                                {{ $section['description'] }}
                            </h2>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="h5-working-process-inner">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="working-process-area h5-working-process-wrapper">

                            @foreach ($section['items'] ?? [] as $index => $item)
                                @php
                                    $stepNumber = $index + 1;
                                    $formattedStep = str_pad($stepNumber, 2, '0', STR_PAD_LEFT);

                                    $delay = 0.3 + $index * 0.1;
                                @endphp

                                <div class="process-item h5-working-process-item wow bounceInUp"
                                    data-wow-delay="{{ $delay }}s">

                                    <span class="h5-working-process-indicator">
                                        Step {{ $formattedStep }}
                                    </span>

                                    <div class="process-step">
                                        <span>{{ $formattedStep }}</span>
                                    </div>

                                    <div class="process-content">

                                        @if (!empty($item['title']))
                                            <span class="title" style="font-size: 22px;">
                                                {{ $item['title'] }}
                                            </span>
                                        @endif

                                        @if (!empty($item['description']))
                                            <p class="desc" style="margin-top: 20px;">
                                                {{ $item['description'] }}
                                            </p>
                                        @endif

                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="bg-shape-1">
            <img src="{{ asset('home_assets/images/shape/pattern-2.svg') }}" alt="">
        </div>

        <div class="bg-shape-2">
            <img src="{{ asset('home_assets/images/shape/pattern-3.svg') }}" alt="">
        </div>

        <div class="bg-shape-3">
            <img src="{{ asset('home_assets/images/shape/shape-blur.svg') }}" alt="">
        </div>

        <div class="bg-shape-4">
            <img src="{{ asset('home_assets/images/shape/shape-blur.svg') }}" alt="">
        </div>
    </section>

@endif
