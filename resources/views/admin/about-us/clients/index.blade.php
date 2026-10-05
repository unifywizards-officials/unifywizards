{{-- resources/views/admin/clients/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Clients CMS')

@section('content')

    <div class="row">

        <div class="col-xl-12">

            <div class="panel panel-inverse">

                <div class="panel-heading">

                    <h4 class="panel-title">
                        Clients CMS
                    </h4>

                </div>

                <div class="panel-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.about-us.clients.update') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        {{-- Main Title --}}
                        <div class="mb-4">

                            <label class="form-label fw-bold">
                                Main Title
                            </label>

                            <input type="text" name="client_title" class="form-control"
                                value="{{ $mainData->client_title ?? '' }}" placeholder="Enter Main Title">

                        </div>

                        {{-- Main Heading --}}
                        <div class="mb-5">

                            <label class="form-label fw-bold">
                                Main Heading
                            </label>

                            <textarea name="client_heading" class="form-control" rows="4" placeholder="Enter Main Heading">{{ $mainData->client_heading ?? '' }}</textarea>

                        </div>

                        {{-- Header --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <h4 class="fw-bold mb-0">
                                Client Items
                            </h4>

                            <button type="button" class="btn btn-primary" id="addMore">

                                <i class="fa fa-plus me-1"></i>
                                Add More

                            </button>

                        </div>

                        {{-- Wrapper --}}
                        <div id="clientWrapper">

                            @forelse($clients as $item)
                                <div class="card shadow-sm border-0 mb-4 client-row">

                                    <div class="card-body">

                                        <div class="d-flex justify-content-between align-items-center mb-4">

                                            <h5 class="fw-bold mb-0">
                                                Client Item
                                            </h5>

                                            <button type="button" class="btn btn-danger btn-sm removeRow">

                                                <i class="fa fa-trash"></i>

                                            </button>

                                        </div>

                                        <div class="row">

                                            {{-- Logo --}}
                                            <div class="col-md-4 mb-3">

                                                <label class="form-label">
                                                    Logo
                                                </label>

                                                <input type="file" name="logo[]" class="form-control">

                                                <input type="hidden" name="old_logo[]" value="{{ $item->logo }}">

                                                @if ($item->logo)
                                                    <img src="{{ asset('uploads/clients/' . $item->logo) }}" width="70"
                                                        class="mt-2">
                                                @endif

                                            </div>

                                            {{-- Name --}}
                                            <div class="col-md-4 mb-3">

                                                <label class="form-label">
                                                    Client Name
                                                </label>

                                                <input type="text" name="name[]" class="form-control"
                                                    value="{{ $item->name }}" placeholder="Enter Client Name">

                                            </div>

                                            {{-- Website --}}
                                            <div class="col-md-4 mb-3">

                                                <label class="form-label">
                                                    Website
                                                </label>

                                                <input type="text" name="website[]" class="form-control"
                                                    value="{{ $item->website }}" placeholder="https://example.com">

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @empty

                                {{-- Default Row --}}
                                <div class="card shadow-sm border-0 mb-4 client-row">

                                    <div class="card-body">

                                        <div class="row">

                                            <div class="col-md-4 mb-3">

                                                <label class="form-label">
                                                    Logo
                                                </label>

                                                <input type="file" name="logo[]" class="form-control">

                                                <input type="hidden" name="old_logo[]" value="">

                                            </div>

                                            <div class="col-md-4 mb-3">

                                                <label class="form-label">
                                                    Client Name
                                                </label>

                                                <input type="text" name="name[]" class="form-control">

                                            </div>

                                            <div class="col-md-4 mb-3">

                                                <label class="form-label">
                                                    Website
                                                </label>

                                                <input type="text" name="website[]" class="form-control">

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            @endforelse

                        </div>

                        <div class="text-end">

                            <button type="submit" class="btn btn-success">

                                <i class="fa fa-save me-1"></i>
                                Update

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        $('#addMore').click(function() {

            $('#clientWrapper').append(`

            <div class="card shadow-sm border-0 mb-4 client-row">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h5 class="fw-bold mb-0">
                            Client Item
                        </h5>

                        <button type="button"
                                class="btn btn-danger btn-sm removeRow">

                            <i class="fa fa-trash"></i>

                        </button>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Logo
                            </label>

                            <input type="file"
                                   name="logo[]"
                                   class="form-control">

                            <input type="hidden"
                                   name="old_logo[]"
                                   value="">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Client Name
                            </label>

                            <input type="text"
                                   name="name[]"
                                   class="form-control">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Website
                            </label>

                            <input type="text"
                                   name="website[]"
                                   class="form-control">

                        </div>

                    </div>

                </div>

            </div>

        `);

        });

        $(document).on('click', '.removeRow', function() {

            $(this).closest('.client-row').remove();

        });
    </script>
@endpush
