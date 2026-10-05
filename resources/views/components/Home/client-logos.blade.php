@php
    $logos = [];

    if (!empty($clientlogos->logos)) {
        $logos = is_string($clientlogos->logos) ? json_decode($clientlogos->logos, true) : $clientlogos->logos;
    }
@endphp

<section class="tj-client-section client-section-gap wow fadeInUp" data-wow-delay=".4s">
    <div class="container-fluid client-container">
        <div class="row">
            <div class="col-12">

                <div class="client-content">
                    <h5 class="sec-title">
                        {{ $clientlogos->title ?? 'Join Over' }}

                        <span class="client-numbers">
                            {{ $clientlogos->highlight_number ?? '' }}
                        </span>

                        <span class="client-text">
                            {{ $clientlogos->highlight_text ?? '' }}
                        </span>
                    </h5>
                </div>

                @if (!empty($logos))
                    <div class="swiper client-slider client-slider-1">
                        <div class="swiper-wrapper">

                            @foreach ($logos as $logo)
                                <div class="swiper-slide client-item">
                                    <div class="client-logo">
                                        <img src="{{ asset($logo) }}" alt="Client Logo">
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
