@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">

        <form action="{{ route('admin.home.marketing-sections.store-or-update') }}" method="POST">

            @csrf

            <div class="panel panel-inverse">

                <div class="panel-heading d-flex justify-content-between align-items-center">

                    <h4 class="panel-title">
                        Digital Marketing Tabs CMS
                    </h4>

                    <button type="submit" class="btn btn-success">

                        Save Section

                    </button>

                </div>

                <div class="panel-body">

                    {{-- ================= HEADER SECTION ================= --}}

                    <div class="card mb-4">

                        <div class="card-header">
                            Section Header
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-8 mb-3">

                                    <label>
                                        Main Title
                                    </label>

                                    <input type="text" name="title" class="form-control"
                                        value="{{ $section->title ?? '' }}">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label>
                                        Highlight Text
                                    </label>

                                    <input type="text" name="highlight_text" class="form-control"
                                        value="{{ $section->highlight_text ?? '' }}">

                                </div>

                                <div class="col-md-12 mb-3">

                                    <label>
                                        Description
                                    </label>

                                    <textarea name="description" class="form-control" rows="4">{{ $section->description ?? '' }}</textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- ================= TABS ================= --}}

                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h4>
                                Tabs Section
                            </h4>

                            <button type="button" class="btn btn-primary" id="addTab">

                                + Add Tab

                            </button>

                        </div>

                        <div class="card-body">

                            <div id="tabsWrapper">

                                @php
                                    $tabs = $section->tabs ?? [];
                                @endphp

                                @foreach ($tabs as $index => $tab)
                                    <div class="card mb-5 tab-card">

                                        <div
                                            class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

                                            <h5 class="mb-0">
                                                Tab {{ $index + 1 }}
                                            </h5>

                                            <button type="button" class="btn btn-danger btn-sm removeTab">

                                                Remove

                                            </button>

                                        </div>

                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-md-6 mb-3">

                                                    <label>
                                                        Tab Title
                                                    </label>

                                                    <input type="text" name="tab_title[]" class="form-control"
                                                        value="{{ $tab['tab_title'] ?? '' }}">

                                                </div>

                                                <div class="col-md-6 mb-3">

                                                    <label>
                                                        Tab Slug
                                                    </label>

                                                    <input type="text" name="tab_slug[]" class="form-control"
                                                        value="{{ $tab['tab_slug'] ?? '' }}">

                                                </div>

                                            </div>

                                            {{-- ================= POINTS ================= --}}

                                            <hr>

                                            <div class="d-flex justify-content-between mb-3">

                                                <h5>
                                                    Points
                                                </h5>

                                                <button type="button" class="btn btn-success btn-sm addPoint">

                                                    + Add Point

                                                </button>

                                            </div>

                                            <div class="pointsWrapper">

                                                @if (isset($tab['points']))
                                                    @foreach ($tab['points'] as $point)
                                                        <div class="border rounded p-3 mb-3 pointItem">

                                                            <div class="mb-3">

                                                                <label>
                                                                    Point Title
                                                                </label>

                                                                <input type="text"
                                                                    name="point_title[{{ $index }}][]"
                                                                    class="form-control"
                                                                    value="{{ $point['title'] ?? '' }}">

                                                            </div>

                                                            <div class="mb-3">

                                                                <label>
                                                                    Point Description
                                                                </label>

                                                                <textarea name="point_description[{{ $index }}][]" class="form-control" rows="3">{{ $point['description'] ?? '' }}</textarea>

                                                            </div>

                                                            <button type="button"
                                                                class="btn btn-danger btn-sm removePoint">

                                                                Remove

                                                            </button>

                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>

                                            {{-- ================= TAGS ================= --}}

                                            <hr>

                                            <div class="d-flex justify-content-between mb-3">

                                                <h5>
                                                    Tags
                                                </h5>

                                                <button type="button" class="btn btn-warning btn-sm addTag">

                                                    + Add Tag

                                                </button>

                                            </div>

                                            <div class="tagsWrapper">

                                                @if (isset($tab['tags']))
                                                    @foreach ($tab['tags'] as $tag)
                                                        <div class="row mb-3 tagItem">

                                                            <div class="col-md-5">

                                                                <input type="text"
                                                                    name="tag_text[{{ $index }}][]"
                                                                    class="form-control" value="{{ $tag['text'] ?? '' }}"
                                                                    placeholder="Tag Text">

                                                            </div>

                                                            <div class="col-md-5">

                                                                <input type="text"
                                                                    name="tag_link[{{ $index }}][]"
                                                                    class="form-control" value="{{ $tag['link'] ?? '' }}"
                                                                    placeholder="Tag Link">

                                                            </div>

                                                            <div class="col-md-2">

                                                                <button type="button" class="btn btn-danger removeTag">

                                                                    Remove

                                                                </button>

                                                            </div>

                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>

                                        </div>

                                    </div>
                                @endforeach

                            </div>

                        </div>

                    </div>

                    {{-- ================= STATUS ================= --}}

                    <div class="card mt-4">

                        <div class="card-body">

                            <div class="col-md-4">

                                <label>
                                    Status
                                </label>

                                <select name="status" class="form-control">

                                    <option value="1" {{ ($section->status ?? 1) == 1 ? 'selected' : '' }}>

                                        Active

                                    </option>

                                    <option value="0" {{ ($section->status ?? 1) == 0 ? 'selected' : '' }}>

                                        Inactive

                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>
