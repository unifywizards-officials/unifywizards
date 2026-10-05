@extends('layouts.app')

@section('title', 'Schemas Management')

@push('css')
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .schemas-page {
            min-height: 100vh;
            background: #f1f4f8;
            padding: 32px 20px 60px;
        }

        /* ===== HEADER ===== */
        .schemas-header {
            max-width: 1100px;
            margin: 0 auto 28px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
        }

        .schemas-header h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1a202c;
            letter-spacing: -0.4px;
            margin: 0 0 4px;
        }

        .schemas-header p {
            font-size: 13px;
            color: #718096;
            margin: 0;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 20px;
            background: #5a67d8;
            color: #fff;
            font-size: 13.5px;
            font-weight: 600;
            border-radius: 9px;
            text-decoration: none;
            transition: background .2s, transform .1s;
            white-space: nowrap;
            border: none;
            cursor: pointer;
        }

        .btn-add:hover {
            background: #4c51bf;
            color: #fff;
        }

        .btn-add:active {
            transform: scale(.98);
        }

        .btn-add svg {
            opacity: .9;
        }

        /* ===== CARD ===== */
        .schemas-card {
            max-width: 1100px;
            margin: 0 auto;
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
            overflow: hidden;
        }

        /* ===== CARD TOP BAR ===== */
        .card-topbar {
            padding: 18px 28px;
            border-bottom: 1px solid #f0f4f8;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            background: #fafbfd;
        }

        .card-topbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-topbar-left h3 {
            font-size: 15px;
            font-weight: 700;
            color: #1a202c;
            margin: 0;
        }

        .total-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 24px;
            height: 22px;
            padding: 0 7px;
            background: #eef0fd;
            color: #5a67d8;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .search-input {
            padding: 8px 14px 8px 36px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 13px;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' stroke='%23a0aec0' stroke-width='2' viewBox='0 0 24 24'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='M21 21l-4.35-4.35'/%3E%3C/svg%3E") no-repeat 11px center;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            width: 240px;
            font-family: inherit;
            color: #2d3748;
        }

        .search-input:focus {
            border-color: #5a67d8;
            box-shadow: 0 0 0 3px rgba(90, 103, 216, .1);
        }

        /* ===== TABLE ===== */
        .schemas-table-wrap {
            overflow-x: auto;
        }

        table.schemas-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 620px;
        }

        .schemas-table thead tr {
            background: #f8fafc;
            border-bottom: 1px solid #edf2f7;
        }

        .schemas-table thead th {
            padding: 11px 20px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            white-space: nowrap;
        }

        .schemas-table tbody tr {
            border-bottom: 1px solid #f0f4f8;
            transition: background .15s;
        }

        .schemas-table tbody tr:last-child {
            border-bottom: none;
        }

        .schemas-table tbody tr:hover {
            background: #f7f8ff;
        }

        .schemas-table tbody td {
            padding: 13px 20px;
            font-size: 13.5px;
            color: #4a5568;
            vertical-align: middle;
        }

        .td-id {
            color: #a0aec0;
            font-size: 12.5px;
            font-weight: 600;
            font-family: monospace;
            width: 60px;
        }

        .td-pages {
            max-width: 420px;
        }

        .page-url-chip {
            display: inline-block;
            background: #f0f4ff;
            color: #4c51bf;
            font-size: 11.5px;
            padding: 3px 9px;
            border-radius: 5px;
            margin: 2px 3px 2px 0;
            font-family: 'Cascadia Code', 'Fira Code', 'Courier New', monospace;
            border: 1px solid #e0e4fc;
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            vertical-align: middle;
        }

        .more-chip {
            display: inline-block;
            background: #f1f4f8;
            color: #718096;
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 5px;
            margin: 2px 0;
            vertical-align: middle;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .status-badge.active {
            background: #c6f6d5;
            color: #276749;
        }

        .status-badge.inactive {
            background: #fed7d7;
            color: #9b2c2c;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .status-badge.active .status-dot {
            background: #38a169;
        }

        .status-badge.inactive .status-dot {
            background: #e53e3e;
        }

        /* ===== SCHEMA TAGS ===== */
        .schema-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
        }

        .schema-tag {
            font-size: 10.5px;
            padding: 2px 7px;
            border-radius: 4px;
            font-weight: 600;
            background: #eef0fd;
            color: #5a67d8;
            border: 1px solid #dde2fc;
        }

        /* ===== ACTION BUTTONS ===== */
        .action-cell {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
            font-size: 12.5px;
        }

        .action-btn.edit {
            background: #eef0fd;
            color: #4c51bf;
            border-color: #dde2fc;
        }

        .action-btn.edit:hover {
            background: #e0e3fc;
            color: #3c409a;
        }

        .action-btn.delete {
            background: #fff5f5;
            color: #c53030;
            border-color: #fed7d7;
        }

        .action-btn.delete:hover {
            background: #fed7d7;
            color: #9b2c2c;
        }

        .action-btn svg {
            pointer-events: none;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #a0aec0;
        }

        .empty-state svg {
            opacity: .35;
            margin-bottom: 14px;
        }

        .empty-state p {
            font-size: 14px;
            margin: 0;
        }

        /* ===== PAGINATION ===== */
        .card-footer {
            padding: 14px 28px;
            border-top: 1px solid #f0f4f8;
            background: #fafbfd;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pagination-info {
            font-size: 12.5px;
            color: #718096;
        }

        @media(max-width:640px) {
            .card-topbar {
                padding: 14px 16px;
            }

            .schemas-table thead th,
            .schemas-table tbody td {
                padding: 10px 12px;
            }

            .card-footer {
                padding: 12px 16px;
            }
        }
    </style>
