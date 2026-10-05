@extends('layouts.app')

@section('title', 'Edit Sub Categories')

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
		<li class="breadcrumb-item"><a href="{{route('admin.sub-categories.index')}}">Sub Categories</a></li>

		<form action="{{ route('admin.sub-categories.update', $SubCategory->id) }}" method="POST" class="form-horizontal" data-parsley-validate="true" name="demo-form">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-3">
							<label class="col-lg-4 col-form-label form-label" for="sub_category_name">Sub Category Name * :</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" id="sub_category_name" value="{{ $SubCategory->sub_category_name }}" name="sub_category_name" placeholder="Sub Category Name" data-parsley-required="true" />
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
				<!-- END panel-body -->

			</div>
			<!-- END panel -->
		</div>


	</div>
	<!-- END row -->
@endsection
