@extends('layouts.app')

@section('content')

    @php

        $logos = [];

        if (!empty($clientsLogo->logos)) {
            $logos = is_array($clientsLogo->logos) ? $clientsLogo->logos : json_decode($clientsLogo->logos, true);
        }

    @endphp

    <h1 class="page-header">
        Manage Clients Logo Section
    </h1>

    <div class="panel panel-inverse">

        <div class="panel-heading">

            <h4 class="panel-title">
                Clients Logo CMS
            </h4>

        </div>

        <div class="panel-body">

            <form action="{{ route('admin.home.clients-logo.update') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="row">

                    {{-- TITLE --}}
                    <div class="col-md-12 mb-3">

                        <label class="form-label">
                            Title
                        </label>

                        <input type="text" name="title" class="form-control" value="{{ $clientsLogo->title ?? '' }}"
                            placeholder="Join Over Companies with Unify Wizards Here">

                    </div>

                    {{-- HIGHLIGHT NUMBER --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Highlight Number
                        </label>

                        <input type="text" name="highlight_number" class="form-control"
                            value="{{ $clientsLogo->highlight_number ?? '' }}" placeholder="1000+">

                    </div>

                    {{-- HIGHLIGHT TEXT --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Highlight Text
                        </label>

                        <input type="text" name="highlight_text" class="form-control"
                            value="{{ $clientsLogo->highlight_text ?? '' }}" placeholder="Unify Wizards">

                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-control">

                            <option value="1" {{ ($clientsLogo->status ?? '') == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ ($clientsLogo->status ?? '') == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                    {{-- LOGOS --}}
                    <div class="col-md-12 mb-4">

                        <label class="form-label">
                            Client Logos
                        </label>

                        <input type="file" name="logos[]" class="form-control" multiple>

                        @if (!empty($logos))
                            <div class="row mt-4">

                                @foreach ($logos as $logo)
                                    <div class="col-md-2 mb-4 text-center">

                                        <img src="{{ asset($logo) }}"
                                            style="
                                            width:100%;
                                            height:90px;
                                            object-fit:contain;
                                            border:1px solid #ddd;
                                            border-radius:10px;
                                            padding:10px;
                                            background:#fff;
                                        ">

                                        <div class="mt-2">

                                            <label
                                                style="
                                                color:red;
                                                font-size:13px;
                                                cursor:pointer;
                                            ">

                                                <input type="checkbox" name="delete_logos[]" value="{{ $logo }}">

                                                Delete

                                            </label>

                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        @endif

                    </div>

                    {{-- SUBMIT --}}
                    <div class="col-md-12">

                        <button type="submit" class="btn btn-success">
                            Save Clients Logo Section
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection
