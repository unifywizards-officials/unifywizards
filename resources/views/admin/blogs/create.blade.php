@extends('layouts.app')

@section('title', 'Add Blog')

@push('css')
    {{--
    SUMMERNOTE FIX:
    summernote-lite.min.css poore page ka CSS reset kar deta hai.
    Isliye hum summernote-bs5 use karein jo Bootstrap ke saath
    compatible hai aur global styles override nahi karta.
    Agar assets folder mein hai to local path use karo,
    warna CDN fallback:
--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" />

    <style>
        /* ═══════════════════════════════════════════════════════
                                                                                       ROOT VARIABLES
                                                                                    ═══════════════════════════════════════════════════════ */
        :root {
            --primary: #4361ee;
            --primary-dark: #3348c8;
            --primary-light: #eef0fd;
            --success: #2ec4b6;
            --danger: #e63946;
            --warning: #f59e0b;
            --txt: #1e293b;
            --muted: #64748b;
            --border: #e2e8f0;
            --card: #ffffff;
            --bg: #f1f5f9;
            --radius: 10px;
            --radius-sm: 6px;
            --sh: 0 1px 4px rgba(0, 0, 0, .07);
            --tr: all .18s ease;
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       TWO COLUMN LAYOUT
                                                                                    ═══════════════════════════════════════════════════════ */
        .blog-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 20px;
            align-items: start;
        }

        @media(max-width:1100px) {
            .blog-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       CARDS
                                                                                    ═══════════════════════════════════════════════════════ */
        .bc {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--sh);
            margin-bottom: 18px;
            overflow: hidden;
        }

        .bc-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 18px;
            border-bottom: 1px solid var(--border);
            background: #fafbfc;
        }

        .bc-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--txt);
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }

        .bc-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .ic-blue {
            background: #eef2ff;
            color: var(--primary);
        }

        .ic-green {
            background: #e6faf5;
            color: #0c7a59;
        }

        .ic-amber {
            background: #fff7ed;
            color: #c05621;
        }

        .ic-purple {
            background: #f5f3ff;
            color: #6d28d9;
        }

        .ic-info {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .bc-body {
            padding: 20px;
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       FORM ELEMENTS
                                                                                    ═══════════════════════════════════════════════════════ */
        .fg {
            margin-bottom: 16px;
        }

        .fg:last-child {
            margin-bottom: 0;
        }

        .fl {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: var(--muted);
            margin-bottom: 5px;
            letter-spacing: .4px;
            text-transform: uppercase;
        }

        .fl .req {
            color: var(--danger);
            margin-left: 2px;
        }

        .fl-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .fc {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 13px;
            color: var(--txt);
            background: #fff;
            transition: var(--tr);
            font-family: inherit;
            box-sizing: border-box;
        }

        .fc:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, .1);
        }

        textarea.fc {
            resize: vertical;
            min-height: 80px;
            line-height: 1.6;
        }

        select.fc {
            appearance: none;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='%2364748b' d='M4 6l4 4 4-4'/%3E%3C/svg%3E") no-repeat right 10px center / 14px;
            padding-right: 32px;
            cursor: pointer;
        }

        .fhint {
            font-size: 11px;
            color: var(--muted);
            margin-top: 4px;
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       SUMMERNOTE — scoped overrides so it doesn't bleed out
                                                                                    ═══════════════════════════════════════════════════════ */
        #content+.note-editor.note-frame,
        .note-editor.note-frame {
            border: 1px solid var(--border) !important;
            border-radius: var(--radius-sm) !important;
            /* CRITICAL: relative + z-index:1 keeps it inside the card */
            position: relative !important;
            z-index: 1 !important;
        }

        .note-toolbar {
            background: #f8fafc !important;
            border-bottom: 1px solid var(--border) !important;
            border-radius: var(--radius-sm) var(--radius-sm) 0 0 !important;
            /* prevent toolbar from escaping to top of page */
            position: relative !important;
            z-index: 1 !important;
        }

        .note-editable {
            min-height: 260px !important;
            padding: 14px 16px !important;
            font-size: 14px !important;
            line-height: 1.7 !important;
            color: var(--txt) !important;
        }

        .note-statusbar {
            border-top: 1px solid var(--border) !important;
            background: #fafbfc !important;
        }

        /* dropdown menus from summernote — needs higher z so they show above siblings */
        .note-dropdown-menu,
        .note-popover,
        .note-color-palette {
            z-index: 1060 !important;
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       BUTTONS
                                                                                    ═══════════════════════════════════════════════════════ */
        .btn-b {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 20px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--tr);
            white-space: nowrap;
            text-decoration: none;
        }

        .btn-b-primary {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 2px 8px rgba(67, 97, 238, .3);
        }

        .btn-b-primary:hover {
            background: var(--primary-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-b-outline {
            background: #fff;
            color: var(--muted);
            border: 1px solid var(--border);
        }

        .btn-b-outline:hover {
            background: var(--bg);
            color: var(--txt);
        }

        .btn-b-sm {
            padding: 6px 14px;
            font-size: 12px;
        }

        .btn-b-block {
            width: 100%;
            justify-content: center;
        }

        /* AI check pill button */
        .btn-ai {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            font-size: 11px;
            font-weight: 600;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: #fff;
            color: var(--muted);
            cursor: pointer;
            transition: var(--tr);
        }

        .btn-ai:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .btn-ai:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       UPLOAD ZONE
                                                                                    ═══════════════════════════════════════════════════════ */
        .upload-zone {
            border: 2px dashed var(--border);
            border-radius: var(--radius);
            padding: 24px 16px;
            text-align: center;
            cursor: pointer;
            transition: var(--tr);
            background: #fafbfc;
        }

        .upload-zone:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .upload-zone .uz-icon {
            font-size: 28px;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        .upload-zone .uz-txt {
            font-size: 13px;
            color: var(--muted);
        }

        .upload-zone .uz-hint {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 3px;
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       AI DETECTION WIDGET
                                                                                    ═══════════════════════════════════════════════════════ */
        .ai-spinner {
            display: none;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: var(--muted);
            margin-top: 6px;
        }

        .ai-spinner.show {
            display: flex;
        }

        .ai-result {
            display: none;
            margin-top: 8px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: #fafbfc;
        }

        .ai-result.show {
            display: block;
        }

        .ai-result-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .ai-result-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--muted);
        }

        .ai-result-pct {
            font-size: 13px;
            font-weight: 700;
        }

        .ai-track {
            height: 6px;
            background: var(--border);
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .ai-fill {
            height: 100%;
            border-radius: 3px;
            transition: width .6s ease;
            width: 0%;
        }

        .ai-verdict {
            font-size: 11px;
            color: var(--muted);
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       SEO ANALYZER
                                                                                    ═══════════════════════════════════════════════════════ */
        .seo-check-item {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            padding: 9px 0;
            border-bottom: 1px solid var(--border);
        }

        .seo-check-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .seo-check-icon {
            font-size: 14px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .seo-check-label {
            font-size: 12px;
            font-weight: 700;
            color: var(--txt);
        }

        .seo-check-msg {
            font-size: 11px;
            color: var(--muted);
            margin-top: 2px;
            line-height: 1.5;
        }

        .score-bar-wrap {
            height: 8px;
            background: var(--border);
            border-radius: 4px;
            overflow: hidden;
        }

        .score-bar {
            height: 100%;
            border-radius: 4px;
            transition: width .5s ease;
        }

        .seo-badge {
            display: none;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            margin-left: 8px;
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       PAGE ANALYSIS
                                                                                    ═══════════════════════════════════════════════════════ */
        .read-tab-bar {
            display: flex;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            overflow: hidden;
        }

        .read-tab {
            padding: 5px 12px;
            font-size: 11px;
            font-weight: 600;
            border: none;
            background: transparent;
            color: var(--muted);
            cursor: pointer;
            transition: var(--tr);
            border-right: 1px solid var(--border);
        }

        .read-tab:last-child {
            border-right: none;
        }

        .read-tab.active {
            background: var(--primary);
            color: #fff;
        }

        .read-tab:hover:not(.active) {
            background: var(--bg);
            color: var(--txt);
        }

        .read-check-item {
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
        }

        .read-check-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .read-check-row {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            user-select: none;
        }

        .read-check-icon {
            font-size: 13px;
            flex-shrink: 0;
        }

        .read-check-label {
            font-size: 12px;
            font-weight: 700;
            color: var(--txt);
            flex: 1;
        }

        .read-check-arrow {
            font-size: 10px;
            color: var(--muted);
            transition: transform .2s;
        }

        .read-check-arrow.open {
            transform: rotate(180deg);
        }

        .read-check-detail {
            display: none;
            padding: 4px 0 8px 22px;
            font-size: 11px;
            color: var(--muted);
            line-height: 1.6;
        }

        .read-check-detail.open {
            display: block;
        }

        .read-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .flesch-bar-wrap {
            height: 6px;
            background: var(--border);
            border-radius: 3px;
            overflow: hidden;
            margin: 6px 0 3px;
        }

        .flesch-bar {
            height: 100%;
            border-radius: 3px;
            transition: width .5s ease;
        }

        .flesch-labels {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: var(--muted);
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       SERP PREVIEW
                                                                                    ═══════════════════════════════════════════════════════ */
        .serp-box {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            background: #fff;
            padding: 14px 16px;
        }

        .serp-top {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 8px;
        }

        .serp-favicon {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid var(--border);
        }

        .serp-site {
            font-size: 13px;
            color: #202124;
            font-weight: 500;
            line-height: 1.2;
        }

        .serp-url {
            font-size: 12px;
            color: #188038;
            word-break: break-all;
            margin-top: 1px;
        }

        .serp-ttl {
            font-size: 18px;
            color: #1a0dab;
            line-height: 1.3;
            font-weight: 400;
            margin-bottom: 3px;
        }

        .serp-desc {
            font-size: 13px;
            color: #4d5156;
            line-height: 1.5;
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       CHAR COUNTER BAR
                                                                                    ═══════════════════════════════════════════════════════ */
        .char-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 4px;
        }

        .char-track {
            flex: 1;
            height: 3px;
            background: var(--border);
            border-radius: 2px;
            overflow: hidden;
            margin-right: 8px;
        }

        .char-fill {
            height: 100%;
            border-radius: 2px;
            transition: width .2s, background .2s;
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       SAVE BAR (sticky bottom)
                                                                                    ═══════════════════════════════════════════════════════ */
        .save-bar {
            position: sticky;
            bottom: 0;
            z-index: 99;
            background: #fff;
            border-top: 1px solid var(--border);
            padding: 11px 20px;
            display: none;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 -3px 12px rgba(0, 0, 0, .06);
            margin: 20px -15px -10px;
        }

        .save-bar.show {
            display: flex;
        }

        .save-bar-info {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            color: var(--muted);
        }

        .save-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--warning);
            flex-shrink: 0;
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       DIVIDER / MISC
                                                                                    ═══════════════════════════════════════════════════════ */
        .divider {
            height: 1px;
            background: var(--border);
            margin: 14px 0;
        }

        .sec-label {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 10px;
        }

        /* ═══════════════════════════════════════════════════════
                                                                                       ALERT OVERRIDES (errors from Laravel)
                                                                                    ═══════════════════════════════════════════════════════ */
        .alert-flat {
            border: none;
            border-radius: var(--radius-sm);
            font-size: 13px;
            padding: 10px 14px;
            margin-bottom: 18px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .alert-flat-danger {
            background: #fff0f0;
            color: var(--danger);
        }

        .alert-flat-success {
            background: #e6faf5;
            color: #0c7a59;
        }

        /* topbar */
        .blog-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 22px;
        }

        .blog-topbar h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--txt);
            margin: 0 0 2px;
        }

        .blog-topbar p {
            font-size: 13px;
            color: var(--muted);
            margin: 0;
        }
        
          .note-modal-content {
            margin-top: 95px;
        }

        .note-modal-backdrop {
            display: none !important;
        }
    </style>
@endpush

@section('content')

    {{-- Flash Messages --}}
    @if ($errors->any())
        <div class="alert-flat alert-flat-danger">
            <i class="fas fa-exclamation-circle mt-1"></i>
            <ul class="mb-0 ps-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert-flat alert-flat-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Top Bar --}}
    <div class="blog-topbar">
        <div>
            <h2>Create Blog Post</h2>
            <p>Fill in the details below and publish your new post</p>
        </div>
        <div style="display:flex;gap:10px;align-items:center;">
            <a href="{{ route('admin.blogs.index') }}" class="btn-b btn-b-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <button type="submit" form="mainBlogForm" class="btn-b btn-b-primary">
                <i class="fas fa-save"></i> Create Blog
            </button>
        </div>
    </div>

    {{-- ═══════════════ MAIN FORM ═══════════════ --}}
    <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data" id="mainBlogForm">
        @csrf

        {{-- Hidden SEO/analysis fields --}}
        <input type="hidden" name="focus_keyword" id="hiddenFocusKeyword" value="{{ old('focus_keyword', '') }}">
        <input type="hidden" name="seo_score" id="hiddenSeoScore" value="{{ old('seo_score', '') }}">
        <input type="hidden" name="seo_checks" id="hiddenSeoChecks" value='{{ old('seo_checks', '[]') }}'>
        <input type="hidden" name="readability_errors" id="hiddenReadabilityErrors"
            value="{{ old('readability_errors', '') }}">
        <input type="hidden" name="readability_checks" id="hiddenReadabilityChecks"
            value='{{ old('readability_checks', '[]') }}'>
        <input type="hidden" name="title_checks" id="hiddenTitleChecks" value='{{ old('title_checks', '[]') }}'>

        <div class="blog-grid">

            {{-- ═══════════ LEFT COLUMN ═══════════ --}}
            <div>

                {{-- ── Card: Blog Content ── --}}
                <div class="bc">
                    <div class="bc-head">
                        <h3 class="bc-title">
                            <span class="bc-icon ic-blue"><i class="fas fa-pen-nib"></i></span>
                            Blog Content
                        </h3>
                    </div>
                    <div class="bc-body">



                        <div class="row mb-3">

                            <div class="col-md-6">

                                <label>
                                    Service Type
                                </label>

                                <select id="header_menu" class="form-control">

                                    <option value="">
                                        Select Service Type
                                    </option>

                                    @foreach (App\Models\DmPage::headerMenus() as $key => $menu)
                                        <option value="{{ $key }}">
                                            {{ $menu }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-6">

                                <label>
                                    Service Page
                                </label>

                                <select name="service_page_id" id="service_page_id" class="form-control">

                                    <option value="">
                                        Select Service Page
                                    </option>

                                </select>

                            </div>

                        </div>

                        {{-- Title --}}
                        <div class="fg">
                            <div class="fl-row">
                                <label class="fl mb-0">Title <span class="req">*</span></label>
                                <button type="button" class="btn-ai" id="btn-ai-blogtitle"
                                    onclick="checkAI('blogTitle','ai-blogtitle',false)">
                                    <i class="fas fa-robot"></i> Check AI
                                </button>
                            </div>
                            <input type="text" class="fc @error('title') is-invalid @enderror" name="title"
                                id="blogTitle" value="{{ old('title') }}" placeholder="Blog title" required>
                            @error('title')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            <div class="ai-spinner" id="ai-blogtitle-spinner"><i
                                    class="fas fa-spinner fa-spin"></i>&nbsp;Checking...</div>
                            <div class="ai-result" id="ai-blogtitle">
                                <div class="ai-result-top">
                                    <span class="ai-result-label"><i class="fas fa-robot"></i> AI Content</span>
                                    <span class="ai-result-pct" id="ai-blogtitle-pct">0%</span>
                                </div>
                                <div class="ai-track">
                                    <div class="ai-fill" id="ai-blogtitle-fill"></div>
                                </div>
                                <div class="ai-verdict" id="ai-blogtitle-verdict"></div>
                            </div>
                        </div>

                        {{-- Excerpt --}}
                        <div class="fg">
                            <label class="fl">Excerpt / Summary</label>
                            <textarea class="fc @error('excerpt') is-invalid @enderror" name="excerpt" rows="3"
                                placeholder="Short summary shown in blog listings...">{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Content Editor --}}
                        <div class="fg">
                            <div class="fl-row">
                                <label class="fl mb-0">Content <span class="req">*</span></label>
                                <button type="button" class="btn-ai" id="btn-ai-content"
                                    onclick="checkAI('content','ai-content',true)">
                                    <i class="fas fa-robot"></i> Check AI
                                </button>
                            </div>
                            {{--
                            CRITICAL: Do NOT put {{ old('content') }} directly in textarea.
                            Summernote renders the textarea value as-is AND also injects it
                            into the editor → double content.
                            We restore old value safely via summernote('code') in onInit.
                        --}}
                            <textarea id="content" class="summernote" name="content"></textarea>
                            @error('content')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            <div class="ai-spinner" id="ai-content-spinner"><i
                                    class="fas fa-spinner fa-spin"></i>&nbsp;Checking...</div>
                            <div class="ai-result" id="ai-content">
                                <div class="ai-result-top">
                                    <span class="ai-result-label"><i class="fas fa-robot"></i> AI Content</span>
                                    <span class="ai-result-pct" id="ai-content-pct">0%</span>
                                </div>
                                <div class="ai-track">
                                    <div class="ai-fill" id="ai-content-fill"></div>
                                </div>
                                <div class="ai-verdict" id="ai-content-verdict"></div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ── Card: Focus Keyword Analyzer ── --}}
                <div class="bc">
                    <div class="bc-head">
                        <h3 class="bc-title">
                            <span class="bc-icon ic-info"><i class="fas fa-chart-line"></i></span>
                            Focus Keyword Analyzer
                            <span class="seo-badge" id="seoScoreBadge"></span>
                        </h3>
                    </div>
                    <div class="bc-body">
                        <div class="fg">
                            <label class="fl">Focus Keyword</label>
                            <div style="display:flex;gap:8px;">
                                <input type="text" id="focusKeyword" class="fc"
                                    placeholder="e.g. laravel tutorial" value="{{ old('focus_keyword', '') }}">
                                <button type="button" class="btn-b btn-b-primary btn-b-sm" onclick="runSeoAnalysis()">
                                    <i class="fas fa-search"></i> Analyze
                                </button>
                            </div>
                        </div>

                        <div id="seoLoading"
                            style="display:none;text-align:center;padding:14px;color:var(--muted);font-size:13px;">
                            <i class="fas fa-spinner fa-spin"></i> Analyzing...
                        </div>

                        <div id="seoResults" style="display:none;">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
                                <span
                                    style="font-size:11px;font-weight:800;letter-spacing:.5px;color:var(--muted);text-transform:uppercase;">Overall
                                    Score</span>
                                <span id="seoScoreText" style="font-size:16px;font-weight:800;"></span>
                            </div>
                            <div class="score-bar-wrap" style="margin-bottom:16px;">
                                <div class="score-bar" id="seoProgressBar" style="width:0%;"></div>
                            </div>
                            <div id="seoChecklist"></div>
                        </div>
                    </div>
                </div>

                {{-- ── Card: Page Analysis ── --}}
                <div class="bc">
                    <div class="bc-head">
                        <h3 class="bc-title">
                            <span class="bc-icon ic-amber"><i class="fas fa-book-open"></i></span>
                            Page Analysis
                        </h3>
                        <div class="read-tab-bar">
                            <button type="button" class="read-tab active" id="tabBasicSeo"
                                onclick="switchReadTab('basic_seo')">Basic SEO</button>
                            <button type="button" class="read-tab" id="tabTitle"
                                onclick="switchReadTab('title')">Title</button>
                            <button type="button" class="read-tab" id="tabReadability"
                                onclick="switchReadTab('readability')">Readability</button>
                        </div>
                    </div>
                    <div class="bc-body">
                        <button type="button" class="btn-b btn-b-primary btn-b-sm btn-b-block"
                            style="margin-bottom:14px;" onclick="runPageAnalysis()">
                            <i class="fas fa-sync-alt"></i> Analyze Page
                        </button>

                        <div id="readLoading"
                            style="display:none;text-align:center;padding:14px;font-size:13px;color:var(--muted);">
                            <i class="fas fa-spinner fa-spin"></i> Analyzing...
                        </div>

                        <div id="readResults" style="display:none;">
                            <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                                <div id="badgeBasicSeo" class="read-status-badge" style="display:none;"></div>
                                <div id="badgeTitle" class="read-status-badge" style="display:none;"></div>
                                <div id="badgeReadability" class="read-status-badge" style="display:none;"></div>
                            </div>
                            <div id="panelBasicSeo">
                                <div id="checklistBasicSeo"></div>
                            </div>
                            <div id="panelTitle" style="display:none;">
                                <div id="checklistTitle"></div>
                            </div>
                            <div id="panelReadability" style="display:none;">
                                <div id="checklistReadability"></div>
                            </div>
                        </div>

                        <div id="readEmpty" style="text-align:center;padding:18px 0;color:var(--muted);font-size:13px;">
                            <i class="fas fa-chart-bar"
                                style="font-size:24px;display:block;margin-bottom:8px;opacity:.25;"></i>
                            Click "Analyze Page" to check page health
                        </div>
                    </div>
                </div>

            </div>{{-- /left --}}

            {{-- ═══════════ RIGHT COLUMN ═══════════ --}}
            <div>

                {{-- ── Card: Publish ── --}}
                <div class="bc">
                    <div class="bc-head">
                        <h3 class="bc-title">
                            <span class="bc-icon ic-green"><i class="fas fa-rocket"></i></span>
                            Publish
                        </h3>
                    </div>
                    <div class="bc-body">
                        <div class="fg">
                            <label class="fl">Status <span class="req">*</span></label>
                              <select class="fc @error('status') is-invalid @enderror" name="status" required>
                                @can('draft')
                                    <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>
                                        📝 Draft
                                    </option>
                                @endcan

                                @can('published')
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                                        🟢 Published
                                    </option>
                                @endcan

                            </select>
                            @error('status')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="fg">
                            <label class="fl">Publish Date &amp; Time</label>
                            <input type="datetime-local" class="fc @error('published_at') is-invalid @enderror"
                                name="published_at" value="{{ old('published_at') }}">
                            @error('published_at')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            <div class="fhint">Leave blank to publish immediately.</div>
                        </div>
                        <div class="divider"></div>
                        <button type="submit" class="btn-b btn-b-primary btn-b-block">
                            <i class="fas fa-save"></i> Create Blog Post
                        </button>
                    </div>
                </div>

                {{-- ── Card: Featured Image ── --}}
                <div class="bc">
                    <div class="bc-head">
                        <h3 class="bc-title">
                            <span class="bc-icon ic-amber"><i class="fas fa-image"></i></span>
                            Featured Image
                        </h3>
                    </div>
                    <div class="bc-body">
                        <div class="upload-zone" id="uploadZone"
                            onclick="document.getElementById('featured_image').click()">
                            <div class="uz-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <div class="uz-txt">Click to upload</div>
                            <div class="uz-hint">JPEG · PNG · GIF — Max 2MB</div>
                        </div>
                        <input type="file" id="featured_image" name="featured_image" accept="image/*"
                            onchange="previewFeaturedImg(this)" style="display:none;">
                        <img id="featuredImgPreview"
                            style="width:100%;margin-top:12px;border-radius:8px;border:1px solid var(--border);display:none;max-height:180px;object-fit:cover;"
                            src="#" alt="Preview">
                        @error('featured_image')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- ── Card: SEO & Meta ── --}}
                <div class="bc">
                    <div class="bc-head">
                        <h3 class="bc-title">
                            <span class="bc-icon ic-purple"><i class="fas fa-tag"></i></span>
                            SEO &amp; Meta
                        </h3>
                    </div>
                    <div class="bc-body">

                        {{-- Meta Title --}}
                        <div class="fg">
                            <div class="fl-row">
                                <label class="fl mb-0">Meta Title</label>
                                <button type="button" class="btn-ai" id="btn-ai-metatitle"
                                    onclick="checkAI('metaTitle','ai-metatitle',false)">
                                    <i class="fas fa-robot"></i> Check AI
                                </button>
                            </div>
                            <input type="text" class="fc @error('meta_title') is-invalid @enderror" id="metaTitle"
                                name="meta_title" value="{{ old('meta_title') }}" placeholder="SEO page title..."
                                oninput="updateCharCount(this,'mtCount','mtFill',60)">
                            @error('meta_title')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            <div class="char-row">
                                <div class="char-track">
                                    <div class="char-fill" id="mtFill" style="width:0%;background:#2ec4b6;"></div>
                                </div>
                                <span style="font-size:11px;color:var(--muted);"><span id="mtCount"
                                        style="font-weight:700;">0</span>/60</span>
                            </div>
                            <div class="ai-spinner" id="ai-metatitle-spinner"><i
                                    class="fas fa-spinner fa-spin"></i>&nbsp;Checking...</div>
                            <div class="ai-result" id="ai-metatitle">
                                <div class="ai-result-top">
                                    <span class="ai-result-label"><i class="fas fa-robot"></i> AI Content</span>
                                    <span class="ai-result-pct" id="ai-metatitle-pct">0%</span>
                                </div>
                                <div class="ai-track">
                                    <div class="ai-fill" id="ai-metatitle-fill"></div>
                                </div>
                                <div class="ai-verdict" id="ai-metatitle-verdict"></div>
                            </div>
                        </div>

                        {{-- Meta Description --}}
                        <div class="fg">
                            <div class="fl-row">
                                <label class="fl mb-0">Meta Description</label>
                                <button type="button" class="btn-ai" id="btn-ai-metadesc"
                                    onclick="checkAI('metaDesc','ai-metadesc',false)">
                                    <i class="fas fa-robot"></i> Check AI
                                </button>
                            </div>
                            <textarea class="fc @error('meta_description') is-invalid @enderror" id="metaDesc" name="meta_description"
                                rows="3" placeholder="Brief description for search engines..."
                                oninput="updateCharCount(this,'mdCount','mdFill',160)">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            <div class="char-row">
                                <div class="char-track">
                                    <div class="char-fill" id="mdFill" style="width:0%;background:#2ec4b6;"></div>
                                </div>
                                <span style="font-size:11px;color:var(--muted);"><span id="mdCount"
                                        style="font-weight:700;">0</span>/160</span>
                            </div>
                            <div class="ai-spinner" id="ai-metadesc-spinner"><i
                                    class="fas fa-spinner fa-spin"></i>&nbsp;Checking...</div>
                            <div class="ai-result" id="ai-metadesc">
                                <div class="ai-result-top">
                                    <span class="ai-result-label"><i class="fas fa-robot"></i> AI Content</span>
                                    <span class="ai-result-pct" id="ai-metadesc-pct">0%</span>
                                </div>
                                <div class="ai-track">
                                    <div class="ai-fill" id="ai-metadesc-fill"></div>
                                </div>
                                <div class="ai-verdict" id="ai-metadesc-verdict"></div>
                            </div>
                        </div>

                        {{-- Google SERP Preview --}}
                        <div class="fg">
                            <div class="sec-label">Google Search Preview</div>
                            <div class="serp-box">
                                <div class="serp-top">
                                    <img src="{{ asset('assets/img/logo/favicon.png') }}" alt="favicon"
                                        class="serp-favicon" onerror="this.style.display='none'">
                                    <div>
                                        <div class="serp-site">{{ config('app.name') }}</div>
                                        <div class="serp-url">{{ url('/') }}/<span
                                                id="serpSlug">your-blog-url</span></div>
                                    </div>
                                </div>
                                <div class="serp-ttl" id="serpTitlePreview">Blog Title Preview</div>
                                <div class="serp-desc" id="serpDescPreview">Your meta description will appear here...
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>{{-- /right --}}
        </div>{{-- /blog-grid --}}

    </form>

    {{-- Sticky Save Bar --}}
    <div class="save-bar" id="saveBar">
        <div class="save-bar-info">
            <div class="save-dot"></div>
            You have unsaved changes
        </div>
        <div style="display:flex;gap:10px;">
            <button type="button" class="btn-b btn-b-outline btn-b-sm" onclick="hideSaveBar()">Discard</button>
            <button type="submit" form="mainBlogForm" class="btn-b btn-b-primary btn-b-sm">
                <i class="fas fa-save"></i> Save
            </button>
        </div>
    </div>

@endsection


@push('scripts')
   
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.summernote').summernote({

                placeholder: 'Write blog content...',

                height: 300,

                tabsize: 2

            });


        });
    </script>

    <script>
        /* ══════════════════════════════════════════════════════════
                                                                                       HELPERS
                                                                                    ══════════════════════════════════════════════════════════ */
        function getEditorContent() {
            try {
                if (typeof $.fn.summernote !== 'undefined' && $('#content').data('summernote')) {
                    return $('#content').summernote('isEmpty') ? '' : $('#content').summernote('code');
                }
            } catch (e) {
                // If there's an error with summernote, fall back to textarea
            }
            var textarea = document.getElementById('content');
            if (textarea) {
                return textarea.value;
            }
            return '';
        }

        function stripHtml(html) {
            var d = document.createElement('div');
            d.innerHTML = html;
            return (d.textContent || d.innerText || '').trim();
        }

        /* ══════════════════════════════════════════════════════════
           CHAR COUNTER + FILL BAR
        ══════════════════════════════════════════════════════════ */
        function updateCharCount(el, countId, fillId, limit) {
            var len = el.value.length;
            var pct = Math.min((len / limit) * 100, 100);
            var col = len <= limit ? '#2ec4b6' : '#e63946';
            var cEl = document.getElementById(countId);
            var fEl = document.getElementById(fillId);
            if (cEl) {
                cEl.textContent = len;
                cEl.style.color = col;
            }
            if (fEl) {
                fEl.style.width = pct + '%';
                fEl.style.background = col;
            }
        }

        /* legacy alias used by inline oninput on older fields */
        function updateMetaCount(el, countId, limit) {
            var fillId = countId === 'metaTitleCount' ? 'mtFill' : 'mdFill';
            updateCharCount(el, countId, fillId, limit);
        }

        /* ══════════════════════════════════════════════════════════
           FEATURED IMAGE PREVIEW
        ══════════════════════════════════════════════════════════ */
        function previewFeaturedImg(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var p = document.getElementById('featuredImgPreview');
                    if (p) {
                        p.src = e.target.result;
                        p.style.display = 'block';
                    }
                    var z = document.getElementById('uploadZone');
                    if (z) z.style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        /* ══════════════════════════════════════════════════════════
           SAVE BAR
        ══════════════════════════════════════════════════════════ */
        function showSaveBar() {
            document.getElementById('saveBar').classList.add('show');
        }

        function hideSaveBar() {
            document.getElementById('saveBar').classList.remove('show');
        }

        /* ══════════════════════════════════════════════════════════
           AI DETECTION (Sapling API)
        ══════════════════════════════════════════════════════════ */
        var SAPLING_KEY = 'ZTD4XCI0P55544R97SQMQJ67O2YTF4BX';

        function checkAI(fieldId, resultId, isSummernote) {
            var text = isSummernote ?
                stripHtml(getEditorContent() || '') :
                (document.getElementById(fieldId) ? document.getElementById(fieldId).value.trim() : '');

            if (!text || text.length < 10) {
                alert('Please write some content first (minimum 10 characters).');
                return;
            }

            var spinner = document.getElementById(resultId + '-spinner');
            var resultEl = document.getElementById(resultId);
            var btn = document.getElementById('btn-ai-' + fieldId.toLowerCase().replace('blogtitle', 'blogtitle').replace(
                'metatitle', 'metatitle'));

            if (spinner) spinner.classList.add('show');
            if (resultEl) resultEl.classList.remove('show');
            if (btn) btn.disabled = true;

            fetch('https://api.sapling.ai/api/v1/aidetect', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        key: SAPLING_KEY,
                        text: text
                    })
                })
                .then(function(r) {
                    if (!r.ok) throw new Error('HTTP ' + r.status);
                    return r.json();
                })
                .then(function(d) {
                    if (spinner) spinner.classList.remove('show');
                    if (btn) btn.disabled = false;
                    renderAiResult(resultId, d.score !== undefined ? d.score : 0);
                })
                .catch(function(err) {
                    if (spinner) spinner.classList.remove('show');
                    if (btn) btn.disabled = false;
                    var vEl = document.getElementById(resultId + '-verdict');
                    if (vEl) vEl.textContent = '⚠️ Error: ' + err.message;
                    if (resultEl) resultEl.classList.add('show');
                });
        }

        function renderAiResult(resultId, score) {
            var pct = Math.round(score * 100);
            var fillEl = document.getElementById(resultId + '-fill');
            var pctEl = document.getElementById(resultId + '-pct');
            var verdEl = document.getElementById(resultId + '-verdict');
            var boxEl = document.getElementById(resultId);

            var color, verdict;
            if (pct <= 20) {
                color = '#2ec4b6';
                verdict = '✅ Mostly human-written (' + pct + '% AI)';
            } else if (pct <= 50) {
                color = '#f59e0b';
                verdict = '⚠️ Mixed — some AI detected (' + pct + '% AI)';
            } else if (pct <= 80) {
                color = '#e07b39';
                verdict = '🟠 High AI content — consider rewriting (' + pct + '% AI)';
            } else {
                color = '#e63946';
                verdict = '🔴 Mostly AI-generated (' + pct + '% AI)';
            }

            if (pctEl) {
                pctEl.textContent = pct + '%';
                pctEl.style.color = color;
            }
            if (fillEl) {
                fillEl.style.width = pct + '%';
                fillEl.style.background = color;
            }
            if (verdEl) verdEl.textContent = verdict;
            if (boxEl) boxEl.classList.add('show');
        }

        /* ══════════════════════════════════════════════════════════
           PAGE ANALYSIS — TAB SWITCHER
        ══════════════════════════════════════════════════════════ */
        var _activeTab = 'basic_seo';

        function switchReadTab(tab) {
            _activeTab = tab;
            var map = {
                basic_seo: 'BasicSeo',
                title: 'Title',
                readability: 'Readability'
            };
            Object.keys(map).forEach(function(t) {
                var panel = document.getElementById('panel' + map[t]);
                var btn = document.getElementById('tab' + map[t]);
                if (panel) panel.style.display = (t === tab) ? 'block' : 'none';
                if (btn) btn.classList.toggle('active', t === tab);
            });
        }

        /* ══════════════════════════════════════════════════════════
           SEO RESULTS RENDERER
        ══════════════════════════════════════════════════════════ */
        function renderSeoResults(data) {
            var s = data.score;
            var col = s >= 70 ? '#2ec4b6' : s >= 40 ? '#f59e0b' : '#e63946';
            var tcol = s >= 70 ? '#0c7a59' : s >= 40 ? '#c05621' : '#e63946';
            var bcol = s >= 70 ? '#e6faf5' : s >= 40 ? '#fff7ed' : '#fff0f0';

            document.getElementById('seoProgressBar').style.width = s + '%';
            document.getElementById('seoProgressBar').style.background = col;
            document.getElementById('seoScoreText').textContent = s + ' / 100';
            document.getElementById('seoScoreText').style.color = tcol;

            var badge = document.getElementById('seoScoreBadge');
            if (badge) {
                badge.textContent = s + '/100';
                badge.style.display = 'inline-flex';
                badge.style.background = bcol;
                badge.style.color = tcol;
            }

            var html = '';
            data.checks.forEach(function(c) {
                var icon, ic;
                if (c.status === 'pass') {
                    icon = 'fa-check-circle';
                    ic = '#0c7a59';
                } else if (c.status === 'warn') {
                    icon = 'fa-exclamation-circle';
                    ic = '#f59e0b';
                } else {
                    icon = 'fa-times-circle';
                    ic = '#e63946';
                }
                html += '<div class="seo-check-item">' +
                    '<i class="fas ' + icon + ' seo-check-icon" style="color:' + ic + '"></i>' +
                    '<div><div class="seo-check-label">' + c.label + '</div>' +
                    '<div class="seo-check-msg">' + c.message + '</div>';
                if (c.extra) html += '<div class="seo-check-msg" style="margin-top:2px;">Density: <strong>' +
                    c.extra.density + '%</strong> · Found <strong>' + c.extra.count + '</strong>×</div>';
                html += '</div></div>';
            });
            document.getElementById('seoChecklist').innerHTML = html;
            document.getElementById('seoResults').style.display = 'block';
        }

        function renderReadChecklist(cid, checks) {
            var html = '';
            checks.forEach(function(c) {
                var icon, ic;
                if (c.status === 'pass') {
                    icon = 'fa-check-circle';
                    ic = '#0c7a59';
                } else if (c.status === 'warn') {
                    icon = 'fa-exclamation-circle';
                    ic = '#f59e0b';
                } else {
                    icon = 'fa-times-circle';
                    ic = '#e63946';
                }
                html += '<div class="read-check-item">' +
                    '<div class="read-check-row" onclick="toggleReadCheck(this)">' +
                    '<i class="fas ' + icon + ' read-check-icon" style="color:' + ic + '"></i>' +
                    '<span class="read-check-label">' + c.label + '</span>' +
                    '<i class="fas fa-chevron-down read-check-arrow"></i></div>' +
                    '<div class="read-check-detail">';
                if (c.key === 'flesch_reading_ease' && c.extra) {
                    var fs = c.extra.score;
                    var fc = fs >= 60 ? '#2ec4b6' : fs >= 30 ? '#f59e0b' : '#e63946';
                    html += '<p style="margin:0 0 5px">' + c.message + '</p>' +
                        '<div class="flesch-bar-wrap"><div class="flesch-bar" style="width:' + fs +
                        '%;background:' + fc + '"></div></div>' +
                        '<div class="flesch-labels"><span>0 Hard</span><span>Score: ' + fs +
                        '</span><span>100 Easy</span></div>';
                } else {
                    html += '<p style="margin:0">' + c.message + '</p>';
                    if (c.extra) html += '<p style="margin:3px 0 0">Density: <strong>' + c.extra.density +
                        '%</strong> · Found <strong>' + c.extra.count + '</strong>×</p>';
                }
                html += '</div></div>';
            });
            document.getElementById(cid).innerHTML = html;
        }

        function toggleReadCheck(row) {
            var d = row.parentElement.querySelector('.read-check-detail');
            var a = row.querySelector('.read-check-arrow');
            d.classList.toggle('open');
            a.classList.toggle('open');
        }

        function setBadge(id, label, errors, tab) {
            var el = document.getElementById(id);
            el.style.display = 'inline-flex';
            if (errors === 0) {
                el.innerHTML = '<i class="fas fa-check-circle"></i>&nbsp;' + label + ' — OK';
                el.style.background = '#e6faf5';
                el.style.color = '#0c7a59';
            } else {
                el.innerHTML = '<i class="fas fa-dot-circle"></i>&nbsp;' + label + ' — ' + errors + ' Error(s)';
                el.style.background = '#fff0f0';
                el.style.color = '#e63946';
            }
            el.onclick = function() {
                switchReadTab(tab);
            };
        }

        function buildTitleChecks() {
            var title = document.getElementById('blogTitle').value.trim();
            var meta = document.getElementById('metaTitle').value.trim();
            var kw = document.getElementById('focusKeyword').value.trim().toLowerCase();
            var tLen = title.length,
                mLen = meta.length;
            var checks = [];

            checks.push({
                key: 'title_length',
                label: 'Title length',
                status: (tLen >= 40 && tLen <= 60) ? 'pass' : (tLen > 0 ? 'warn' : 'fail'),
                message: (tLen >= 40 && tLen <= 60) ? 'Good (' + tLen + ' chars).' : 'Currently ' + tLen +
                    ' chars. Ideal: 40–60.'
            });
            checks.push({
                key: 'meta_title_length',
                label: 'Meta title length',
                status: (mLen >= 30 && mLen <= 60) ? 'pass' : (mLen > 0 ? 'warn' : 'fail'),
                message: (mLen >= 30 && mLen <= 60) ? 'Good (' + mLen + ' chars).' : 'Currently ' + mLen +
                    ' chars. Ideal: 30–60.'
            });
            if (kw) {
                var inT = title.toLowerCase().includes(kw);
                checks.push({
                    key: 'keyword_in_title',
                    label: 'Keyword in title',
                    status: inT ? 'pass' : 'fail',
                    message: inT ? 'Focus keyword found in title.' : 'Add keyword to blog title.'
                });
                checks.push({
                    key: 'title_starts_keyword',
                    label: 'Keyword at title start',
                    status: title.toLowerCase().startsWith(kw) ? 'pass' : 'warn',
                    message: title.toLowerCase().startsWith(kw) ? 'Title starts with keyword.' :
                        'Consider starting title with keyword.'
                });
            }
            return checks;
        }

        function renderPageAnalysis(seo, read) {
            renderReadChecklist('checklistBasicSeo', seo.checks);
            setBadge('badgeBasicSeo', 'Basic SEO', seo.checks.filter(function(c) {
                return c.status === 'fail';
            }).length, 'basic_seo');
            var tc = buildTitleChecks();
            renderReadChecklist('checklistTitle', tc);
            setBadge('badgeTitle', 'Title', tc.filter(function(c) {
                return c.status === 'fail';
            }).length, 'title');
            renderReadChecklist('checklistReadability', read.checks);
            setBadge('badgeReadability', 'Readability', read.errors, 'readability');
            document.getElementById('readEmpty').style.display = 'none';
            document.getElementById('readResults').style.display = 'block';
            switchReadTab(_activeTab);
        }

        /* ══════════════════════════════════════════════════════════
           SEO ANALYSIS
        ══════════════════════════════════════════════════════════ */
        function runSeoAnalysis() {
            var kw = document.getElementById('focusKeyword').value.trim();
            if (!kw) {
                alert('Please enter a focus keyword first.');
                return;
            }

            document.getElementById('seoLoading').style.display = 'block';
            document.getElementById('seoResults').style.display = 'none';
            var b = document.getElementById('seoScoreBadge');
            if (b) b.style.display = 'none';

            fetch('{{ route('admin.blogs.analyzeSeo') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        focus_keyword: kw,
                        seo_title: document.getElementById('metaTitle').value,
                        meta_description: document.getElementById('metaDesc').value,
                        url: '/' + document.getElementById('blogTitle').value.toLowerCase().replace(/\s+/g, '-')
                            .replace(/[^a-z0-9-]/g, ''),
                        content: getEditorContent() || ''
                    })
                })
                .then(function(r) {
                    if (!r.ok) throw new Error('Server ' + r.status);
                    return r.json();
                })
                .then(function(d) {
                    document.getElementById('seoLoading').style.display = 'none';
                    renderSeoResults(d);
                    document.getElementById('hiddenFocusKeyword').value = kw;
                    document.getElementById('hiddenSeoScore').value = d.score;
                    document.getElementById('hiddenSeoChecks').value = JSON.stringify(d.checks);
                })
                .catch(function(e) {
                    document.getElementById('seoLoading').style.display = 'none';
                    alert('SEO analysis failed: ' + e.message);
                });
        }

        /* ══════════════════════════════════════════════════════════
           PAGE ANALYSIS
        ══════════════════════════════════════════════════════════ */
        function runPageAnalysis() {
            var content = getEditorContent() || '';
            if (!content.trim()) {
                alert('Content is empty.');
                return;
            }
            var kw = document.getElementById('focusKeyword').value.trim() || 'content';

            document.getElementById('readLoading').style.display = 'block';
            document.getElementById('readResults').style.display = 'none';
            document.getElementById('readEmpty').style.display = 'none';

            Promise.all([
                    fetch('{{ route('admin.blogs.analyzeSeo') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            focus_keyword: kw,
                            seo_title: document.getElementById('metaTitle').value,
                            meta_description: document.getElementById('metaDesc').value,
                            url: '/' + document.getElementById('blogTitle').value.toLowerCase().replace(
                                /\s+/g, '-').replace(/[^a-z0-9-]/g, ''),
                            content: content
                        })
                    }).then(function(r) {
                        return r.json();
                    }),
                    fetch('{{ route('admin.blogs.analyzeReadability') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            content: content
                        })
                    }).then(function(r) {
                        return r.json();
                    })
                ])
                .then(function(res) {
                    document.getElementById('readLoading').style.display = 'none';
                    renderPageAnalysis(res[0], res[1]);
                    document.getElementById('hiddenFocusKeyword').value = kw;
                    document.getElementById('hiddenSeoScore').value = res[0].score;
                    document.getElementById('hiddenSeoChecks').value = JSON.stringify(res[0].checks);
                    document.getElementById('hiddenReadabilityErrors').value = res[1].errors;
                    document.getElementById('hiddenReadabilityChecks').value = JSON.stringify(res[1].checks);
                    document.getElementById('hiddenTitleChecks').value = JSON.stringify(buildTitleChecks());
                })
                .catch(function(e) {
                    document.getElementById('readLoading').style.display = 'none';
                    alert('Analysis failed: ' + e.message);
                });
        }

        /* ══════════════════════════════════════════════════════════
           JQUERY DOCUMENT READY
        ══════════════════════════════════════════════════════════ */
        $(document).ready(function() {

            /* ── 1. Summernote Init ───────────────────────────────
               CRITICAL SETTINGS:
               • dialogsInBody: true  — dialogs attach to <body>, not the editor
               • container: 'body'    — popups don't clip inside the card
               These two prevent the editor from breaking out of the layout.
            ─────────────────────────────────────────────────────── */


            /* ── 2. Kill panel drag/sort ─────────────────────────── */
            if ($.fn.sortable) {
                try {
                    $('.panel, [data-sortable-id]').sortable('destroy');
                } catch (e) {}
            }
            $(document).on('mousedown dragstart', '.panel-heading', function(e) {
                e.stopPropagation();
            });

            /* ── 3. Unsaved changes bar ─────────────────────────── */
            $('#mainBlogForm').on('input change', 'input, textarea, select', showSaveBar);

            /* ── 4. Form submit — sync editor → textarea ────────── */
            $('#mainBlogForm').on('submit', function() {
                if (typeof $.fn.summernote !== 'undefined') {
                    $('#content').val($('#content').summernote('code'));
                }
                var fk = document.getElementById('focusKeyword').value.trim();
                if (fk) document.getElementById('hiddenFocusKeyword').value = fk;
            });

            /* ── 5. Google SERP live preview ───────────────────── */
            function updateSerp() {
                var mt = document.getElementById('metaTitle').value.trim();
                var md = document.getElementById('metaDesc').value.trim();
                var bt = document.getElementById('blogTitle').value.trim();
                var ttl = mt || bt || 'Blog Title Preview';
                var dsc = md || 'Your meta description will appear here...';
                if (ttl.length > 60) ttl = ttl.substring(0, 60) + '…';
                if (dsc.length > 160) dsc = dsc.substring(0, 160) + '…';
                var slug = bt.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-') || 'your-blog-url';
                document.getElementById('serpTitlePreview').textContent = ttl;
                document.getElementById('serpDescPreview').textContent = dsc;
                document.getElementById('serpSlug').textContent = slug;
            }
            $('#metaTitle, #metaDesc, #blogTitle').on('input', updateSerp);
            updateSerp();

            /* ── 6. Init char counters ──────────────────────────── */
            updateCharCount(document.getElementById('metaTitle'), 'mtCount', 'mtFill', 60);
            updateCharCount(document.getElementById('metaDesc'), 'mdCount', 'mdFill', 160);

        });


        // services pages related script


        $(document).ready(function() {

            let selectedServiceId = "{{ $blog?->service_page_id ?? '' }}";

            function loadServices(headerMenu) {

                $.ajax({

                    url: "{{ route('admin.blog.services') }}",

                    type: "GET",

                    data: {
                        header_menu: headerMenu
                    },

                    success: function(response) {

                        let options =
                            '<option value="">Select Service Page</option>';

                        response.forEach(function(item) {

                            let selected =
                                item.id == selectedServiceId ?
                                'selected' :
                                '';

                            options += `
                        <option value="${item.id}" ${selected}>
                            ${item.page_name}
                        </option>
                    `;
                        });

                        $('#service_page_id').html(options);
                    }
                });
            }

            $('#header_menu').change(function() {

                loadServices($(this).val());

            });

            // EDIT PAGE LOAD
            if ($('#header_menu').val() !== '') {

                loadServices($('#header_menu').val());

            }

        });
    </script>
@endpush
