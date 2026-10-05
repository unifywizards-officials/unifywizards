@extends('layouts.app')

@section('title', 'Blog History')

@push('css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0f1117;
            --ink-2: #374151;
            --ink-3: #6b7280;
            --ink-4: #9ca3af;
            --border: #e5e7eb;
            --border-2: #f3f4f6;
            --bg: #f9fafb;
            --white: #ffffff;
            --accent: #4361ee;
            --accent-bg: #eef0fd;
            --green: #16a34a;
            --green-bg: #dcfce7;
            --amber: #b45309;
            --amber-bg: #fef3c7;
            --red: #dc2626;
            --red-bg: #fee2e2;
            --radius: 12px;
            --radius-sm: 8px;
            --shadow: 0 1px 3px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, .07), 0 2px 4px -1px rgba(0, 0, 0, .04);
        }

        * {
            box-sizing: border-box;
        }

        .hp-wrap {
            font-family: 'Inter', -apple-system, sans-serif;
            max-width: 1200px;
            padding-bottom: 48px;
        }

        /* ── Topbar ── */
        .hp-topbar {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .hp-btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 500;
            color: var(--ink-3);
            text-decoration: none;
            transition: all .15s;
        }

        .hp-btn-back:hover {
            background: var(--bg);
            color: var(--ink);
            text-decoration: none;
            border-color: #d1d5db;
        }

        .hp-btn-back svg {
            width: 14px;
            height: 14px;
            stroke-width: 2;
            flex-shrink: 0;
        }

        /* ── Page Title Row ── */
        .hp-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .hp-page-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--ink);
            margin: 0;
            letter-spacing: -0.025em;
        }

        .hp-page-subtitle {
            font-size: 13px;
            color: var(--ink-4);
            margin: 3px 0 0;
        }

        /* ── Cards ── */
        .hp-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 16px;
            overflow: hidden;
        }

        /* ── Blog Hero Strip ── */
        .hp-hero {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--border-2);
        }

        .hp-hero-img {
            width: 64px;
            height: 64px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid var(--border);
            flex-shrink: 0;
        }

        .hp-hero-placeholder {
            width: 64px;
            height: 64px;
            border-radius: 10px;
            background: var(--bg);
            border: 1px dashed var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .hp-hero-placeholder svg {
            width: 22px;
            height: 22px;
            stroke: var(--ink-4);
            stroke-width: 1.5;
        }

        .hp-hero-info {
            flex: 1;
            min-width: 0;
        }

        .hp-hero-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--ink);
            margin: 0 0 8px;
            line-height: 1.4;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .hp-hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
        }

        .hp-chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 99px;
            font-size: 11.5px;
            font-weight: 500;
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--ink-3);
            white-space: nowrap;
        }

        .hp-chip svg {
            width: 10px;
            height: 10px;
            stroke: var(--ink-4);
            stroke-width: 2;
            flex-shrink: 0;
        }

        .hp-chip-accent {
            background: var(--accent-bg);
            border-color: #c7d2fe;
            color: var(--accent);
            font-family: 'Courier New', monospace;
            font-size: 11px;
        }

        .hp-chip-accent svg {
            stroke: var(--accent);
        }

        /* status badge */
        .hp-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 11px;
            border-radius: 99px;
            font-size: 11.5px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .hp-status .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .hp-status-published {
            background: var(--green-bg);
            color: var(--green);
        }

        .hp-status-draft {
            background: var(--amber-bg);
            color: var(--amber);
        }

        .hp-status-archived {
            background: var(--bg);
            color: var(--ink-3);
            border: 1px solid var(--border);
        }

        /* ── Stats Strip ── */
        .hp-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }

        .hp-stat {
            padding: 16px 20px;
            border-right: 1px solid var(--border-2);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hp-stat:last-child {
            border-right: none;
        }

        .hp-stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .hp-stat-icon svg {
            width: 16px;
            height: 16px;
            stroke-width: 1.8;
        }

        .hp-stat-icon-total {
            background: #f0f0fe;
        }

        .hp-stat-icon-total svg {
            stroke: var(--accent);
        }

        .hp-stat-icon-create {
            background: var(--green-bg);
        }

        .hp-stat-icon-create svg {
            stroke: var(--green);
        }

        .hp-stat-icon-update {
            background: var(--amber-bg);
        }

        .hp-stat-icon-update svg {
            stroke: var(--amber);
        }

        .hp-stat-num {
            font-size: 22px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
            letter-spacing: -0.03em;
        }

        .hp-stat-lbl {
            font-size: 11.5px;
            color: var(--ink-4);
            font-weight: 500;
            margin-top: 2px;
        }

        .hp-stat-num-green {
            color: var(--green);
        }

        .hp-stat-num-amber {
            color: var(--amber);
        }

        /* ── Table Card Header ── */
        .hp-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 20px;
            border-bottom: 1px solid var(--border-2);
            gap: 12px;
        }

        .hp-table-header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .hp-table-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: var(--amber-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .hp-table-icon svg {
            width: 14px;
            height: 14px;
            stroke: var(--amber);
            stroke-width: 1.8;
        }

        .hp-tbl-title {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--ink);
        }

        .hp-tbl-sub {
            font-size: 11.5px;
            color: var(--ink-4);
            margin-top: 1px;
        }

        .hp-count-pill {
            padding: 3px 11px;
            border-radius: 99px;
            font-size: 11.5px;
            font-weight: 600;
            background: var(--accent-bg);
            color: var(--accent);
            border: 1px solid #c7d2fe;
        }

        /* ── Table ── */
        .hp-table {
            width: 100%;
            border-collapse: collapse;
        }

        .hp-table thead th {
            padding: 10px 16px;
            font-size: 10.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--ink-4);
            background: var(--bg);
            border-bottom: 1px solid var(--border);
            text-align: left;
            white-space: nowrap;
        }

        .hp-table tbody td {
            padding: 13px 16px;
            border-bottom: 1px solid var(--border-2);
            vertical-align: middle;
        }

        .hp-table tbody tr:last-child td {
            border-bottom: none;
        }

        .hp-table tbody tr {
            transition: background .12s;
            opacity: 0;
            animation: rowIn .3s ease forwards;
        }

        @keyframes rowIn {
            from {
                opacity: 0;
                transform: translateY(4px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .hp-table tbody tr:hover {
            background: #fafbff;
        }

        /* Stagger animation delays */
        .hp-table tbody tr:nth-child(1) {
            animation-delay: .04s
        }

        .hp-table tbody tr:nth-child(2) {
            animation-delay: .08s
        }

        .hp-table tbody tr:nth-child(3) {
            animation-delay: .12s
        }

        .hp-table tbody tr:nth-child(4) {
            animation-delay: .16s
        }

        .hp-table tbody tr:nth-child(5) {
            animation-delay: .20s
        }

        .hp-table tbody tr:nth-child(6) {
            animation-delay: .24s
        }

        .hp-table tbody tr:nth-child(7) {
            animation-delay: .28s
        }

        .hp-table tbody tr:nth-child(8) {
            animation-delay: .32s
        }

        .hp-table tbody tr:nth-child(9) {
            animation-delay: .36s
        }

        .hp-table tbody tr:nth-child(10) {
            animation-delay: .40s
        }

        /* ── Row #  ── */
        .hp-row-num {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--bg);
            border: 1px solid var(--border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            color: var(--ink-3);
        }

        /* ── Action Badge ── */
        .hp-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 11px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .hp-action svg {
            width: 11px;
            height: 11px;
            stroke-width: 2.2;
        }

        .hp-action-created {
            background: var(--green-bg);
            color: var(--green);
        }

        .hp-action-created svg {
            stroke: var(--green);
        }

        .hp-action-updated {
            background: var(--amber-bg);
            color: var(--amber);
        }

        .hp-action-updated svg {
            stroke: var(--amber);
        }

        .hp-action-deleted {
            background: var(--red-bg);
            color: var(--red);
        }

        .hp-action-deleted svg {
            stroke: var(--red);
        }

        /* ── Blog title cell ── */
        .hp-blog-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--ink);
            line-height: 1.45;
            max-width: 240px;
        }

        .hp-blog-id {
            font-size: 11px;
            color: var(--ink-4);
            margin-top: 2px;
            font-family: 'Courier New', monospace;
        }

        /* ── User cell ── */
        .hp-user {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .hp-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #eef0fd, #c7d2fe);
            border: 1px solid #c7d2fe;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: var(--accent);
            flex-shrink: 0;
            letter-spacing: .04em;
        }

        .hp-uname {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            line-height: 1.3;
        }

        .hp-uemail {
            font-size: 11px;
            color: var(--ink-4);
            margin-top: 1px;
        }

        /* ── Date / Time cells ── */
        .hp-day-main {
            font-size: 13px;
            font-weight: 500;
            color: var(--ink);
        }

        .hp-day-short {
            font-size: 11px;
            color: var(--ink-4);
            margin-top: 1px;
        }

        .hp-date-main {
            font-size: 13px;
            font-weight: 500;
            color: var(--ink);
        }

        .hp-date-ago {
            font-size: 11px;
            color: var(--ink-4);
            margin-top: 1px;
        }

        .hp-time-12 {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            letter-spacing: .01em;
        }

        .hp-time-24 {
            font-size: 11px;
            color: var(--ink-4);
            margin-top: 1px;
            font-family: 'Courier New', monospace;
            font-variant-numeric: tabular-nums;
        }

        /* ── Empty state ── */
        .hp-empty {
            padding: 60px 24px;
            text-align: center;
        }

        .hp-empty-icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
        }

        .hp-empty-icon svg {
            width: 24px;
            height: 24px;
            stroke: var(--ink-4);
            stroke-width: 1.5;
        }

        .hp-empty h4 {
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
            margin: 0 0 5px;
        }

        .hp-empty p {
            font-size: 13px;
            color: var(--ink-4);
            margin: 0;
        }

        /* ── Pagination footer ── */
        .hp-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            padding: 13px 20px;
            border-top: 1px solid var(--border-2);
            font-size: 12.5px;
            color: var(--ink-4);
            background: var(--bg);
        }

        .hp-footer .pagination {
            margin: 0;
        }

        @media(max-width:768px) {
            .hp-stats {
                grid-template-columns: 1fr;
            }

            .hp-stat {
                border-right: none;
                border-bottom: 1px solid var(--border-2);
            }

            .hp-stat:last-child {
                border-bottom: none;
            }

            .hp-hero {
                flex-wrap: wrap;
            }
        }
    </style>
