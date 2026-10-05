@php
    $review = $review ?? null;

    // safe JSON decode (fix error: array given)
    $platforms = is_string($review->review_items ?? null)
        ? json_decode($review->review_items, true)
        : $review->review_items ?? [];

    $testimonials = is_string($review->testimonial_items ?? null)
        ? json_decode($review->testimonial_items, true)
        : $review->testimonial_items ?? [];
@endphp

@if ($review)

    <section class="au-trust-section">
        <div class="au-trust-inner">

            {{-- LEFT SIDE --}}
            <div class="sr left">

                <div class="au-label">
                    {{ $review->badge }}
                </div>

                <h2 class="au-h2">
                    {!! nl2br(e($review->heading)) !!}
                </h2>

                <p class="au-p">
                    {{ $review->description_1 }}
                </p>

                <p class="au-p" style="margin-top:12px">
                    {{ $review->description_2 }}
                </p>

                {{-- TESTIMONIALS --}}
                <div class="au-rev-cards">

                    @foreach ($testimonials as $t)
                        <div class="au-rev-card">
                            <div class="au-rev-stars">★★★★★</div>
                            <p>"{{ $t['review'] ?? '' }}"</p>
                            <div class="au-rev-author">
                                — {{ $t['name'] ?? '' }}, {{ $t['designation'] ?? '' }}
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="au-trust-right sr right">

                <div class="au-label-g" style="margin-bottom:20px">
                    <span class="gc gc-b">G</span>
                    <span class="gc gc-r">o</span>
                    <span class="gc gc-y">o</span>
                    <span class="gc gc-g">g</span>
                    <span style="color:var(--g-blue-ab);font-weight:800">l</span>
                    <span style="color:var(--g-red-ab);font-weight:800">e</span>

                    <span style="color:var(--muted-ab);font-weight:600;font-size:11px;letter-spacing:2px">
                        · CLUTCH · VERIFIED
                    </span>
                </div>

                {{-- PLATFORM CARDS --}}
                <div class="au-platform-cards">

                    @foreach ($platforms as $p)
                        <div class="au-plat-card">

                            <div class="au-plat-icon">

                                @if (!empty($p['icon']))
                                    <img src="{{ asset('uploads/reviews/' . $p['icon']) }}" width="26">
                                @else
                                    <span style="font-size:22px">⭐</span>
                                @endif

                            </div>

                            <div class="au-plat-info">
                                <div class="au-plat-name">
                                    {{ $p['title'] ?? '' }}
                                </div>

                                <div class="au-plat-stars">★★★★★</div>

                                <div class="au-plat-count">
                                    {{ $p['small_text'] ?? '' }}
                                </div>
                            </div>

                            <div class="au-plat-num">
                                {{ $p['rating'] ?? '' }}
                            </div>

                        </div>
                    @endforeach

                </div>

                {{-- STATS --}}
                <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-top:20px">

                    <div
                        style="background:rgba(66,133,244,.06);border:1px solid rgba(66,133,244,.18);border-radius:10px;padding:16px 18px;text-align:center">
                        <div style="font-family:var(--tj-ff-heading);font-size:26px;color:var(--g-blue-ab)">
                            {{ $review->retention_rate }}
                        </div>
                        <div
                            style="font-size:11px;font-weight:700;color:var(--muted-ab);letter-spacing:.5px;margin-top:4px">
                            RETENTION RATE
                        </div>
                    </div>

                    <div
                        style="background:rgba(52,168,83,.06);border:1px solid rgba(52,168,83,.18);border-radius:10px;padding:16px 18px;text-align:center">
                        <div style="font-family:var(--tj-ff-heading);font-size:26px;color:var(--g-green-ab)">
                            {{ $review->satisfaction_rate }}
                        </div>
                        <div
                            style="font-size:11px;font-weight:700;color:var(--muted-ab);letter-spacing:.5px;margin-top:4px">
                            SATISFACTION
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endif
