@extends('layouts.app')

@section('title', 'Clients Recommend')

@section('page-title', 'Clients Recommend')

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">

                        <h4 class="card-title mb-0">
                            Clients Recommend Us
                        </h4>

                    </div>

                    <form action="{{ route('client-recommend.update') }}" method="POST" enctype="multipart/form-data">

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


                            {{-- SECTION TITLE --}}
                            <div class="mb-4">

                                <label class="form-label">
                                    Section Title <span class="text-danger">*</span>
                                </label>

                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $clientRecommend->title ?? '') }}"
                                    placeholder="Clients Recommend Us" required>

                            </div>


                            {{-- SECTION DESCRIPTION --}}
                            <div class="mb-4">

                                <label class="form-label">
                                    Section Description
                                </label>

                                <textarea name="description" class="form-control" rows="4" placeholder="Enter section description">{{ old('description', $clientRecommend->description ?? '') }}</textarea>

                            </div>


                            {{-- STATUS --}}
                            <div class="mb-4">

                                <label class="form-label d-block">
                                    Status
                                </label>

                                <div class="form-check form-switch">

                                    <input type="hidden" name="status" value="0">

                                    <input class="form-check-input" type="checkbox" name="status" value="1"
                                        id="status"
                                        {{ old('status', $clientRecommend->status ?? true) ? 'checked' : '' }}>

                                    <label class="form-check-label" for="status">
                                        Active
                                    </label>

                                </div>

                            </div>


                            <hr>


                            {{-- CLIENTS --}}
                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <h5 class="mb-0">
                                    Client Recommendations
                                </h5>

                                <button type="button" class="btn btn-primary btn-sm" id="addClient">
                                    <i class="fa fa-plus"></i>
                                    Add Client
                                </button>

                            </div>


                            <div id="clientsWrapper">

                                @php
                                    $clients = old('clients', $clientRecommend->clients ?? []);
                                @endphp


                                @forelse($clients as $index => $client)
                                    <div class="client-item card border mb-4">

                                        <div class="card-header d-flex justify-content-between align-items-center">

                                            <strong>
                                                Client {{ $index + 1 }}
                                            </strong>

                                            <button type="button" class="btn btn-danger btn-sm removeClient">
                                                <i class="fa fa-trash"></i>
                                                Remove
                                            </button>

                                        </div>


                                        <div class="card-body">

                                            <div class="row">

                                                {{-- NAME --}}
                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Client Name
                                                        <span class="text-danger">*</span>
                                                    </label>

                                                    <input type="text" name="clients[{{ $index }}][name]"
                                                        class="form-control" value="{{ $client['name'] ?? '' }}" required>

                                                </div>


                                                {{-- DESIGNATION --}}
                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Designation
                                                        <span class="text-danger">*</span>
                                                    </label>

                                                    <input type="text" name="clients[{{ $index }}][designation]"
                                                        class="form-control" value="{{ $client['designation'] ?? '' }}"
                                                        required>

                                                </div>

                                                {{-- IMAGE --}}
                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Client Image
                                                    </label>

                                                    <input type="file" name="clients[{{ $index }}][image]"
                                                        class="form-control" accept="image/jpeg,image/png,image/webp">

                                                    <input type="hidden" name="clients[{{ $index }}][old_image]"
                                                        value="{{ $client['image'] ?? '' }}">

                                                    @if (!empty($client['image']))
                                                        <div class="mt-2">

                                                            <img src="{{ asset('storage/' . $client['image']) }}"
                                                                alt="{{ $client['name'] ?? 'Client' }}"
                                                                style="width:120px;height:80px;object-fit:cover;border-radius:6px;">

                                                        </div>
                                                    @endif

                                                </div>


                                                {{-- VIDEO FILE --}}
                                                <div class="col-md-6 mb-3 videoFileBox"
                                                    style="{{ ($client['video_type'] ?? 'file') === 'url' ? 'display:none;' : '' }}">

                                                    <label class="form-label">
                                                        Video
                                                    </label>

                                                    <input type="file" name="clients[{{ $index }}][video]"
                                                        class="form-control" accept="video/mp4,video/webm,video/ogg">

                                                    <input type="hidden" name="clients[{{ $index }}][old_video]"
                                                        value="{{ ($client['video_type'] ?? 'file') === 'file' ? $client['video'] ?? '' : '' }}">

                                                    @if (!empty($client['video']) && ($client['video_type'] ?? 'file') === 'file')
                                                        <small class="text-success">
                                                            Existing video uploaded.
                                                        </small>
                                                    @endif

                                                </div>


                                                {{-- VIDEO URL --}}
                                                <div class="col-md-6 mb-3 videoUrlBox"
                                                    style="{{ ($client['video_type'] ?? '') === 'url' ? '' : 'display:none;' }}">

                                                    <label class="form-label">
                                                        Video URL
                                                    </label>

                                                    <input type="url" name="clients[{{ $index }}][video]"
                                                        class="form-control"
                                                        value="{{ ($client['video_type'] ?? '') === 'url' ? $client['video'] ?? '' : '' }}"
                                                        placeholder="https://example.com/video.mp4">

                                                </div>


                                            </div>

                                        </div>

                                    </div>

                                @empty

                                    {{-- First Client --}}
                                    <div class="client-item card border mb-4">

                                        <div class="card-header d-flex justify-content-between">

                                            <strong>
                                                Client 1
                                            </strong>

                                            <button type="button" class="btn btn-danger btn-sm removeClient">
                                                <i class="fa fa-trash"></i>
                                                Remove
                                            </button>

                                        </div>

                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Client Name
                                                        <span class="text-danger">*</span>
                                                    </label>

                                                    <input type="text" name="clients[0][name]" class="form-control"
                                                        required>

                                                </div>


                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Designation
                                                        <span class="text-danger">*</span>
                                                    </label>

                                                    <input type="text" name="clients[0][designation]"
                                                        class="form-control" required>

                                                </div>


                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Client Image
                                                    </label>

                                                    <input type="file" name="clients[0][image]" class="form-control"
                                                        accept="image/jpeg,image/png,image/webp">

                                                    <input type="hidden" name="clients[0][old_image]" value="">

                                                </div>


                                                <div class="col-md-6 mb-3 videoFileBox">

                                                    <label class="form-label">
                                                        Video
                                                    </label>

                                                    <input type="file" name="clients[0][video]" class="form-control"
                                                        accept="video/mp4,video/webm,video/ogg">

                                                    <input type="hidden" name="clients[0][old_video]" value="">

                                                </div>


                                                <div class="col-md-6 mb-3 videoUrlBox" style="display:none;">

                                                    <label class="form-label">
                                                        Video URL
                                                    </label>

                                                    <input type="url" name="clients[0][video]" class="form-control"
                                                        placeholder="https://example.com/video.mp4">

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                @endforelse

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

        </div>

    </div>


    {{-- CLIENT TEMPLATE --}}
    <template id="clientTemplate">

        <div class="client-item card border mb-4">

            <div class="card-header d-flex justify-content-between align-items-center">

                <strong>
                    Client <span class="clientNumber"></span>
                </strong>

                <button type="button" class="btn btn-danger btn-sm removeClient">
                    <i class="fa fa-trash"></i>
                    Remove
                </button>

            </div>


            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Client Name
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text" name="clients[INDEX][name]" class="form-control" required>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Designation
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text" name="clients[INDEX][designation]" class="form-control" required>

                    </div>



                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Client Image
                        </label>

                        <input type="file" name="clients[INDEX][image]" class="form-control"
                            accept="image/jpeg,image/png,image/webp">

                        <input type="hidden" name="clients[INDEX][old_image]" value="">

                    </div>


                    <div class="col-md-6 mb-3 videoFileBox">

                        <label class="form-label">
                            Video
                        </label>

                        <input type="file" name="clients[INDEX][video]" class="form-control"
                            accept="video/mp4,video/webm,video/ogg">

                        <input type="hidden" name="clients[INDEX][old_video]" value="">

                    </div>


                    <div class="col-md-6 mb-3 videoUrlBox" style="display:none;">

                        <label class="form-label">
                            Video URL
                        </label>

                        <input type="url" name="clients[INDEX][video]" class="form-control"
                            placeholder="https://example.com/video.mp4">

                    </div>

                </div>

            </div>

        </div>

    </template>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const wrapper = document.getElementById('clientsWrapper');

            const addButton = document.getElementById('addClient');

            const template = document.getElementById('clientTemplate');


            /*
            |--------------------------------------------------------------------------
            | Get next index
            |--------------------------------------------------------------------------
            */

            function getNextIndex() {

                return wrapper.querySelectorAll('.client-item').length;

            }


            /*
            |--------------------------------------------------------------------------
            | Update client numbers
            |--------------------------------------------------------------------------
            */

            function updateClientNumbers() {

                const items = wrapper.querySelectorAll('.client-item');

                items.forEach(function(item, index) {

                    const number = item.querySelector('.clientNumber');

                    if (number) {
                        number.textContent = index + 1;
                    }

                    const header = item.querySelector('.card-header strong');

                    if (header && !number) {
                        header.textContent = 'Client ' + (index + 1);
                    }

                });

            }


            /*
            |--------------------------------------------------------------------------
            | Add Client
            |--------------------------------------------------------------------------
            */

            addButton.addEventListener('click', function() {

                const index = getNextIndex();

                let html = template.innerHTML.replaceAll(
                    'INDEX',
                    index
                );

                wrapper.insertAdjacentHTML(
                    'beforeend',
                    html
                );

                updateClientNumbers();

            });


            /*
            |--------------------------------------------------------------------------
            | Remove Client
            |--------------------------------------------------------------------------
            */

            wrapper.addEventListener('click', function(event) {

                const button = event.target.closest('.removeClient');

                if (!button) {
                    return;
                }

                const item = button.closest('.client-item');

                if (!item) {
                    return;
                }

                const total = wrapper.querySelectorAll('.client-item').length;

                if (total <= 1) {

                    alert('At least one client is required.');

                    return;
                }

                item.remove();

                updateClientNumbers();

            });


            /*
            |--------------------------------------------------------------------------
            | Video Type
            |--------------------------------------------------------------------------
            */

            wrapper.addEventListener('change', function(event) {

                if (!event.target.classList.contains('videoType')) {
                    return;
                }

                const item = event.target.closest('.client-item');

                const fileBox = item.querySelector('.videoFileBox');

                const urlBox = item.querySelector('.videoUrlBox');

                if (event.target.value === 'url') {

                    fileBox.style.display = 'none';

                    urlBox.style.display = 'block';

                } else {

                    fileBox.style.display = 'block';

                    urlBox.style.display = 'none';

                }

            });


            updateClientNumbers();

        });
    </script>

@endsection
