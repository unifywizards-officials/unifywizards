@extends('layouts.app')

@section('title', 'Edit Recent Awards')

@section('page-title', 'Recent Awards')


@section('content')

    <div class="container-fluid">

        {{-- =====================================================
         SUCCESS MESSAGE
    ====================================================== --}}

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        {{-- =====================================================
         VALIDATION ERRORS
    ====================================================== --}}

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <div class="card">

            {{-- =================================================
             CARD HEADER
        ================================================== --}}

            <div class="card-header">

                <h4 class="mb-0">
                    Edit Recent Awards
                </h4>

            </div>


            {{-- =================================================
             FORM
        ================================================== --}}

            <form action="{{ route('recent-awards.update') }}" method="POST" enctype="multipart/form-data">

                @csrf

                @method('PUT')


                <div class="card-body">


                    {{-- =================================================
                     SECTION TITLE
                ================================================== --}}

                    <div class="mb-4">

                        <label class="form-label">
                            Heading
                        </label>

                        <input type="text" name="title" class="form-control"
                            value="{{ old('title', $recentAwards->title) }}" placeholder="Recent Awards">

                    </div>


                    {{-- =================================================
                     SECTION DESCRIPTION
                ================================================== --}}

                    <div class="mb-4">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea name="description" class="form-control" rows="5" placeholder="Enter Recent Awards description...">{{ old('description', $recentAwards->description) }}</textarea>

                    </div>


                    <hr>


                    {{-- =================================================
                     AWARDS
                ================================================== --}}

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h5 class="mb-0">
                            Awards
                        </h5>

                        <button type="button" class="btn btn-primary" id="addAward">
                            + Add Award
                        </button>

                    </div>


                    <div id="awardsWrapper">

                        @php

                            $awards = old('awards', $recentAwards->awards ?? []);

                        @endphp


                        @if (!empty($awards) && is_array($awards))

                            @foreach ($awards as $index => $award)
                                <div class="award-item border rounded p-3 mb-3" data-index="{{ $index }}">

                                    <div class="d-flex justify-content-between align-items-center mb-3">

                                        <h6 class="mb-0">
                                            Award {{ $index + 1 }}
                                        </h6>

                                        <button type="button" class="btn btn-danger btn-sm removeAward">
                                            Remove
                                        </button>

                                    </div>


                                    {{-- =================================
                                     TITLE
                                ================================== --}}

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Award Title
                                        </label>

                                        <input type="text" name="awards[{{ $index }}][title]" class="form-control"
                                            value="{{ $award['title'] ?? '' }}" placeholder="Best Digital Marketing Agency">

                                    </div>


                                    {{-- =================================
                                     DESCRIPTION
                                ================================== --}}

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Award Description
                                        </label>

                                        <textarea name="awards[{{ $index }}][description]" class="form-control" rows="4"
                                            placeholder="Enter award description...">{{ $award['description'] ?? '' }}</textarea>

                                    </div>


                                    {{-- =================================
                                     LOGO
                                ================================== --}}

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Award Logo
                                        </label>

                                        <input type="file" name="awards[{{ $index }}][logo]" class="form-control"
                                            accept=".jpg,.jpeg,.png,.webp,.svg">

                                    </div>


                                    {{-- =================================
                                     EXISTING LOGO
                                ================================== --}}

                                    @if (!empty($award['logo']))
                                        <div class="mb-3">

                                            <label class="form-label d-block">
                                                Current Logo
                                            </label>

                                            <img src="{{ asset($award['logo']) }}"
                                                alt="{{ $award['title'] ?? 'Award Logo' }}"
                                                style="
                                                max-width:150px;
                                                max-height:80px;
                                                object-fit:contain;
                                                border:1px solid #ddd;
                                                padding:8px;
                                                border-radius:6px;
                                            ">

                                        </div>
                                    @endif


                                    <input type="hidden" name="awards[{{ $index }}][existing_logo]"
                                        value="{{ $award['logo'] ?? '' }}">

                                </div>
                            @endforeach
                        @else
                            {{-- =====================================
                             FIRST EMPTY AWARD
                        ====================================== --}}

                            <div class="award-item border rounded p-3 mb-3" data-index="0">

                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <h6 class="mb-0">
                                        Award 1
                                    </h6>

                                    <button type="button" class="btn btn-danger btn-sm removeAward">
                                        Remove
                                    </button>

                                </div>


                                <div class="mb-3">

                                    <label class="form-label">
                                        Award Title
                                    </label>

                                    <input type="text" name="awards[0][title]" class="form-control"
                                        placeholder="Best Digital Marketing Agency">

                                </div>


                                <div class="mb-3">

                                    <label class="form-label">
                                        Award Description
                                    </label>

                                    <textarea name="awards[0][description]" class="form-control" rows="4" placeholder="Enter award description..."></textarea>

                                </div>


                                <div class="mb-3">

                                    <label class="form-label">
                                        Award Logo
                                    </label>

                                    <input type="file" name="awards[0][logo]" class="form-control"
                                        accept=".jpg,.jpeg,.png,.webp,.svg">

                                </div>


                                <input type="hidden" name="awards[0][existing_logo]" value="">

                            </div>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                 FOOTER
            ================================================== --}}

                <div class="card-footer text-end">

                    <button type="submit" class="btn btn-success">
                        Update Recent Awards
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
     JAVASCRIPT
========================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const wrapper = document.getElementById('awardsWrapper');
            const addButton = document.getElementById('addAward');


            /*
            |--------------------------------------------------------------------------
            | Get Next Index
            |--------------------------------------------------------------------------
            */

            function getNextIndex() {

                const items = wrapper.querySelectorAll('.award-item');

                let maxIndex = -1;

                items.forEach(function(item) {

                    const index = parseInt(
                        item.getAttribute('data-index')
                    );

                    if (!isNaN(index) && index > maxIndex) {
                        maxIndex = index;
                    }

                });

                return maxIndex + 1;
            }


            /*
            |--------------------------------------------------------------------------
            | Add Award
            |--------------------------------------------------------------------------
            */

            addButton.addEventListener('click', function() {

                const index = getNextIndex();

                const html = `

            <div
                class="award-item border rounded p-3 mb-3"
                data-index="${index}"
            >

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h6 class="mb-0">
                        Award ${index + 1}
                    </h6>

                    <button
                        type="button"
                        class="btn btn-danger btn-sm removeAward"
                    >
                        Remove
                    </button>

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Award Title
                    </label>

                    <input
                        type="text"
                        name="awards[${index}][title]"
                        class="form-control"
                        placeholder="Best Digital Marketing Agency"
                    >

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Award Description
                    </label>

                    <textarea
                        name="awards[${index}][description]"
                        class="form-control"
                        rows="4"
                        placeholder="Enter award description..."
                    ></textarea>

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Award Logo
                    </label>

                    <input
                        type="file"
                        name="awards[${index}][logo]"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp,.svg"
                    >

                </div>


                <input
                    type="hidden"
                    name="awards[${index}][existing_logo]"
                    value=""
                >

            </div>

        `;

                wrapper.insertAdjacentHTML('beforeend', html);

            });


            /*
            |--------------------------------------------------------------------------
            | Remove Award
            |--------------------------------------------------------------------------
            */

            wrapper.addEventListener('click', function(event) {

                if (
                    event.target.classList.contains('removeAward')
                ) {

                    const item = event.target.closest('.award-item');

                    if (item) {
                        item.remove();
                    }

                }

            });

        });
    </script>

@endsection
