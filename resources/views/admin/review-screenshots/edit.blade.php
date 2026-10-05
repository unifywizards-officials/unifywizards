@extends('layouts.app')

@section('title', 'Review Screenshots')

@section('page-title', 'Review Screenshots')

@section('content')

    <div class="container-fluid">

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @php
            $platforms = [
                'clutch' => 'Clutch',
                'trustpilot' => 'Trustpilot',
                'google' => 'Google Reviews',
            ];

            $images = $reviewScreenshot->images ?? [];

            if (!is_array($images)) {
                $images = [];
            }
        @endphp


        <div class="card">

            <div class="card-header">
                <h4 class="card-title mb-0">
                    Review Screenshots (Homepage)
                </h4>
            </div>


            <div class="card-body">

                <form action="{{ route('review-screenshots.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')


                    <div class="row">

                        {{-- Heading --}}
                        <div class="col-md-8 mb-4">

                            <label class="form-label">
                                Heading <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="heading" class="form-control"
                                value="{{ old('heading', $reviewScreenshot->heading ?? '') }}"
                                placeholder="e.g. What Clients Say About Our Digital Marketing Company" required>

                        </div>


                        {{-- Highlight Text --}}
                        <div class="col-md-4 mb-4">

                            <label class="form-label">
                                Highlighted Word(s)
                            </label>

                            <input type="text" name="highlight_text" class="form-control"
                                value="{{ old('highlight_text', $reviewScreenshot->highlight_text ?? '') }}"
                                placeholder="e.g. Company">

                            <small class="text-muted">
                                Must match text inside the heading exactly — it'll be shown in accent color.
                            </small>

                        </div>

                    </div>


                    {{-- Description --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea name="description" class="form-control" rows="3" placeholder="Enter description">{{ old('description', $reviewScreenshot->description ?? '') }}</textarea>

                    </div>


                    {{-- Status --}}
                    <div class="mb-4" style="max-width: 220px;">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-control">

                            <option value="1" {{ old('status', $reviewScreenshot->status ?? 1) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ old('status', $reviewScreenshot->status ?? 1) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>


                    <hr>

                    <h5 class="mb-3">
                        Platform Screenshots
                    </h5>

                    <div class="row">

                        @foreach ($platforms as $key => $label)
                            <div class="col-md-4 mb-4">

                                <div class="border rounded p-3 h-100">

                                    <h6 class="mb-3">
                                        {{ $label }}
                                    </h6>

                                    @if (!empty($images[$key]))

                                        <img src="{{ asset('storage/' . $images[$key]) }}" class="img-fluid rounded mb-2"
                                            style="
                                            width:100%;
                                            height:160px;
                                            object-fit:contain;
                                            border:1px solid #ddd;
                                            padding:5px;
                                            background:#f8f9fa;
                                        " alt="{{ $label }} screenshot">

                                        <div class="form-check d-flex align-items-center mb-2">

                                            <input type="checkbox" name="remove_platform_image[]" value="{{ $key }}"
                                                class="form-check-input" id="remove_{{ $key }}">

                                            <label class="form-check-label text-danger ms-1 small"
                                                for="remove_{{ $key }}">
                                                Remove screenshot
                                            </label>

                                        </div>

                                    @else

                                        <div class="d-flex align-items-center justify-content-center text-muted mb-2"
                                            style="
                                            height:160px;
                                            border:1px dashed #ccc;
                                            border-radius:8px;
                                            background:#f8f9fa;
                                        ">
                                            No screenshot yet
                                        </div>

                                    @endif

                                    <input type="file" name="platform_image[{{ $key }}]" class="form-control"
                                        accept="image/jpeg,image/png,image/webp">

                                    <small class="text-muted d-block mt-1">
                                        Max 5MB. JPG, PNG or WEBP.
                                    </small>

                                </div>

                            </div>
                        @endforeach

                    </div>


                    {{-- Submit --}}
                    <div class="mt-4">

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-1"></i>
                            Update Review Screenshots
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
