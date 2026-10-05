@extends('layouts.app')

@section('title', 'Blogs')

@section('page-title', 'Blogs Management')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.home') }}">
            Dashboard
        </a>
    </li>

    <li class="breadcrumb-item active">
        Blogs
    </li>
@endsection

@push('css')
    <style>
        .blogs-wrap {
            padding: 24px 0;
        }

        .blogs-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .blogs-heading {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }

        .blogs-subtext {
            font-size: 13px;
            color: #6b7280;
            margin: 0;
        }

        .btn-add-blog {
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
            transition: 0.3s;
        }

        .btn-add-blog:hover {
            background: #1f6fb8;
            color: #fff;
            text-decoration: none;
        }

        .blogs-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .table-toolbar {
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
            width: 280px;
        }

        .search-box input {
            width: 100%;
            height: 42px;
            border: 1px solid #dbe0e6;
            border-radius: 10px;
            padding: 0 15px 0 42px;
            font-size: 13px;
            outline: none;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 14px;
            color: #9ca3af;
            font-size: 13px;
        }

        .blogs-table-wrap {
            overflow-x: auto;
        }

        .blogs-tbl {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
        }

        .blogs-tbl thead th {
            background: #f8fafc;
            border-bottom: 1px solid #edf2f7;
            padding: 14px 16px;
            font-size: 11px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            white-space: nowrap;
        }

        .blogs-tbl tbody td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
            color: #374151;
        }

        .blogs-tbl tbody tr:hover {
            background: #fafcff;
        }

        .blog-thumb {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .blog-title {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 5px;
        }

        .blog-desc {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.6;
            max-width: 320px;
        }

        .author-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .author-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #dbeafe;
            color: #1d4ed8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .author-name {
            font-weight: 600;
            color: #111827;
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

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-draft {
            background: #fee2e2;
            color: #991b1b;
        }

        .action-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-view {
            background: #eff6ff;
            color: #2563eb;
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

        .pagination {
            margin-bottom: 0;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 4px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .pagination .page-item .page-link {
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #374151;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s;
            line-height: 1;
        }

        .pagination .page-item .page-link:hover {
            background: #eff6ff;
            border-color: #348fe2;
            color: #348fe2;
        }

        .pagination .page-item.active .page-link {
            background: #348fe2;
            border-color: #348fe2;
            color: #fff;
            font-weight: 700;
        }

        .pagination .page-item.disabled .page-link {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }

        @media(max-width:768px) {

            .table-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')

    <div class="blogs-wrap">

        <!-- TOPBAR -->
        <div class="blogs-topbar">

            <div>

                <h2 class="blogs-heading">
                    All Blogs
                </h2>

                <p class="blogs-subtext">
                    {{ $blogs->total() }} articles total
                </p>

            </div>

               @can('create-blog')
                <a href="{{ route('admin.blogs.create') }}" class="btn-add-blog">

                    <i class="fa fa-plus"></i>

                    Add New Blog

                </a>
            @endcan

        </div>

        <!-- CARD -->
        <div class="blogs-card">

            <!-- TOOLBAR -->
            <div class="table-toolbar">

                <div class="search-box">

                    <i class="fa fa-search"></i>

                    <input type="text" id="blogSearch" placeholder="Search blogs...">

                </div>

            </div>

            <!-- TABLE -->
            <div class="blogs-table-wrap">

                <table class="blogs-tbl">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Image</th>

                            <th>Blog Details</th>

                            <th>Focus Keyword</th>

                            <th>Author</th>

                            <th>Status</th>

                            <th>Published Date</th>

                            <th>SEO Score</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($blogs as $blog)
                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>

                                    @if ($blog->featured_image)
                                        <img src="{{ asset('storage/' . $blog->featured_image) }}" class="blog-thumb">
                                    @else
                                        <img src="https://via.placeholder.com/70x70.png?text=No+Image" class="blog-thumb">
                                    @endif

                                </td>

                                <td>

                                    <div class="blog-title">
                                        {{ $blog->title }}
                                    </div>

                                    <div class="blog-desc">

                                        {{ \Illuminate\Support\Str::limit(strip_tags($blog->excerpt ?? $blog->content), 120) }}

                                    </div>

                                </td>

                                <td>
                                    {{ $blog->focus_keyword ?? 'N/A' }}
                                </td>

                                <td>

                                    <div class="author-wrap">

                                        <div class="author-avatar">

                                            {{ strtoupper(substr($blog->user->name ?? 'A', 0, 2)) }}

                                        </div>

                                        <div class="author-name">

                                            {{ $blog->user->name ?? 'Admin' }}

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    @if ($blog->status == 'published')
                                        <span class="status-badge status-active">

                                            <span class="status-dot"></span>

                                            Published

                                        </span>
                                    @else
                                        <span class="status-badge status-draft">

                                            <span class="status-dot"></span>

                                            Draft

                                        </span>
                                    @endif

                                </td>

                                <td>

                                    {{ $blog->published_at ? $blog->published_at->format('d M Y') : 'N/A' }}

                                </td>

                                <td>

                                    <strong>
                                        {{ $blog->seo_score }}/100
                                    </strong>

                                </td>

                                <td>

                                     <div class="action-group">

                                        {{-- VIEW --}}
                                        @can('view-blog')
                                            <a href="{{ route('admin.blogs.show', $blog->id) }}" target="_blank"
                                                class="action-btn btn-view">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        @endcan

                                        {{-- EDIT --}}
                                        @can('edit-blog')
                                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="action-btn btn-edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan

                                        {{-- DELETE --}}
                                        @can('delete-blog')
                                            <button type="button" class="action-btn btn-delete deleteBlogBtn"
                                                data-url="{{ route('admin.blogs.destroy', $blog->id) }}"
                                                data-title="{{ $blog->title }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan

                                        {{-- HISTORY --}}
                                        @can('history-blog')
                                            <a href="{{ route('admin.blogs.history', $blog->id) }}" class="action-btn btn-view"
                                                title="View History">
                                                <i class="fa fa-history"></i>
                                            </a>
                                        @endcan

                                    </div>

                                </td>

                            </tr>
                        @empty

                            <tr>

                                <td colspan="9" class="text-center py-5">

                                    <div class="text-muted">

                                        No blogs found.

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- FOOTER -->
            <div class="table-footer">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div style="font-size:13px; color:#6b7280;">
                        Showing {{ $blogs->firstItem() ?? 0 }}
                        to {{ $blogs->lastItem() ?? 0 }}
                        of {{ $blogs->total() }} entries
                    </div>
                    <div>
                        {{ $blogs->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

        </div>

    </div>


    <!-- Delete Blog Modal -->
    <div class="modal fade" id="deleteBlogModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Delete Blog
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body text-center">

                    <i class="fa fa-trash text-danger mb-3" style="font-size:60px;">
                    </i>

                    <h4>
                        Are you sure?
                    </h4>

                    <p class="text-muted">
                        You are about to delete:
                    </p>

                    <strong id="deleteBlogTitle"></strong>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <form id="deleteBlogForm" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            Yes, Delete
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const deleteModalElement =
                document.getElementById('deleteBlogModal');

            const deleteModal =
                new bootstrap.Modal(deleteModalElement);

            const deleteForm =
                document.getElementById('deleteBlogForm');

            const deleteTitle =
                document.getElementById('deleteBlogTitle');

            document.querySelectorAll('.deleteBlogBtn')
                .forEach(button => {

                    button.addEventListener('click', function() {

                        deleteForm.action =
                            this.dataset.url;

                        deleteTitle.innerText =
                            this.dataset.title;

                        deleteModal.show();

                    });

                });

            // Add search functionality
            const searchInput = document.getElementById('blogSearch');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.trim().toLowerCase();
                    const rows = document.querySelectorAll('.blogs-tbl tbody tr');

                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }

        });
    </script>
@endpush
