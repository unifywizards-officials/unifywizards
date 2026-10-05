@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h3>Add Marketing Section</h3>

        <form action="{{ route('admin.home.marketing-sections.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Highlight Text</label>
                <input type="text" name="highlight_text" class="form-control">
            </div>

            <div class="mb-3">
                <label>Subtitle</label>
                <textarea name="subtitle" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Link Text</label>
                <input type="text" name="link_text" class="form-control">
            </div>

            <div class="mb-3">
                <label>Link URL</label>
                <input type="text" name="link_url" class="form-control">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <button class="btn btn-success">Save</button>
        </form>

    </div>
@endsection
