<!-- resources/views/users/profile.blade.php -->

@extends('layouts.app')

@section('title', 'User Profile')

@push('scripts')
    <script src="/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
    <script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
    <script src="/assets/js/demo/render.highlight.js"></script>
@endpush

@section('content')
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">User Profile</h1>
    <!-- END page-header -->
    <!-- BEGIN row -->
    <div class="row">
        <div class="col-xl-12">
            <!-- BEGIN panel -->
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <!-- BEGIN panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Profile Details</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
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
                    <div class="form-horizontal">
                        <div class="form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label">Full Name :</label>
                            <div class="col-lg-8">
                                <p class="form-control-static">{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label">Email :</label>
                            <div class="col-lg-8">
                                <p class="form-control-static">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label">Role :</label>
                            <div class="col-lg-8">
                                <p class="form-control-static">
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                            <div class="col-lg-8">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END panel-body -->
            </div>
            <!-- END panel -->
        </div>
    </div>
    <!-- END row -->
@endsection