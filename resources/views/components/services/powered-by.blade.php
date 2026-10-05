@php
    $poweredBy = is_array($page->s8_powered_by) ? $page->s8_powered_by : json_decode($page->s8_powered_by, true);
@endphp

@if (!empty($poweredBy) && ($poweredBy['status'] ?? '') === 'active')

    <section class="tj-service-section service-3 section-gap">
        <div class="container">

            {{-- Heading --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-heading style-3 text-center">

                        @if (!empty($poweredBy['sub_title']))
                            <span class="sub-title wow fadeInUp" data-wow-delay=".3s">
                                <i class="tji-box"></i>{{ $poweredBy['sub_title'] }}
                            </span>
                        @endif

                        @if (!empty($poweredBy['heading']))
                            <h3 class="sec-title">
                                {{ $poweredBy['heading'] }}
                            </h3><br>
                        @endif

                        @if (!empty($poweredBy['description']))
                            <p class="desc wow fadeInUp" data-wow-delay=".5s">
                                {{ $poweredBy['description'] }}
                            </p>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Items --}}
            <div class="row">
                <div class="col-12">

                    <div class="service-wrapper">

                        @foreach ($poweredBy['items'] ?? [] as $index => $item)
                            <div class="service-item style-3 wow fadeInUp" data-wow-delay="{{ 0.2 + $index * 0.1 }}s">

                                <div class="service-content-wrap">

                                    <div class="service-title">

                                        <div class="service-icon">
                                            {!! $item['icon'] ?? '' !!}
                                        </div>

                                        <span class="span-title-black">
                                            <a>
                                                {{ $item['heading'] ?? '' }}
                                            </a>
                                        </span>

                                    </div>

                                    <div class="service-content">
                                        <p class="desc">
                                            {{ $item['description'] ?? '' }}
                                        </p>
                                    </div>

                                </div>

                                <div class="service-reveal-bg"
                                    data-bg-image="{{ !empty($item['image_path']) ? asset('storage/' . $item['image_path']) : '' }}">
                                </div>

                            </div>
                        @endforeach

                    </div>

                    {{-- Button --}}
                    @if (!empty($poweredBy['button_text']))
                        <div class="service-btn-area text-center wow fadeInUp" data-wow-delay=".3s">

                            <a class="tj-primary-btn" href="{{ $poweredBy['button_url'] ?? '#' }}">

                                <span class="btn-text">
                                    <span>{{ $poweredBy['button_text'] }}</span>
                                </span>

                                <span class="btn-icon">
                                    <i class="tji-arrow-right-long"></i>
                                </span>

                            </a>

                        </div>
                    @endif

                </div>
            </div>

        </div>
    </section>

@endif
