@extends('layouts.app')

@section('content')
    <h1 class="page-header">
        Edit SEO
    </h1>

    <div class="panel panel-inverse">

        <div class="panel-heading">
            <h4 class="panel-title">
                Edit SEO
            </h4>
        </div>

        <div class="panel-body">

            <form action="{{ route('admin.seo.update', $seo->id) }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">

                    <label>Page Name</label>

                    <input type="text" name="page_name" class="form-control" value="{{ $seo->page_name }}">

                </div>

                <div class="mb-3">

                    <label>Page Slug</label>

                    <input type="text" name="page_slug" class="form-control" value="{{ $seo->page_slug }}">

                </div>

                <div class="mb-3">

                    <label>Meta Title</label>

                    <input type="text" name="meta_title" class="form-control" value="{{ $seo->meta_title }}">

                </div>

                <div class="mb-3">

                    <label>Meta Description</label>

                    <textarea name="meta_description" class="form-control" rows="4">{{ $seo->meta_description }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Meta Keywords</label>

                    <textarea name="meta_keywords" class="form-control" rows="3">{{ $seo->meta_keywords }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Canonical URL</label>

                    <input type="text" name="canonical_url" class="form-control" value="{{ $seo->canonical_url }}">

                </div>

                <div class="mb-3">

                    <label>Robots</label>

                    <input type="text" name="robots" class="form-control" value="{{ $seo->robots }}">

                </div>

                <div class="mb-3">

                    <label>OG Title</label>

                    <input type="text" name="og_title" class="form-control" value="{{ $seo->og_title }}">

                </div>

                <div class="mb-3">

                    <label>OG Description</label>

                    <textarea name="og_description" class="form-control" rows="4">{{ $seo->og_description }}</textarea>

                </div>

                <div class="mb-3">

                    <label>OG Image</label>

                    <input type="file" name="og_image" class="form-control">

                    @if ($seo->og_image)
                        <img src="{{ asset('storage/' . $seo->og_image) }}" width="120" class="mt-2">
                    @endif

                </div>

                <button type="submit" class="btn btn-success">

                    Update SEO

                </button>

            </form>

        </div>

    </div>
@endsection
