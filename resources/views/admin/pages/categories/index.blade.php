@extends('layouts.app')

@section('title', 'Categories')

@push('css')
    <link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="/assets/plugins/datatables.net/js/dataTables.min.js"></script>
    <script src="/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    {{-- <script src="/assets/js/demo/table-manage-default.demo.js"></script> --}}
    <script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
    <script src="/assets/js/demo/render.highlight.js"></script>
@endpush

@section('content')
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">Categories</h1>
    <!-- END page-header -->
    <!-- BEGIN panel -->
    <div class="panel panel-inverse">
        <!-- BEGIN panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary w-125px" data-bs-toggle="tooltip"
                    title="Add Category">Add Category</a>
            </h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i
                        class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                        class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                        class="fa fa-times"></i></a>
            </div>
        </div>
        <!-- END panel-heading -->
        <!-- BEGIN panel-body -->
        <div class="panel-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table id="data-table-default" width="100%"
                class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th width="1%"></th>
                        <th width="1%" data-orderable="false"></th>
                        <th class="text-nowrap">Category Name</th>
                        <th class="text-nowrap">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr class="odd gradeX">
                            <td width="1%" class="fw-bold">{{ $key + 1 }}</td>
                            <td width="1%" class="with-img">
                            <td>{{ $category->category_name }}</td>

                            <td>
                                <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info"
                                    data-bs-toggle="tooltip" title="Show Category"><i class="fas fa-eye"></i></a>

                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning"
                                    data-bs-toggle="tooltip" title="Edit Category"><i class="fas fa-edit"></i></a>

                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this Category?');"
                                        data-bs-toggle="tooltip" title="Delete Category"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END panel-body -->

    </div>
    <!-- END panel -->
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent default form submission

                    const confirmation = confirm('Are you sure you want to delete this Category?');

                    if (confirmation) {
                        form.submit(); // Submit form if confirmed
                    }
                });
            });
        });
    </script>
@endsection
