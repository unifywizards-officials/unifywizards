@extends('layouts.app')

@section('title', 'Create Extra Fold')

@section('page-title', 'Create Extra Fold')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.extrafold.index') }}">Extra Fold</a>
    </li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@push('css')
    <link rel="stylesheet" href="/assets/plugins/summernote/dist/summernote-lite.min.css" />
    <style>
        .fold-form-wrap {
            padding: 24px 0;
        }

        .fold-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card-header-custom {
            padding: 18px 22px;
            border-bottom: 1px solid #f1f5f9;
            background: #fafcff;
        }

        .card-header-custom h5 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .card-body-custom {
            padding: 24px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #374151;
        }

        .form-control,
        .form-select {
            height: 48px;
            border-radius: 10px;
        }

        textarea.form-control {
            height: auto;
        }

        .image-preview {
            width: 180px;
            height: 120px;
            border: 2px dashed #d1d5db;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fafafa;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-save {
            background: #348fe2;
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
        }

        .btn-save:hover {
            background: #1f6fb8;
            color: #fff;
        }

        .btn-cancel {
            background: #f3f4f6;
            color: #111827;
            padding: 10px 22px;
            border-radius: 8px;
            text-decoration: none;
        }
    </style>
@endpush

@section('content')

    <div class="fold-form-wrap">

        <form action="{{ route('admin.extrafold.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            {{-- PAGE INFORMATION --}}
            <div class="fold-card">
                <div class="card-header-custom">
                    <h5>Page Information</h5>
                </div>
                <div class="card-body-custom">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Page URL</label>
                            <input type="text" name="page_url" class="form-control" value="{{ old('page_url') }}"
                                placeholder="/services/web-development">
                            @error('page_url')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                placeholder="Enter title">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Heading</label>
                            <input type="text" name="heading" class="form-control" value="{{ old('heading') }}"
                                placeholder="Enter heading">
                        </div>
                    </div>
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="fold-card">
                <div class="card-header-custom">
                    <h5>Content</h5>
                </div>
                <div class="card-body-custom">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="description" rows="10" class="form-control summernote">{{ old('description') }}</textarea>
                </div>
            </div>

            {{-- MEDIA & SETTINGS --}}
            <div class="fold-card">
                <div class="card-header-custom">
                    <h5>Media & Settings</h5>
                </div>
                <div class="card-body-custom">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Upload Image</label>
                            <input type="file" name="image" id="imageInput" class="form-control">
                            <div class="mt-3 image-preview">
                                <img id="previewImage">
                                <span id="previewText">Preview</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BUTTON SETTINGS --}}
            <div class="fold-card">
                <div class="card-header-custom">
                    <h5>Button Settings</h5>
                </div>
                <div class="card-body-custom">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Button Name</label>
                            <input type="text" name="button_name" class="form-control" value="{{ old('button_name') }}"
                                placeholder="Learn More">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Button URL</label>
                            <input type="text" name="button_url" class="form-control" value="{{ old('button_url') }}"
                                placeholder="/contact">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.extrafold.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Save Extra Fold</button>
            </div>

        </form>

    </div>

@endsection

@push('scripts')
    <script src="/assets/plugins/summernote/dist/summernote-lite.min.js"></script>
    <script>
        document.getElementById('imageInput').addEventListener('change', function(e) {
            let file = e.target.files[0];
            if (!file) return;
            let reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('previewImage').src = event.target.result;
                document.getElementById('previewImage').style.display = 'block';
                document.getElementById('previewText').style.display = 'none';
            }
            reader.readAsDataURL(file);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300
            });
        });
    </script>
@endpush
