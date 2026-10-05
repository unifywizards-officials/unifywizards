@extends('layouts.app')

@section('title', 'Blog Details')

@push('css')
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        /* ══════════════════════════════════════════
           ROOT VARIABLES
        ══════════════════════════════════════════ */
        :root {
            --ink: #0f1117;
            --ink-2: #3d4152;
            --ink-3: #6b7080;
            --ink-4: #9ea5b4;
            --line: rgba(0, 0, 0, 0.07);
            --line-2: rgba(0, 0, 0, 0.04);
            --surface: #ffffff;
            --surface-2: #f7f8fa;
            --surface-3: #f0f2f5;
            --accent: #4361ee;
            --accent-dim: #eef0fd;
            --green: #16a34a;
            --green-bg: #dcfce7;
            --amber: #b45309;
            --amber-bg: #fef3c7;
            --red: #dc2626;
            --red-bg: #fee2e2;
            --radius-lg: 14px;
            --radius-md: 10px;
            --radius-sm: 7px;
            --shadow-card: 0 1px 2px rgba(0, 0, 0, 0.04), 0 4px 16px rgba(0, 0, 0, 0.04);
            --shadow-hover: 0 2px 4px rgba(0, 0, 0, 0.06), 0 8px 24px rgba(0, 0, 0, 0.08);
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ══ Page Shell ══ */
        .bd-page {
            
            padding: 0.25rem 0 3rem;
            animation: bdFadeIn 0.4s ease both;
        }

        @keyframes bdFadeIn {
            from {
                opacity: 0;
                transform: translateY(8px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        /* ══ Top action bar ══ */
        .bd-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 24px;
        }

        .bd-topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .bd-topbar-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .bd-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--radius-sm);
            font-size: 12.5px;
            font-weight: 500;
            color: var(--ink-3);
            text-decoration: none;
            transition: var(--transition);
        }

        .bd-back-btn:hover {
            background: var(--surface-2);
            color: var(--ink);
            text-decoration: none;
        }

        .bd-back-btn svg {
            width: 14px;
            height: 14px;
        }

        .bd-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 18px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 500;
            
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: var(--transition);
            letter-spacing: -0.01em;
        }

        .bd-btn svg {
            width: 13.5px;
            height: 13.5px;
            flex-shrink: 0;
        }

        .bd-btn-edit {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 2px 8px rgba(67, 97, 238, .3);
        }

        .bd-btn-edit:hover {
            background: #3651d4;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(67, 97, 238, .4);
        }

        .bd-btn-delete {
            background: var(--red-bg);
            color: var(--red);
            border: 1px solid #fca5a5;
        }

        .bd-btn-delete:hover {
            background: #fecaca;
            color: var(--red);
        }

        /* ══ Layout Grid ══ */
        .bd-grid {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 20px;
            align-items: start;
        }

        @media(max-width:900px) {
            .bd-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ══ Cards ══ */
        .bd-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            transition: var(--transition);
            margin-bottom: 18px;
        }

        .bd-card:last-child {
            margin-bottom: 0;
        }

        .bd-card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--line-2);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .bd-card-title-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bd-icon-box {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .bd-icon-box svg {
            width: 15px;
            height: 15px;
            stroke-width: 1.75;
        }

        .bd-icon-blue {
            background: #eef2ff;
        }

        .bd-icon-blue svg {
            stroke: var(--accent);
        }

        .bd-icon-green {
            background: #dcfce7;
        }

        .bd-icon-green svg {
            stroke: var(--green);
        }

        .bd-icon-amber {
            background: #fef3c7;
        }

        .bd-icon-amber svg {
            stroke: var(--amber);
        }

        .bd-icon-purple {
            background: #f5f3ff;
        }

        .bd-icon-purple svg {
            stroke: #7c3aed;
        }

        .bd-icon-slate {
            background: var(--surface-3);
        }

        .bd-icon-slate svg {
            stroke: var(--ink-3);
        }

        .bd-icon-red {
            background: var(--red-bg);
        }

        .bd-icon-red svg {
            stroke: var(--red);
        }

        .bd-card-title {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--ink);
            margin: 0;
            letter-spacing: -0.01em;
        }

        .bd-card-subtitle {
            font-size: 11.5px;
            color: var(--ink-4);
            margin: 2px 0 0;
        }

        .bd-card-body {
            padding: 20px;
        }

        /* ══ Article Hero ══ */
        .bd-hero {
            position: relative;
            width: 100%;
            height: 260px;
            border-radius: var(--radius-md);
            overflow: hidden;
            margin-bottom: 22px;
            background: var(--surface-3);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bd-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .bd-hero-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            color: var(--ink-4);
        }

        .bd-hero-placeholder svg {
            width: 36px;
            height: 36px;
            stroke: var(--ink-4);
            stroke-width: 1;
        }

        .bd-hero-placeholder span {
            font-size: 12px;
        }

        /* ══ Article Typography ══ */
        .bd-article-eyebrow {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .bd-article-eyebrow::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--accent);
            opacity: .2;
        }

        .bd-article-title {
           
            font-size: 28px;
            font-weight: 400;
            line-height: 1.32;
            color: var(--ink);
            letter-spacing: -0.02em;
            margin: 0 0 20px;
        }

        .bd-excerpt {
            padding: 14px 18px;
            background: linear-gradient(135deg, #f8f9ff 0%, #f0f3ff 100%);
            border-radius: var(--radius-md);
            border-left: 3px solid var(--accent);
            margin-bottom: 24px;
        }

        .bd-excerpt-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 6px;
        }

        .bd-excerpt-text {
            font-size: 14px;
            line-height: 1.75;
            color: var(--ink-2);
            margin: 0;
            font-style: italic;
        }

        .bd-content-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--ink-4);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .bd-content-label::before,
        .bd-content-label::after {
            content: '';
            height: 1px;
            background: var(--line);
            flex: 1;
        }

        .bd-content-label::before {
            width: 0;
        }

        .bd-content-body {
            font-size: 14.5px;
            line-height: 1.85;
            color: var(--ink-2);
            font-weight: 300;
        }

        .bd-content-body h1,
        .bd-content-body h2,
        .bd-content-body h3 {
           
            font-weight: 400;
            color: var(--ink);
            margin: 1.5em 0 .5em;
        }

        .bd-content-body h2 {
            font-size: 20px;
        }

        .bd-content-body h3 {
            font-size: 17px;
        }

        .bd-content-body p {
            margin: 0 0 1em;
        }

        .bd-content-body a {
            color: var(--accent);
        }

        .bd-content-body img {
            max-width: 100%;
            border-radius: var(--radius-sm);
        }

        .bd-content-body ul,
        .bd-content-body ol {
            padding-left: 1.4em;
            margin: 0 0 1em;
        }

        .bd-content-body li {
            margin-bottom: .35em;
        }

        .bd-content-body blockquote {
            border-left: 3px solid var(--accent);
            margin: 1em 0;
            padding: .75em 1.25em;
            background: var(--accent-dim);
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
            font-style: italic;
            color: var(--ink-2);
        }

        .bd-content-body pre,
        .bd-content-body code {
            background: var(--surface-3);
            border-radius: var(--radius-sm);
            font-size: 13px;
        }

        .bd-content-body pre {
            padding: 1em 1.25em;
            overflow-x: auto;
        }

        .bd-content-body code {
            padding: 1px 6px;
        }

        /* ══ SEO Section ══ */
        .bd-sep {
            height: 1px;
            background: var(--line-2);
            margin: 24px 0;
        }

        .bd-seo-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 14px;
        }

        @media(max-width:600px) {
            .bd-seo-grid {
                grid-template-columns: 1fr;
            }
        }

        .bd-seo-tile {
            padding: 14px 16px;
            background: var(--surface-2);
            border: 1px solid var(--line);
            border-radius: var(--radius-md);
            transition: var(--transition);
        }

        .bd-seo-tile:hover {
            border-color: #c7d2fe;
            background: #f5f7ff;
        }

        .bd-seo-tile-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--ink-4);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .bd-seo-tile-label svg {
            width: 11px;
            height: 11px;
            stroke: var(--ink-4);
            stroke-width: 2;
        }

        .bd-seo-tile-val {
            font-size: 13px;
            line-height: 1.55;
            color: var(--ink-2);
            font-weight: 400;
            margin: 0;
        }

        /* ══ SEO Score Bar ══ */
        .bd-score-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: var(--surface-2);
            border: 1px solid var(--line);
            border-radius: var(--radius-md);
            margin-top: 14px;
        }

        .bd-score-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--ink-3);
            white-space: nowrap;
        }

        .bd-score-track {
            flex: 1;
            height: 7px;
            background: var(--surface-3);
            border-radius: 99px;
            overflow: hidden;
        }

        .bd-score-fill {
            height: 100%;
            border-radius: 99px;
            transition: width .9s cubic-bezier(.4, 0, .2, 1);
        }

        .bd-score-num {
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* ══ Sidebar Info List ══ */
        .bd-info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .bd-info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 11px 20px;
            border-bottom: 1px solid var(--line-2);
            gap: 12px;
            font-size: 13px;
            transition: var(--transition);
        }

        .bd-info-item:last-child {
            border-bottom: none;
        }

        .bd-info-item:hover {
            background: var(--surface-2);
        }

        .bd-info-key {
            color: var(--ink-4);
            font-weight: 400;
            white-space: nowrap;
        }

        .bd-info-val {
            color: var(--ink);
            font-weight: 500;
            text-align: right;
            font-size: 12.5px;
        }

        .bd-info-val.mono {
           
            font-size: 11px;
            background: var(--surface-3);
            border: 1px solid var(--line);
            padding: 2px 8px;
            border-radius: 5px;
            color: var(--accent);
            letter-spacing: .02em;
        }

        /* ══ Status Badges ══ */
        .bd-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11.5px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 99px;
            letter-spacing: .02em;
        }

        .bd-badge .pulse-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .bd-badge-published {
            background: var(--green-bg);
            color: var(--green);
        }

        .bd-badge-published .pulse-dot {
            animation: pulseDot 2s infinite;
        }

        @keyframes pulseDot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1)
            }

            50% {
                opacity: .5;
                transform: scale(.75)
            }
        }

        .bd-badge-draft {
            background: var(--amber-bg);
            color: var(--amber);
        }

        .bd-badge-archived {
            background: var(--surface-3);
            color: var(--ink-3);
            border: 1px solid var(--line);
        }

        /* ══ Action Buttons ══ */
        .bd-actions {
            padding: 16px 20px;
            border-top: 1px solid var(--line-2);
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .bd-action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 500;
           
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
            border: 1px solid;
            width: 100%;
            letter-spacing: -0.01em;
        }

        .bd-action-btn svg {
            width: 14px;
            height: 14px;
            stroke-width: 1.75;
            flex-shrink: 0;
        }

        .bd-action-edit {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
            box-shadow: 0 2px 8px rgba(67, 97, 238, .25);
        }

        .bd-action-edit:hover {
            background: #3651d4;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(67, 97, 238, .35);
            text-decoration: none;
        }

        .bd-action-delete {
            background: #fff;
            color: var(--red);
            border-color: #fca5a5;
        }

        .bd-action-delete:hover {
            background: var(--red-bg);
            color: var(--red);
        }

        /* ══ Quick Stats Row ══ */
        .bd-stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: var(--line);
            border-radius: var(--radius-md);
            overflow: hidden;
            margin-bottom: 18px;
        }

        .bd-stat-cell {
            background: var(--surface);
            padding: 14px 16px;
            text-align: center;
        }

        .bd-stat-val {
            
            font-size: 22px;
            font-weight: 400;
            color: var(--ink);
            line-height: 1;
            margin-bottom: 4px;
        }

        .bd-stat-label {
            font-size: 10.5px;
            color: var(--ink-4);
            font-weight: 500;
            letter-spacing: .04em;
        }

        /* ══ Focus Keyword pill ══ */
        .bd-kw-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            background: var(--accent-dim);
            border: 1px solid #c7d2fe;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 600;
            color: var(--accent);
            letter-spacing: .02em;
        }

        .bd-kw-pill svg {
            width: 11px;
            height: 11px;
            stroke: var(--accent);
            stroke-width: 2;
        }

        /* ══ SEO Checks ══ */
        .bd-check-list {
            margin-top: 6px;
        }

        .bd-check-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 9px 0;
            border-bottom: 1px solid var(--line-2);
            font-size: 12.5px;
        }

        .bd-check-row:last-child {
            border-bottom: none;
        }

        .bd-check-icon {
            flex-shrink: 0;
            margin-top: 1px;
        }

        .bd-check-icon svg {
            width: 14px;
            height: 14px;
            stroke-width: 2;
        }

        .bd-check-pass svg {
            stroke: var(--green);
        }

        .bd-check-warn svg {
            stroke: var(--amber);
        }

        .bd-check-fail svg {
            stroke: var(--red);
        }

        .bd-check-text-label {
            font-weight: 600;
            color: var(--ink);
        }

        .bd-check-text-msg {
            font-size: 11.5px;
            color: var(--ink-3);
            margin-top: 1px;
        }

        /* ══ Analysis Tabs ══ */
        .bd-read-tabs {
            display: flex;
            border-bottom: 1px solid var(--line);
            margin-bottom: 14px;
            gap: 0;
        }

        .bd-read-tab {
            padding: 8px 14px;
            font-size: 12px;
            font-weight: 500;
            color: var(--ink-4);
            border: none;
            background: none;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
            transition: var(--transition);
           
        }

        .bd-read-tab.active {
            color: var(--accent);
            border-bottom-color: var(--accent);
        }

        .bd-read-tab:hover:not(.active) {
            color: var(--ink-2);
        }

        /* ══ SERP Preview ══ */
        .serp-preview {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--radius-md);
            padding: 16px;
            margin-top: 14px;
        }

        .serp-top {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
        }

        .serp-favicon {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid rgba(0, 0, 0, .06);
        }

        .serp-site-name {
            font-size: 13px;
            font-weight: 500;
            color: #202124;
            line-height: 1.2;
        }

        .serp-url {
            font-size: 12px;
            color: #4d5156;
            margin-top: 2px;
            word-break: break-word;
        }

        .serp-title {
            color: #1a0dab;
            font-size: 20px;
            line-height: 1.3;
            font-weight: 400;
            margin-bottom: 6px;
        
        }

        .serp-title a {
            color: #1a0dab;
            text-decoration: none;
        }

        .serp-title a:hover {
            text-decoration: underline;
        }

        .serp-description {
            color: #4d5156;
            font-size: 13.5px;
            line-height: 1.58;
         
        }

        /* ══ Section sub-heading inside card ══ */
        .bd-section-head {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 16px 20px 14px;
            border-top: 1px solid var(--line-2);
            margin-top: 4px;
        }
    </style>
