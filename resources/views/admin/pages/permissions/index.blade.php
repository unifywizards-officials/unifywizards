@extends('layouts.app')

@section('title', 'Permissions')

@push('css')
    <style>
        .w-125px {
            width: 125px !important;
        }
    </style>
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
        <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">Permissions</a></li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">Permissions </h1>
    <!-- END page-header -->
    <!-- BEGIN panel -->
    <div class="panel panel-inverse">
        <!-- BEGIN panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title"> <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary w-125px"
                    data-bs-toggle="tooltip" title="Add Permission">Add Permission</a></h4>
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
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <table id="data-table-default" width="100%"
                class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Group</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->group ?? 'Ungrouped' }}</td>
                            <td>{{ $permission->description ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                    class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST"
                                    class="delete-form d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fa fa-trash"></i></button>
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
                    e.preventDefault();

                    const confirmation = confirm(
                    'Are you sure you want to delete this Permission?');

                    if (confirmation) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
