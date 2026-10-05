@extends('layouts.app')

@section('title', 'Businesses Choose Us')

@section('page-title', 'Businesses Choose Us')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" />>

@section('content')

    <div class="container-fluid">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Businesses Choose Us
                </h3>

            </div>


            <form action="{{ route('business-choose-us.update') }}" method="POST">

                @csrf

                @method('PUT')


                <div class="card-body">


                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif


                    {{-- Validation Errors --}}
                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- Main Heading --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Heading
                        </label>

                        <input type="text" name="heading" class="form-control"
                            value="{{ old('heading', $businessChooseUs->heading ?? '') }}" placeholder="Enter heading">

                    </div>


                    {{-- Main Description --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea name="description" id="main_description" class="form-control">{{ old('description', $businessChooseUs->description ?? '') }}</textarea>

                    </div>


                    <hr>


                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h4 class="mb-0">
                            Businesses Choose Us Items
                        </h4>

                        <button type="button" class="btn btn-primary" id="addItem">
                            <i class="fa fa-plus"></i>
                            Add Item
                        </button>

                    </div>


                    {{-- ITEMS WILL COME HERE --}}
                    <div id="itemsContainer">

                        @php
                            $items = old('choose_items', $businessChooseUs->choose_items ?? []);
                        @endphp


                        @if (!empty($items))

                            @foreach ($items as $index => $item)
                                <div class="item-card card border mb-4">

                                    <div class="card-body">

                                        <div class="d-flex justify-content-between align-items-center mb-3">

                                            <h5 class="mb-0">
                                                Item
                                            </h5>

                                            <button type="button" class="btn btn-danger btn-sm removeItem">
                                                <i class="fa fa-trash"></i>
                                                Remove
                                            </button>

                                        </div>


                                        {{-- Title --}}
                                        <div class="mb-3">

                                            <label class="form-label">
                                                Title
                                            </label>

                                            <input type="text" name="choose_items[{{ $index }}][title]"
                                                class="form-control" value="{{ $item['title'] ?? '' }}"
                                                placeholder="Enter title">

                                        </div>


                                        {{-- Description --}}
                                        <div class="mb-3">

                                            <label class="form-label">
                                                Description
                                            </label>

                                            <textarea name="choose_items[{{ $index }}][description]" class="form-control item-description">{{ $item['description'] ?? '' }}</textarea>

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        @endif

                    </div>


                    {{-- Status --}}
                    <div class="mb-4">

                        <div class="form-check form-switch">

                            <input type="checkbox" name="status" value="1" class="form-check-input" id="status"
                                {{ old('status', $businessChooseUs->status ?? 1) ? 'checked' : '' }}>

                            <label class="form-check-label" for="status">
                                Active
                            </label>

                        </div>

                    </div>


                </div>


                <div class="card-footer text-end">

                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i>
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {

            /*
            |--------------------------------------------------------------------------
            | Init Summernote — existing item descriptions (loaded from DB)
            |--------------------------------------------------------------------------
            */
            $('.item-description').each(function() {
                $(this).summernote({
                    placeholder: 'Write item description...',
                    height: 180,
                    tabsize: 2
                });
            });


            /*
            |--------------------------------------------------------------------------
            | ADD ITEM
            |--------------------------------------------------------------------------
            */

            document.addEventListener('click', function(e) {

                if (!e.target.closest('#addItem')) {
                    return;
                }

                e.preventDefault();

                let index = Date.now();

                let html = `
            <div class="item-card card border mb-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h5 class="mb-0">
                            Item
                        </h5>

                        <button
                            type="button"
                            class="btn btn-danger btn-sm removeItem"
                        >
                            <i class="fa fa-trash"></i>
                            Remove
                        </button>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Title
                        </label>

                        <input
                            type="text"
                            name="choose_items[${index}][title]"
                            class="form-control"
                            placeholder="Enter title"
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="choose_items[${index}][description]"
                            class="form-control item-description"
                        ></textarea>

                    </div>

                </div>

            </div>
        `;

                let container = document.getElementById('itemsContainer');

                container.insertAdjacentHTML('beforeend', html);

                // Init Summernote only on the newly added item's textarea
                let lastCard = container.lastElementChild;

                $(lastCard).find('.item-description').summernote({
                    placeholder: 'Write item description...',
                    height: 180,
                    tabsize: 2
                });

            });


            /*
            |--------------------------------------------------------------------------
            | REMOVE ITEM
            |--------------------------------------------------------------------------
            */

            document.addEventListener('click', function(e) {

                let removeButton = e.target.closest('.removeItem');

                if (!removeButton) {
                    return;
                }

                e.preventDefault();

                let itemCard = removeButton.closest('.item-card');

                if (itemCard) {
                    itemCard.remove();
                }

            });

        });
    </script>
@endpush
