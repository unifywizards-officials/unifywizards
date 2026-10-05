@if ($whyChooses->count())

    @php
        $sectionTitle = $whyChooses->first()->whychoose_title;
        $sectionHeading = $whyChooses->first()->whychoose_heading;
    @endphp

    <section class="au-why-section">

        <div class="au-why-head sr up">

            <div class="au-label-g">
                <span class="gc gc-b">W</span>
                <span class="gc gc-r">H</span>
                <span class="gc gc-y">Y</span>

                <span style="color:var(--muted-ab);font-weight:600;font-size:11px;letter-spacing:2px">
                    · CHOOSE US
                </span>
            </div>

            <h2 class="au-h2">
                {{ $sectionTitle }}
            </h2>

            <p class="au-p">
                {{ $sectionHeading }}
            </p>

        </div>

        <div class="au-why-grid">

            @foreach ($whyChooses as $index => $item)
                <div class="au-why-card sr up sr-d{{ ($index % 6) + 1 }}">

                    <div class="au-why-num">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>

                    <div class="au-why-icon-wrap">

                        @if (!empty($item->icon))
                            <img src="{{ asset('uploads/why-choose/' . $item->icon) }}" alt="{{ $item->title }}"
                                style="width:40px;height:40px;object-fit:contain;">
                        @else
                            💡
                        @endif

                    </div>

                    <span style="color: #0f1b3d;font-weight: 600;">
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
