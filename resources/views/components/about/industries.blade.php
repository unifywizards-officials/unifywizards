@if ($industries->count())

    @php
        // optional static fallback heading (you can also make this CMS later)
        $defaultHeading = 'We Work Across Various Niches';
        $defaultSub = 'Unify Wizards deliver digital marketing and web development services across multiple niches:';
    @endphp

    <section class="au-sectors-section">

        <div class="au-sectors-head sr up">

            <div class="au-label-g" style="justify-content:center">

                <span class="gc gc-b">I</span>
                <span class="gc gc-r">N</span>
                <span class="gc gc-y">D</span>
                <span class="gc gc-g">U</span>

                <span style="color:rgba(255,255,255,.5);font-weight:600;font-size:11px;letter-spacing:2px">
                    STRIES WE SERVE
                </span>

            </div>

            <h2 class="au-h2 au-h2-white">
                {{ $defaultHeading }}
            </h2>

            <p class="au-p" style="color:rgba(255,255,255,.5)">
                {{ $defaultSub }}
            </p>

        </div>

        <div class="au-sectors-grid">

            @foreach ($industries as $index => $item)
                <div class="au-sector-card sr up sr-d{{ ($index % 4) + 1 }}">

                    <span class="au-sector-dot"></span>

                    <div class="au-sector-icon">

                        {{-- ICON HANDLING --}}
                       @if (!empty($item->icon))
{!! $item->icon !!}

@else
    📦
@endif

                    </div>

                    <span style="color: #fff;font-weight: 600;">
                        {{ $item->title }}
                    </span>

                    <p>
                        {{ $item->description }}
                    </p>

                </div>
            @endforeach

        </div>

    </section>

@endif
