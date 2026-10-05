@php
    $topServices = is_array($page->s2_top_services)
        ? $page->s2_top_services
        : json_decode($page->s2_top_services, true);
@endphp

@if (!empty($topServices) && ($topServices['status'] ?? '') == 'active')

    <section class="tj-team-section section-separator">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="sec-heading text-center style-2">

                        <h2 class="sec-title" style="margin-top: -50px;">
                            {{ $topServices['heading'] ?? '' }}
                            <span>{{ $topServices['name'] ?? '' }}</span>
                        </h2><br>

                        @if (!empty($topServices['description']))
                            <p class="desc">
                                {{ $topServices['description'] }}
                            </p>
                        @endif

                    </div>
                </div>
            </div>

            <div class="details-content-box row">

                @foreach ($topServices['items'] ?? [] as $index => $item)

                    @if (!empty($item['title']))

                        <div class="col-6 col-md-4 col-lg-3">

                            @if (!empty($item['url']))
                                <a href="{{ $item['url'] }}"
                                   class="service-details-link">
                            @endif

                                <div class="service-details-item wow fadeInUp"
                                    data-wow-delay="{{ (($index % 3) + 1) * 0.2 }}s">

                                    <span class="number">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}.
                                    </span>

                                    <span class="span-title">
                                        {{ $item['title'] }}
                                    </span>

                                    @if (!empty($item['description']))
                                        <div class="desc">
                                            <p>
                                                {{ \Illuminate\Support\Str::words(strip_tags($item['description']), 25, '...') }}
                                            </p>
                                        </div>
                                    @endif

                                </div>

                            @if (!empty($item['url']))
                                </a>
                            @endif

                        </div>

                    @endif

                @endforeach

            </div>

        </div>
    </section>

@endif

<style>
 

    /* Full box clickable */
    .service-details-link {
        display: block;
        text-decoration: none;
        color: inherit;
        height: 100%;
    }

    .service-details-link:hover {
        text-decoration: none;
        color: inherit;
    }

</style>