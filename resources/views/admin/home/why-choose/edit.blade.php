@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h1 class="page-header mb-4">
            Manage Why Choose Us (Homepage)
        </h1>

        <div class="panel panel-inverse">

            <div class="panel-heading">

                <h4 class="panel-title">
                    Why Choose Us CMS
                </h4>

            </div>

            <div class="panel-body">

                <form action="{{ route('admin.home.why-choose.update') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>
                                Badge Text
                            </label>

                            <input type="text" name="sub_title" class="form-control"
                                placeholder="e.g. Why Choose Us"
                                value="{{ $whyChoose->sub_title ?? '' }}">

                        </div>

                        <div class="col-md-8 mb-3">

                            <label>
                                Main Heading
                            </label>

                            <input type="text" name="title" class="form-control"
                                placeholder="e.g. Why Do Thousands of Businesses Choose Our Digital Marketing Company?"
                                value="{{ $whyChoose->title ?? '' }}">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12 mb-3">

                            <label>
                                Description
                            </label>

                            <textarea name="description" class="form-control" rows="3">{{ $whyChoose->description ?? '' }}</textarea>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h3>
                            Reasons
                        </h3>

                        <button type="button" class="btn btn-primary" id="addWhyChooseItem">
                            Add Reason
                        </button>

                    </div>

                    <div id="whyChooseWrapper">

                        @php
                            $items = $whyChoose->items ?? [];
                        @endphp

                        @foreach ($items as $index => $item)
                            <div class="card mb-4 why-choose-item-card">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <h4>
                                        Reason {{ $index + 1 }}
                                    </h4>

                                    <button type="button" class="btn btn-danger removeWhyChooseItem">
                                        Remove
                                    </button>

                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-12 mb-3">

                                            <label>
                                                Title
                                            </label>

                                            <input type="text" name="item_title[]" class="form-control"
                                                value="{{ $item['title'] ?? '' }}">

                                        </div>

                                        <div class="col-md-12 mb-3">

                                            <label>
                                                Description
                                            </label>

                                            <textarea name="item_description[]" class="form-control" rows="2">{{ $item['description'] ?? '' }}</textarea>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>
                                Status
                            </label>

                            <select name="status" class="form-control">

                                <option value="1" {{ ($whyChoose->status ?? 1) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ ($whyChoose->status ?? 1) == 0 ? 'selected' : '' }}>
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
        $('#addWhyChooseItem').click(function() {

            let html = `

    <div class="card mb-4 why-choose-item-card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4>
                New Reason
            </h4>

            <button type="button"
                class="btn btn-danger removeWhyChooseItem">
                Remove
            </button>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-12 mb-3">

                    <label>
                        Title
                    </label>

                    <input type="text"
                        name="item_title[]"
                        class="form-control">

                </div>

                <div class="col-md-12 mb-3">

                    <label>
                        Description
                    </label>

                    <textarea name="item_description[]"
                        class="form-control"
                        rows="2"></textarea>

                </div>

            </div>

        </div>

    </div>

    `;

            $('#whyChooseWrapper').append(html);

        });

        $(document).on('click', '.removeWhyChooseItem', function() {

            $(this).closest('.why-choose-item-card').remove();

        });
    </script>
@endpush
