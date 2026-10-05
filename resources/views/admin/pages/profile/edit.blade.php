<!-- resources/views/users/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Edit Profile')

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
        <li class="breadcrumb-item active">Edit Profile</li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">Edit Profile</h1>
    <!-- END page-header -->
    <!-- BEGIN row -->
    <div class="row">
        <div class="col-xl-12">
            <!-- BEGIN panel -->
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <!-- BEGIN panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Edit Profile</h4>
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
                    @if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
						</div>
					@endif
                    <form action="{{ route('admin.profile.update') }}" method="POST" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate="true" name="demo-form">
                        @csrf
                      
                        <div class="form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="fullname">Full Name * :</label>
                            <div class="col-lg-8">
                                <input class="form-control" type="text" id="fullname" name="name" value="{{ old('name', $user->name) }}" placeholder="Required" data-parsley-required="true" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="email">Email * :</label>
                            <div class="col-lg-8">
                                <input class="form-control" type="text" id="email" name="email" value="{{ old('email', $user->email) }}" data-parsley-type="email" placeholder="Email" data-parsley-required="true" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="password">Password :</label>
                            <div class="col-lg-8">
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="password_confirmation">Confirm Password :</label>
                            <div class="col-lg-8">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="profile_image">Profile Image :</label>
                            <div class="col-lg-8">
                                <input type="file" class="form-control" id="profile_image" name="profile_image">
                                @error('profile_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if ($user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="img-thumbnail mt-2" width="150">
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                            <div class="col-lg-8">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END panel-body -->
            </div>
            <!-- END panel -->
        </div>
    </div>
    <!-- END row -->
@endsection
