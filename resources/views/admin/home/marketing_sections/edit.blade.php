@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h3>Edit Marketing Section</h3>

        <form action="{{ route('admin.home.marketing-sections.update', $section->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ $section->title }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Highlight Text</label>
                <input type="text" name="highlight_text" value="{{ $section->highlight_text }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Subtitle</label>
                <textarea name="subtitle" class="form-control">{{ $section->subtitle }}</textarea>
            </div>

            <div class="mb-3">
                <label>Link Text</label>
                <input type="text" name="link_text" value="{{ $section->link_text }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Link URL</label>
                <input type="text" name="link_url" value="{{ $section->link_url }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $section->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$section->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button class="btn btn-primary">Update</button>
        </form>

    </div>
@endsection
