@extends('layouts.app')

@section('content')

    @php

        $services = $solution->services ?? [];

    @endphp

    <div class="container-fluid">

        <h1 class="page-header mb-4">
            Manage Our Solutions
        </h1>

        <div class="panel panel-inverse">

            <div class="panel-heading">

                <h4 class="panel-title">
                    Our Solutions CMS
                </h4>

            </div>

            <div class="panel-body">

                <form action="{{ route('admin.home.our-solutions.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    {{-- SECTION HEADING --}}

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>
                                Sub Title
                            </label>

                            <input type="text" name="sub_title" class="form-control" value="{{ $solution->sub_title }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>
                                Title
                            </label>

                            <input type="text" name="title" class="form-control" value="{{ $solution->title }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>
                                Highlight Text
                            </label>

                            <input type="text" name="highlight_text" class="form-control"
                                value="{{ $solution->highlight_text }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>
                                Status
                            </label>

                            <select name="status" class="form-control">

                                <option value="1" {{ $solution->status == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ $solution->status == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    {{-- SERVICES --}}

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h3>
                            Services
                        </h3>

                        <button type="button" class="btn btn-primary" id="addService">

                            Add More Service

                        </button>

                    </div>

                    <div id="serviceWrapper">

                        @if (count($services))
                            @foreach ($services as $index => $service)
                                <div class="card mb-5 service-card">

                                    <div class="card-header d-flex justify-content-between align-items-center">

                                        <h4>
                                            Service {{ $index + 1 }}
                                        </h4>

                                        <button type="button" class="btn btn-danger removeService">

                                            Remove

                                        </button>

                                    </div>

                                    <div class="card-body">

                                        <div class="row">

                                            {{-- ICON --}}

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Icon Class
                                                </label>

                                                <input type="text" name="service_icon[]" class="form-control"
                                                    value="{{ $service['icon'] ?? '' }}">

                                            </div>

                                            {{-- TITLE --}}

                                            <div class="col-md-8 mb-3">

                                                <label>
                                                    Service Title
                                                </label>

                                                <input type="text" name="service_title[]" class="form-control"
                                                    value="{{ $service['title'] ?? '' }}">

                                            </div>

                                            {{-- FULL CONTENT --}}

                                            <div class="col-md-12 mb-3">

                                                <label>
                                                    Full Content
                                                </label>

                                                <textarea name="service_description[]" class="form-control editor" rows="10">{{ $service['description'] ?? '' }}</textarea>

                                            </div>

                                            {{-- IMAGE --}}

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Service Image
                                                </label>

                                                <input type="file" name="service_image[{{ $index }}]"
                                                    class="form-control">

                                                <input type="hidden" name="old_service_image[]"
                                                    value="{{ $service['image'] ?? '' }}">

                                            </div>

                                            @if (!empty($service['image']))
                                                <div class="col-md-3 mb-3">

                                                    <img src="{{ asset($service['image']) }}"
                                                        style="
                                                            width:100%;
                                                            height:120px;
                                                            object-fit:cover;
                                                            border-radius:10px;
                                                            border:1px solid #ddd;
                                                        ">

                                                </div>
                                            @endif

                                        </div>

                                        <hr>

                                        {{-- TAG BUTTONS --}}

                                        <div class="d-flex justify-content-between align-items-center mb-3">

                                            <h5>
                                                Service Buttons / Tags
                                            </h5>

                                            <button type="button" class="btn btn-success addTag">

                                                Add More Button

                                            </button>

                                        </div>

                                        <div class="tagWrapper">

                                            @if (!empty($service['tags']))
                                                @foreach ($service['tags'] as $tagIndex => $tag)
                                                    <div class="row mb-3 tag-item">

                                                        <div class="col-md-5">

                                                            <input type="text"
                                                                name="service_tags[{{ $index }}][{{ $tagIndex }}][text]"
                                                                class="form-control" placeholder="Button Text"
                                                                value="{{ $tag['text'] ?? '' }}">

                                                        </div>

                                                        <div class="col-md-5">

                                                            <input type="text"
                                                                name="service_tags[{{ $index }}][{{ $tagIndex }}][link]"
                                                                class="form-control" placeholder="Button Link"
                                                                value="{{ $tag['link'] ?? '' }}">

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

                                        <hr>

                                        {{-- LEARN MORE BUTTON --}}

                                        <div class="row">

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Learn More Button Text
                                                </label>

                                                <input type="text" name="button_text[]" class="form-control"
                                                    value="{{ $service['button_text'] ?? '' }}">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Learn More Button Link
                                                </label>

                                                <input type="text" name="button_link[]" class="form-control"
                                                    value="{{ $service['button_link'] ?? '' }}">

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            @endforeach
                        @endif

                    </div>

                    <hr>

                    {{-- BOTTOM CTA --}}

                    <div class="row mt-4">

                        <div class="col-md-12 mb-3">

                            <label>
                                Bottom Text
                            </label>

                            <input type="text" name="bottom_text" class="form-control"
                                value="{{ $solution->bottom_text }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>
                                Bottom Button Text
                            </label>

                            <input type="text" name="bottom_button_text" class="form-control"
                                value="{{ $solution->bottom_button_text }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>
                                Bottom Button Link
                            </label>

                            <input type="text" name="bottom_button_link" class="form-control"
                                value="{{ $solution->bottom_button_link }}">

                        </div>

                    </div>

                    <button type="submit" class="btn btn-success mt-4">

                        Save Our Solutions

                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection
@push('scripts')
    {{-- CKEDITOR 5 --}}

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        /*
                |--------------------------------------------------------------------------
                | LOAD CKEDITOR
                |--------------------------------------------------------------------------
                */

        function loadEditor() {

            document.querySelectorAll('.editor').forEach((el) => {

                if (!el.classList.contains('ck-loaded')) {

                    ClassicEditor
                        .create(el)
                        .catch(error => {
                            console.error(error);
                        });

                    el.classList.add('ck-loaded');
                }

            });

        }

        loadEditor();

        /*
        |--------------------------------------------------------------------------
        | SERVICE INDEX
        |--------------------------------------------------------------------------
        */

        let serviceIndex = {{ count($services) }};

        /*
        |--------------------------------------------------------------------------
        | ADD SERVICE
        |--------------------------------------------------------------------------
        */

        $('#addService').click(function() {

            let html = `

                <div class="card mb-5 service-card">

                    <div class="card-header d-flex justify-content-between align-items-center">

                        <h4>
                            New Service
                        </h4>

                        <button type="button"
                            class="btn btn-danger removeService">

                            Remove

                        </button>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label>
                                    Icon Class
                                </label>

                                <input type="text"
                                    name="service_icon[]"
                                    class="form-control">

                            </div>

                            <div class="col-md-8 mb-3">

                                <label>
                                    Service Title
                                </label>

                                <input type="text"
                                    name="service_title[]"
                                    class="form-control">

                            </div>

                            <div class="col-md-12 mb-3">

                                <label>
                                    Full Content
                                </label>

                                <textarea name="service_description[]"
                                    class="form-control editor"
                                    rows="10"></textarea>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>
                                    Service Image
                                </label>

                                <input type="file"
                                    name="service_image[` + serviceIndex + `]"
                                    class="form-control">

                                <input type="hidden"
                                    name="old_service_image[]">

                            </div>

                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h5>
                                Service Buttons / Tags
                            </h5>

                            <button type="button"
                                class="btn btn-success addTag">

                                Add More Button

                            </button>

                        </div>

                        <div class="tagWrapper"></div>

                        <hr>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label>
                                    Learn More Button Text
                                </label>

                                <input type="text"
                                    name="button_text[]"
                                    class="form-control">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>
                                    Learn More Button Link
                                </label>

                                <input type="text"
                                    name="button_link[]"
                                    class="form-control">

                            </div>

                        </div>

                    </div>

                </div>

            `;

            $('#serviceWrapper').append(html);

            loadEditor();

            serviceIndex++;

        });

        /*
        |--------------------------------------------------------------------------
        | REMOVE SERVICE
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.removeService', function() {

            $(this)
                .closest('.service-card')
                .remove();

        });

        /*
        |--------------------------------------------------------------------------
        | ADD TAG BUTTON
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.addTag', function() {

            let wrapper = $(this)
                .closest('.card-body')
                .find('.tagWrapper');

            let serviceCard = $(this)
                .closest('.service-card');

            let serviceIndex = $('.service-card')
                .index(serviceCard);

            let tagCount = wrapper
                .find('.tag-item')
                .length;

            let html = `

                <div class="row mb-3 tag-item">

                    <div class="col-md-5">

                        <input type="text"
                            name="service_tags[` + serviceIndex + `][` + tagCount + `][text]"
                            class="form-control"
                            placeholder="Button Text">

                    </div>

                    <div class="col-md-5">

                        <input type="text"
                            name="service_tags[` + serviceIndex + `][` + tagCount + `][link]"
                            class="form-control"
                            placeholder="Button Link">

                    </div>

                    <div class="col-md-2">

                        <button type="button"
                            class="btn btn-danger removeTag">

                            Remove

                        </button>

                    </div>

                </div>

            `;

            wrapper.append(html);

        });

        /*
        |--------------------------------------------------------------------------
        | REMOVE TAG
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.removeTag', function() {

            $(this)
                .closest('.tag-item')
                .remove();

        });
    </script>
@endpush
