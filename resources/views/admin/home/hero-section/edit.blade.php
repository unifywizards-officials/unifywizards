@extends('layouts.app')

@section('content')

    @php

        $customerImages = [];

        if (!empty($hero->customer_images)) {
            $customerImages = is_array($hero->customer_images)
                ? $hero->customer_images
                : json_decode($hero->customer_images, true);
        }

        $awardImages = [];

        if (!empty($hero->award_images)) {
            $awardImages = is_array($hero->award_images) ? $hero->award_images : json_decode($hero->award_images, true);
        }

    @endphp

    <h1 class="page-header">
        Manage Hero Section
    </h1>

    <div class="panel panel-inverse">

        <div class="panel-heading">

            <h4 class="panel-title">
                Hero Section CMS
            </h4>

        </div>

        <div class="panel-body">

            <form action="{{ route('admin.home.hero.update') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="row">

                    {{-- SUB TITLE --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Sub Title
                        </label>

                        <input type="text" name="sub_title" class="form-control" value="{{ $hero->sub_title ?? '' }}">

                    </div>

                    {{-- TITLE --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Title
                        </label>

                        <input type="text" name="title" class="form-control" value="{{ $hero->title ?? '' }}">

                    </div>

                    {{-- HIGHLIGHT TEXT --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Highlight Text
                        </label>

                        <input type="text" name="highlight_text" class="form-control"
                            value="{{ $hero->highlight_text ?? '' }}">

                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-control">

                            <option value="1" {{ ($hero->status ?? '') == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ ($hero->status ?? '') == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="col-md-12 mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea name="description" class="form-control" rows="5">{{ $hero->description ?? '' }}</textarea>

                    </div>

                    {{-- HERO IMAGE --}}
                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Hero Image
                        </label>

                        <input type="file" name="hero_image" class="form-control">

                        @if (!empty($hero->hero_image))
                            <div class="mt-3">

                                <img src="{{ asset($hero->hero_image) }}"
                                    style="
                                    width:150px;
                                    border-radius:10px;
                                    border:1px solid #ddd;
                                    padding:5px;
                                ">

                            </div>
                        @endif

                    </div>

                    {{-- PATTERN SHAPE --}}


                    {{-- CUSTOMER COUNT --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Customer Count
                        </label>

                        <input type="text" name="customer_count" class="form-control"
                            value="{{ $hero->customer_count ?? '' }}">

                    </div>

                    {{-- CUSTOMER TEXT --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Customer Text
                        </label>

                        <input type="text" name="customer_text" class="form-control"
                            value="{{ $hero->customer_text ?? '' }}">

                    </div>

                    {{-- CUSTOMER IMAGES --}}
                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Customer Images
                        </label>

                        <input type="file" name="customer_images[]" class="form-control" multiple>

                        @if (!empty($customerImages))
                            <div class="row mt-3">

                                @foreach ($customerImages as $image)
                                    <div class="col-md-3 mb-3 text-center">

                                        <img src="{{ asset($image) }}"
                                            style="
                                            width:100%;
                                            height:90px;
                                            object-fit:cover;
                                            border-radius:8px;
                                            border:1px solid #ddd;
                                        ">

                                        <div class="mt-2">

                                            <label
                                                style="
                                                color:red;
                                                font-size:13px;
                                                cursor:pointer;
                                            ">

                                                <input type="checkbox" name="delete_customer_images[]"
                                                    value="{{ $image }}">

                                                Delete

                                            </label>

                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        @endif

                    </div>

                    {{-- AWARD IMAGES --}}
                    <div class="col-md-12 mb-4">

                        <label class="form-label">
                            Award Images
                        </label>

                        <input type="file" name="award_images[]" class="form-control" multiple>

                        @if (!empty($awardImages))
                            <div class="row mt-3">

                                @foreach ($awardImages as $image)
                                    <div class="col-md-3 mb-3 text-center">

                                        <img src="{{ asset($image) }}"
                                            style="
                                            width:100%;
                                            height:90px;
                                            object-fit:contain;
                                            border-radius:8px;
                                            border:1px solid #ddd;
                                            padding:5px;
                                        ">

                                        <div class="mt-2">

                                            <label
                                                style="
                                                color:red;
                                                font-size:13px;
                                                cursor:pointer;
                                            ">

                                                <input type="checkbox" name="delete_award_images[]"
                                                    value="{{ $image }}">

                                                Delete

                                            </label>

                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        @endif

                    </div>

                    {{-- SUBMIT BUTTON --}}
                    <div class="col-md-12 mt-4">

                        <button type="submit" class="btn btn-success">
                            Save Hero Section
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection
