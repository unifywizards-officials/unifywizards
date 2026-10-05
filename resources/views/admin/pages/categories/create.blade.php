@extends('layouts.app')

@section('title', 'Add Categories')


@push('css')
	<link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

    @endpush

@push('scripts')
	<script src="/assets/plugins/moment/min/moment.min.js"></script>
	<script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="/assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script src="/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
	<script src="/assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
	<script src="/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="/assets/plugins/tag-it/js/tag-it.min.js"></script>
	<script src="/assets/plugins/clipboard/dist/clipboard.min.js"></script>
	<script src="/assets/plugins/spectrum-colorpicker2/dist/spectrum.min.js"></script>
	<script src="/assets/plugins/select-picker/dist/picker.min.js"></script>
	<script src="/assets/js/demo/form-plugins.demo.js"></script>
	<script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
	<script src="/assets/js/demo/render.highlight.js"></script>

    <script src="/assets/plugins/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
	<script src="/assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js"></script>
	<script src="/assets/js/demo/form-wysiwyg.demo.js"></script>
	<script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
	<script src="/assets/js/demo/render.highlight.js"></script>
@endpush

@section('content')
	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{route('admin.categories.index')}}">Categories</a></li>
		<li class="breadcrumb-item active">Add Category</li>
	</ol>
	<!-- END breadcrumb -->
	<!-- BEGIN page-header -->
	<h1 class="page-header">Add Category</small></h1>
	<!-- END page-header -->
	<!-- BEGIN row -->
	<div class="row">

		<div class="col-xl-12">
			<!-- BEGIN panel -->
			<div class="panel panel-inverse" data-sortable-id="form-validation-1">
				<!-- BEGIN panel-heading -->
				<div class="panel-heading">
					<h4 class="panel-title">Add Category</h4>
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
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
						</div>
					@endif
					<form action="{{ route('admin.categories.store') }}" method="POST" class="form-horizontal" data-parsley-validate="true" name="demo-form">
                        @csrf



          <div class="form-group row mb-3">
						<label class="col-lg-4 col-form-label form-label" for="category_name">Category Name * :</label>
						<div class="col-lg-8">
							<input class="form-control" type="text" id="category_name" value="{{old('category_name')}}" name="category_name" placeholder="Category Name" data-parsley-required="true" />
						</div>
					</div>



						<div class="form-group row">
							<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
							<div class="col-lg-8">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
