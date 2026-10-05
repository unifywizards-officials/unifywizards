@props(['processData'])

@php
    $processItems = [];

    if (!empty($processData?->process_items)) {
        $processItems = is_string($processData->process_items)
            ? json_decode($processData->process_items, true)
            : $processData->process_items;
    }
@endphp

<section class="h10-process section-gap section-gap-x tj-sticky-panel-3-container">
    <div class="container">

        <div class="row">

            {{-- Left Content --}}
            <div class="col-12 col-lg-5">
                <div class="sec-heading style-3 tj-sticky-panel-3">

                    <span class="sub-title google-text">
                        <i class="tji-box google-text"></i>
                        {{ $processData->sub_title ?? '' }}
                    </span>

                    <h3 class="sec-title" style="font-size:40px;">
                        {{ $processData->title ?? '' }}
                    </h3>

                    @if (!empty($processData->description_1))
                        <p class="desc text-white">
                            {{ $processData->description_1 }}
                        </p>
                    @endif

                    @if (!empty($processData->description_2))
                        <p class="desc text-white">
                            {{ $processData->description_2 }}
                        </p>
                    @endif

                    <div class="h10-process-more">
                        <a class="tj-primary-btn" href="{{ $processData->button_link ?? '#' }}">

                            <span class="btn-text">
                                <span>
                                    {{ $processData->button_text ?? 'Explore More' }}
                                </span>
                            </span>

                            <span class="btn-icon">
                                <i class="tji-arrow-right-long"></i>
                            </span>

                        </a>
                    </div>

                </div>
            </div>

            {{-- Right Process Items --}}
            <div class="col-12 col-lg-7">
                <div class="h10-process-wrapper">

                    @foreach ($processItems as $index => $item)
                        <div class="h10-process-item tj-sticky-panel-3"
                            style="margin-bottom:20px; padding:24px 28px;">

                            <span class="h10-process-sln">
                                Step {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>

                            <div class="h10-process-content" style="display:flex; flex-direction:column; margin-top:10px;">

                                {{-- Icon + Title in one row --}}
                                <div style="display:flex; align-items:center; gap:14px;margin-top: 22px;">

                                    <div class="h10-process-icon google-red-background"
                                        style="margin:0 !important; flex-shrink:0;">
                                        {!! $item['icon'] ?? '' !!}
                                    </div>

                                    <span class="title" style="font-size:22px; margin:0;">
                                        {{ $item['title'] ?? '' }}
                                    </span>

                                </div>

                                {{-- Description below --}}
                                @if (!empty($item['description_1']))
                                    <p class="desc" style="margin-top:10px;">
                                        {{ $item['description_1'] }}
                                    </p>
                                @endif

                                @if (!empty($item['description_2']))
                                    <p class="desc" style="margin-top:4px;">
                                        {{ $item['description_2'] }}
                                    </p>
                                @endif

                            </div>

                        </div>
                    @endforeach

                </div>
            </div>

        </div>

    </div>

    {{-- Shapes Same As Original Design --}}
    <div class="bg-shape-1">
        <img src="{{ asset('assets/images/shape/pattern-2.svg') }}" alt="" />
    </div>

    <div class="bg-shape-2">
        <img src="{{ asset('assets/images/shape/pattern-3.svg') }}" alt="" />
    </div>

    <div class="bg-shape-3">
        <img src="{{ asset('assets/images/shape/h7-testimonial-shape-blur.svg') }}" alt="" />
    </div>

</section>
