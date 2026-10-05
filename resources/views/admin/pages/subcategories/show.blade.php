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
    <h1 class="page-header">View Sub Category</h1>

    <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-secondary mt-3">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
