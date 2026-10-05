@props(['solution'])

@php
    $services = [];

    if (!empty($solution->services)) {
        $services = is_string($solution->services) ? json_decode($solution->services, true) : $solution->services;
    }
@endphp

<section class="tj-service-section-5 section-gap">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="sec-heading style-4 text-center">
                    <span class="sub-title" data-wow-delay=".3s">
                        <i class="tji-box"></i>
                        {{ $solution->sub_title }}
                    </span>

                    <h2 class="sec-title">
                        {!! str_replace(
                            $solution->highlight_text,
                            '<span class="google-text">' . $solution->highlight_text . '</span>',
                            $solution->title,
                        ) !!}
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="service-wrapper">

                    @foreach ($services as $index => $service)
                        <div class="service-item style-5 {{ !$loop->last ? 'service-stack' : '' }}">
                            <div class="row">

                                <div class="service-content-area col-lg-9">

                                    <div class="service-content fold-content-mb-5 position-relative">

                                        <div class="service-icon">
                                            {!! $service['icon'] ?? '' !!}
                                        </div>

                                        <span class="no">
                                            {{ sprintf('%02d', $index + 1) }}.
                                        </span>

                                        {{-- IMPORTANT --}}
                                        {{-- Database se pura HTML aa raha hai --}}
                                        {!! $service['description'] ?? '' !!}

                                        @if (!empty($service['tags']))
                                            <div class="d-flex mt-4">

                                                @foreach ($service['tags'] as $tag)
                                                    <div class="tooltip-container">
                                                        <span class="text">
                                                            {{ $tag['text'] }}
                                                        </span>
                                                    </div>
                                                @endforeach

                                            </div>
                                        @endif

                                        @if (!empty($service['button_text']))
                                            <a class="tj-primary-btn" href="{{ $service['button_link'] ?? '#' }}">

                                                <span class="btn-text">
                                                    <span>
                                                        {{ $service['button_text'] }}
                                                    </span>
                                                </span>

                                                <span class="btn-icon">
                                                    <i class="tji-arrow-right-long"></i>
                                                </span>
                                            </a>
                                        @endif

                                    </div>
                                </div>

                                <div class="service-img col-lg-3">

                                    @if (!empty($service['image']))
                                        <img src="{{ asset($service['image']) }}"
                                            alt="{{ strip_tags($service['title'] ?? 'Service') }}">
                                    @endif

                                </div>

                            </div>
                        </div>
                    @endforeach

                    <div class="service-bottom-text">
                        <p class="desc">
                            <span>
                                <i class="tji-box"></i>

                                {{ $solution->bottom_text }}

                            &nbsp;
                            <a href="{{ $solution->bottom_button_link }}">
                                {{ $solution->bottom_button_text }}
                            </a>
                        </p>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
