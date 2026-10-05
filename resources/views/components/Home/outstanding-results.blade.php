@php
    $results = $getoutstandingresult->results ?? [];

    if (!is_array($results)) {
        $results = json_decode($results, true) ?? [];
    }

    /*
    |--------------------------------------------------------------------------
    | Normalize into a list of category entries. Supports:
    | - current shape: a list of ['key' => ..., 'label' => ..., ...]
    | - old fixed-key shape: ['insurance' => [...] | 'path' | null, ...]
    |--------------------------------------------------------------------------
    */

    $isList = array_is_list($results) && isset($results[0]['key']);

    if (!$isList) {

        $legacyLabels = [
            'insurance' => 'Insurance',
            'automobile' => 'Automobile',
            'hotel_tourism' => 'Hotel & Tourism',
            'advertising_agency' => 'Advertising Agency',
        ];

        $normalized = [];

        foreach ($results as $key => $value) {

            if (is_array($value)) {
                $normalized[] = array_merge(['key' => $key, 'label' => $legacyLabels[$key] ?? $key], $value);
            } else {
                $normalized[] = [
                    'key' => $key,
                    'label' => $legacyLabels[$key] ?? $key,
                    'analytics_image' => $value ?: null,
                ];
            }
        }

        $results = $normalized;
    }
@endphp

@if ($getoutstandingresult && $getoutstandingresult->status && !empty($results))

    <section class="tj-outstanding-section section-gap">
        <div class="container">

            <div class="sec-heading-wrap">
                <div class="sec-heading sec-heading-centered  sec-heading-centered-style-2">

                    <span class="sub-title">
                        <i class="tji-growth"></i>
                        Proven Results
                    </span>

                    <h3 class="sec-title">
                        {{ $getoutstandingresult->heading }}
                    </h3>

                    @if ($getoutstandingresult->description)
                        <p class="desc">
                            {{ $getoutstandingresult->description }}
                        </p>
                    @endif

                </div>
            </div>

            <div class="or-tabs" role="tablist">

                @foreach ($results as $entry)
                    <button type="button" class="or-tab-btn {{ $loop->first ? 'active' : '' }}"
                        data-tab="{{ $entry['key'] }}" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ $entry['label'] ?? $entry['key'] }}
                    </button>
                @endforeach

            </div>

            <div class="or-panels">

                @foreach ($results as $entry)

                    @php
                        $label = $entry['label'] ?? $entry['key'];
                        $keywords = $entry['keywords'] ?? [];

                        $hasStructuredData = !empty($entry['website']) ||
                            !empty($entry['challenge']) ||
                            !empty($entry['results_percentage']) ||
                            !empty($entry['results_summary']) ||
                            !empty($keywords) ||
                            !empty($entry['case_study_link']) ||
                            !empty($entry['analytics_image']);
                    @endphp

                    <div class="or-panel {{ $loop->first ? 'active' : '' }}" data-panel="{{ $entry['key'] }}">

                        @if ($hasStructuredData)

                            <div class="or-panel-inner">

                                {{-- LEFT: challenge / results / keyword table --}}
                                <div class="or-panel-left">

                                    @if (!empty($entry['website']))
                                        <span class="or-website-tag">
                                            {{ $entry['website'] }}
                                        </span>
                                    @endif

                                    @if (!empty($entry['challenge']))
                                        <h4 class="or-eyebrow">Challenge</h4>
                                        <p class="or-block-text">
                                            {{ $entry['challenge'] }}
                                        </p>
                                    @endif

                                    @if (!empty($entry['results_percentage']) || !empty($entry['results_summary']))
                                        <h4 class="or-eyebrow">Results</h4>

                                        @if (!empty($entry['results_percentage']))
                                            <div class="or-result-percentage">
                                                {{ $entry['results_percentage'] }}
                                            </div>
                                        @endif

                                        @if (!empty($entry['results_summary']))
                                            <p class="or-block-text">
                                                {{ $entry['results_summary'] }}
                                            </p>
                                        @endif
                                    @endif

                                    @if (!empty($keywords))
                                        <div class="or-keyword-table-wrap">
                                            <table class="or-keyword-table">
                                                <thead>
                                                    <tr>
                                                        <th>Keyword</th>
                                                        <th>Ranking</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($keywords as $row)
                                                        <tr>
                                                            <td>{{ $row['keyword'] ?? '' }}</td>
                                                            <td>{{ $row['ranking'] ?? '' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                </div>

                                {{-- RIGHT: analytics screenshot --}}
                                <div class="or-panel-right">

                                    <h4 class="or-eyebrow">
                                        {{ $entry['analytics_heading'] ?? 'Traffic & Rankings' }}
                                    </h4>

                                    <div class="or-analytics-card">

                                        @if (!empty($entry['analytics_image']))
                                            <img src="{{ asset('storage/' . $entry['analytics_image']) }}"
                                                alt="{{ $label }} analytics" class="or-analytics-img">
                                        @else
                                            <div class="or-analytics-empty">
                                                Analytics screenshot coming soon
                                            </div>
                                        @endif

                                    </div>

                                    @if (!empty($entry['case_study_link']))
                                        <a href="{{ $entry['case_study_link'] }}" class="or-case-study-link">
                                            View Case Study
                                            <i class="tji-arrow-right-long"></i>
                                        </a>
                                    @endif

                                </div>

                            </div>

                        @else

                            <div class="or-panel-empty">
                                <span>{{ $label }} case study coming soon</span>
                            </div>

                        @endif

                    </div>
                @endforeach

            </div>

        </div>
    </section>

@endif
