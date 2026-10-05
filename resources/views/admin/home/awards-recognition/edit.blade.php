@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h1 class="page-header mb-4">
            Manage Awards & Recognition
        </h1>

        <div class="panel panel-inverse">

            <div class="panel-heading">

                <h4 class="panel-title">
                    Awards & Recognition CMS
                </h4>

            </div>

            <div class="panel-body">

                <form action="{{ route('admin.home.awards.recognition.update') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>
                                Sub Title
                            </label>

                            <input type="text" name="sub_title" class="form-control"
                                value="{{ $awards->sub_title ?? '' }}">

                        </div>

                        <div class="col-md-8 mb-3">

                            <label>
                                Main Title
                            </label>

                            <input type="text" name="title" class="form-control" value="{{ $awards->title ?? '' }}">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12 mb-3">

                            <label>
                                Description
                            </label>

                            <textarea name="description" class="form-control" rows="4">{{ $awards->description ?? '' }}</textarea>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>
                                Button Text
                            </label>

                            <input type="text" name="button_text" class="form-control"
                                value="{{ $awards->button_text ?? '' }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>
                                Button Link
                            </label>

                            <input type="text" name="button_link" class="form-control"
                                value="{{ $awards->button_link ?? '' }}">

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h3>
                            Award Cards
                        </h3>

                        <button type="button" class="btn btn-primary" id="addAward">

                            Add Award

                        </button>

                    </div>

                    <div id="awardWrapper">

                        @php
                            $items = $awards->award_items ?? [];
                        @endphp

                        @foreach ($items as $index => $item)
                            <div class="card mb-4 award-card">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <h4>
                                        Award {{ $index + 1 }}
                                    </h4>

                                    <button type="button" class="btn btn-danger removeAward">

                                        Remove

                                    </button>

                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-2 mb-3">

                                            <label>
                                                Year
                                            </label>

                                            <input type="text" name="award_year[]" class="form-control"
                                                value="{{ $item['year'] ?? '' }}">

                                        </div>

                                        <div class="col-md-5 mb-3">

                                            <label>
                                                Award Name
                                            </label>

                                            <input type="text" name="award_name[]" class="form-control"
                                                value="{{ $item['award_name'] ?? '' }}">

                                        </div>

                                        <div class="col-md-5 mb-3">

                                            <label>
                                                Award By
                                            </label>

                                            <input type="text" name="award_by[]" class="form-control"
                                                value="{{ $item['award_by'] ?? '' }}">

                                        </div>

                                        <div class="col-md-4 mb-3">

                                            <label>
                                                Location
                                            </label>

                                            <input type="text" name="award_location[]" class="form-control"
                                                value="{{ $item['location'] ?? '' }}">

                                        </div>

                                        <div class="col-md-4 mb-3">

                                            <label>
                                                Category
                                            </label>

                                            <input type="text" name="award_category[]" class="form-control"
                                                value="{{ $item['category'] ?? '' }}">

                                        </div>

                                        <div class="col-md-4 mb-3">

                                            <label>
                                                Icon Class
                                            </label>

                                            <input type="text" name="award_icon[]" class="form-control"
                                                value="{{ $item['icon_class'] ?? '' }}">

                                        </div>

                                        <div class="col-md-4 mb-3">

                                            <label>
                                                Card Type
                                            </label>

                                            <select name="card_type[]" class="form-control">

                                                <option value="featured"
                                                    {{ ($item['card_type'] ?? '') == 'featured' ? 'selected' : '' }}>
                                                    Featured
                                                </option>

                                                <option value="normal"
                                                    {{ ($item['card_type'] ?? '') == 'normal' ? 'selected' : '' }}>
                                                    Normal
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-12 mb-3">

                            <label>
                                Bottom Text
                            </label>

                            <textarea name="bottom_text" class="form-control" rows="4">{{ $awards->bottom_text ?? '' }}</textarea>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>
                                Status
                            </label>

                            <select name="status" class="form-control">

                                <option value="1" {{ ($awards->status ?? 1) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ ($awards->status ?? 1) == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                    <button type="submit" class="btn btn-success mt-3">

                        Save Section

                    </button>

                </form>

            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $('#addAward').click(function() {

            let html = `

    <div class="card mb-4 award-card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4>
                New Award
            </h4>

            <button type="button"
                class="btn btn-danger removeAward">

                Remove

            </button>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-2 mb-3">

                    <label>
                        Year
                    </label>

                    <input type="text"
                        name="award_year[]"
                        class="form-control">

                </div>

                <div class="col-md-5 mb-3">

                    <label>
                        Award Name
                    </label>

                    <input type="text"
                        name="award_name[]"
                        class="form-control">

                </div>

                <div class="col-md-5 mb-3">

                    <label>
                        Award By
                    </label>

                    <input type="text"
                        name="award_by[]"
                        class="form-control">

                </div>

                <div class="col-md-4 mb-3">

                    <label>
                        Location
                    </label>

                    <input type="text"
                        name="award_location[]"
                        class="form-control">

                </div>

                <div class="col-md-4 mb-3">

                    <label>
                        Category
                    </label>

                    <input type="text"
                        name="award_category[]"
                        class="form-control">

                </div>

                <div class="col-md-4 mb-3">

                    <label>
                        Icon Class
                    </label>

                    <input type="text"
                        name="award_icon[]"
                        class="form-control">

                </div>

                <div class="col-md-4 mb-3">

                    <label>
                        Card Type
                    </label>

                    <select name="card_type[]"
                        class="form-control">

                        <option value="featured">
                            Featured
                        </option>

                        <option value="normal">
                            Normal
                        </option>

                    </select>

                </div>

            </div>

        </div>

    </div>

    `;

            $('#awardWrapper').append(html);

        });

        $(document).on('click', '.removeAward', function() {

            $(this).closest('.award-card').remove();

        });
    </script>
@endpush
