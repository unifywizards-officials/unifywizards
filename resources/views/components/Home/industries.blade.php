@props(['industry'])

@php
    $industries = [];

    if (!empty($industry->industries)) {
        $industries = is_string($industry->industries)
            ? json_decode($industry->industries, true)
            : $industry->industries;
    }
@endphp

<section class="h5-project">
    <div class="tj-scroll-slider section-gap" style="padding-top:20px;">
        <div class="container">

            {{-- Heading --}}
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading-wrap style-3"
                        style="display:flex; flex-direction:column; align-items:center; text-align:center; margin-bottom:10px;">

                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s">
                            <i class="tji-box"></i>
                            {{ $industry->sub_title }}
                        </span>

                        <div class="heading-wrap-content"
                            style="display:flex; flex-direction:column; align-items:center; text-align:center; width:100%;">

                            <div class="sec-heading style-3" style="text-align:center;">
                                <h2 class="sec-title" style="font-size:37px; line-height:1.3; max-width:700px; margin:0 auto;">
                                    {{ $industry->title }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Industries Loop --}}
            <div class="row">
                <div class="col-12">
                    <div class="project-wrapper h5-project-wrapper">

                       @foreach ($industries as $item)

    @php

        $offerItems = [];
        $steps = [];

        $lines = preg_split('/\r\n|\r|\n/', $item['description_2']);

        $mode = '';
        $currentStep = [];

        foreach ($lines as $line) {

            $line = trim($line);

            if ($line == '') {
                continue;
            }

            if (strtolower($line) == 'what we offer') {
                $mode = 'offer';
                continue;
            }

            if (strtolower($line) == 'how it works') {
                $mode = 'steps';
                continue;
            }

            if ($mode == 'offer') {
                $offerItems[] = $line;
                continue;
            }

            if ($mode == 'steps') {

                if (preg_match('/^\d+\./', $line)) {

                    if (!empty($currentStep)) {
                        $steps[] = $currentStep;
                    }

                    $number = preg_replace('/\..*/', '', $line);

                    $title = trim(
                        preg_replace('/^\d+\.\s*/', '', $line)
                    );

                    $currentStep = [
                        'number' => $number,
                        'title' => $title,
                        'sub' => '',
                    ];

                } else {

                    if (!empty($currentStep)) {
                        $currentStep['sub'] .=
                            ($currentStep['sub'] ? ' ' : '') . $line;
                    }

                }
            }
        }

        if (!empty($currentStep)) {
            $steps[] = $currentStep;
        }

    @endphp
                            <div class="h5-project-item-wrapper tj-scroll-slider-item">

                                <div class="project-item h4-project-item h5-project-item">

                                    {{-- Image --}}
                                    <div class="project-img">
                                        <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}">
                                    </div>

                                    <div class="hcw-content">

                                        {{-- LEFT --}}
                                        <div class="hcw-left">

                                            <div>

                                                <div class="hcw-tag">
                                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                                        <path
                                                            d="M12 2a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4z" />
                                                    </svg>

                                                    {{ $item['tag'] }}
                                                </div>

                                                <h2 class="hcw-title">
                                                    {{ $item['title'] }}
                                                </h2>

                                                <p class="hcw-desc">
                                                    {!! nl2br(e($item['description_1'])) !!}
                                                </p>

                                            </div>

                                            <!--<a class="hcw-btn" href="{{ $item['button_link'] }}">-->

                                            <!--    {{ $item['button_text'] }}-->

                                            <!--    <span class="hcw-btn-icon">-->
                                            <!--        <svg viewBox="0 0 24 24" aria-hidden="true">-->
                                            <!--            <line x1="7" y1="17" x2="17"-->
                                            <!--                y2="7" />-->
                                            <!--            <polyline points="7 7 17 7 17 17" />-->
                                            <!--        </svg>-->
                                            <!--    </span>-->

                                            <!--</a>-->

                                        </div>

                                        {{-- RIGHT --}}
                                        <div class="hcw-right">

                                            {{-- What We Offer --}}
                                            <div>

                                                <p class="hcw-section-label">
                                                    What we offer
                                                </p>

                                                <div class="hcw-pills">

                                                    @foreach ($offerItems as $offer)
                                                        <span class="hcw-pill">

                                                            <svg viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">

                                                                <circle cx="12" cy="12" r="10" />

                                                            </svg>

                                                            {{ $offer }}

                                                        </span>
                                                    @endforeach

                                                </div>

                                            </div>

                                            <hr class="hcw-divider">

                                            {{-- Steps --}}
                                        <div>
    <p class="hcw-section-label">
        How it works
    </p>

    <div class="hcw-steps">

        @foreach ($steps as $step)

            <div class="hcw-step">

                <div class="hcw-step-num">
                    {{ $step['number'] }}
                </div>

                <div>

                    <p class="hcw-step-title">
                        {{ $step['title'] }}
                    </p>

                    <p class="hcw-step-sub">
                        {{ $step['sub'] }}
                    </p>

                </div>

            </div>

        @endforeach

    </div>
</div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            {{-- Button (moved below the slider) --}}
            <div class="row">
                <div class="col-12">
                    <div class="btn-area wow fadeInUp" data-wow-delay=".8s"
                        style="display:flex; justify-content:center; margin-top:55px;">
                        <a class="tj-primary-btn" href="{{ $industry->button_link }}">
                            <span class="btn-text">
                                <span>{{ $industry->button_text }}</span>
                            </span>
                            <span class="btn-icon">
                                <i class="tji-arrow-right-long"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
