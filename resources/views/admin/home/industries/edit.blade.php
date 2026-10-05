@extends('layouts.app')

@section('content')
    @php
        $industries = $industry->industries ?? [];
    @endphp

    <div class="container-fluid">

        <h1 class="page-header mb-4">
            Manage Industries Section
        </h1>

        <div class="panel panel-inverse">

            <div class="panel-heading">

                <h4 class="panel-title">
                    Industries CMS
                </h4>

            </div>

            <div class="panel-body">

                <form action="{{ route('admin.home.industries.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>
                                Sub Title
                            </label>

                            <input type="text" name="sub_title" class="form-control"
                                value="{{ $industry->sub_title ?? '' }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>
                                Title
                            </label>

                            <input type="text" name="title" class="form-control" value="{{ $industry->title ?? '' }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>
                                Status
                            </label>

                            <select name="status" class="form-control">

                                <option value="1" {{ ($industry->status ?? 1) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ ($industry->status ?? 1) == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>
                                Button Text
                            </label>

                            <input type="text" name="button_text" class="form-control"
                                value="{{ $industry->button_text ?? '' }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>
                                Button Link
                            </label>

                            <input type="text" name="button_link" class="form-control"
                                value="{{ $industry->button_link ?? '' }}">

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h3>
                            Industries
                        </h3>

                        <button type="button" class="btn btn-primary" id="addIndustry">

                            Add Industry

                        </button>

                    </div>

                    <div id="industryWrapper">

                        @foreach ($industries as $index => $item)
                            <div class="card mb-5 industry-card">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <h4>
                                        Industry {{ $index + 1 }}
                                    </h4>

                                    <button type="button" class="btn btn-danger removeIndustry">

                                        Remove

                                    </button>

                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        {{-- IMAGE --}}

                                        <div class="col-md-6 mb-3">

                                            <label>
                                                Industry Image
                                            </label>

                                            <input type="file" name="industry_image[]" class="form-control">

                                        </div>

                                        <div class="col-md-6 mb-3">

                                            @if (!empty($item['image']))
                                                <img src="{{ asset($item['image']) }}" width="120" class="img-thumbnail">
                                            @endif

                                            <input type="hidden" name="old_industry_image[]"
                                                value="{{ $item['image'] ?? '' }}">

                                        </div>

                                        {{-- TAG --}}

                                        <div class="col-md-6 mb-3">

                                            <label>
                                                Tag
                                            </label>

                                            <input type="text" name="industry_tag[]" class="form-control"
                                                value="{{ $item['tag'] ?? '' }}" placeholder="Healthcare">

                                        </div>

                                        {{-- TITLE --}}

                                        <div class="col-md-6 mb-3">

                                            <label>
                                                Industry Title
                                            </label>

                                            <input type="text" name="industry_title[]" class="form-control"
                                                value="{{ $item['title'] ?? '' }}"
                                                placeholder="Healthcare Marketing & Web Solutions">

                                        </div>

                                        {{-- DESCRIPTION 1 --}}

                                        <div class="col-md-6 mb-3">

                                            <label>
                                                Description 1
                                            </label>

                                            <textarea name="description_1[]" class="form-control" rows="5">{{ $item['description_1'] ?? '' }}</textarea>

                                        </div>

                                        {{-- DESCRIPTION 2 --}}

                                        <div class="col-md-6 mb-3">

                                            <label>
                                                Description 2
                                            </label>

                                            <textarea name="description_2[]" class="form-control" rows="5">{{ $item['description_2'] ?? '' }}</textarea>

                                        </div>

                                        {{-- BUTTON TEXT --}}

                                        <div class="col-md-6 mb-3">

                                            <label>
                                                Button Text
                                            </label>

                                            <input type="text" name="industry_button_text[]" class="form-control"
                                                value="{{ $item['button_text'] ?? '' }}" placeholder="Learn More">

                                        </div>

                                        {{-- BUTTON LINK --}}

                                        <div class="col-md-6 mb-3">

                                            <label>
                                                Button Link
                                            </label>

                                            <input type="text" name="industry_button_link[]" class="form-control"
                                                value="{{ $item['button_link'] ?? '' }}" placeholder="#">

                                        </div>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>

                    <button type="submit" class="btn btn-success">

                        Save Industries Section

                    </button>

                </form>

            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        /*
            |--------------------------------------------------------------------------
            | ADD INDUSTRY
            |--------------------------------------------------------------------------
            */

        $('#addIndustry').click(function() {

            let html = `

        <div class="card mb-5 industry-card">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h4>
                    New Industry
                </h4>

                <button type="button"
                    class="btn btn-danger removeIndustry">

                    Remove

                </button>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>
                            Industry Image
                        </label>

                        <input type="file"
                            name="industry_image[]"
                            class="form-control">

                    </div>

                    <div class="col-md-6 mb-3"></div>

                    <div class="col-md-6 mb-3">

                        <label>
                            Tag
                        </label>

                        <input type="text"
                            name="industry_tag[]"
                            class="form-control"
                            placeholder="Healthcare">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>
                            Industry Title
                        </label>

                        <input type="text"
                            name="industry_title[]"
                            class="form-control"
                            placeholder="Healthcare Marketing & Web Solutions">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>
                            Description 1
                        </label>

                        <textarea name="description_1[]"
                            class="form-control"
                            rows="5"></textarea>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>
                            Description 2
                        </label>

                        <textarea name="description_2[]"
                            class="form-control"
                            rows="5"></textarea>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>
                            Button Text
                        </label>

                        <input type="text"
                            name="industry_button_text[]"
                            class="form-control"
                            placeholder="Learn More">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>
                            Button Link
                        </label>

                        <input type="text"
                            name="industry_button_link[]"
                            class="form-control"
                            placeholder="#">

                    </div>

                </div>

            </div>

        </div>

        `;

            $('#industryWrapper').append(html);

        });

        /*
        |--------------------------------------------------------------------------
        | REMOVE INDUSTRY
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.removeIndustry', function() {

            $(this)
                .closest('.industry-card')
                .remove();

        });
    </script>
@endpush