@endpush

@section('content')
    <div class="bd-page">

        {{-- ── Top Bar ── --}}
        <div class="bd-topbar">
            <div class="bd-topbar-left">
                <a href="{{ route('admin.blogs.index') }}" class="bd-back-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 5l-7 7 7 7" />
                    </svg>
                    All Blogs
                </a>
            </div>
            <div class="bd-topbar-actions">
                @can('blogs.edit')
                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="bd-btn bd-btn-edit">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                        Edit Post
                    </a>
                @endcan
                @can('blogs.delete')
                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST"
                        onsubmit="return confirm('Delete this blog permanently?');" style="margin:0;">
                        @csrf @method('DELETE')
                        <button type="submit" class="bd-btn bd-btn-delete">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete
                        </button>
                    </form>
                @endcan
            </div>
        </div>

        <div class="bd-grid">

            {{-- ════════════════ LEFT COLUMN ════════════════ --}}
            <div>

                {{-- ── Card: Article Content ── --}}
                <div class="bd-card">
                    <div class="bd-card-header">
                        <div class="bd-card-title-group">
                            <div class="bd-icon-box bd-icon-blue">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="bd-card-title">Article</p>
                                <p class="bd-card-subtitle">Full post content</p>
                            </div>
                        </div>
                        {{-- Status Badge --}}
                        @if ($blog->status === 'published')
                            <span class="bd-badge bd-badge-published"><span class="pulse-dot"></span> Published</span>
                        @elseif($blog->status === 'draft')
                            <span class="bd-badge bd-badge-draft"><span class="pulse-dot"></span> Draft</span>
                        @else
                            <span class="bd-badge bd-badge-archived"><span class="pulse-dot"></span> Archived</span>
                        @endif
                    </div>

                    <div class="bd-card-body">

                        {{-- Featured Image --}}
                        <div class="bd-hero">
                            @if ($blog->featured_image)
                                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}">
                            @else
                                <div class="bd-hero-placeholder">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <rect x="3" y="3" width="18" height="18" rx="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <path d="M21 15l-5-5L5 21" />
                                    </svg>
                                    <span>No featured image</span>
                                </div>
                            @endif
                        </div>

                        {{-- Eyebrow + Title --}}
                        <div class="bd-article-eyebrow">Blog Post</div>
                        <h1 class="bd-article-title">{{ $blog->title }}</h1>

                        {{-- Excerpt --}}
                        @if ($blog->excerpt)
                            <div class="bd-excerpt">
                                <div class="bd-excerpt-label">Excerpt</div>
                                <p class="bd-excerpt-text">{{ $blog->excerpt }}</p>
                            </div>
                        @endif

                        {{-- Full Content --}}
                        <div class="bd-content-label">Full Content</div>
                        <div class="bd-content-body">
                            {!! $blog->content !!}
                        </div>

                    </div>
                </div>

                {{-- ── Card: SEO & Meta ── --}}
                @if ($blog->meta_title || $blog->meta_description || $blog->focus_keyword || $blog->seo_score)
                    <div class="bd-card">
                        <div class="bd-card-header">
                            <div class="bd-card-title-group">
                                <div class="bd-icon-box bd-icon-green">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <circle cx="11" cy="11" r="8" />
                                        <path d="M21 21l-4.35-4.35" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="bd-card-title">SEO &amp; Meta</p>
                                    <p class="bd-card-subtitle">Search engine optimization data</p>
                                </div>
                            </div>
                            @if ($blog->focus_keyword)
                                <span class="bd-kw-pill">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                    </svg>
                                    {{ $blog->focus_keyword }}
                                </span>
                            @endif
                        </div>

                        <div class="bd-card-body">

                            {{-- SEO Score bar --}}
                            @if ($blog->seo_score)
                                @php
                                    $score = (int) $blog->seo_score;
                                    $scoreColor = $score >= 70 ? '#16a34a' : ($score >= 40 ? '#b45309' : '#dc2626');
                                    $fillColor = $score >= 70 ? '#22c55e' : ($score >= 40 ? '#f59e0b' : '#ef4444');
                                @endphp
                                <div class="bd-score-wrap" style="margin-top:0;margin-bottom:16px;">
                                    <span class="bd-score-label">SEO Score</span>
                                    <div class="bd-score-track">
                                        <div class="bd-score-fill" id="seoFill"
                                            style="width:0%;background:{{ $fillColor }};"></div>
                                    </div>
                                    <span class="bd-score-num"
                                        style="color:{{ $scoreColor }}">{{ $score }}/100</span>
                                </div>
                            @endif

                            {{-- Meta tiles --}}
                            <div class="bd-seo-grid">
                                @if ($blog->meta_title)
                                    <div class="bd-seo-tile">
                                        <div class="bd-seo-tile-label">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M4 6h16M4 12h8m-8 6h16" />
                                            </svg>
                                            Meta Title
                                        </div>
                                        <p class="bd-seo-tile-val">{{ $blog->meta_title }}</p>
                                    </div>
                                @endif
                                @if ($blog->meta_description)
                                    <div class="bd-seo-tile">
                                        <div class="bd-seo-tile-label">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M4 6h16M4 10h16M4 14h8" />
                                            </svg>
                                            Meta Description
                                        </div>
                                        <p class="bd-seo-tile-val">{{ $blog->meta_description }}</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Google SERP Preview --}}
                            <div style="margin-top:18px;">
                                <p
                                    style="font-size:10px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--ink-4);margin-bottom:4px;">
                                    Google Search Preview</p>
                                <div class="serp-preview">
                                    <div class="serp-top">
                                        <img src="{{ asset('assets/img/logo/favicon.png') }}" alt="favicon"
                                            class="serp-favicon" onerror="this.style.display='none'">
                                        <div>
                                            <div class="serp-site-name">{{ config('app.name') }}</div>
                                            <div class="serp-url">{{ url('/') }}/{{ $blog->slug }}</div>
                                        </div>
                                    </div>
                                    <div class="serp-title">
                                        <a href="{{ url('/' . $blog->slug) }}" target="_blank">
                                            {{ Str::limit($blog->meta_title ?: $blog->title, 60) }}
                                        </a>
                                    </div>
                                    <div class="serp-description">
                                        {{ Str::limit($blog->meta_description ?: 'Your meta description will appear here...', 160) }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

                {{-- ── Card: Analysis Checks (SEO + Readability + Title) ── --}}
                @if (
                    ($blog->seo_checks && count((array) $blog->seo_checks) > 0) ||
                        ($blog->readability_checks && count((array) $blog->readability_checks) > 0) ||
                        ($blog->title_checks && count((array) $blog->title_checks) > 0))
                    <div class="bd-card">
                        <div class="bd-card-header">
                            <div class="bd-card-title-group">
                                <div class="bd-icon-box bd-icon-purple">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="bd-card-title">Page Analysis</p>
                                    <p class="bd-card-subtitle">SEO, readability &amp; title checks</p>
                                </div>
                            </div>
                            {{-- Readability errors badge --}}
                            @if ($blog->readability_errors !== null)
                                @if ($blog->readability_errors == 0)
                                    <span class="bd-badge bd-badge-published"><span class="pulse-dot"></span> No
                                        Errors</span>
                                @else
                                    <span class="bd-badge bd-badge-draft"><span class="pulse-dot"></span>
                                        {{ $blog->readability_errors }} Error(s)</span>
                                @endif
                            @endif
                        </div>

                        <div class="bd-card-body" style="padding-top:14px;">

                            {{-- Analysis Tab Nav --}}
                            <div class="bd-read-tabs">
                                @if ($blog->seo_checks && count((array) $blog->seo_checks) > 0)
                                    <button class="bd-read-tab active" onclick="switchAnalTab('seo', this)">
                                        <svg style="width:11px;height:11px;stroke:currentColor;stroke-width:2;vertical-align:-1px;margin-right:4px;"
                                            viewBox="0 0 24 24" fill="none">
                                            <circle cx="11" cy="11" r="8" />
                                            <path d="M21 21l-4.35-4.35" />
                                        </svg>
                                        SEO Checks
                                    </button>
                                @endif
                                @if ($blog->readability_checks && count((array) $blog->readability_checks) > 0)
                                    <button class="bd-read-tab" onclick="switchAnalTab('read', this)">
                                        <svg style="width:11px;height:11px;stroke:currentColor;stroke-width:2;vertical-align:-1px;margin-right:4px;"
                                            viewBox="0 0 24 24" fill="none">
                                            <path d="M4 6h16M4 12h16M4 18h12" />
                                        </svg>
                                        Readability
                                    </button>
                                @endif
                                @if ($blog->title_checks && count((array) $blog->title_checks) > 0)
                                    <button class="bd-read-tab" onclick="switchAnalTab('title', this)">
                                        <svg style="width:11px;height:11px;stroke:currentColor;stroke-width:2;vertical-align:-1px;margin-right:4px;"
                                            viewBox="0 0 24 24" fill="none">
                                            <path d="M4 7V4h16v3M9 20h6M12 4v16" />
                                        </svg>
                                        Title
                                    </button>
                                @endif
                            </div>

                            {{-- SEO Checks Panel --}}
                            @if ($blog->seo_checks && count((array) $blog->seo_checks) > 0)
                                <div id="analPanel-seo" class="bd-check-list">
                                    @foreach ((array) $blog->seo_checks as $check)
                                        @php $st = $check['status'] ?? 'fail'; @endphp
                                        <div class="bd-check-row">
                                            <span class="bd-check-icon bd-check-{{ $st }}">
                                                @if ($st === 'pass')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @elseif($st === 'warn')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path
                                                            d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                                                    </svg>
                                                @else
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <circle cx="12" cy="12" r="10" />
                                                        <path d="M15 9l-6 6M9 9l6 6" />
                                                    </svg>
                                                @endif
                                            </span>
                                            <div>
                                                <div class="bd-check-text-label">{{ $check['label'] ?? '' }}</div>
                                                <div class="bd-check-text-msg">{{ $check['message'] ?? '' }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Readability Panel --}}
                            @if ($blog->readability_checks && count((array) $blog->readability_checks) > 0)
                                <div id="analPanel-read" class="bd-check-list" style="display:none;">
                                    @foreach ((array) $blog->readability_checks as $check)
                                        @php $st = $check['status'] ?? 'fail'; @endphp
                                        <div class="bd-check-row">
                                            <span class="bd-check-icon bd-check-{{ $st }}">
                                                @if ($st === 'pass')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @elseif($st === 'warn')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path
                                                            d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                                                    </svg>
                                                @else
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <circle cx="12" cy="12" r="10" />
                                                        <path d="M15 9l-6 6M9 9l6 6" />
                                                    </svg>
                                                @endif
                                            </span>
                                            <div>
                                                <div class="bd-check-text-label">{{ $check['label'] ?? '' }}</div>
                                                <div class="bd-check-text-msg">{{ $check['message'] ?? '' }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Title Checks Panel --}}
                            @if ($blog->title_checks && count((array) $blog->title_checks) > 0)
                                <div id="analPanel-title" class="bd-check-list" style="display:none;">
                                    @foreach ((array) $blog->title_checks as $check)
                                        @php $st = $check['status'] ?? 'fail'; @endphp
                                        <div class="bd-check-row">
                                            <span class="bd-check-icon bd-check-{{ $st }}">
                                                @if ($st === 'pass')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @elseif($st === 'warn')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path
                                                            d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                                                    </svg>
                                                @else
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <circle cx="12" cy="12" r="10" />
                                                        <path d="M15 9l-6 6M9 9l6 6" />
                                                    </svg>
                                                @endif
                                            </span>
                                            <div>
                                                <div class="bd-check-text-label">{{ $check['label'] ?? '' }}</div>
                                                <div class="bd-check-text-msg">{{ $check['message'] ?? '' }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                @endif

            </div>{{-- /left --}}

            {{-- ════════════════ RIGHT COLUMN (Sidebar) ════════════════ --}}
            <div>

                {{-- ── Quick Stats ── --}}
                @php
                    $wordCount = str_word_count(strip_tags($blog->content));
                    $readMin = max(1, (int) round($wordCount / 200));
                    $charCount = strlen(strip_tags($blog->content));
                @endphp
                <div class="bd-card">
                    <div class="bd-stats-row">
                        <div class="bd-stat-cell">
                            <div class="bd-stat-val">{{ number_format($wordCount) }}</div>
                            <div class="bd-stat-label">Words</div>
                        </div>
                        <div class="bd-stat-cell">
                            <div class="bd-stat-val">{{ $readMin }}<span
                                    style="font-size:14px;color:var(--ink-3);">m</span></div>
                            <div class="bd-stat-label">Read time</div>
                        </div>
                        <div class="bd-stat-cell">
                            <div class="bd-stat-val">{{ number_format($charCount) }}</div>
                            <div class="bd-stat-label">Chars</div>
                        </div>
                    </div>
                </div>

                {{-- ── Post Info ── --}}
                <div class="bd-card">
                    <div class="bd-card-header">
                        <div class="bd-card-title-group">
                            <div class="bd-icon-box bd-icon-slate">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="bd-card-title">Post Info</p>
                        </div>
                    </div>

                    <ul class="bd-info-list">
                        <li class="bd-info-item">
                            <span class="bd-info-key">Status</span>
                            @if ($blog->status === 'published')
                                <span class="bd-badge bd-badge-published"><span class="pulse-dot"></span>Published</span>
                            @elseif($blog->status === 'draft')
                                <span class="bd-badge bd-badge-draft"><span class="pulse-dot"></span>Draft</span>
                            @else
                                <span class="bd-badge bd-badge-archived"><span class="pulse-dot"></span>Archived</span>
                            @endif
                        </li>
                        <li class="bd-info-item">
                            <span class="bd-info-key">Author</span>
                            <span class="bd-info-val">{{ $blog->user->name ?? 'N/A' }}</span>
                        </li>
                        <li class="bd-info-item">
                            <span class="bd-info-key">Published</span>
                            <span
                                class="bd-info-val">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : '—' }}</span>
                        </li>
                        <li class="bd-info-item">
                            <span class="bd-info-key">Created</span>
                            <span class="bd-info-val">{{ $blog->created_at->format('M d, Y') }}</span>
                        </li>
                        <li class="bd-info-item">
                            <span class="bd-info-key">Updated</span>
                            <span class="bd-info-val">{{ $blog->updated_at->diffForHumans() }}</span>
                        </li>
                        @if ($blog->slug)
                            <li class="bd-info-item">
                                <span class="bd-info-key">Slug</span>
                                <span class="bd-info-val mono">{{ $blog->slug }}</span>
                            </li>
                        @endif
                        @if ($blog->seo_score)
                            @php $s = (int)$blog->seo_score; @endphp
                            <li class="bd-info-item">
                                <span class="bd-info-key">SEO Score</span>
                                <span class="bd-info-val"
                                    style="color:{{ $s >= 70 ? '#16a34a' : ($s >= 40 ? '#b45309' : '#dc2626') }};font-size:14px;font-weight:700;">
                                    {{ $s }}/100
                                </span>
                            </li>
                        @endif
                        @if ($blog->readability_errors !== null)
                            <li class="bd-info-item">
                                <span class="bd-info-key">Read. Errors</span>
                                <span class="bd-info-val"
                                    style="color:{{ $blog->readability_errors == 0 ? '#16a34a' : '#dc2626' }}">
                                    {{ $blog->readability_errors == 0 ? '✓ None' : $blog->readability_errors . ' error(s)' }}
                                </span>
                            </li>
                        @endif
                    </ul>

                    <div class="bd-actions">
                        @can('blogs.edit')
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="bd-action-btn bd-action-edit">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                                Edit Post
                            </a>
                        @endcan
                        @can('blogs.delete')
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST"
                                onsubmit="return confirm('Delete this blog permanently?');" style="margin:0;">
                                @csrf @method('DELETE')
                                <button type="submit" class="bd-action-btn bd-action-delete">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete Post
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>

                {{-- ── Focus Keyword + SEO Score mini card ── --}}
                @if ($blog->focus_keyword)
                    <div class="bd-card">
                        <div class="bd-card-header">
                            <div class="bd-card-title-group">
                                <div class="bd-icon-box bd-icon-amber">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                    </svg>
                                </div>
                                <p class="bd-card-title">Focus Keyword</p>
                            </div>
                        </div>
                        <div class="bd-card-body" style="padding-top:14px;padding-bottom:16px;">
                            <div class="bd-kw-pill" style="font-size:13px;padding:5px 14px;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                </svg>
                                {{ $blog->focus_keyword }}
                            </div>

                            @if ($blog->seo_score)
                                @php
                                    $s = (int) $blog->seo_score;
                                    $fc = $s >= 70 ? '#22c55e' : ($s >= 40 ? '#f59e0b' : '#ef4444');
                                    $tc = $s >= 70 ? '#16a34a' : ($s >= 40 ? '#b45309' : '#dc2626');
                                @endphp
                                <div style="margin-top:16px;">
                                    <div
                                        style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
                                        <span
                                            style="font-size:10px;color:var(--ink-4);font-weight:600;text-transform:uppercase;letter-spacing:.08em;">Overall
                                            SEO Score</span>
                                        <span
                                            style="font-size:15px;font-weight:700;color:{{ $tc }}">{{ $s }}/100</span>
                                    </div>
                                    <div class="bd-score-track">
                                        <div class="bd-score-fill" id="seoFill2"
                                            style="width:0%;background:{{ $fc }};"></div>
                                    </div>
                                    <p style="font-size:11px;color:var(--ink-4);margin:6px 0 0;">
                                        {{ $s >= 70 ? '✅ Good SEO score' : ($s >= 40 ? '⚠️ Needs improvement' : '🔴 Poor SEO score') }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

            </div>{{-- /right --}}

        </div>{{-- /bd-grid --}}
    </div>{{-- /bd-page --}}
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ── Animate SEO score bars ── */
            @if ($blog->seo_score)
                var score = {{ (int) $blog->seo_score }};
                setTimeout(function() {
                    var f1 = document.getElementById('seoFill');
                    var f2 = document.getElementById('seoFill2');
                    if (f1) f1.style.width = score + '%';
                    if (f2) f2.style.width = score + '%';
                }, 350);
            @endif

        });

        /* ── Analysis tab switcher ── */
        function switchAnalTab(key, btn) {
            document.querySelectorAll('[id^="analPanel-"]').forEach(function(el) {
                el.style.display = 'none';
            });
            document.querySelectorAll('.bd-read-tab').forEach(function(t) {
                t.classList.remove('active');
            });
            var panel = document.getElementById('analPanel-' + key);
            if (panel) panel.style.display = 'block';
            if (btn) btn.classList.add('active');
        }
    </script>
@endpush
