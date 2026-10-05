@extends('layouts.app')

@section('title', 'Extra Fold Management')

@section('page-title', 'Extra Fold Management')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Extra Fold</li>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .fold-wrap {
            padding: 24px 0;
        }

        .fold-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .fold-heading {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }

        .fold-subtext {
            font-size: 13px;
            color: #6b7280;
            margin: 0;
        }

        .btn-add-fold {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #348fe2;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-add-fold:hover {
            color: #fff;
            background: #1f6fb8;
        }

        .fold-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .table-toolbar {
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            width: 100%;
            height: 42px;
            border: 1px solid #dbe0e6;
            border-radius: 10px;
            padding: 0 15px 0 42px;
            font-size: 13px;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 14px;
            color: #9ca3af;
        }

        .fold-table-wrap {
            overflow-x: auto;
        }

        .fold-table {
            width: 100%;
            border-collapse: collapse;
        }

        .fold-table thead th {
            background: #f8fafc;
            padding: 14px 16px;
            font-size: 11px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            border-bottom: 1px solid #edf2f7;
        }

        .fold-table tbody td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .fold-table tbody tr:hover {
            background: #fafcff;
        }

        .fold-image {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .fold-title {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
        }

        .fold-url {
            font-size: 13px;
            color: #6b7280;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .action-group {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background: #fef9c3;
            color: #a16207;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .table-footer {
            padding: 18px 20px;
        }

        /* ===== Pagination design fix ===== */
        .table-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .table-footer .footer-info {
            font-size: 13px;
            color: #6b7280;
        }

        .pagination {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 6px;
        }

        .pagination .page-item .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #374151;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            line-height: 1;
            transition: all 0.15s ease-in-out;
        }

        .pagination .page-item .page-link i {
            font-size: 12px;
        }

        .pagination .page-item .page-link:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: #111827;
        }

        .pagination .page-item.active .page-link {
            background: #348fe2;
            border-color: #348fe2;
            color: #fff;
            box-shadow: 0 4px 10px rgba(52, 143, 226, 0.35);
        }

        .pagination .page-item.disabled .page-link {
            background: #f9fafb;
            color: #d1d5db;
            border-color: #edf2f7;
            cursor: not-allowed;
        }

        .pagination .page-item.disabled .page-link:hover {
            background: #f9fafb;
            color: #d1d5db;
            border-color: #edf2f7;
        }
    </style>
@endpush

@section('content')

    <div class="fold-wrap">

        <div class="fold-topbar">
            <div>
                <h2 class="fold-heading">Extra Fold Management</h2>
                <p class="fold-subtext">{{ $folds->total() }} folds available</p>
            </div>
            <a href="{{ route('admin.extrafold.create') }}" class="btn-add-fold">
                <i class="fa fa-plus"></i> Add Extra Fold
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="fold-card">

            <div class="table-toolbar">
                <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="text" id="foldSearch" placeholder="Search folds...">
                </div>
            </div>

            <div class="fold-table-wrap">
                <table class="fold-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Page URL</th>
                            <th>Title</th>
                            <th>Heading</th>
                            <th>Button Name</th>
                            <th>Button URL</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($folds as $fold)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($fold->image)
                                        <img src="{{ asset('storage/' . $fold->image) }}" class="fold-image">
                                    @else
                                        <img src="https://via.placeholder.com/70x70?text=No+Image" class="fold-image">
                                    @endif
                                </td>
                                <td><span class="fold-url">{{ $fold->page_url }}</span></td>
                                <td><span class="fold-title">{{ $fold->title }}</span></td>
                                <td>{{ Str::limit($fold->heading, 40) }}</td>
                                <td>{{ $fold->button_name ?? '-' }}</td>
                                <td>{{ $fold->button_url ?? '-' }}</td>
                                <td>{{ $fold->sort_order }}</td>
                                <td>
                                    @if ($fold->status)
                                        <span class="status-badge status-active">Active</span>
                                    @else
                                        <span class="status-badge status-inactive">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-group">
                                        <a href="{{ route('admin.extrafold.edit', $fold->id) }}"
                                            class="action-btn btn-edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        {{-- Hidden delete form --}}
                                        <form id="delete-form-{{ $fold->id }}"
                                            action="{{ route('admin.extrafold.destroy', $fold->id) }}" method="POST"
                                            style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <button type="button" class="action-btn btn-delete"
                                            onclick="confirmDelete({{ $fold->id }}, '{{ addslashes($fold->title) }}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5">No Extra Fold Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <div class="footer-info">
                    Showing {{ $folds->firstItem() ?? 0 }} to {{ $folds->lastItem() ?? 0 }} of {{ $folds->total() }}
                    results
                </div>

                @if ($folds->hasPages())
                    <nav aria-label="Pagination">
                        <ul class="pagination">
                            {{-- Previous --}}
                            @if ($folds->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="fa fa-chevron-left"></i></span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $folds->previousPageUrl() }}"><i
                                            class="fa fa-chevron-left"></i></a>
                                </li>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach ($folds->getUrlRange(1, $folds->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $folds->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            {{-- Next --}}
                            @if ($folds->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $folds->nextPageUrl() }}"><i
                                            class="fa fa-chevron-right"></i></a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="fa fa-chevron-right"></i></span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Search
        document.getElementById('foldSearch').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            document.querySelectorAll('.fold-table tbody tr').forEach(function(row) {
                row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
            });
        });

        // Delete confirmation modal
        function confirmDelete(id, title) {
            Swal.fire({
                title: 'Delete Fold?',
                html: 'Are you sure you want to delete <strong>' + title +
                    '</strong>?<br><small class="text-muted">This action cannot be undone.</small>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa fa-trash me-1"></i> Yes, Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                focusCancel: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endpush
