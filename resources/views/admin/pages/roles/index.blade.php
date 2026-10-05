@extends('layouts.app')

@section('title', 'Roles')

@push('css')
    <style>
        .w-125px {
            width: 125px !important;
        }

        .permission-list {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: flex-start;
        }

        .permission-badge {
            white-space: nowrap;
            margin-bottom: 4px;
        }

        #data-table-default td {
            vertical-align: top;
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
        <li class="breadcrumb-item active">Roles</li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">Roles </h1>
    <!-- END page-header -->
    <!-- BEGIN panel -->
    <div class="panel panel-inverse">
        <!-- BEGIN panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title"> <a href="{{ route('admin.roles.create') }}" class="btn btn-primary w-125px"
                    data-bs-toggle="tooltip" title="Add Role">Add Role</a></h4>
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
                        <th>Guard</th>
                        <th>Super Admin</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>
                                <a
                                    href="{{ route('admin.roles.edit', $role->id) }}"><strong>{{ $role->name }}</strong></a>
                            </td>
                            <td>{{ $role->guard_name }}</td>
                            <td>
                                @if ($role->is_super_admin)
                                    <span class="badge bg-danger">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td style="min-width:320px; max-width:420px; white-space:normal;">
                                <div class="permission-list">
                                    @forelse ($role->permissions as $permission)
                                        <span class="badge bg-info permission-badge">
                                            {{ $permission->name }}
                                        </span>
                                    @empty
                                        <span class="text-muted">No permissions assigned</span>
                                    @endforelse
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fa fa-pencil"></i></a>
                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                        class="delete-form d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this role?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="margin-left:10px;"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </div>
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

                    const confirmation = confirm('Are you sure you want to delete this Role?');

                    if (confirmation) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