@endpush

@section('content')
    <div class="hp-wrap">

        {{-- ── Topbar ── --}}
        <div class="hp-topbar">
            <a href="{{ route('admin.blogs.index') }}" class="hp-btn-back">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M19 12H5M12 5l-7 7 7 7" />
                </svg>
                All Blogs
            </a>
            <a href="{{ route('admin.blogs.show', $blog) }}" class="hp-btn-back">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
                View Post
            </a>
        </div>

        {{-- ── Page Heading ── --}}
        <div class="hp-page-header">
            <div>
                <h1 class="hp-page-title">Blog History</h1>
                <p class="hp-page-subtitle">Complete activity log for this post</p>
            </div>
            {{-- Status --}}
            @if ($blog->status === 'published')
                <span class="hp-status hp-status-published"><span class="dot"></span> Published</span>
            @elseif ($blog->status === 'draft')
                <span class="hp-status hp-status-draft"><span class="dot"></span> Draft</span>
            @else
                <span class="hp-status hp-status-archived"><span class="dot"></span> Archived</span>
            @endif
        </div>

        {{-- ════════ Blog Summary Card ════════ --}}
        <div class="hp-card">

            {{-- Blog Hero --}}
            <div class="hp-hero">
                @if ($blog->featured_image)
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}"
                        class="hp-hero-img">
                @else
                    <div class="hp-hero-placeholder">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <rect x="3" y="3" width="18" height="18" rx="2" />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <path d="M21 15l-5-5L5 21" />
                        </svg>
                    </div>
                @endif

                <div class="hp-hero-info">
                    <p class="hp-hero-title" title="{{ $blog->title }}">{{ $blog->title }}</p>
                    <div class="hp-hero-meta">
                        @if ($blog->slug)
                            <span class="hp-chip hp-chip-accent">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71" />
                                    <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71" />
                                </svg>
                                /{{ $blog->slug }}
                            </span>
                        @endif
                        <span class="hp-chip">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            {{ $blog->user->name ?? 'N/A' }}
                        </span>
                        <span class="hp-chip">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            Created {{ $blog->created_at->format('M d, Y') }}
                        </span>
                        <span class="hp-chip">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            {{ $blog->updated_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Stats Strip --}}
            @php
                $totalCount = $histories->total();
                $createdCount = $blog->histories()->where('action', 'Created')->count();
                $updatedCount = $blog->histories()->where('action', 'Updated')->count();
            @endphp
            <div class="hp-stats">
                <div class="hp-stat">
                    <div class="hp-stat-icon hp-stat-icon-total">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="hp-stat-num">{{ $totalCount }}</div>
                        <div class="hp-stat-lbl">Total Actions</div>
                    </div>
                </div>
                <div class="hp-stat">
                    <div class="hp-stat-icon hp-stat-icon-create">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 8v8M8 12h8" />
                        </svg>
                    </div>
                    <div>
                        <div class="hp-stat-num hp-stat-num-green">{{ $createdCount }}</div>
                        <div class="hp-stat-lbl">Created</div>
                    </div>
                </div>
                <div class="hp-stat">
                    <div class="hp-stat-icon hp-stat-icon-update">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                    </div>
                    <div>
                        <div class="hp-stat-num hp-stat-num-amber">{{ $updatedCount }}</div>
                        <div class="hp-stat-lbl">Updated</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ════════ Activity Table Card ════════ --}}
        <div class="hp-card">

            {{-- Card Header --}}
            <div class="hp-table-header">
                <div class="hp-table-header-left">
                    <div class="hp-table-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <div class="hp-tbl-title">Activity Log</div>
                        <div class="hp-tbl-sub">
                            Showing {{ $histories->firstItem() }}–{{ $histories->lastItem() }}
                            of {{ $histories->total() }} record(s)
                        </div>
                    </div>
                </div>
                <span class="hp-count-pill">{{ $histories->total() }} Records</span>
            </div>

            @if ($histories->isEmpty())
                <div class="hp-empty">
                    <div class="hp-empty-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4>No History Found</h4>
                    <p>No activity has been recorded for this blog post yet.</p>
                </div>
            @else
                <div style="overflow-x:auto;">
                    <table class="hp-table">
                        <thead>
                            <tr>
                                <th style="width:48px;">#</th>
                                <th style="width:120px;">Action</th>
                                <th>Blog Title</th>
                                <th>User</th>
                                <th style="width:100px;">Day</th>
                                <th style="width:130px;">Date</th>
                                <th style="width:110px;">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $index => $history)
                                @php
                                    $al = strtolower($history->action);
                                    $aClass = match ($al) {
                                        'created' => 'hp-action-created',
                                        'deleted' => 'hp-action-deleted',
                                        default => 'hp-action-updated',
                                    };
                                    $aIcon = match ($al) {
                                        'created' => '<circle cx="12" cy="12" r="10"/><path d="M12 8v8M8 12h8"/>',
                                        'deleted'
                                            => '<path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>',
                                        default
                                            => '<path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>',
                                    };
                                    $user = $history->user;
                                    $uName = $user->name ?? 'Unknown';
                                    $uEmail = $user->email ?? '';
                                    $init = collect(explode(' ', $uName))
                                        ->take(2)
                                        ->map(fn($w) => strtoupper($w[0] ?? ''))
                                        ->implode('');
                                    $rowNum = ($histories->currentPage() - 1) * $histories->perPage() + $index + 1;
                                    $dt = $history->created_at;
                                @endphp
                                <tr>
                                    {{-- # --}}
                                    <td>
                                        <span class="hp-row-num">{{ $rowNum }}</span>
                                    </td>

                                    {{-- Action --}}
                                    <td>
                                        <span class="hp-action {{ $aClass }}">
                                            <svg viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor">{!! $aIcon !!}</svg>
                                            {{ $history->action }}
                                        </span>
                                    </td>

                                    {{-- Blog Title --}}
                                    <td>
                                        <div class="hp-blog-name">{{ Str::limit($history->blog_title, 50) }}</div>
                                        <div class="hp-blog-id">Blog #{{ $history->blog_id }}</div>
                                    </td>

                                    {{-- User --}}
                                    <td>
                                        <div class="hp-user">
                                            <div class="hp-avatar">{{ $init }}</div>
                                            <div>
                                                <div class="hp-uname">{{ $uName }}</div>
                                                @if ($uEmail)
                                                    <div class="hp-uemail">{{ $uEmail }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Day --}}
                                    <td>
                                        <div class="hp-day-main">{{ $dt->format('l') }}</div>
                                        <div class="hp-day-short">{{ $dt->format('D, d') }}</div>
                                    </td>

                                    {{-- Date --}}
                                    <td>
                                        <div class="hp-date-main">{{ $dt->format('M d, Y') }}</div>
                                        <div class="hp-date-ago">{{ $dt->diffForHumans() }}</div>
                                    </td>

                                    {{-- Time --}}
                                    @php
                                        $dt = $history->created_at->copy()->timezone('Asia/Kolkata');
                                    @endphp

                                    <td>
                                        <div class="hp-time-12">{{ $dt->format('h:i A') }}</div>
                                        <div class="hp-time-24">{{ $dt->format('H:i:s') }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Footer / Pagination --}}
                <div class="hp-footer">
                    <span>
                        Showing
                        <strong style="color:var(--ink-2);">{{ $histories->firstItem() }}</strong>
                        –
                        <strong style="color:var(--ink-2);">{{ $histories->lastItem() }}</strong>
                        of
                        <strong style="color:var(--ink-2);">{{ $histories->total() }}</strong>
                        records
                    </span>
                    @if ($histories->hasPages())
                        {{ $histories->links() }}
                    @endif
                </div>

            @endif
        </div>{{-- /table card --}}

    </div>
@endsection
