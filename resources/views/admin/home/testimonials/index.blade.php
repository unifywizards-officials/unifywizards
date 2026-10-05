@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">

        <form action="{{ route('admin.home.clients-feedback.update') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="panel panel-inverse">

                <div class="panel-heading d-flex justify-content-between align-items-center">

                    <h4 class="panel-title">
                        Clients Feedback CMS
                    </h4>

                    <button type="submit" class="btn btn-success">

                        Save Section

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
                                        value="{{ $testimonial->sub_title ?? '' }}">

                                </div>

                                <div class="col-md-8 mb-3">

                                    <label>
                                        Main Title
                                    </label>

                                    <input type="text" name="title" class="form-control"
                                        value="{{ $testimonial->title ?? '' }}">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label>
                                        Highlight Text
                                    </label>

                                    <input type="text" name="highlight_text" class="form-control"
                                        value="{{ $testimonial->highlight_text ?? '' }}">

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- ================= TESTIMONIALS ================= --}}

                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h4>
                                Testimonials
                            </h4>

                            <button type="button" class="btn btn-primary" id="addTestimonial">

                                + Add Testimonial

                            </button>

                        </div>

                        <div class="card-body">

                            <div id="testimonialWrapper">

                                @php
                                    $testimonials = $testimonial->testimonials_json ?? [];
                                @endphp

                                @foreach ($testimonials as $item)
                                    <div class="card mb-4 testimonial-card">

                                        <div
                                            class="card-header d-flex justify-content-between align-items-center bg-dark text-white">

                                            <h5 class="mb-0">
                                                Testimonial
                                            </h5>

                                            <button type="button" class="btn btn-danger btn-sm removeTestimonial">

                                                Remove

                                            </button>

                                        </div>

                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-md-6 mb-3">

                                                    <label>
                                                        Client Name
                                                    </label>

                                                    <input type="text" name="testimonial_name[]" class="form-control"
                                                        value="{{ $item['name'] ?? '' }}">

                                                </div>

                                                <div class="col-md-6 mb-3">

                                                    <label>
                                                        Designation
                                                    </label>

                                                    <input type="text" name="testimonial_designation[]"
                                                        class="form-control" value="{{ $item['designation'] ?? '' }}">

                                                </div>

                                                <div class="col-md-12 mb-3">

                                                    <label>
                                                        Description
                                                    </label>

                                                    <textarea name="testimonial_description[]" class="form-control" rows="5">{{ $item['description'] ?? '' }}</textarea>

                                                </div>

                                                <div class="col-md-6 mb-3">

                                                    <label>
                                                        Client Image
                                                    </label>

                                                    <input type="file" name="testimonial_image[]" class="form-control">

                                                </div>

                                                @if (!empty($item['image']))
                                                    <div class="col-md-6 mb-3">

                                                        <img src="{{ asset($item['image']) }}" width="100"
                                                            class="rounded">

                                                    </div>
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

                                    <option value="1" {{ ($testimonial->status ?? 1) == 1 ? 'selected' : '' }}>

                                        Active

                                    </option>

                                    <option value="0" {{ ($testimonial->status ?? 1) == 0 ? 'selected' : '' }}>

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
        $(document).on('click', '#addTestimonial', function() {

            let html = `

    <div class="card mb-4 testimonial-card">

        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">

            <h5 class="mb-0">
                New Testimonial
            </h5>

            <button type="button"
                    class="btn btn-danger btn-sm removeTestimonial">

                Remove

            </button>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>
                        Client Name
                    </label>

                    <input type="text"
                           name="testimonial_name[]"
                           class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label>
                        Designation
                    </label>

                    <input type="text"
                           name="testimonial_designation[]"
                           class="form-control">

                </div>

                <div class="col-md-12 mb-3">

                    <label>
                        Description
                    </label>

                    <textarea name="testimonial_description[]"
                              class="form-control"
                              rows="5"></textarea>

                </div>

                <div class="col-md-6 mb-3">

                    <label>
                        Client Image
                    </label>

                    <input type="file"
                           name="testimonial_image[]"
                           class="form-control">

                </div>

            </div>

        </div>

    </div>
    `;

            $('#testimonialWrapper').append(html);
        });


        $(document).on('click', '.removeTestimonial', function() {

            $(this).closest('.testimonial-card').remove();
        });
    </script>
@endpush
