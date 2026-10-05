@extends('layouts.app')

@section('title', 'View Categories')

@push('scripts')
    <script src="/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
    <script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
    <script src="/assets/js/demo/render.highlight.js"></script>
@endpush

@section('content')
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
        <li class="breadcrumb-item active">View Category</li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">View Category</h1>
    <!-- END page-header -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                    <h4 class="panel-title">View Category</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Category Name:</th>
                            <td class="p-0">{{ $category->category_name }}</td>
                        </tr>

                    </table>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mt-3">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
