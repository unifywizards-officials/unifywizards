@php
    $testimonialData = $gettestimonial ?? null;

    $testimonials = [];

    if ($testimonialData && !empty($testimonialData->testimonials_json)) {
        $testimonials = is_array($testimonialData->testimonials_json)
            ? $testimonialData->testimonials_json
            : json_decode($testimonialData->testimonials_json, true);
    }
@endphp

<section class="tj-testimonial-section section-gap section-gap-x">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12">
                <div class="sec-heading-wrap"
                    style="display:flex; flex-direction:column; align-items:center; text-align:center;">
                    <span class="sub-title">
                        <i class="tji-box"></i>
                        {{ $testimonialData->sub_title ?? '' }}
                    </span>

                    <div class="heading-wrap-content"
                        style="display:flex; align-items:center; justify-content:center; position:relative; width:100%;">

                        <div class="sec-heading" style="text-align:center; width:100%;">
                            <h3 class="sec-title">
                                @php
                                    $title = $testimonialData->title ?? '';
                                    $highlight = $testimonialData->highlight_text ?? '';
                                @endphp

                                @if ($highlight && str_contains($title, $highlight))
                                    {!! str_replace($highlight, '<span>' . $highlight . '</span>', $title) !!}
                                @else
                                    {{ $title }}
                                @endif
                            </h3>
                        </div>

                        <div class="slider-navigation d-inline-flex wow fadeInUp" data-wow-delay=".4s"
                            style="position:absolute; right:0; top:50%; transform:translateY(-50%);">
                            <div class="slider-prev">
                                <span class="anim-icon">
                                    <i class="tji-arrow-left"></i>
                                    <i class="tji-arrow-left"></i>
                                </span>
                            </div>

                            <div class="slider-next">
                                <span class="anim-icon">
                                    <i class="tji-arrow-right"></i>
                                    <i class="tji-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="testimonial-wrapper wow fadeInUp" data-wow-delay=".5s">
                    <div class="swiper swiper-container testimonial-slider">
                        <div class="swiper-wrapper">

                            @foreach ($testimonials as $item)
                                <div class="swiper-slide">
                                    <div class="testimonial-item">

                                        <span class="quote-icon google-red-text">
                                            <i class="tji-quote"></i>
                                        </span>

                                        <div class="desc">
                                          <p>
                                        {{ \Illuminate\Support\Str::words($item['description'] ?? '', 20, '...') }}
                                    </p>
                                       </div>

                                        <div class="testimonial-author">
                                            <div class="author-inner">

                                                {{-- Dynamic Image --}}
                                                <div class="author-img">
                                                    <img src="{{ asset($item['image'] ?? '') }}"
                                                        alt="{{ $item['name'] ?? '' }}">
                                                </div>

                                                <div class="author-header">
                                                    <span class="span-testimonials">
                                                        {{ $item['name'] ?? '' }}
                                                    </span>

                                                    <span class="designation">
                                                        {{ $item['designation'] ?? '' }}
                                                    </span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="swiper-pagination-area"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-shape-1">
        <img src="{{ asset('assets/images/shape/pattern-2.svg') }}" alt="">
    </div>

    <div class="bg-shape-2">
        <img src="{{ asset('assets/images/shape/pattern-3.svg') }}" alt="">
    </div>
</section>
<style>
    .testimonial-content p {
    min-height: 120px;
}
</style>
