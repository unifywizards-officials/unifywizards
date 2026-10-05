@props(['position' => null])

@php
    use App\Models\ExtraFold;

    // Current page ka URL lo
    $currentUrl = '/' . trim(request()->path(), '/');

    // Query build karo
    $query = ExtraFold::where('page_url', $currentUrl)->where('status', 1)->orderBy('sort_order', 'asc');

    // Agar position diya hai to sirf us sort_order wala fold lo
    if ($position !== null) {
        $query->where('sort_order', $position);
    }

    $extraFolds = $query->get();
@endphp

@foreach ($extraFolds as $fold)
    <section class="tj-about-section h6-about section-gap section-gap-x">
        <div class="container">

            <div class="row align-items-center">

                {{-- Image Side FIRST --}}
                <div class="col-xl-6 col-lg-6">

                    <div class="about-img-area h6-about-img wow fadeInLeft" data-wow-delay=".2s">

                        <div class="about-img overflow-hidden wow fadeInRight" data-wow-delay=".8s">

                            @if (!empty($fold->image))
                                <img data-speed=".8" src="{{ asset('storage/' . $fold->image) }}"
                                    alt="{{ $fold->heading ?? ($fold->title ?? 'Extra Fold') }}">
                            @endif

                        </div>

                    </div>

                </div>

                {{-- Content Side SECOND --}}
                <div class="col-xl-6 col-lg-6">

                    <div class="about-content-area h6-about-content style-1 wow fadeInLeft" data-wow-delay=".2s">

                        <div class="sec-heading style-2 style-6">

                            @if (!empty($fold->title))
                                <span class="sub-title wow fadeInUp" data-wow-delay=".3s">
                                    <i class="tji-box "></i>
                                    {{ $fold->title }}
                                </span>
                            @endif

                            @if (!empty($fold->heading))
                                <h2 class="sec-title">
                                    {{ $fold->heading }}
                                </h2><br>
                            @endif

                            @if (!empty($fold->description))
                                <div class="desc mb-1">
                                    {!! $fold->description !!}
                                </div>
                            @endif
                            
                            {{-- Button --}}
                           @if (!empty($fold->button_name) && !empty($fold->button_url))
                            <div class="btn-area wow fadeInUp" data-wow-delay=".8s" style="margin-top:40px;">
                        
                                <a class="tj-primary-btn" href="{{ $fold->button_url }}">
                        
                                    <span class="btn-text">
                                        <span>{{ $fold->button_name }}</span>
                                    </span>
                        
                                    <span class="btn-icon">
                                        <i class="tji-arrow-right-long"></i>
                                    </span>
                        
                                </a>
                        
                            </div>
                        @endif

                        </div>

                        <div class="h6-about-funfact-wrapper">
                            <div class="h6-about-funfact-shape">
                                <img src="{{ asset('home_assets/images/shape/about-counter-shape-blur.svg') }}"
                                    alt="">
                            </div>
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

    </section>
@endforeach
