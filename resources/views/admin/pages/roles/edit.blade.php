@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item active">Edit Role</li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">Edit Role</h1>
    <!-- END page-header -->

    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                    <h4 class="panel-title">Edit Role: {{ $role->name }}</h4>
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
                <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="form-horizontal"
                        data-parsley-validate="true" name="demo-form">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="name">Role Name *</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $role->name }}" data-parsley-required="true">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="description">Description</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" id="description" name="description" rows="3">{{ $role->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="guard_name">Guard Name</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="guard_name" name="guard_name"
                                    value="{{ $role->guard_name }}">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-lg-8 offset-lg-4">
                                <div class="checkbox checkbox-css">
                                    <input type="checkbox" id="is_super_admin" name="is_super_admin" value="1"
                                        {{ $role->is_super_admin ? 'checked' : '' }}>
                                    <label for="is_super_admin">Super Admin (Full system access, bypass all
                                        permissions)</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="permissions">Permissions</label>
                            <div class="col-lg-8">
                                <select class="form-control selectpicker" id="permissions" name="permissions[]" multiple
                                    data-live-search="true" data-width="100%" style="height:300px;">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'selected' : '' }}>
                                            {{ $permission->name }} ({{ $permission->group ?? 'Ungrouped' }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 offset-lg-4">
                                <button type="submit" class="btn btn-primary">Update Role</button>
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
