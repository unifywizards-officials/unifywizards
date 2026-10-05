{{-- resources/views/admin/about-us/reviews/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Reviews CMS')

@section('content')

    {{-- Breadcrumb --}}
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">Reviews CMS</li>
    </ol>

    <h1 class="page-header">Reviews CMS</h1>

    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse">

                <div class="panel-heading">
                    <h4 class="panel-title">Reviews Section Settings</h4>
                </div>

                <div class="panel-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle me-1"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.about-us.reviews.update', 1) }}" method="POST"
                        enctype="multipart/form-data" id="reviewsForm">
                        @csrf

                        {{-- ================================================= --}}
                        {{-- SECTION 1: LEFT SIDE CONTENT                        --}}
                        {{-- ================================================= --}}
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white">
                                <h4 class="mb-0 fw-bold">
                                    <i class="fa fa-align-left text-primary me-2"></i>
                                    Left Side Content
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold">Badge Text</label>
                                        <input type="text" name="badge" class="form-control"
                                            value="{{ $review->badge ?? '' }}" placeholder="OUR REPUTATION">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold">Main Heading</label>
                                        <input type="text" name="heading" class="form-control"
                                            value="{{ $review->heading ?? '' }}"
                                            placeholder="Recognized & Trusted Across Platforms">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold">Description 1</label>
                                        <textarea name="description_1" class="form-control" rows="5" placeholder="Enter description...">{{ $review->description_1 ?? '' }}</textarea>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold">Description 2</label>
                                        <textarea name="description_2" class="form-control" rows="5" placeholder="Enter description...">{{ $review->description_2 ?? '' }}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- ================================================= --}}
                        {{-- SECTION 2: PLATFORM REVIEWS (→ review_items JSON)  --}}
                        {{-- ================================================= --}}
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="mb-1 fw-bold">
                                        <i class="fa fa-star text-warning me-2"></i>
                                        Platform Reviews
                                    </h4>
                                    <p class="text-muted mb-0 small">
                                        Saved as <code>review_items</code> JSON array in DB
                                    </p>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm" id="addPlatformReview">
                                    <i class="fa fa-plus me-1"></i> Add Platform
                                </button>
                            </div>

                            <div class="card-body">
                                <div id="platformReviewWrapper">

                                    {{-- Loop existing review_items from JSON --}}
                                    @php
                                        $reviewItems = $review->review_items ?? [];
                                    @endphp

                                    @forelse($reviewItems as $index => $item)
                                        <div class="border rounded p-4 mb-3 platform-review-row bg-light">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="fw-bold mb-0 text-primary">
                                                    <i class="fa fa-star me-1"></i> Platform Review #{{ $index + 1 }}
                                                </h6>
                                                <button type="button" class="btn btn-danger btn-sm removeRow">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </div>

                                            <div class="row">

                                                {{-- Icon --}}
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label fw-semibold">Icon Image</label>
                                                    {{-- Hidden: existing icon filename --}}
                                                    <input type="hidden" name="existing_icon[]"
                                                        value="{{ $item['icon'] ?? '' }}">
                                                    <input type="file" name="platform_icon[]" class="form-control"
                                                        accept="image/*">
                                                    @if (!empty($item['icon']))
                                                        <div class="mt-2">
                                                            <img src="{{ asset('uploads/reviews/' . $item['icon']) }}"
                                                                width="50" height="50" class="rounded border"
                                                                style="object-fit:contain;" alt="icon">
                                                            <small class="text-muted d-block mt-1">
                                                                Current: {{ $item['icon'] }}
                                                            </small>
                                                        </div>
                                                    @endif
                                                </div>

                                                {{-- Title --}}
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label fw-semibold">Platform Title</label>
                                                    <input type="text" name="platform_title[]" class="form-control"
                                                        value="{{ $item['title'] ?? '' }}" placeholder="Google Reviews">
                                                </div>

                                                {{-- Rating --}}
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label fw-semibold">Rating</label>
                                                    <input type="text" name="platform_rating[]" class="form-control"
                                                        value="{{ $item['rating'] ?? '' }}" placeholder="4.9">
                                                </div>

                                                {{-- Small Text --}}
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label fw-semibold">Small Text</label>
                                                    <input type="text" name="platform_small_text[]"
                                                        class="form-control" value="{{ $item['small_text'] ?? '' }}"
                                                        placeholder="150+ verified reviews">
                                                </div>

                                            </div>
                                        </div>
                                    @empty
                                        {{-- Default empty row when no data --}}
                                        <div class="border rounded p-4 mb-3 platform-review-row bg-light">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="fw-bold mb-0 text-primary">
                                                    <i class="fa fa-star me-1"></i> Platform Review #1
                                                </h6>
                                                <button type="button" class="btn btn-danger btn-sm removeRow">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label fw-semibold">Icon Image</label>
                                                    <input type="hidden" name="existing_icon[]" value="">
                                                    <input type="file" name="platform_icon[]" class="form-control"
                                                        accept="image/*">
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label fw-semibold">Platform Title</label>
                                                    <input type="text" name="platform_title[]" class="form-control"
                                                        placeholder="Google Reviews">
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label fw-semibold">Rating</label>
                                                    <input type="text" name="platform_rating[]" class="form-control"
                                                        placeholder="4.9">
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label fw-semibold">Small Text</label>
                                                    <input type="text" name="platform_small_text[]"
                                                        class="form-control" placeholder="150+ verified reviews">
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse

                                </div>{{-- /#platformReviewWrapper --}}
                            </div>
                        </div>

                        {{-- ================================================= --}}
                        {{-- SECTION 3: TESTIMONIALS (→ testimonial_items JSON) --}}
                        {{-- ================================================= --}}
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="mb-1 fw-bold">
                                        <i class="fa fa-comment text-success me-2"></i>
                                        Testimonials
                                    </h4>
                                    <p class="text-muted mb-0 small">
                                        Saved as <code>testimonial_items</code> JSON array in DB
                                    </p>
                                </div>
                                <button type="button" class="btn btn-success btn-sm" id="addTestimonial">
                                    <i class="fa fa-plus me-1"></i> Add Testimonial
                                </button>
                            </div>

                            <div class="card-body">
                                <div id="testimonialWrapper">

                                    @php
                                        $testimonialItems = $review->testimonial_items ?? [];
                                    @endphp

                                    @forelse($testimonialItems as $index => $item)
                                        <div class="border rounded p-4 mb-3 testimonial-row bg-light">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="fw-bold mb-0 text-success">
                                                    <i class="fa fa-comment me-1"></i> Testimonial #{{ $index + 1 }}
                                                </h6>
                                                <button type="button" class="btn btn-danger btn-sm removeRow">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Review Text</label>
                                                    <textarea name="testimonial_review[]" class="form-control" rows="5" placeholder="Enter review...">{{ $item['review'] ?? '' }}</textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Client Name</label>
                                                        <input type="text" name="testimonial_name[]"
                                                            class="form-control" value="{{ $item['name'] ?? '' }}"
                                                            placeholder="Rahul Mehra">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Designation</label>
                                                        <input type="text" name="testimonial_designation[]"
                                                            class="form-control" value="{{ $item['designation'] ?? '' }}"
                                                            placeholder="CEO - TechVentures India">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @empty
                                        <div class="border rounded p-4 mb-3 testimonial-row bg-light">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="fw-bold mb-0 text-success">
                                                    <i class="fa fa-comment me-1"></i> Testimonial #1
                                                </h6>
                                                <button type="button" class="btn btn-danger btn-sm removeRow">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Review Text</label>
                                                    <textarea name="testimonial_review[]" class="form-control" rows="5" placeholder="Enter review..."></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Client Name</label>
                                                        <input type="text" name="testimonial_name[]"
                                                            class="form-control" placeholder="Rahul Mehra">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Designation</label>
                                                        <input type="text" name="testimonial_designation[]"
                                                            class="form-control" placeholder="CEO - TechVentures India">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse

                                </div>{{-- /#testimonialWrapper --}}
                            </div>
                        </div>

                        {{-- ================================================= --}}
                        {{-- SECTION 4: BOTTOM STATS                             --}}
                        {{-- ================================================= --}}
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white">
                                <h4 class="mb-0 fw-bold">
                                    <i class="fa fa-chart-bar text-info me-2"></i>
                                    Bottom Statistics
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Retention Rate</label>
                                        <input type="text" name="retention_rate" class="form-control"
                                            value="{{ $review->retention_rate ?? '' }}" placeholder="80%">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Satisfaction Rate</label>
                                        <input type="text" name="satisfaction_rate" class="form-control"
                                            value="{{ $review->satisfaction_rate ?? '' }}" placeholder="93%">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-5">
                                <i class="fa fa-save me-2"></i> Update Reviews Section
                            </button>
                        </div>

                    </form>

                </div>{{-- /.panel-body --}}
            </div>{{-- /.panel --}}
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        /* ============================================================
       Platform Review counter for labeling new rows
    ============================================================ */
        var platformCount = {{ count($review->review_items ?? []) }};
        var testimonialCount = {{ count($review->testimonial_items ?? []) }};

        /* ============================================================
           ADD PLATFORM REVIEW ROW
        ============================================================ */
        $('#addPlatformReview').on('click', function() {
            platformCount++;

            var html = `
        <div class="border rounded p-4 mb-3 platform-review-row bg-light">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0 text-primary">
                    <i class="fa fa-star me-1"></i> Platform Review #${platformCount}
                </h6>
                <button type="button" class="btn btn-danger btn-sm removeRow">
                    <i class="fa fa-trash"></i> Remove
                </button>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Icon Image</label>
                    <input type="hidden" name="existing_icon[]" value="">
                    <input type="file" name="platform_icon[]" class="form-control" accept="image/*">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Platform Title</label>
                    <input type="text" name="platform_title[]" class="form-control" placeholder="Google Reviews">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Rating</label>
                    <input type="text" name="platform_rating[]" class="form-control" placeholder="4.9">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Small Text</label>
                    <input type="text" name="platform_small_text[]" class="form-control" placeholder="150+ verified reviews">
                </div>
            </div>
        </div>`;

            $('#platformReviewWrapper').append(html);
        });

        /* ============================================================
           ADD TESTIMONIAL ROW
        ============================================================ */
        $('#addTestimonial').on('click', function() {
            testimonialCount++;

            var html = `
        <div class="border rounded p-4 mb-3 testimonial-row bg-light">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0 text-success">
                    <i class="fa fa-comment me-1"></i> Testimonial #${testimonialCount}
                </h6>
                <button type="button" class="btn btn-danger btn-sm removeRow">
                    <i class="fa fa-trash"></i> Remove
                </button>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Review Text</label>
                    <textarea name="testimonial_review[]" class="form-control" rows="5" placeholder="Enter review..."></textarea>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Client Name</label>
                        <input type="text" name="testimonial_name[]" class="form-control" placeholder="Rahul Mehra">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Designation</label>
                        <input type="text" name="testimonial_designation[]" class="form-control" placeholder="CEO - TechVentures India">
                    </div>
                </div>
            </div>
        </div>`;

            $('#testimonialWrapper').append(html);
        });

        /* ============================================================
           REMOVE ROW
        ============================================================ */
        $(document).on('click', '.removeRow', function() {
            $(this).closest('.platform-review-row, .testimonial-row').remove();
        });

        /* ============================================================
           IMAGE PREVIEW before upload
        ============================================================ */
        $(document).on('change', 'input[name="platform_icon[]"]', function() {
            var file = this.files[0];
            if (!file) return;

            var reader = new FileReader();
            var $input = $(this);

            reader.onload = function(e) {
                // Remove old preview if any
                $input.siblings('div.mt-2').remove();
                $input.after(
                    '<div class="mt-2">' +
                    '<img src="' + e.target.result + '" width="50" height="50" ' +
                    'class="rounded border" style="object-fit:contain;" alt="preview">' +
                    '<small class="text-muted d-block mt-1">New image selected</small>' +
                    '</div>'
                );
            };

            reader.readAsDataURL(file);
        });
    </script>
@endpush
