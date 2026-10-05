@extends('layouts.app')

@section('title', 'Edit Permission')

@section('content')
	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{route('admin.permissions.index')}}">Permissions</a></li>
		<li class="breadcrumb-item active">Edit Permission</li>
	</ol>
	<!-- END breadcrumb -->
	<!-- BEGIN page-header -->
	<h1 class="page-header">Edit Permission</h1>
	<!-- END page-header -->

	<div class="row">
		<div class="col-xl-12">
			<div class="panel panel-inverse" data-sortable-id="form-validation-1">
				<div class="panel-heading">
					<h4 class="panel-title">Edit Permission</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
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

					<form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST" class="form-horizontal" data-parsley-validate="true" name="demo-form">
						@csrf
						@method('PUT')
						<div class="form-group row mb-3">
							<label class="col-lg-4 col-form-label form-label" for="name">Permission Name *</label>
							<div class="col-lg-8">
								<input type="text" placeholder="e.g., manage users" value="{{$permission->name}}" class="form-control" id="name" name="name" data-parsley-required="true">
							</div>
						</div>

						<div class="form-group row mb-3">
							<label class="col-lg-4 col-form-label form-label" for="guard_name">Guard Name</label>
							<div class="col-lg-8">
								<input type="text" placeholder="web" value="{{$permission->guard_name}}" class="form-control" id="guard_name" name="guard_name">
							</div>
						</div>

						<div class="form-group row mb-3">
							<label class="col-lg-4 col-form-label form-label" for="group">Group</label>
							<div class="col-lg-8">
								<select class="form-select" id="group" name="group">
									<option value="">-- Select Group --</option>
									@foreach ($groups as $group)
										<option value="{{ $group }}" {{ $permission->group == $group ? 'selected' : '' }}>{{ ucfirst($group) }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row mb-3">
							<label class="col-lg-4 col-form-label form-label" for="description">Description</label>
							<div class="col-lg-8">
								<textarea class="form-control" id="description" name="description" rows="3">{{$permission->description}}</textarea>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-8 offset-lg-4">
								<button type="submit" class="btn btn-primary">Update Permission</button>
								<a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection