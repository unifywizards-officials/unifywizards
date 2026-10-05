@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h1 class="page-header mb-4">
            Manage Company Overview Section
        </h1>

        <div class="panel panel-inverse">

            <div class="panel-heading">

                <h4 class="panel-title">
                    Company Overview CMS
                </h4>

            </div>

            <div class="panel-body">

                <form action="{{ route('admin.home.company.overview.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>
                                Sub Title
                            </label>

                            <input type="text" name="sub_title" class="form-control"
                                value="{{ $overview->sub_title ?? '' }}">

                        </div>

                        <div class="col-md-8 mb-3">

                            <label>
                                Main Title
                            </label>

                            <input type="text" name="title" class="form-control" value="{{ $overview->title ?? '' }}">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>
                                Button Text
                            </label>

                            <input type="text" name="button_text" class="form-control"
                                value="{{ $overview->button_text ?? '' }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>
                                Button Link
                            </label>

                            <input type="text" name="button_link" class="form-control"
                                value="{{ $overview->button_link ?? '' }}">

                        </div>

                    </div>

                    <hr>

                    <h3 class="mb-4">
                        Video Section
                    </h3>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>
                                Main Image
                            </label>

                            <input type="file" name="main_image" class="form-control">

                            @if (!empty($overview->main_image))
                                <img src="{{ asset($overview->main_image) }}" width="120" class="mt-2 rounded">
                            @endif

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>
                                Youtube Video Link
                            </label>

                            <input type="text" name="video_url" class="form-control"
                                value="{{ $overview->video_url ?? '' }}">

                        </div>

                    </div>

                    <hr>

                    <h3 class="mb-4">
                        Customer Section
                    </h3>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>
                                Customer Background Image
                            </label>

                            <input type="file" name="customer_bg" class="form-control">

                            @if (!empty($overview->customer_bg))
                                <img src="{{ asset($overview->customer_bg) }}" width="120" class="mt-2 rounded">
                            @endif

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>
                                Customer Text
                            </label>

                            <input type="text" name="customer_text" class="form-control"
                                value="{{ $overview->customer_text ?? '' }}">

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h3>
                            Customer Images
                        </h3>

                        <button type="button" class="btn btn-primary" id="addCustomerImage">

                            Add More

                        </button>

                    </div>

                    <div id="customerImageWrapper">

                        @php
                            $customerImages = $overview->customer_images ?? [];
                        @endphp

                        @if (!empty($customerImages))
                            @foreach ($customerImages as $image)
                                <div class="card mb-3 customer-image-card">

                                    <div class="card-body">

                                        <div class="row align-items-center">

                                            <div class="col-md-10">

                                                <label>
                                                    Customer Image
                                                </label>

                                                <input type="file" name="customer_images[]" class="form-control">

                                                <input type="hidden" name="old_customer_images[]"
                                                    value="{{ $image }}">

                                            </div>

                                            <div class="col-md-2">

                                                <img src="{{ asset($image) }}" width="80" class="rounded mt-4">
                                            </div>

                                        </div>

                                        <button type="button" class="btn btn-danger btn-sm mt-3 removeCustomerImage">

                                            Remove

                                        </button>

                                    </div>

                                </div>
                            @endforeach
                        @else
                            <div class="card mb-3 customer-image-card">

                                <div class="card-body">

                                    <label>
                                        Customer Image
                                    </label>

                                    <input type="file" name="customer_images[]" class="form-control">

                                    <button type="button" class="btn btn-danger btn-sm mt-3 removeCustomerImage">

                                        Remove

                                    </button>

                                </div>

                            </div>
                        @endif

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h3>
                            Counter Boxes
                        </h3>

                        <button type="button" class="btn btn-primary" id="addCounter">

                            Add Counter

                        </button>

                    </div>

                    <div id="counterWrapper">

                        @php
                            $counters = $overview->counters ?? [];
                        @endphp

                        @foreach ($counters as $index => $counter)
                            <div class="card mb-4 counter-card">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <h4>
                                        Counter {{ $index + 1 }}
                                    </h4>

                                    <button type="button" class="btn btn-danger removeCounter">

                                        Remove

                                    </button>

                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-4 mb-3">

                                            <label>
                                                Icon Class
                                            </label>

                                            <input type="text" name="counter_icon[]" class="form-control"
                                                value="{{ $counter['icon'] ?? '' }}">

                                        </div>

                                        <div class="col-md-4 mb-3">

                                            <label>
                                                Counter Title
                                            </label>

                                            <input type="text" name="counter_title[]" class="form-control"
                                                value="{{ $counter['title'] ?? '' }}">

                                        </div>

                                        <div class="col-md-4 mb-3">

                                            <label>
                                                Count Number
                                            </label>

                                            <input type="text" name="counter_number[]" class="form-control"
                                                value="{{ $counter['number'] ?? '' }}">

                                        </div>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>

                    <div class="row mt-4">

                        <div class="col-md-4 mb-3">

                            <label>
                                Status
                            </label>

                            <select name="status" class="form-control">

                                <option value="1" {{ ($overview->status ?? 1) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ ($overview->status ?? 1) == 0 ? 'selected' : '' }}>
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
        $('#addCustomerImage').click(function() {

            let html = `

            <div class="card mb-3 customer-image-card">

                <div class="card-body">

                    <label>
                        Customer Image
                    </label>

                    <input type="file"
                        name="customer_images[]"
                        class="form-control">

                    <button type="button"
                        class="btn btn-danger btn-sm mt-3 removeCustomerImage">

                        Remove

                    </button>

                </div>

            </div>

            `;

            $('#customerImageWrapper').append(html);

        });

        $(document).on('click', '.removeCustomerImage', function() {

            $(this).closest('.customer-image-card').remove();

        });

        $('#addCounter').click(function() {

            let html = `

            <div class="card mb-4 counter-card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h4>
                        New Counter
                    </h4>

                    <button type="button"
                        class="btn btn-danger removeCounter">

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
                                name="counter_icon[]"
                                class="form-control">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>
                                Counter Title
                            </label>

                            <input type="text"
                                name="counter_title[]"
                                class="form-control">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>
                                Count Number
                            </label>

                            <input type="text"
                                name="counter_number[]"
                                class="form-control">

                        </div>

                    </div>

                </div>

            </div>

            `;

            $('#counterWrapper').append(html);

        });

        $(document).on('click', '.removeCounter', function() {

            $(this).closest('.counter-card').remove();

        });
    </script>
@endpush
