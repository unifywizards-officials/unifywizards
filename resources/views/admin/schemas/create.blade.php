@extends('layouts.app')

@section('title', 'Create Schema')

@push('css')
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .schema-page {
            min-height: 100vh;
            background: #f1f4f8;
            padding: 32px 20px 60px;
        }

        /* ===== HEADER ===== */
        .schema-page-header {
            max-width: 900px;
            margin: 0 auto 28px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .schema-page-header h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1a202c;
            letter-spacing: -0.4px;
            margin: 0 0 4px;
        }

        .schema-page-header p {
            font-size: 13px;
            color: #718096;
            margin: 0;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #5a67d8;
            text-decoration: none;
            padding: 7px 14px;
            border: 1px solid #c3c9f5;
            border-radius: 8px;
            background: #fff;
            transition: all .2s;
            font-weight: 500;
            white-space: nowrap;
        }

        .back-btn:hover {
            background: #eef0fd;
            color: #4c51bf;
        }

        /* ===== MAIN CARD ===== */
        .schema-card {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
            overflow: hidden;
        }

        .schema-card-body {
            padding: 32px 32px 24px;
        }

        @media(max-width:600px) {
            .schema-card-body {
                padding: 20px 16px 16px;
            }
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11.5px;
            font-weight: 700;
            color: #4a5568;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 14px;
        }

        .section-heading svg {
            opacity: .45;
            flex-shrink: 0;
        }

        /* ===== URL INPUTS ===== */
        .url-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .url-input {
            flex: 1;
            padding: 9px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 13.5px;
            color: #2d3748;
            background: #f8fafc;
            transition: all .2s;
            outline: none;
            font-family: inherit;
        }

        .url-input:focus {
            border-color: #5a67d8;
            box-shadow: 0 0 0 3px rgba(90, 103, 216, .12);
            background: #fff;
        }

        .url-input:hover {
            border-color: #a0aec0;
        }

        .url-remove-btn {
            width: 30px;
            height: 30px;
            border: 1px solid #e2e8f0;
            border-radius: 7px;
            background: #fff;
            color: #e53e3e;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all .2s;
            font-size: 16px;
            line-height: 1;
        }

        .url-remove-btn:hover {
            background: #fff5f5;
            border-color: #feb2b2;
        }

        .add-url-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12.5px;
            color: #5a67d8;
            background: none;
            border: none;
            cursor: pointer;
            padding: 2px 0;
            font-weight: 600;
            font-family: inherit;
            transition: color .2s;
            margin-top: 4px;
        }

        .add-url-btn:hover {
            color: #4c51bf;
        }

        /* ===== DIVIDER ===== */
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e2e8f0 15%, #e2e8f0 85%, transparent);
            margin: 28px 0;
        }

        /* ===== SCHEMA ITEMS ===== */
        .schema-types-grid {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .schema-item {
            border: 1.5px solid #e8ecf2;
            border-radius: 10px;
            overflow: hidden;
            transition: border-color .2s, box-shadow .2s;
        }

        .schema-item.is-active {
            border-color: #5a67d8;
            box-shadow: 0 0 0 3px rgba(90, 103, 216, .08);
        }

        .schema-header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 18px;
            cursor: pointer;
            user-select: none;
            background: #fff;
            transition: background .15s;
        }

        .schema-header:hover {
            background: #f7f8ff;
        }

        .schema-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .schema-meta {
            flex: 1;
            min-width: 0;
        }

        .schema-meta-title {
            font-size: 13.5px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 2px;
        }

        .schema-meta-desc {
            font-size: 11.5px;
            color: #a0aec0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ===== TOGGLE SWITCH ===== */
        .toggle-wrap {
            position: relative;
            width: 42px;
            height: 24px;
            flex-shrink: 0;
        }

        .toggle-wrap input {
            opacity: 0;
            width: 0;
            height: 0;
            position: absolute;
        }

        .toggle-track {
            position: absolute;
            inset: 0;
            background: #cbd5e0;
            border-radius: 24px;
            cursor: pointer;
            transition: background .25s;
        }

        .toggle-track::before {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            left: 3px;
            top: 3px;
            background: #fff;
            border-radius: 50%;
            transition: transform .25s;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .25);
        }

        .toggle-wrap input:checked+.toggle-track {
            background: #5a67d8;
        }

        .toggle-wrap input:checked+.toggle-track::before {
            transform: translateX(18px);
        }

        .toggle-wrap input:focus+.toggle-track {
            box-shadow: 0 0 0 3px rgba(90, 103, 216, .2);
        }

        /* ===== JSON BOX ===== */
        .json-box {
            display: none;
            padding: 0 18px 16px;
            background: #fafbff;
            border-top: 1px solid #eef0fb;
        }

        .json-box.open {
            display: block;
        }

        .json-box-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0 8px;
        }

        .json-box-label {
            font-size: 11px;
            font-weight: 600;
            color: #a0aec0;
            font-family: 'Cascadia Code', 'Fira Code', 'Courier New', monospace;
            letter-spacing: .3px;
            text-transform: uppercase;
        }

        .json-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .json-format-btn {
            font-size: 11px;
            color: #5a67d8;
            background: #eef0fd;
            border: none;
            padding: 3px 9px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background .2s;
            font-family: inherit;
        }

        .json-format-btn:hover {
            background: #e0e3fc;
        }

        .json-template-btn {
            font-size: 11px;
            color: #319795;
            background: #e6fffa;
            border: none;
            padding: 3px 9px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background .2s;
            font-family: inherit;
        }

        .json-template-btn:hover {
            background: #b2f5ea;
        }

        .json-ta {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 12.5px;
            font-family: 'Cascadia Code', 'Fira Code', 'Courier New', monospace;
            color: #2d3748;
            background: #fff;
            resize: vertical;
            min-height: 120px;
            line-height: 1.65;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .json-ta:focus {
            border-color: #5a67d8;
            box-shadow: 0 0 0 3px rgba(90, 103, 216, .1);
        }

        .json-ta.json-error {
            border-color: #fc8181;
            box-shadow: 0 0 0 3px rgba(252, 129, 129, .15);
        }

        .json-status {
            margin-top: 6px;
            font-size: 11.5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .json-status.valid {
            color: #38a169;
        }

        .json-status.invalid {
            color: #e53e3e;
        }

        /* ===== FILTER ROW ===== */
        .schema-filter-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .schema-search {
            flex: 1;
            padding: 8px 14px 8px 36px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 13px;
            background: #f8fafc url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' stroke='%23a0aec0' stroke-width='2' viewBox='0 0 24 24'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='M21 21l-4.35-4.35'/%3E%3C/svg%3E") no-repeat 12px center;
            outline: none;
            transition: border-color .2s;
            font-family: inherit;
            color: #2d3748;
        }

        .schema-search:focus {
            border-color: #5a67d8;
            background-color: #fff;
        }

        .select-all-btn {
            font-size: 12px;
            color: #5a67d8;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 600;
            white-space: nowrap;
            font-family: inherit;
            transition: color .2s;
        }

        .select-all-btn:hover {
            color: #4c51bf;
        }

        /* ===== BADGE ===== */
        .rec-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 5px;
            background: #c6f6d5;
            color: #276749;
            letter-spacing: .3px;
            flex-shrink: 0;
        }

        /* ===== FOOTER ===== */
        .schema-card-footer {
            padding: 18px 32px;
            border-top: 1px solid #f0f4f8;
            background: #fafbfd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        @media(max-width:600px) {
            .schema-card-footer {
                padding: 14px 16px;
            }
        }

        .active-count-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #718096;
        }

        .active-count-badge .count-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 24px;
            height: 24px;
            padding: 0 7px;
            background: #eef0fd;
            color: #5a67d8;
            border-radius: 20px;
            font-size: 12.5px;
            font-weight: 700;
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }

        .btn-cancel {
            padding: 9px 20px;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #4a5568;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all .2s;
            font-family: inherit;
        }

        .btn-cancel:hover {
            background: #f7fafc;
            border-color: #a0aec0;
        }

        .btn-submit {
            padding: 9px 22px;
            background: #5a67d8;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: background .2s, transform .1s;
            font-family: inherit;
        }

        .btn-submit:hover {
            background: #4c51bf;
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        .btn-submit.loading {
            opacity: .75;
            pointer-events: none;
        }

        .field-error {
            font-size: 12px;
            color: #e53e3e;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush

@section('content')

    @php
        $schemaTypes = [
            'blog' => [
                'label' => 'Blog',
                'desc' => 'Article & blog post markup',
                'emoji' => '📝',
                'color' => '#ffe4ef',
                'rec' => true,
            ],
            'author' => [
                'label' => 'Author',
                'desc' => 'Person / author entity',
                'emoji' => '👤',
                'color' => '#e8edff',
                'rec' => false,
            ],
            'faq' => [
                'label' => 'FAQ',
                'desc' => 'Question & answer pairs',
                'emoji' => '❓',
                'color' => '#fff8e1',
                'rec' => true,
            ],
            'event' => [
                'label' => 'Event',
                'desc' => 'Events & occurrences',
                'emoji' => '📅',
                'color' => '#e8f5e9',
                'rec' => false,
            ],
            'review' => [
                'label' => 'Review',
                'desc' => 'Ratings & reviews',
                'emoji' => '⭐',
                'color' => '#fffde7',
                'rec' => false,
            ],
            'breadcrumb' => [
                'label' => 'Breadcrumb',
                'desc' => 'Navigation breadcrumbs',
                'emoji' => '🔗',
                'color' => '#e1f5fe',
                'rec' => true,
            ],
            'howto' => [
                'label' => 'How To',
                'desc' => 'Step-by-step instructions',
                'emoji' => '🔧',
                'color' => '#fff3e0',
                'rec' => false,
            ],
            'local' => [
                'label' => 'Local Business',
                'desc' => 'Location, hours & contact',
                'emoji' => '📍',
                'color' => '#f3e5f5',
                'rec' => false,
            ],
            'organization' => [
                'label' => 'Organization',
                'desc' => 'Business / org entity',
                'emoji' => '🏢',
                'color' => '#e3f2fd',
                'rec' => false,
            ],
            'video' => [
                'label' => 'Video',
                'desc' => 'Video content metadata',
                'emoji' => '🎬',
                'color' => '#fce4ec',
                'rec' => false,
            ],
        ];

        $templates = [
            'blog' =>
                "{\n  \"@context\": \"https://schema.org\",\n  \"@type\": \"BlogPosting\",\n  \"headline\": \"Your Blog Title\",\n  \"author\": { \"@type\": \"Person\", \"name\": \"Author Name\" },\n  \"datePublished\": \"2024-01-01\"\n}",
            'author' =>
                "{\n  \"@context\": \"https://schema.org\",\n  \"@type\": \"Person\",\n  \"name\": \"Author Name\",\n  \"url\": \"https://example.com/author\"\n}",
            'faq' =>
                "{\n  \"@context\": \"https://schema.org\",\n  \"@type\": \"FAQPage\",\n  \"mainEntity\": [{\n    \"@type\": \"Question\",\n    \"name\": \"Your Question?\",\n    \"acceptedAnswer\": { \"@type\": \"Answer\", \"text\": \"Your answer here.\" }\n  }]\n}",
            'event' =>
                "{\n  \"@context\": \"https://schema.org\",\n  \"@type\": \"Event\",\n  \"name\": \"Event Name\",\n  \"startDate\": \"2024-06-01T09:00\",\n  \"location\": { \"@type\": \"Place\", \"name\": \"Venue Name\" }\n}",
            'review' =>
                "{\n  \"@context\": \"https://schema.org\",\n  \"@type\": \"Review\",\n  \"reviewRating\": { \"@type\": \"Rating\", \"ratingValue\": \"5\", \"bestRating\": \"5\" },\n  \"author\": { \"@type\": \"Person\", \"name\": \"Reviewer Name\" }\n}",
            'breadcrumb' =>
                "{\n  \"@context\": \"https://schema.org\",\n  \"@type\": \"BreadcrumbList\",\n  \"itemListElement\": [{\n    \"@type\": \"ListItem\",\n    \"position\": 1,\n    \"name\": \"Home\",\n    \"item\": \"https://example.com\"\n  }]\n}",
            'howto' =>
                "{\n  \"@context\": \"https://schema.org\",\n  \"@type\": \"HowTo\",\n  \"name\": \"How To Do Something\",\n  \"step\": [{\n    \"@type\": \"HowToStep\",\n    \"text\": \"Step 1 description\"\n  }]\n}",
            'local' =>
                "{\n  \"@context\": \"https://schema.org\",\n  \"@type\": \"LocalBusiness\",\n  \"name\": \"Business Name\",\n  \"address\": { \"@type\": \"PostalAddress\", \"streetAddress\": \"123 Main St\" },\n  \"telephone\": \"+1-555-555-5555\"\n}",
            'organization' =>
                "{\n  \"@context\": \"https://schema.org\",\n  \"@type\": \"Organization\",\n  \"name\": \"Your Organization\",\n  \"url\": \"https://example.com\",\n  \"logo\": \"https://example.com/logo.png\"\n}",
            'video' =>
                "{\n  \"@context\": \"https://schema.org\",\n  \"@type\": \"VideoObject\",\n  \"name\": \"Video Title\",\n  \"description\": \"Video description\",\n  \"thumbnailUrl\": \"https://example.com/thumb.jpg\",\n  \"uploadDate\": \"2024-01-01\"\n}",
        ];
    @endphp

    <div class="schema-page">

        {{-- ===== PAGE HEADER ===== --}}
        <div class="schema-page-header">
            <div>
                <h1>Create Schema</h1>
                <p>Add SEO structured data for your pages</p>
            </div>
            <a href="{{ route('admin.schemas.index') }}" class="back-btn">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5">
                    <path d="M19 12H5M12 5l-7 7 7 7" />
                </svg>
                Back to list
            </a>
        </div>

        {{-- ===== CARD ===== --}}
        <div class="schema-card">
            <form method="POST" action="{{ route('admin.schemas.store') }}" id="schema-form">
                @csrf

                <div class="schema-card-body">

                    {{-- PAGE URLS --}}
                    <div class="section-heading">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                        </svg>
                        Page URLs
                    </div>

                    <div id="pages-container">
                        <div class="url-row" data-url-row>
                            <input type="text" name="pages[]" value="{{ old('pages.0') }}"
                                class="url-input @error('pages.0') json-error @enderror"
                                placeholder="https://example.com/your-page" />
                            <button type="button" class="url-remove-btn" onclick="removeUrl(this)"
                                title="Remove">&times;</button>
                        </div>
                    </div>

                    @error('pages')
                        <div class="field-error">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror

                    <button type="button" class="add-url-btn" onclick="addUrl()">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Add another URL
                    </button>

                    <div class="divider"></div>

                    {{-- SCHEMA TYPES --}}
                    <div class="section-heading">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <polyline points="16 18 22 12 16 6" />
                            <polyline points="8 6 2 12 8 18" />
                        </svg>
                        Schema Types
                    </div>

                    <div class="schema-filter-row">
                        <input type="text" class="schema-search" id="schema-search" placeholder="Search schema types..."
                            oninput="filterSchemas(this.value)" />
                        <button type="button" class="select-all-btn" id="toggle-all-btn" onclick="toggleAll()">Select
                            All</button>
                    </div>

                    <div class="schema-types-grid" id="schema-grid">

                        @foreach ($schemaTypes as $type => $info)
                            <div class="schema-item" id="item-{{ $type }}" data-schema-type="{{ $type }}"
                                data-label="{{ strtolower($info['label']) }}">

                                <div class="schema-header" onclick="toggleSchema('{{ $type }}')">
                                    <div class="schema-icon" style="background:{{ $info['color'] }}">{{ $info['emoji'] }}
                                    </div>

                                    <div class="schema-meta">
                                        <div class="schema-meta-title">{{ $info['label'] }}</div>
                                        <div class="schema-meta-desc">{{ $info['desc'] }}</div>
                                    </div>

                                    @if ($info['rec'])
                                        <span class="rec-badge">Recommended</span>
                                    @endif

                                    <label class="toggle-wrap" onclick="event.stopPropagation()"
                                        title="Enable {{ $info['label'] }}">
                                        <input type="checkbox" name="schema_types[]" value="{{ $type }}"
                                            id="chk-{{ $type }}"
                                            {{ old('schema_types') && in_array($type, old('schema_types')) ? 'checked' : '' }}
                                            onchange="onToggle('{{ $type }}', this.checked)" />
                                        <span class="toggle-track"></span>
                                    </label>
                                </div>

                                <div class="json-box {{ old('schema_types') && in_array($type, old('schema_types')) ? 'open' : '' }}"
                                    id="box-{{ $type }}">
                                    <div class="json-box-header">
                                        <span class="json-box-label">JSON-LD · {{ $info['label'] }}</span>
                                        <div class="json-actions">
                                            <button type="button" class="json-template-btn"
                                                onclick="loadTemplate('{{ $type }}')">Load Template</button>
                                            <button type="button" class="json-format-btn"
                                                onclick="formatJson('{{ $type }}')">Format JSON</button>
                                        </div>
                                    </div>
                                    <textarea name="json_data[{{ $type }}]" id="ta-{{ $type }}" rows="7" class="json-ta"
                                        placeholder="Paste {{ $info['label'] }} JSON-LD here, or click Load Template..."
                                        oninput="validateJson('{{ $type }}')">{{ old('json_data.' . $type) }}</textarea>
                                    <div class="json-status" id="status-{{ $type }}"></div>
                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>{{-- end card-body --}}

                {{-- FOOTER --}}
                <div class="schema-card-footer">
                    <div class="active-count-badge">
                        <span class="count-pill" id="active-count">0</span>
                        schema type(s) selected
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('admin.schemas.index') }}" class="btn-cancel">Cancel</a>
                        <button type="submit" class="btn-submit" id="submit-btn">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z" />
                                <polyline points="17 21 17 13 7 13 7 21" />
                                <polyline points="7 3 7 8 15 8" />
                            </svg>
                            Save Schema
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        /* ===== TEMPLATES ===== */
        const TEMPLATES = @json($templates);

        document.addEventListener('DOMContentLoaded', function() {

            /* ===== URL MANAGEMENT ===== */
            window.addUrl = function() {
                const c = document.getElementById('pages-container');
                const row = document.createElement('div');
                row.className = 'url-row';
                row.setAttribute('data-url-row', '');
                row.innerHTML = `
            <input type="text" name="pages[]" class="url-input" placeholder="https://example.com/another-page" />
            <button type="button" class="url-remove-btn" onclick="removeUrl(this)" title="Remove">&times;</button>
        `;
                c.appendChild(row);
                row.querySelector('input').focus();
            };

            window.removeUrl = function(btn) {
                const rows = document.querySelectorAll('[data-url-row]');
                if (rows.length <= 1) {
                    btn.closest('[data-url-row]').querySelector('input').value = '';
                    return;
                }
                btn.closest('[data-url-row]').remove();
            };

            /* ===== TOGGLE ===== */
            window.onToggle = function(type, checked) {
                const item = document.getElementById('item-' + type);
                const box = document.getElementById('box-' + type);
                if (checked) {
                    item.classList.add('is-active');
                    box.classList.add('open');
                } else {
                    item.classList.remove('is-active');
                    box.classList.remove('open');
                    const status = document.getElementById('status-' + type);
                    const ta = document.getElementById('ta-' + type);
                    if (status) status.innerHTML = '';
                    if (ta) ta.classList.remove('json-error');
                }
                updateCount();
            };

            window.toggleSchema = function(type) {
                const chk = document.getElementById('chk-' + type);
                chk.checked = !chk.checked;
                onToggle(type, chk.checked);
            };

            function updateCount() {
                const n = document.querySelectorAll('input[name="schema_types[]"]:checked').length;
                document.getElementById('active-count').textContent = n;
            }
            updateCount();

            /* ===== TEMPLATE LOADER ===== */
            window.loadTemplate = function(type) {
                const ta = document.getElementById('ta-' + type);
                if (ta.value.trim()) {
                    if (!confirm('This will replace your current JSON. Continue?')) return;
                }
                ta.value = TEMPLATES[type] || '';
                validateJson(type);
            };

            /* ===== JSON VALIDATION ===== */
            window.validateJson = function(type) {
                const ta = document.getElementById('ta-' + type);
                const status = document.getElementById('status-' + type);
                const val = ta.value.trim();
                if (!val) {
                    status.innerHTML = '';
                    ta.classList.remove('json-error');
                    return;
                }
                try {
                    JSON.parse(val);
                    ta.classList.remove('json-error');
                    status.className = 'json-status valid';
                    status.innerHTML =
                        `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Valid JSON`;
                } catch (e) {
                    ta.classList.add('json-error');
                    status.className = 'json-status invalid';
                    status.innerHTML =
                        `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> ${e.message}`;
                }
            };

            window.formatJson = function(type) {
                const ta = document.getElementById('ta-' + type);
                try {
                    ta.value = JSON.stringify(JSON.parse(ta.value), null, 2);
                    validateJson(type);
                } catch (e) {
                    validateJson(type);
                }
            };

            /* ===== FILTER ===== */
            window.filterSchemas = function(q) {
                q = q.toLowerCase().trim();
                document.querySelectorAll('[data-schema-type]').forEach(function(item) {
                    item.style.display = (!q || item.getAttribute('data-label').includes(q)) ? '' :
                        'none';
                });
            };

            /* ===== SELECT ALL ===== */
            let allSelected = false;
            window.toggleAll = function() {
                allSelected = !allSelected;
                document.querySelectorAll('input[name="schema_types[]"]').forEach(function(chk) {
                    chk.checked = allSelected;
                    onToggle(chk.value, allSelected);
                });
                document.getElementById('toggle-all-btn').textContent = allSelected ? 'Deselect All' :
                    'Select All';
            };

            /* ===== SUBMIT GUARD ===== */
            document.getElementById('schema-form').addEventListener('submit', function(e) {
                const checked = document.querySelectorAll('input[name="schema_types[]"]:checked');

                if (checked.length === 0) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'No schema selected',
                        text: 'Please select at least one schema type.',
                        confirmButtonColor: '#5a67d8'
                    });
                    return;
                }

                let hasJsonError = false;
                checked.forEach(function(chk) {
                    const ta = document.getElementById('ta-' + chk.value);
                    if (ta && ta.value.trim()) {
                        try {
                            JSON.parse(ta.value);
                        } catch (_) {
                            hasJsonError = true;
                            validateJson(chk.value);
                        }
                    }
                });

                if (hasJsonError) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid JSON',
                        text: 'Please fix JSON errors before saving.',
                        confirmButtonColor: '#5a67d8'
                    });
                    return;
                }

                const btn = document.getElementById('submit-btn');
                btn.classList.add('loading');
                btn.innerHTML =
                    `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin .8s linear infinite"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> Saving...`;
            });

            /* Re-init old() values on validation fail */
            document.querySelectorAll('input[name="schema_types[]"]:checked').forEach(function(chk) {
                const item = document.getElementById('item-' + chk.value);
                const box = document.getElementById('box-' + chk.value);
                if (item) item.classList.add('is-active');
                if (box) box.classList.add('open');
                validateJson(chk.value);
            });
            updateCount();
        });
    </script>
@endpush
