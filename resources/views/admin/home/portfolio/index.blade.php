@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">

        <form action="{{ route('admin.home.portfolio.update') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="panel panel-inverse">

                <div class="panel-heading d-flex justify-content-between align-items-center">

                    <h4 class="panel-title">
                        Portfolio CMS
                    </h4>

                    <button type="submit" class="btn btn-success">

                        Save Portfolio

                    </button>

                </div>

                <div class="panel-body">

                    {{-- ================= HEADER ================= --}}

                    <div class="card mb-4">

                        <div class="card-header">

                            <h4>
                                Section Header
                            </h4>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-4 mb-3">

                                    <label>
                                        Sub Title
                                    </label>

                                    <input type="text" name="sub_title" class="form-control"
                                        value="{{ $portfolio->sub_title ?? '' }}">

                                </div>

                                <div class="col-md-8 mb-3">

                                    <label>
                                        Main Title
                                    </label>

                                    <input type="text" name="title" class="form-control"
                                        value="{{ $portfolio->title ?? '' }}">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label>
                                        Highlight Text
                                    </label>

                                    <input type="text" name="highlight_text" class="form-control"
                                        value="{{ $portfolio->highlight_text ?? '' }}">

                                </div>

                                <div class="col-md-12 mb-3">

                                    <label>
                                        Description
                                    </label>

                                    <textarea name="description" class="form-control" rows="4">{{ $portfolio->description ?? '' }}</textarea>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Button Text
                                    </label>

                                    <input type="text" name="button_text" class="form-control"
                                        value="{{ $portfolio->button_text ?? '' }}">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Button Link
                                    </label>

                                    <input type="text" name="button_link" class="form-control"
                                        value="{{ $portfolio->button_link ?? '' }}">

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- ================= PROJECTS ================= --}}

                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h4>
                                Projects
                            </h4>

                            <button type="button" class="btn btn-primary" id="addProject">

                                + Add Project

                            </button>

                        </div>

                        <div class="card-body">

                            <div id="projectsWrapper">

                                @php
                                    $projects = $portfolio->projects_json ?? [];
                                @endphp

                                @foreach ($projects as $project)
                                    <div class="card mb-4 project-card">

                                        <div
                                            class="card-header d-flex justify-content-between align-items-center bg-dark text-white">

                                            <h5 class="mb-0">
                                                Project
                                            </h5>

                                            <button type="button" class="btn btn-danger btn-sm removeProject">

                                                Remove

                                            </button>

                                        </div>

                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-md-3 mb-3">

                                                    <label>
                                                        Category
                                                    </label>

                                                    <input type="text" name="project_category[]" class="form-control"
                                                        value="{{ $project['category'] ?? '' }}">

                                                </div>

                                                <div class="col-md-3 mb-3">

                                                    <label>
                                                        Project Title
                                                    </label>

                                                    <input type="text" name="project_title[]" class="form-control"
                                                        value="{{ $project['title'] ?? '' }}">

                                                </div>

                                                <div class="col-md-3 mb-3">

                                                    <label>
                                                        Project Link
                                                    </label>

                                                    <input type="text" name="project_link[]" class="form-control"
                                                        value="{{ $project['project_link'] ?? '' }}">

                                                </div>

                                                <div class="col-md-3 mb-3">

                                                    <label>
                                                        Project Image
                                                    </label>

                                                    <input type="file" name="project_image[]" class="form-control">

                                                    @if (!empty($project['image']))
                                                        <img src="{{ asset($project['image']) }}" width="80"
                                                            class="mt-2 rounded">
                                                    @endif

                                                </div>

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

                            <div class="row">

                                <div class="col-md-4">

                                    <label>
                                        Status
                                    </label>

                                    <select name="status" class="form-control">

                                        <option value="1" {{ ($portfolio->status ?? 1) == 1 ? 'selected' : '' }}>
                                            Active
                                        </option>

                                        <option value="0" {{ ($portfolio->status ?? 1) == 0 ? 'selected' : '' }}>
                                            Inactive
                                        </option>

                                    </select>

                                </div>

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
        $(document).on('click', '#addProject', function() {

            let html = `

    <div class="card mb-4 project-card">

        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">

            <h5 class="mb-0">
                New Project
            </h5>

            <button type="button"
                    class="btn btn-danger btn-sm removeProject">

                Remove

            </button>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-3 mb-3">

                    <label>
                        Category
                    </label>

                    <input type="text"
                           name="project_category[]"
                           class="form-control">

                </div>

                <div class="col-md-3 mb-3">

                    <label>
                        Project Title
                    </label>

                    <input type="text"
                           name="project_title[]"
                           class="form-control">

                </div>

                <div class="col-md-3 mb-3">

                    <label>
                        Project Link
                    </label>

                    <input type="text"
                           name="project_link[]"
                           class="form-control">

                </div>

                <div class="col-md-3 mb-3">

                    <label>
                        Image URL
                    </label>

                    <input type="file"
                           name="project_image[]"
                           class="form-control">

                </div>

            </div>

        </div>

    </div>

    `;

            $('#projectsWrapper').append(html);

        });


        $(document).on('click', '.removeProject', function() {

            $(this).closest('.project-card').remove();

        });
    </script>
@endpush
