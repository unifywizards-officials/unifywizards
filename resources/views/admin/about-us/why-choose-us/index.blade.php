{{-- resources/views/admin/about-us/why-choose-us/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Why Choose Us')

@section('content')

    <ol class="breadcrumb float-xl-end">

        <li class="breadcrumb-item">
            <a href="{{ route('admin.home') }}">
                Home
            </a>
        </li>

        <li class="breadcrumb-item active">
            Why Choose Us
        </li>

    </ol>

    <h1 class="page-header">
        Why Choose Us CMS
    </h1>

    <div class="row">

        <div class="col-xl-12">

            <div class="panel panel-inverse">

                <div class="panel-heading">

                    <h4 class="panel-title">
                        Why Choose Us Settings
                    </h4>

                </div>

                <div class="panel-body">

                    {{-- Success --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.about-us.why-choose-us.update') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        {{-- Main Title --}}
                        <div class="mb-4">

                            <label class="form-label fw-bold">
                                Main Title
                            </label>

                            <input type="text" name="whychoose_title" class="form-control"
                                value="{{ $mainData->whychoose_title ?? '' }}" placeholder="Enter Main Title">

                        </div>

                        {{-- Main Heading --}}
                        <div class="mb-5">

                            <label class="form-label fw-bold">
                                Main Heading
                            </label>

                            <textarea name="whychoose_heading" class="form-control" rows="4" placeholder="Enter Main Heading">{{ $mainData->whychoose_heading ?? '' }}</textarea>

                        </div>

                        {{-- Header --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <div>

                                <h4 class="mb-1 fw-bold">
                                    Why Choose Items
                                </h4>

                                <p class="text-muted mb-0">
                                    Add multiple why choose cards
                                </p>

                            </div>

                            <button type="button" class="btn btn-primary" id="addMore">

                                <i class="fa fa-plus me-1"></i>
                                Add More

                            </button>

                        </div>

                        {{-- Wrapper --}}
                        <div id="whyChooseWrapper">

                            @forelse($whyChooseItems as $item)
                                <div class="card border-0 shadow-sm mb-4 why-row">

                                    <div class="card-body">

                                        <div class="d-flex justify-content-between align-items-center mb-4">

                                            <h5 class="mb-0 fw-bold">
                                                Why Choose Item
                                            </h5>

                                            <button type="button" class="btn btn-danger btn-sm removeRow">

                                                <i class="fa fa-trash"></i>

                                            </button>

                                        </div>

                                        <div class="row">

                                            {{-- Icon --}}
                                            <div class="col-md-4 mb-3">

                                                <label class="form-label fw-semibold">
                                                    Icon
                                                </label>

                                                <input type="file" name="icon[]" class="form-control">

                                                {{-- OLD ICON --}}
                                                <input type="hidden" name="old_icon[]" value="{{ $item->icon }}">

                                                @if ($item->icon)
                                                    <img src="{{ asset('uploads/why-choose/' . $item->icon) }}"
                                                        width="70" class="mt-2">
                                                @endif

                                            </div>

                                            {{-- Title --}}
                                            <div class="col-md-4 mb-3">

                                                <label class="form-label fw-semibold">
                                                    Card Title
                                                </label>

                                                <input type="text" name="title[]" class="form-control"
                                                    value="{{ $item->title }}" placeholder="Enter Title">

                                            </div>

                                            {{-- Description --}}
                                            <div class="col-md-4 mb-3">

                                                <label class="form-label fw-semibold">
                                                    Description
                                                </label>

                                                <textarea name="description[]" class="form-control" rows="3" placeholder="Enter Description">{{ $item->description }}</textarea>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @empty

                                {{-- Default Row --}}
                                <div class="card border-0 shadow-sm mb-4 why-row">

                                    <div class="card-body">

                                        <div class="d-flex justify-content-between align-items-center mb-4">

                                            <h5 class="mb-0 fw-bold">
                                                Why Choose Item
                                            </h5>

                                            <button type="button" class="btn btn-danger btn-sm removeRow">

                                                <i class="fa fa-trash"></i>

                                            </button>

                                        </div>

                                        <div class="row">

                                            {{-- Icon --}}
                                            <div class="col-md-4 mb-3">

                                                <label class="form-label fw-semibold">
                                                    Icon
                                                </label>

                                                <input type="file" name="icon[]" class="form-control">

                                                <input type="hidden" name="old_icon[]" value="">

                                            </div>

                                            {{-- Title --}}
                                            <div class="col-md-4 mb-3">

                                                <label class="form-label fw-semibold">
                                                    Card Title
                                                </label>

                                                <input type="text" name="title[]" class="form-control"
                                                    placeholder="Enter Title">

                                            </div>

                                            {{-- Description --}}
                                            <div class="col-md-4 mb-3">

                                                <label class="form-label fw-semibold">
                                                    Description
                                                </label>

                                                <textarea name="description[]" class="form-control" rows="3" placeholder="Enter Description"></textarea>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            @endforelse

                        </div>

                        {{-- Submit --}}
                        <div class="text-end">

                            <button type="submit" class="btn btn-success px-4">

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

            $('#whyChooseWrapper').append(`

            <div class="card border-0 shadow-sm mb-4 why-row">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h5 class="mb-0 fw-bold">
                            Why Choose Item
                        </h5>

                        <button type="button"
                                class="btn btn-danger btn-sm removeRow">

                            <i class="fa fa-trash"></i>

                        </button>

                    </div>

                    <div class="row">

                        {{-- Icon --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-semibold">
                                Icon
                            </label>

                            <input type="file"
                                   name="icon[]"
                                   class="form-control">

                            <input type="hidden"
                                   name="old_icon[]"
                                   value="">

                        </div>

                        {{-- Title --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-semibold">
                                Card Title
                            </label>

                            <input type="text"
                                   name="title[]"
                                   class="form-control"
                                   placeholder="Enter Title">

                        </div>

                        {{-- Description --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-semibold">
                                Description
                            </label>

                            <textarea name="description[]"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Enter Description"></textarea>

                        </div>

                    </div>

                </div>

            </div>

        `);

        });

        $(document).on('click', '.removeRow', function() {

            $(this).closest('.why-row').remove();

        });
    </script>
@endpush
