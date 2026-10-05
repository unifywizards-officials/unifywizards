@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h1 class="page-header mb-4">
            Manage Our Process Section
        </h1>

        <div class="panel panel-inverse">

            <div class="panel-heading">

                <h4 class="panel-title">
                    Our Process CMS
                </h4>

            </div>

            <div class="panel-body">

                <form action="{{ route('admin.home.our-process.update') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>
                                Sub Title
                            </label>

                            <input type="text" name="sub_title" class="form-control"
                                value="{{ $process->sub_title ?? '' }}">

                        </div>

                        <div class="col-md-8 mb-3">

                            <label>
                                Main Title
                            </label>

                            <input type="text" name="title" class="form-control" value="{{ $process->title ?? '' }}">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>
                                Description 1
                            </label>

                            <textarea name="description_1" class="form-control" rows="5">{{ $process->description_1 ?? '' }}</textarea>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>
                                Description 2
                            </label>

                            <textarea name="description_2" class="form-control" rows="5">{{ $process->description_2 ?? '' }}</textarea>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>
                                Button Text
                            </label>

                            <input type="text" name="button_text" class="form-control"
                                value="{{ $process->button_text ?? '' }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>
                                Button Link
                            </label>

                            <input type="text" name="button_link" class="form-control"
                                value="{{ $process->button_link ?? '' }}">

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h3>
                            Process Items
                        </h3>

                        <button type="button" class="btn btn-primary" id="addProcess">

                            Add Process

                        </button>

                    </div>

                    <div id="processWrapper">

                        @php
                            $items = $process->process_items ?? [];
                        @endphp

                        @foreach ($items as $index => $item)
                            <div class="card mb-4 process-card">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <h4>
                                        Process {{ $index + 1 }}
                                    </h4>

                                    <button type="button" class="btn btn-danger removeProcess">

                                        Remove

                                    </button>

                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-4 mb-3">

                                            <label>
                                                Icon Class
                                            </label>

                                            <input type="text" name="process_icon[]" class="form-control"
                                                value="{{ $item['icon'] ?? '' }}">

                                        </div>

                                        <div class="col-md-8 mb-3">

                                            <label>
                                                Title
                                            </label>

                                            <input type="text" name="process_title[]" class="form-control"
                                                value="{{ $item['title'] ?? '' }}">

                                        </div>

                                        <div class="col-md-12 mb-3">

                                            <label>
                                                Description
                                            </label>

                                            <textarea name="process_description_1[]" class="form-control" rows="5">{{ $item['description_1'] ?? '' }}</textarea>

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

                                <option value="1" {{ ($process->status ?? 1) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ ($process->status ?? 1) == 0 ? 'selected' : '' }}>
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
        $('#addProcess').click(function() {

            let html = `

            <div class="card mb-4 process-card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h4>
                        New Process
                    </h4>

                    <button type="button"
                        class="btn btn-danger removeProcess">

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
                                name="process_icon[]"
                                class="form-control">

                        </div>

                        <div class="col-md-8 mb-3">

                            <label>
                                Title
                            </label>

                            <input type="text"
                                name="process_title[]"
                                class="form-control">

                        </div>

                        <div class="col-md-12 mb-3">

                            <label>
                                Description
                            </label>

                            <textarea name="process_description_1[]"
                                class="form-control"
                                rows="5"></textarea>

                        </div>

                    </div>

                </div>

            </div>

            `;

            $('#processWrapper').append(html);

        });

        $(document).on('click', '.removeProcess', function() {

            $(this).closest('.process-card').remove();

        });
    </script>
@endpush
