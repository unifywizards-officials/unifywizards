@props(['recognitionPress'])
@php
    $pressItems = [];
    if (!empty($recognitionPress?->press_items)) {
        $pressItems = is_string($recognitionPress->press_items)
            ? json_decode($recognitionPress->press_items, true)
            : $recognitionPress->press_items;
    }
@endphp
<section class="tj-featured-on section-gap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sec-heading-wrap style-3"
                    style="display:flex; flex-direction:column; align-items:center; text-align:center;">

                    <div class="heading-wrap-content"
                        style="display:flex; flex-direction:column; align-items:center; text-align:center; width:100%;">
                        <div class="sec-heading style-3" style="text-align:center;">
                            <h3 class="sec-title">
                                {{ $recognitionPress->title ?? '' }}
                            </h3>
                        </div>
                        <p class="featured-on-desc wow fadeInUp" data-wow-delay=".5s"
                            style="text-align:center; max-width:640px; margin:10px auto 0;">
                            {{ $recognitionPress->description ?? '' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="featured-on-grid">
                    @foreach ($pressItems as $index => $item)
                        @php
                            // Support either key name, in case the controller saves it as 'logo' or 'image'.
                            $logoPath = $item['logo'] ?? ($item['image'] ?? null);
                        @endphp
                        <div class="featured-on-card wow fadeInUp" data-wow-delay="{{ 0.2 + $index * 0.05 }}s">
                            <div class="press-logo">
                                @if (!empty($logoPath))
                                    <img src="{{ asset($logoPath) }}"
                                        alt="{{ $item['label'] ?? ($item['name'] ?? 'Press logo') }}"
                                        class="press-logo-img">
                                @else
                                    <div class="press-logo-placeholder">
                                        {{ strtoupper(substr($item['label'] ?? ($item['name'] ?? 'P'), 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                         
                           
                            
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>