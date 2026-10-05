@extends('layouts.app')

@section('content')
    @php
        $pressItems = $recognition->press_items ?? [];
    @endphp

    <div class="container-fluid">

        <h1 class="page-header mb-4">
            Manage Recognition & Press Section
        </h1>

        <div class="panel panel-inverse">

            <div class="panel-heading">

                <h4 class="panel-title">
                    Recognition & Press CMS
                </h4>

            </div>

            <div class="panel-body">

                <form action="{{ route('admin.home.recognition.press.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>
                                Sub Title
                            </label>

                            <input type="text" name="sub_title" class="form-control"
                                value="{{ $recognition->sub_title ?? '' }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>
                                Title
                            </label>

                            <input type="text" name="title" class="form-control"
                                value="{{ $recognition->title ?? '' }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>
                                Status
                            </label>

                            <select name="status" class="form-control">

                                <option value="1" {{ ($recognition->status ?? 1) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ ($recognition->status ?? 1) == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12 mb-3">

                            <label>
                                Description
                            </label>

                            <textarea name="description" class="form-control" rows="5">{{ $recognition->description ?? '' }}</textarea>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h3>
                            Press Items
                        </h3>

                        <button type="button" class="btn btn-primary" id="addPress">

                            Add Press Item

                        </button>

                    </div>

                    <div id="pressWrapper">

                        @foreach ($pressItems as $index => $item)
                            <div class="card mb-5 press-card">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <h4>
                                        Press Item {{ $index + 1 }}
                                    </h4>

                                    <button type="button" class="btn btn-danger removePress">

                                        Remove

                                    </button>

                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-4 mb-3">

                                            <label>
                                                Logo Image
                                            </label>

                                            <input type="file" name="press_logo[]" class="form-control">

                                            <input type="hidden" name="old_press_logo[]" value="{{ $item['logo'] ?? '' }}">

                                            @if (!empty($item['logo']))
                                                <img src="{{ asset($item['logo']) }}" width="80"
                                                    class="mt-2 border p-1">
                                            @endif

                                        </div>

                                        <div class="col-md-4 mb-3">

                                            <label>
                                                Press Name
                                            </label>

                                            <input type="text" name="press_name[]" class="form-control"
                                                value="{{ $item['name'] ?? '' }}">

                                        </div>

                                        <div class="col-md-4 mb-3">

                                            <label>
                                                Label
                                            </label>

                                            <input type="text" name="press_label[]" class="form-control"
                                                value="{{ $item['label'] ?? '' }}">

                                        </div>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>

                    <button type="submit" class="btn btn-success">

                        Save Section

                    </button>

                </form>

            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $('#addPress').click(function() {

            let html = `

        <div class="card mb-5 press-card">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h4>
                    New Press Item
                </h4>

                <button type="button"
                    class="btn btn-danger removePress">

                    Remove

                </button>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label>
                            Logo Image
                        </label>

                        <input type="file"
                            name="press_logo[]"
                            class="form-control">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label>
                            Press Name
                        </label>

                        <input type="text"
                            name="press_name[]"
                            class="form-control">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label>
                            Label
                        </label>

                        <input type="text"
                            name="press_label[]"
                            class="form-control">

                    </div>

                </div>

            </div>

        </div>

        `;

            $('#pressWrapper').append(html);

        });

        $(document).on('click', '.removePress', function() {

            $(this).closest('.press-card').remove();

        });
    </script>
@endpush
