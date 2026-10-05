@extends('layouts.app')

@section('title', 'Permission Details')

@section('content')
	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{route('admin.permissions.index')}}">Permissions</a></li>
		<li class="breadcrumb-item active">Details</li>
	</ol>
	<!-- END breadcrumb -->
	<!-- BEGIN page-header -->
	<h1 class="page-header">Permission Details</h1>
	<!-- END page-header -->

	<div class="row">
		<div class="col-xl-6">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Permission #{{ $permission->id }}</h4>
				</div>
				<div class="panel-body">
					<table class="table table-striped">
						<tr>
							<td class="fw-bold">ID:</td>
							<td>{{ $permission->id }}</td>
						</tr>
						<tr>
							<td class="fw-bold">Name:</td>
							<td>{{ $permission->name }}</td>
						</tr>
						<tr>
							<td class="fw-bold">Guard Name:</td>
							<td>{{ $permission->guard_name }}</td>
						</tr>
						<tr>
							<td class="fw-bold">Group:</td>
							<td>{{ $permission->group ?? 'Ungrouped' }}</td>
						</tr>
						<tr>
							<td class="fw-bold">Description:</td>
							<td>{{ $permission->description ?? 'N/A' }}</td>
						</tr>
						<tr>
							<td class="fw-bold">Created:</td>
							<td>{{ $permission->created_at->format('M d, Y H:i') }}</td>
						</tr>
						<tr>
							<td class="fw-bold">Updated:</td>
							<td>{{ $permission->updated_at->format('M d, Y H:i') }}</td>
						</tr>
					</table>

					@if ($permission->roles->isNotEmpty())
					<h5 class="mt-3">Assigned to Roles:</h5>
					<div class="mt-2">
						@foreach ($permission->roles as $role)
							<span class="badge bg-primary me-1">{{ $role->name }}</span>
						@endforeach
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection