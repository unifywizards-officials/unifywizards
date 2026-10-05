@extends('layouts.app')

@section('title', 'User Roles - ' . $user->name)

@section('content')
	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Users</a></li>
		<li class="breadcrumb-item active">Assign Roles - {{ $user->name }}</li>
	</ol>
	<!-- END breadcrumb -->

	<!-- BEGIN page-header -->
	<h1 class="page-header">Assign Roles to: {{ $user->name }}</h1>
	<!-- END page-header -->

	<!-- BEGIN panel -->
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">User Role Assignment</h4>
		</div>
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

			<form action="{{ route('admin.users.roles.assign', $user->id) }}" method="POST" class="form-horizontal" data-parsley-validate="true">
				@csrf
				@method('PUT')

				<div class="mb-3">
					<label class="form-label fw-bold">Current Roles:</label>
					<div class="mt-1">
						@forelse ($user->roles as $role)
							<span class="badge bg-primary mx-1 my-1">{{ $role->name }}</span>
						@empty
							<span class="text-muted">No roles assigned</span>
						@endforelse
					</div>
				</div>

				<div class="mb-3">
					<label class="form-label fw-bold">Select Roles:</label>
					<select class="form-control selectpicker" name="roles[]" multiple data-live-search="true" data-width="100%">
						@foreach ($roles as $role)
							<option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
								{{ $role->name }} @if($role->is_super_admin) [Super Admin] @endif
							</option>
						@endforeach
					</select>
				</div>

				<div class="form-group row mt-3">
					<div class="col-lg-12">
						<button type="submit" class="btn btn-primary me-2">Save Roles</button>
						<a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection