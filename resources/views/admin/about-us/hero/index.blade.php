@extends('layouts.app')

@section('content')
    <h1 class="page-header">
        Manage Hero Section
    </h1>

    <div class="panel panel-inverse">

        <div class="panel-heading">
            <h4 class="panel-title">Hero CMS</h4>
        </div>

        <div class="panel-body">

            <form action="{{ route('admin.about-us.hero.update', $hero->id ?? null) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @php
                    //dd($hero->description);
                @endphp
                @php
                    $desc = json_decode($hero->description ?? '{}', true);
                @endphp

                <div class="row">

                    {{-- SMALL LABEL --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Small Label</label>
                        <input type="text" name="small_label" class="form-control" value="{{ $hero->subtitle ?? '' }}">
                    </div>

                    {{-- MAIN HEADING --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Main Heading</label>
                        <input type="text" name="main_heading" class="form-control" value="{{ $hero->title ?? '' }}">
                    </div>

                    {{-- HIGHLIGHT TEXT --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Highlight Text</label>
                        <input type="text" name="highlight_text" class="form-control"
                            value="{{ $desc['highlight_text'] ?? '' }}">
                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="1" {{ ($hero->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ ($hero->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $desc['description'] ?? '' }}</textarea>
                    </div>

                    {{-- BUTTON 1 --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 1 Text</label>
                        <input type="text" name="button_1_text" class="form-control"
                            value="{{ $hero->button_text ?? '' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 1 URL</label>
                        <input type="text" name="button_1_url" class="form-control"
                            value="{{ $hero->button_link ?? '' }}">
                    </div>

                    {{-- BUTTON 2 --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 2 Text</label>
                        <input type="text" name="button_2_text" class="form-control"
                            value="{{ $hero->button_text2 ?? '' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 2 URL</label>
                        <input type="text" name="button_2_url" class="form-control"
                            value="{{ $hero->button_link2 ?? '' }}">
                    </div>

                    {{-- IMAGE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Background Image</label>
                        <input type="file" name="background_image" class="form-control">

                        @if (!empty($hero->image))
                            <img src="{{ asset($hero->image) }}" style="width:120px; margin-top:10px; border-radius:8px;">
                        @endif
                    </div>

                </div>

                <button class="btn btn-success">
                    Save Hero Section
                </button>

            </form>

        </div>
    </div>
@endsection