@endsection


@push('scripts')
    <script>
        $(document).on('click', '#addTab', function() {

            let tabIndex = $('.tab-card').length;

            let html = `

    <div class="card mb-5 tab-card">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

            <h5>
                New Tab
            </h5>

            <button type="button"
                    class="btn btn-danger btn-sm removeTab">

                Remove

            </button>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>
                        Tab Title
                    </label>

                    <input type="text"
                           name="tab_title[]"
                           class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label>
                        Tab Slug
                    </label>

                    <input type="text"
                           name="tab_slug[]"
                           class="form-control">

                </div>

            </div>

            <hr>

            <div class="d-flex justify-content-between mb-3">

                <h5>
                    Points
                </h5>

                <button type="button"
                        class="btn btn-success btn-sm addPoint">

                    + Add Point

                </button>

            </div>

            <div class="pointsWrapper"></div>

            <hr>

            <div class="d-flex justify-content-between mb-3">

                <h5>
                    Tags
                </h5>

                <button type="button"
                        class="btn btn-warning btn-sm addTag">

                    + Add Tag

                </button>

            </div>

            <div class="tagsWrapper"></div>

        </div>

    </div>
    `;

            $('#tabsWrapper').append(html);

        });


        $(document).on('click', '.removeTab', function() {

            $(this).closest('.tab-card').remove();

        });


        $(document).on('click', '.addPoint', function() {

            let tabCard = $(this).closest('.tab-card');
            let tabIndex = $('.tab-card').index(tabCard);

            let html = `

    <div class="border rounded p-3 mb-3 pointItem">

        <div class="mb-3">

            <label>
                Point Title
            </label>

            <input type="text"
                   name="point_title[${tabIndex}][]"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>
                Point Description
            </label>

            <textarea name="point_description[${tabIndex}][]"
                      class="form-control"
                      rows="3"></textarea>

        </div>

        <button type="button"
                class="btn btn-danger btn-sm removePoint">

            Remove

        </button>

    </div>
    `;

            tabCard.find('.pointsWrapper').append(html);

        });


        $(document).on('click', '.removePoint', function() {

            $(this).closest('.pointItem').remove();

        });


        $(document).on('click', '.addTag', function() {

            let tabCard = $(this).closest('.tab-card');
            let tabIndex = $('.tab-card').index(tabCard);

            let html = `

    <div class="row mb-3 tagItem">

        <div class="col-md-5">

            <input type="text"
                   name="tag_text[${tabIndex}][]"
                   class="form-control"
                   placeholder="Tag Text">

        </div>

        <div class="col-md-5">

            <input type="text"
                   name="tag_link[${tabIndex}][]"
                   class="form-control"
                   placeholder="Tag Link">

        </div>

        <div class="col-md-2">

            <button type="button"
                    class="btn btn-danger removeTag">

                Remove

            </button>

        </div>

    </div>
    `;

            tabCard.find('.tagsWrapper').append(html);

        });


        $(document).on('click', '.removeTag', function() {

            $(this).closest('.tagItem').remove();

        });
    </script>
@endpush
