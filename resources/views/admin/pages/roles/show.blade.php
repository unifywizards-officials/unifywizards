@extends('layouts.app')

@section('title', 'Role Details')

@section('content')
	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">Roles</a></li>
		<li class="breadcrumb-item active">Details</li>
	</ol>
	<!-- END breadcrumb -->
	<!-- BEGIN page-header -->
	<h1 class="page-header">Role Details</h1>
	<!-- END page-header -->

	<div class="row">
		<div class="col-xl-6">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Role #{{ $role->id }}</h4>
				</div>
				<div class="panel-body">
					<table class="table table-striped">
						<tr>
							<td class="fw-bold">ID:</td>
							<td>{{ $role->id }}</td>
						</tr>
						<tr>
							<td class="fw-bold">Name:</td>
							<td>{{ $role->name }}</td>
						</tr>
						<tr>
							<td class="fw-bold">Guard:</td>
							<td>{{ $role->guard_name }}</td>
						</tr>
						<tr>
							<td class="fw-bold">Super Admin:</td>
							<td>{{ $role->is_super_admin ? 'Yes' : 'No' }}</td>
						</tr>
						<tr>
							<td class="fw-bold">Description:</td>
							<td>{{ $role->description ?? 'N/A' }}</td>
						</tr>
						<tr>
							<td class="fw-bold">Created:</td>
							<td>{{ $role->created_at->format('M d, Y H:i') }}</td>
						</tr>
						<tr>
							<td class="fw-bold">Updated:</td>
							<td>{{ $role->updated_at->format('M d, Y H:i') }}</td>
						</tr>
					</table>

					<h5 class="mt-3">Assigned Permissions:</h5>
					<div class="mt-2">
						@if ($role->permissions->isNotEmpty())
							@foreach ($role->permissions as $permission)
								<span class="badge bg-info me-1">{{ $permission->name }}</span>
							@endforeach
						@else
							<span class="text-muted">No permissions assigned</span>
						@endif
					</div>

					<div class="mt-3">
						<a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
						<a href="{{ route('admin.roles.index') }}" class="btn btn-secondary btn-sm">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection