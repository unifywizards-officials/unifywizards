@extends('layouts.app')

@section('content')
    <h1 class="page-header">Manage Introduction</h1>

    {{-- ================= FULL CMS FORM ================= --}}
    <div class="panel panel-inverse">

        <div class="panel-heading">
            <h4 class="panel-title">Introduction CMS (All Data Save Together)</h4>
        </div>

        <div class="panel-body">

            <form action="{{ route('admin.about-us.introduction.update', $main->id ?? 0) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                {{-- ================= MAIN SECTION ================= --}}
                <div class="row">

                    {{-- NAME --}}
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $main->name ?? '' }}">
                    </div>

                    {{-- TITLE --}}
                    <div class="col-md-6 mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $main->title ?? '' }}">
                    </div>

                    {{-- IMAGE --}}
                    <div class="col-md-12 mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">

                        @if (!empty($main->image))
                            <img src="{{ asset($main->image) }}" width="80" class="mt-2">
                            <p class="mt-1"><small>Current image. Upload a new one to replace.</small></p>
                        @endif
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea name="long_description" class="form-control" rows="4">{{ $main->long_description ?? '' }}</textarea>
                    </div>

                </div>

                <hr>

                {{-- ================= REPEATABLE SECTION ================= --}}
                <h4>Experience / Stats (Add More)</h4>

                <div id="repeat-box">

                    @forelse($main->stats_items as $item)
                        <div class="border p-3 mb-3 position-relative">

                            <input type="hidden" name="id[]" value="">

                            <div class="row">

                                {{-- NUMBER --}}
                                <div class="col-md-3 mb-2">
                                    <label>Number</label>
                                    <input type="text" name="number[]" class="form-control" value="{{ $item['number'] ?? '' }}">
                                </div>

                                {{-- HEADING --}}
                                <div class="col-md-3 mb-2">
                                    <label>Heading</label>
                                    <input type="text" name="heading[]" class="form-control"
                                        value="{{ $item['heading'] ?? '' }}">
                                </div>

                                {{-- ICON --}}
                                <div class="col-md-3 mb-2 d-flex align-items-end">
                                    <div class="w-100">
                                        <label>Icon</label>
                                        <input type="text" name="icon[]" class="form-control"
                                            value="{{ $item['icon'] ?? '' }}">
                                    </div>
                                </div>

                                {{-- SUFFIX --}}
                                <div class="col-md-3 mb-2">
                                    <label>Suffix</label>
                                    <input type="text" name="suffix[]" class="form-control"
                                        value="{{ $item['suffix'] ?? '' }}">
                                </div>

                            </div>

                        </div>
                    @empty
                        <div class="border p-3 mb-3">
                            <div class="row">

                                <div class="col-md-3 mb-2">
                                    <input type="text" name="number[]" class="form-control" placeholder="Number">
                                </div>

                                <div class="col-md-3 mb-2">
                                    <input type="text" name="heading[]" class="form-control" placeholder="Heading">
                                </div>

                                <div class="col-md-3 mb-2 d-flex align-items-end">
                                    <div class="w-100">
                                        <input type="text" name="icon[]" class="form-control" placeholder="Icon">
                                    </div>
                                </div>

                                <div class="col-md-3 mb-2">
                                    <input type="text" name="suffix[]" class="form-control" placeholder="Suffix">
                                </div>

                            </div>
                        </div>
                    @endforelse

                </div>

                {{-- ADD MORE BUTTON --}}
                <button type="button" class="btn btn-secondary mb-3" onclick="addMore()">
                    + Add More
                </button>

                <br>

                <button type="submit" class="btn btn-success">
                    Save All Data
                </button>

            </form>




        </div>
    </div>

    {{-- ================= JS ADD MORE ================= --}}
    <script>
        function addMore() {
            let html = `
    <div class="border p-3 mb-3 position-relative">

        <input type="hidden" name="id[]" value="">

        <div class="row">

            <div class="col-md-3 mb-2">
                <input type="text" name="number[]" class="form-control" placeholder="Number">
            </div>

            <div class="col-md-3 mb-2">
                <input type="text" name="heading[]" class="form-control" placeholder="Heading">
            </div>

            <div class="col-md-3 mb-2 d-flex align-items-end">
                <div class="w-100">
                    <input type="text" name="icon[]" class="form-control" placeholder="Icon">
                </div>
            </div>

            <div class="col-md-3 mb-2">
                <input type="text" name="suffix[]" class="form-control" placeholder="Suffix">
            </div>

            <div class="col-md-12 mt-2">
                <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.parentElement.parentElement.remove()">Remove</button>
            </div>

        </div>

    </div>`;

            document.getElementById('repeat-box').insertAdjacentHTML('beforeend', html);
        }
    </script>
@endsection