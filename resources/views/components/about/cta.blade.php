@if ($cta)

    <section class="au-cta-section">

        <div class="au-cta-ring"></div>
        <div class="au-cta-ring2"></div>

        <div class="au-cta-inner sr scale">

            {{-- SMALL LABEL --}}
            <div class="au-label-g">

                @php
                    $labelParts = explode(' ', $cta->small_label ?? '');
                @endphp

                @foreach ($labelParts as $char)
                    <span class="gc gc-b">{{ $char }}</span>
                @endforeach

            </div>

            {{-- MAIN HEADING --}}
            <h2 class="au-h2 au-h2-white">
                {!! nl2br(e($cta->main_heading)) !!}
            </h2>

            {{-- DESCRIPTION --}}
            <p class="au-p">
                {{ $cta->description }}
            </p>

            {{-- BUTTONS --}}
            <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap">

                @if (!empty($cta->button_1_text))
                    <a href="{{ $cta->button_1_url }}" class="au-btn au-btn-green">
                        {{ $cta->button_1_text }}
                    </a>
                @endif

                @if (!empty($cta->button_2_text))
                    <a href="{{ $cta->button_2_url }}" class="au-btn au-btn-ghost">
                        {{ $cta->button_2_text }}
                    </a>
                @endif

            </div>

            {{-- DOTS --}}
            <div style="display:flex;gap:8px;justify-content:center;margin-top:40px;opacity:.5">

                <span
                    style="width:8px;height:8px;border-radius:50%;background:var(--g-blue-ab);display:inline-block;animation:au-dot-pulse 2s .0s infinite"></span>

                <span
                    style="width:8px;height:8px;border-radius:50%;background:var(--g-red-ab);display:inline-block;animation:au-dot-pulse 2s .25s infinite"></span>

                <span
                    style="width:8px;height:8px;border-radius:50%;background:var(--g-yellow-ab);display:inline-block;animation:au-dot-pulse 2s .5s infinite"></span>

                <span
                    style="width:8px;height:8px;border-radius:50%;background:var(--g-green-ab);display:inline-block;animation:au-dot-pulse 2s .75s infinite"></span>

            </div>

        </div>

    </section>

@endif