@endpush

@section('content')

    <div class="schemas-page">

        {{-- ===== PAGE HEADER ===== --}}
        <div class="schemas-header">
            <div>
                <h1>Schemas Management</h1>
                <p>Manage SEO structured data schemas for your pages.</p>
            </div>
            <a href="{{ route('admin.schemas.create') }}" class="btn-add">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Add New Schema
            </a>
        </div>

        {{-- ===== CARD ===== --}}
        <div class="schemas-card">

            {{-- Top Bar --}}
            <div class="card-topbar">
                <div class="card-topbar-left">
                    <h3>All Schemas</h3>

                </div>
                <input type="text" id="schema-search" class="search-input" placeholder="Search by page URL..."
                    oninput="searchSchemas(this.value)" />
            </div>

            {{-- Table --}}
            <div class="schemas-table-wrap">
                <table class="schemas-table" id="schemas-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Page URL(s)</th>
                            <th>Schema Types</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schemas as $index => $schema)
                            <tr data-row>
                                <td class="td-id">#{{ $schema->id }}</td>

                                {{-- Pages --}}
                                <td class="td-pages">
                                    @php $pages = $schema->pages; @endphp
                                    @foreach ($pages->take(2) as $page)
                                        <span class="page-url-chip" title="{{ $page->page }}">{{ $page->page }}</span>
                                    @endforeach
                                    @if ($pages->count() > 2)
                                        <span class="more-chip">+{{ $pages->count() - 2 }} more</span>
                                    @endif
                                </td>

                                {{-- Schema Types --}}
                                <td>
                                    @php
                                        $types = is_array($schema->json_data)
                                            ? array_keys($schema->json_data)
                                            : array_keys((array) json_decode($schema->json_data ?? '{}', true));
                                    @endphp
                                    @if (count($types))
                                        <div class="schema-tags">
                                            @foreach (array_slice($types, 0, 4) as $t)
                                                <span class="schema-tag">{{ ucfirst($t) }}</span>
                                            @endforeach
                                            @if (count($types) > 4)
                                                <span class="more-chip">+{{ count($types) - 4 }}</span>
                                            @endif
                                        </div>
                                    @else
                                        <span style="color:#cbd5e0;font-size:12px">—</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td>
                                    @if ($schema->status)
                                        <span class="status-badge active">
                                            <span class="status-dot"></span> Active
                                        </span>
                                    @else
                                        <span class="status-badge inactive">
                                            <span class="status-dot"></span> Inactive
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td>
                                    <div class="action-cell">
                                        <a href="{{ route('admin.schemas.edit', $schema->id) }}" class="action-btn edit"
                                            title="Edit Schema">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.5">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                        </a>

                                        <form method="POST" action="{{ route('admin.schemas.destroy', $schema->id) }}"
                                            class="js-delete-form" style="margin:0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete" title="Delete Schema">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2.5">
                                                    <polyline points="3 6 5 6 21 6" />
                                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                    <path d="M10 11v6" />
                                                    <path d="M14 11v6" />
                                                    <path d="M9 6V4h6v2" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.5">
                                            <rect x="3" y="3" width="18" height="18" rx="2" />
                                            <path d="M3 9h18M9 21V9" />
                                        </svg>
                                        <p>No schemas found. <a href="{{ route('admin.schemas.create') }}"
                                                style="color:#5a67d8;font-weight:600">Create one now →</a></p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer / Pagination --}}
            @if ($schemas->count())
                <div class="card-footer">
                    <span class="pagination-info">

                    </span>
                    @if (method_exists($schemas, 'links'))
                        {{ $schemas->links() }}
                    @endif
                </div>
            @endif

        </div>

    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ===== LIVE SEARCH ===== */
            window.searchSchemas = function(value) {

                const q = value.toLowerCase().trim();
                const rows = document.querySelectorAll('#schemas-table tbody tr[data-row]');

                rows.forEach(function(row) {

                    const match = row.innerText.toLowerCase().includes(q);

                    row.style.display = match ? '' : 'none';
                });
            };

            /* ===== DELETE CONFIRMATION ===== */
            document.querySelectorAll('.js-delete-form').forEach(function(form) {

                form.addEventListener('submit', function(e) {

                    e.preventDefault();

                    Swal.fire({
                        title: 'Delete this schema?',
                        text: 'This action cannot be undone.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e53e3e',
                        cancelButtonColor: '#718096',
                        confirmButtonText: 'Yes, Delete',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {

                        if (result.isConfirmed) {
                            form.submit();
                        }

                    });

                });

            });

        });
    </script>
@endpush
