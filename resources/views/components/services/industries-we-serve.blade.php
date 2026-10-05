@props(['page'])

@php
    $industries = is_array($page->s3_industries) ? $page->s3_industries : json_decode($page->s3_industries, true);
@endphp

@if (!empty($industries) && ($industries['status'] ?? '') == 'active')
    <section class="tj-industries-section section-gap section-separator">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="sec-heading-wrap style-3 text-center">

                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s">
                            <i class="tji-box"></i>
                            {{ $industries['sub_title'] ?? 'Industries We Serve' }}
                        </span>

                        <div class="sec-heading style-3">
                            <h2 class="sec-title">
                                {{ $industries['heading'] ?? '' }}
                            </h2>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row gy-3 justify-content-center">

                @foreach ($industries['items'] ?? [] as $index => $item)
                    @if (!empty($item['name']))
                        <div class="col-6 col-md-2">

                            <a class="industries-card wow fadeInUp"
                                data-wow-delay="{{ 0.2 + $index * 0.05 }}s">

                                <div class="industries-icon {{ $item['color_class'] ?? 'google-blue' }}">
                                    {!! $item['icon'] ?? '' !!}
                                </div>

                                <p class="industries-title">
                                    {{ $item['name'] }}
                                </p>

                                @if (!empty($item['description']))
                                    <p class="industries-description">
                                        {{ $item['description'] }}
                                    </p>
                                @endif

                            </a>

                        </div>
                    @endif
                @endforeach

            </div>

        </div>
    </section>
@endif
