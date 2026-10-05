@extends('layouts.app')

@section('content')


    @php
        /*
    |--------------------------------------------------------------------------
    | Results JSON (list of category entries: key, label, ...)
    |--------------------------------------------------------------------------
    */

        $results = $outstandingResult->results ?? [];

        if (!is_array($results)) {
            $results = [];
        }
    @endphp


    <h1 class="page-header">
        Outstanding Results
    </h1>


    {{-- SUCCESS / ERROR MESSAGES --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert">
            </button>

        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert">
            </button>

        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">

            <strong>
                Please fix the following errors:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach

            </ul>

        </div>
    @endif


    <div class="panel panel-inverse">

        {{-- PANEL HEADING --}}
        <div class="panel-heading">

            <h4 class="panel-title">
                Edit Outstanding Result
            </h4>

        </div>


        {{-- PANEL BODY --}}
        <div class="panel-body">

            {{-- FORM --}}
            <form id="outstanding-results-form" action="{{ route('outstanding-results.update') }}" method="POST"
                enctype="multipart/form-data">

                @csrf

                @method('PUT')


                <div class="row">


                    {{-- HEADING --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Heading
                        </label>

                        <input type="text" name="heading" class="form-control" placeholder="Enter heading"
                            value="{{ old('heading', $outstandingResult->heading ?? '') }}">

                    </div>


                    {{-- STATUS --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-control">

                            <option value="1"
                                {{ old('status', $outstandingResult->status ?? 1) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('status', $outstandingResult->status ?? 1) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="col-md-12 mb-4">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea name="description" class="form-control" rows="3" placeholder="Enter description">{{ old('description', $outstandingResult->description ?? '') }}</textarea>

                    </div>


                    {{-- CATEGORY CASE STUDY SECTION --}}
                    <div class="col-md-12">

                        <div class="card border mb-4">

                            <div class="card-header">

                                <h5 class="mb-0">
                                    <i class="fa fa-briefcase me-2"></i>
                                    Case Study by Category
                                </h5>

                            </div>


                            <div class="card-body">

                                {{-- CATEGORY --}}
                                <div class="mb-4" style="max-width: 320px;">

                                    <label class="form-label">
                                        Category
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select name="category" id="category" class="form-control">

                                        <option value="">
                                            Select Category
                                        </option>

                                        @foreach ($results as $entry)
                                            <option value="{{ $entry['key'] }}"
                                                {{ old('category') == $entry['key'] ? 'selected' : '' }}>
                                                {{ $entry['label'] }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <small class="text-muted">
                                        Choose a category to load / edit its case study. Existing
                                        values fill in automatically.
                                    </small>

                                </div>


                                <div class="row">

                                    {{-- CATEGORY NAME (rename) --}}
                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Category Name
                                        </label>

                                        <input type="text" name="category_label" id="category_label"
                                            class="form-control" placeholder="e.g. Insurance"
                                            value="{{ old('category_label') }}">

                                    </div>


                                    {{-- WEBSITE TAG --}}
                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Website / Client Tag
                                        </label>

                                        <input type="text" name="website" id="website" class="form-control"
                                            placeholder="e.g. www.acko.com" value="{{ old('website') }}">

                                    </div>


                                    {{-- CASE STUDY LINK --}}
                                    <div class="col-md-12 mb-3">

                                        <label class="form-label">
                                            View Case Study Link
                                        </label>

                                        <input type="url" name="case_study_link" id="case_study_link"
                                            class="form-control" placeholder="https://..."
                                            value="{{ old('case_study_link') }}">

                                    </div>


                                    {{-- CHALLENGE --}}
                                    <div class="col-md-12 mb-3">

                                        <label class="form-label">
                                            Challenge
                                        </label>

                                        <textarea name="challenge" id="challenge" class="form-control" rows="2"
                                            placeholder="e.g. Low-quality backlinks limited growth | High competition in the insurance market">{{ old('challenge') }}</textarea>

                                    </div>


                                    {{-- RESULTS PERCENTAGE --}}
                                    <div class="col-md-4 mb-3">

                                        <label class="form-label">
                                            Results Percentage
                                        </label>

                                        <input type="text" name="results_percentage" id="results_percentage"
                                            class="form-control" placeholder="e.g. 99.94%"
                                            value="{{ old('results_percentage') }}">

                                    </div>


                                    {{-- RESULTS SUMMARY --}}
                                    <div class="col-md-8 mb-3">

                                        <label class="form-label">
                                            Results Summary
                                        </label>

                                        <input type="text" name="results_summary" id="results_summary"
                                            class="form-control"
                                            placeholder="e.g. Traffic tripled to 6 million | 803K keywords covered"
                                            value="{{ old('results_summary') }}">

                                    </div>


                                    {{-- KEYWORD TABLE --}}
                                    <div class="col-md-12 mb-3">

                                        <label class="form-label">
                                            Keyword Rankings
                                        </label>

                                        <div id="keyword-rows"></div>

                                        <button type="button" id="add-keyword-row"
                                            class="btn btn-sm btn-outline-success mt-1">
                                            <i class="fa fa-plus me-1"></i>
                                            Add Keyword
                                        </button>

                                    </div>


                                    {{-- ANALYTICS HEADING --}}
                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Analytics Image Heading
                                        </label>

                                        <input type="text" name="analytics_heading" id="analytics_heading"
                                            class="form-control" placeholder="e.g. Google Analytics"
                                            value="{{ old('analytics_heading') }}">

                                    </div>


                                    {{-- ANALYTICS IMAGE --}}
                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Analytics Screenshot
                                        </label>

                                        <input type="file" name="analytics_image" id="analytics_image"
                                            class="form-control" accept=".jpg,.jpeg,.png,.webp">

                                        <small class="text-muted">
                                            Allowed: JPG, JPEG, PNG, WEBP. Maximum size: 5MB.
                                        </small>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- SUBMIT BUTTON --}}
                    <div class="col-md-12 mt-2">

                        <button type="submit" class="btn btn-success">

                            <i class="fa fa-save me-1"></i>

                            Save Outstanding Results

                        </button>

                    </div>


                </div>

            </form>


            {{-- CURRENT CATEGORY DATA
                 (kept outside the main form — each card has its own "Remove
                 Category" form, and forms cannot be nested; the "remove
                 image" checkbox instead points back at the main form via
                 its `form` attribute so it still submits with it) --}}
            <div class="card border mb-4">

                <div class="card-header">

                    <h5 class="mb-0">
                        <i class="fa fa-list me-2"></i>
                        Current Case Studies
                    </h5>

                </div>


                <div class="card-body">

                    <div class="row">

                        @forelse ($results as $entry)

                            @php
                                $keywordCount = count($entry['keywords'] ?? []);
                            @endphp

                            <div class="col-md-6 col-lg-3 mb-4">

                                <div class="border rounded p-3 h-100">

                                    <h6 class="mb-2">
                                        {{ $entry['label'] }}
                                    </h6>

                                    @if (!empty($entry['website']))
                                        <span class="badge bg-secondary mb-2">
                                            {{ $entry['website'] }}
                                        </span>
                                    @endif

                                    @if (!empty($entry['results_percentage']))
                                        <div class="text-success fw-bold" style="font-size: 20px;">
                                            {{ $entry['results_percentage'] }}
                                        </div>
                                    @endif

                                    @if ($keywordCount > 0)
                                        <small class="text-muted d-block mb-2">
                                            {{ $keywordCount }} keyword(s) added
                                        </small>
                                    @endif

                                    @if (!empty($entry['analytics_image']))

                                        <img src="{{ asset('storage/' . $entry['analytics_image']) }}"
                                            alt="{{ $entry['label'] }}" class="img-fluid rounded mb-2" style="
                                            width:100%;
                                            height:120px;
                                            object-fit:contain;
                                            border:1px solid #ddd;
                                            padding:5px;
                                            background:#f8f9fa;
                                        ">

                                        <div class="form-check d-flex align-items-center mb-2">

                                            <input type="checkbox" name="remove_analytics_image[]"
                                                value="{{ $entry['key'] }}" class="form-check-input"
                                                id="remove_{{ $entry['key'] }}"
                                                form="outstanding-results-form">

                                            <label class="form-check-label text-danger ms-1 small"
                                                for="remove_{{ $entry['key'] }}">
                                                Remove image
                                            </label>

                                        </div>

                                    @else

                                        <div class="d-flex align-items-center justify-content-center text-muted mb-2"
                                            style="
                                            height:120px;
                                            border:1px dashed #ccc;
                                            border-radius:8px;
                                            background:#f8f9fa;
                                        ">
                                            No image yet
                                        </div>

                                    @endif


                                    {{-- REMOVE CATEGORY --}}
                                    <form action="{{ route('outstanding-results.category.remove', $entry['key']) }}"
                                        method="POST"
                                        onsubmit="return confirm('Remove the &quot;{{ $entry['label'] }}&quot; category? This also deletes its uploaded image.');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                            <i class="fa fa-trash me-1"></i>
                                            Remove Category
                                        </button>

                                    </form>

                                </div>

                            </div>
                        @empty

                            <div class="col-12">
                                <p class="text-muted mb-0">
                                    No categories yet. Add one below to get started.
                                </p>
                            </div>

                        @endforelse

                    </div>

                </div>

            </div>


            {{-- ADD CATEGORY (separate form) --}}
            <form action="{{ route('outstanding-results.category.add') }}" method="POST" class="mt-2">

                @csrf

                <div class="card border" style="max-width: 480px;">

                    <div class="card-body">

                        <label class="form-label">
                            <i class="fa fa-plus-circle me-1"></i>
                            Add New Category
                        </label>

                        <div class="input-group">

                            <input type="text" name="new_category_label" class="form-control"
                                placeholder="e.g. E-commerce" required maxlength="255">

                            <button type="submit" class="btn btn-success">
                                Add Category
                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- CATEGORY DATA + DYNAMIC KEYWORD ROWS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const resultsData = {};
            @foreach ($results as $entry)
                resultsData[@json($entry['key'])] = @json($entry);
            @endforeach

            const categorySelect = document.getElementById('category');
            const keywordRowsWrap = document.getElementById('keyword-rows');
            const addKeywordBtn = document.getElementById('add-keyword-row');

            const fields = {
                category_label: document.getElementById('category_label'),
                website: document.getElementById('website'),
                case_study_link: document.getElementById('case_study_link'),
                challenge: document.getElementById('challenge'),
                results_percentage: document.getElementById('results_percentage'),
                results_summary: document.getElementById('results_summary'),
                analytics_heading: document.getElementById('analytics_heading'),
            };

            let keywordIndex = 0;


            /*
            |--------------------------------------------------------------------------
            | Build one keyword row
            |--------------------------------------------------------------------------
            */

            function addKeywordRow(keyword, ranking) {

                const index = keywordIndex++;

                const row = document.createElement('div');
                row.className = 'row align-items-center mb-2 keyword-row';

                row.innerHTML = `
                    <div class="col-6">
                        <input type="text" name="keywords[${index}][keyword]" class="form-control"
                            placeholder="Keyword" value="${keyword ? keyword.replace(/"/g, '&quot;') : ''}">
                    </div>
                    <div class="col-4">
                        <input type="text" name="keywords[${index}][ranking]" class="form-control"
                            placeholder="Ranking" value="${ranking ? ranking.replace(/"/g, '&quot;') : ''}">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-sm btn-outline-danger remove-keyword-row">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                `;

                row.querySelector('.remove-keyword-row').addEventListener('click', function() {
                    row.remove();
                });

                keywordRowsWrap.appendChild(row);
            }


            /*
            |--------------------------------------------------------------------------
            | Reset the keyword rows list
            |--------------------------------------------------------------------------
            */

            function resetKeywordRows(keywords) {

                keywordRowsWrap.innerHTML = '';
                keywordIndex = 0;

                if (Array.isArray(keywords) && keywords.length) {
                    keywords.forEach(function(row) {
                        addKeywordRow(row.keyword || '', row.ranking || '');
                    });
                } else {
                    addKeywordRow('', '');
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Fill form fields from stored data for the selected category
            |--------------------------------------------------------------------------
            */

            function loadCategory(key) {

                const data = resultsData[key] || {};

                fields.category_label.value = data.label || '';
                fields.website.value = data.website || '';
                fields.case_study_link.value = data.case_study_link || '';
                fields.challenge.value = data.challenge || '';
                fields.results_percentage.value = data.results_percentage || '';
                fields.results_summary.value = data.results_summary || '';
                fields.analytics_heading.value = data.analytics_heading || '';

                resetKeywordRows(data.keywords || []);
            }


            categorySelect.addEventListener('change', function() {
                loadCategory(this.value);
            });


            /* Start with one empty keyword row (or pre-fill if a category is pre-selected) */

            if (categorySelect.value) {
                loadCategory(categorySelect.value);
            } else {
                resetKeywordRows([]);
            }

            addKeywordBtn.addEventListener('click', function() {
                addKeywordRow('', '');
            });

        });
    </script>


    {{-- IMAGE PREVIEW / VALIDATION --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const imageInput = document.getElementById('analytics_image');

            if (!imageInput) {
                return;
            }


            imageInput.addEventListener('change', function() {

                const file = this.files[0];

                if (!file) {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Validate File Type
                |--------------------------------------------------------------------------
                */

                const allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/webp'
                ];

                if (!allowedTypes.includes(file.type)) {

                    alert('Please select a JPG, JPEG, PNG or WEBP image.');

                    this.value = '';

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | Validate File Size
                |--------------------------------------------------------------------------
                */

                if (file.size > 5 * 1024 * 1024) {

                    alert('Image size must not exceed 5MB.');

                    this.value = '';

                    return;

                }


            });

        });
    </script>


@endsection
