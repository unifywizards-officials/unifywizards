@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="page-header mb-0">
            SEO Management
        </h1>


        <a href="{{ route('admin.seo.create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i> Create SEO
        </a>


    </div>

    <div class="panel panel-inverse">


        <div class="panel-heading">
            <h4 class="panel-title">SEO Pages</h4>
        </div>

        <div class="panel-body">

            <div class="table-responsive">

                <table class="table table-striped table-bordered align-middle">

                    <thead>
                        <tr>
                            <th width="80">ID</th>
                            <th>Page Name</th>
                            <th>Slug</th>
                            <th width="220" class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($seoPages as $seo)
                            <tr>

                                <td>{{ $seo->id }}</td>

                                <td>{{ $seo->page_name }}</td>

                                <td>
                                    <code>{{ $seo->page_slug }}</code>
                                </td>

                                <td class="text-center">

                                    <a href="{{ route('admin.seo.edit', $seo->id) }}" class="btn btn-primary btn-sm me-1">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.seo.destroy', $seo->id) }}" method="POST"
                                        class="delete-form d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No SEO records found.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            @if ($seoPages->hasPages())
                <div class="mt-3">
                    {{ $seoPages->links() }}
                </div>
            @endif

        </div>


    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.delete-form').forEach(function(form) {

                form.addEventListener('submit', function(e) {

                    e.preventDefault();

                    Swal.fire({
                        title: 'Delete SEO Record?',
                        text: 'This action cannot be undone.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
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
