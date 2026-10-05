@props(['page'])

@php
    $company = is_array($page->s6_our_company)
        ? $page->s6_our_company
        : json_decode($page->s6_our_company, true);
@endphp

@if (!empty($company) && ($company['status'] ?? 'active') === 'active')

<section class="tj-about-section h6-about section-gap section-gap-x">
    <div class="container">

        <div class="row align-items-center">

            <!-- Image FIRST -->
            <div class="col-xl-6 col-lg-6">

                <div class="about-img-area h6-about-img wow fadeInLeft" data-wow-delay=".2s">

                    <div class="about-img overflow-hidden wow fadeInRight" data-wow-delay=".8s">

                        @if (!empty($company['image_path']))
                            <img
                                data-speed=".8"
                                src="{{ asset('storage/' . $company['image_path']) }}"
                                alt="{{ $company['title'] ?? 'Our Company' }}">
                        @endif

                    </div>

                </div>

            </div>

            <!-- Content SECOND -->
            <div class="col-xl-6 col-lg-6">

                <div class="about-content-area h6-about-content style-1 wow fadeInLeft"
                    data-wow-delay=".2s">

                    <div class="sec-heading style-2 style-6">

                        @if (!empty($company['sub_title']))
                            <span class="sub-title wow text-white fadeInUp" data-wow-delay=".3s">
                                <i class="tji-box text-white"></i>
                                {{ $company['sub_title'] }}
                            </span>
                        @endif

                        @if (!empty($company['title']))
                            <h2 class="sec-title">
                                {{ $company['title'] }}
                            </h2>
                        @endif

                        @if (!empty($company['description_1']))
                            <div class="desc s6-desc-content">
                                {!! $company['description_1'] !!}
                            </div>
                        @endif

                    </div>

                    <div class="h6-about-funfact-wrapper">
                        <div class="h6-about-funfact-shape">
                            <img src="{{ asset('home_assets/images/shape/about-counter-shape-blur.svg') }}"
                                alt="">
                        </div>
                    </div>

                    <!--@if (!empty($company['button_text']))-->
                    <!--    <div class="btn-area wow fadeInUp" data-wow-delay=".8s">-->

                    <!--        <a class="tj-primary-btn"-->
                    <!--            href="{{ $company['button_url'] ?? '#' }}">-->

                    <!--            <span class="btn-text">-->
                    <!--                <span>{{ $company['button_text'] }}</span>-->
                    <!--            </span>-->

                    <!--            <span class="btn-icon">-->
                    <!--                <i class="tji-arrow-right-long"></i>-->
                    <!--            </span>-->

                    <!--        </a>-->

                    <!--    </div>-->
                    <!--@endif-->

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

</section>

{{-- Ensure Summernote's generated <p> tags always have spacing, even if theme CSS resets margins --}}
<style>
    .s6-desc-content p {
        margin-bottom: 15px;
    }

    .s6-desc-content p:last-child {
        margin-bottom: 0;
    }
</style>

@endif
