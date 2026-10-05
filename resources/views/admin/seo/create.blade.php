@extends('layouts.app')

@section('content')
    <h1 class="page-header">
        Create SEO </h1>


    <div class="panel panel-inverse">

        <div class="panel-heading">
            <h4 class="panel-title">
                Create SEO
            </h4>
        </div>

        <div class="panel-body">

            <form action="{{ route('admin.seo.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label>Page Name</label>
                    <input type="text" name="page_name" class="form-control" value="{{ old('page_name') }}">
                </div>

                <div class="mb-3">
                    <label>Page Slug</label>
                    <input type="text" name="page_slug" class="form-control" value="{{ old('page_slug') }}">
                </div>

                <div class="mb-3">
                    <label>Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                </div>

                <div class="mb-3">
                    <label>Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="4">{{ old('meta_description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Meta Keywords</label>
                    <textarea name="meta_keywords" class="form-control" rows="3">{{ old('meta_keywords') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Canonical URL</label>
                    <input type="text" name="canonical_url" class="form-control" value="{{ old('canonical_url') }}">
                </div>

                <div class="mb-3">
                    <label>Robots</label>
                    <input type="text" name="robots" class="form-control" value="{{ old('robots') }}">
                </div>

                <div class="mb-3">
                    <label>OG Title</label>
                    <input type="text" name="og_title" class="form-control" value="{{ old('og_title') }}">
                </div>

                <div class="mb-3">
                    <label>OG Description</label>
                    <textarea name="og_description" class="form-control" rows="4">{{ old('og_description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>OG Image</label>
                    <input type="file" name="og_image" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">
                    Create SEO
                </button>

                <a href="{{ route('admin.seo.index') }}" class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>
@endsection
