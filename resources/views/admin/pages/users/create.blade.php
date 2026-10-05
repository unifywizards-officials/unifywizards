@extends('layouts.app')

@section('title', 'Add User')

@push('scripts')
	<script src="/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
	<script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
	<script src="/assets/js/demo/render.highlight.js"></script>
@endpush

@section('content')

	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">

		<li class="breadcrumb-item">
			<a href="{{ route('admin.home') }}">Home</a>
		</li>

		<li class="breadcrumb-item">
			<a href="{{ route('admin.users.index') }}">Users</a>
		</li>

		<li class="breadcrumb-item active">
			Add User
		</li>

	</ol>
	<!-- END breadcrumb -->


	<!-- BEGIN page-header -->
	<h1 class="page-header">
		Add User
	</h1>
	<!-- END page-header -->


	<!-- BEGIN row -->
	<div class="row">

		<div class="col-xl-12">

			<!-- BEGIN panel -->
			<div class="panel panel-inverse" data-sortable-id="form-validation-1">

				<!-- BEGIN panel-heading -->
				<div class="panel-heading">

					<h4 class="panel-title">
						Add User
					</h4>

					<div class="panel-heading-btn">

						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand">
							<i class="fa fa-expand"></i>
						</a>

						<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload">
							<i class="fa fa-redo"></i>
						</a>

						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse">
							<i class="fa fa-minus"></i>
						</a>

						<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove">
							<i class="fa fa-times"></i>
						</a>

					</div>

				</div>
				<!-- END panel-heading -->


				<!-- BEGIN panel-body -->
				<div class="panel-body">

					<form
						action="{{ route('admin.users.store') }}"
						method="POST"
						class="form-horizontal"
						data-parsley-validate="true"
					>

						@csrf

						<!-- Full Name -->
						<div class="form-group row mb-3">

							<label class="col-lg-4 col-form-label form-label">
								Full Name *
							</label>

							<div class="col-lg-8">

								<input
									class="form-control"
									type="text"
									name="name"
									value="{{ old('name') }}"
									placeholder="Enter Full Name"
									required
								/>

							</div>

						</div>


						<!-- Email -->
						<div class="form-group row mb-3">

							<label class="col-lg-4 col-form-label form-label">
								Email *
							</label>

							<div class="col-lg-8">

								<input
									class="form-control"
									type="email"
									name="email"
									value="{{ old('email') }}"
									placeholder="Enter Email"
									required
								/>

							</div>

						</div>


						<!-- Phone -->
						<div class="form-group row mb-3">

							<label class="col-lg-4 col-form-label form-label">
								Phone Number
							</label>

							<div class="col-lg-8">

								<input
									class="form-control"
									type="text"
									name="phone"
									value="{{ old('phone') }}"
									placeholder="Enter Phone Number"
								/>

							</div>

						</div>


						<!-- Password -->
						<div class="form-group row mb-3">

							<label class="col-lg-4 col-form-label form-label">
								Password *
							</label>

							<div class="col-lg-8">

								<input
									type="password"
									class="form-control"
									name="password"
									placeholder="Enter Password"
									required
								/>

							</div>

						</div>


						<!-- Confirm Password -->
						<div class="form-group row mb-3">

							<label class="col-lg-4 col-form-label form-label">
								Confirm Password *
							</label>

							<div class="col-lg-8">

								<input
									type="password"
									class="form-control"
									name="password_confirmation"
									placeholder="Confirm Password"
									required
								/>

							</div>

						</div>


						<!-- Submit -->
						<div class="form-group row">

							<label class="col-lg-4 col-form-label form-label">
								&nbsp;
							</label>

							<div class="col-lg-8">

								<button type="submit" class="btn btn-primary">
									Submit
								</button>

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