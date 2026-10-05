// resources/views/admin/settings/index.blade.php

@extends('layouts.app')

@section('title', 'Settings')

@section('content')

    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.home') }}">Home</a>
        </li>

        <li class="breadcrumb-item active">
            Settings
        </li>
    </ol>

    <h1 class="page-header">
        Settings Page
    </h1>

    <div class="row">

        <div class="col-xl-12">

            <div class="panel panel-inverse">

                <div class="panel-heading">
                    <h4 class="panel-title">Settings</h4>
                </div>

                <div class="panel-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">

                        @csrf


                        <div class="mb-4">

                            <label class="form-label">
                                Website Favicon
                            </label>

                            <input type="file" name="favicon" class="form-control">

                            @if (!empty($setting->favicon))
                                <div class="mt-2">

                                    <img src="{{ asset('storage/' . $setting->favicon) }}" width="40" height="40">

                                </div>
                            @endif

                        </div>

                        <!-- Header Logo -->
                        <div class="mb-4">
                            <label class="form-label">Header Logo</label>

                            <input type="file" name="header_logo" class="form-control">

                            @if (!empty($setting->header_logo))
                                <img src="{{ asset('storage/' . $setting->header_logo) }}" width="120" class="mt-2">
                            @endif
                        </div>

                        <!-- Footer Logo -->
                        <div class="mb-4">
                            <label class="form-label">Footer Logo</label>

                            <input type="file" name="footer_logo" class="form-control">

                            @if (!empty($setting->footer_logo))
                                <img src="{{ asset('storage/' . $setting->footer_logo) }}" width="120" class="mt-2">
                            @endif
                        </div>

                        <!-- Dark Footer Logo 1 -->
                        <div class="mb-4">
                            <label class="form-label">
                                Dark Footer Logo 1
                            </label>

                            <input type="file" name="dark_footer_logo1" class="form-control">

                            @if (!empty($setting->dark_footer_logo1))
                                <img src="{{ asset('storage/' . $setting->dark_footer_logo1) }}" width="120"
                                    class="mt-2">
                            @endif
                        </div>

                        <!-- Dark Footer Logo 2 -->
                        <div class="mb-4">
                            <label class="form-label">
                                Dark Footer Logo 2
                            </label>

                            <input type="file" name="dark_footer_logo2" class="form-control">

                            @if (!empty($setting->dark_footer_logo2))
                                <img src="{{ asset('storage/' . $setting->dark_footer_logo2) }}" width="120"
                                    class="mt-2">
                            @endif
                        </div>

                        <!-- Footer Description -->
                        <div class="mb-4">
                            <label class="form-label">
                                Footer Description
                            </label>

                            <textarea name="footer_description" class="form-control" rows="4">{{ $setting->footer_description ?? '' }}</textarea>
                        </div>

                        <!-- Footer Email -->
                        <div class="mb-4">
                            <label class="form-label">
                                Footer Email
                            </label>

                            <input type="email" name="footer_email" class="form-control"
                                value="{{ $setting->footer_email ?? '' }}">
                        </div>

                        <!-- Footer Number -->
                        <div class="mb-4">
                            <label class="form-label">
                                Footer Number
                            </label>

                            <input type="text" name="footer_number" class="form-control"
                                value="{{ $setting->footer_number ?? '' }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Location
                            </label>

                            <input type="text" name="location" class="form-control"
                                value="{{ $setting->location ?? '' }}">
                        </div>

                        <!-- Location -->
                        <div class="mb-4">

                            <label class="form-label">
                                Google Map Embed Code
                            </label>

                            <textarea name="google_map_embed" class="form-control" rows="6">{{ $setting->google_map_embed ?? '' }}</textarea>

                            <small class="text-muted">
                                Paste the complete Google Maps iframe embed code.
                            </small>

                        </div>




                        <!-- Social Media -->
                        <div class="mb-4">

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <label class="form-label mb-0">
                                    Social Media Links
                                </label>

                                <button type="button" class="btn btn-primary btn-sm" id="addMore">
                                    +
                                </button>

                            </div>

                            <div id="socialWrapper">

                                @if (!empty($setting->social_links))

                                    @foreach ($setting->social_links as $social)
                                        <div class="row social-row mb-3">

                                            <div class="col-md-5">
                                                <input type="text" name="social_name[]" class="form-control"
                                                    placeholder="Facebook" value="{{ $social['name'] }}">
                                            </div>

                                            <div class="col-md-5">
                                                <input type="text" name="social_link[]" class="form-control"
                                                    placeholder="https://facebook.com" value="{{ $social['link'] }}">
                                            </div>

                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger removeRow">
                                                    Remove
                                                </button>
                                            </div>

                                        </div>
                                    @endforeach
                                @else
                                    <div class="row social-row mb-3">

                                        <div class="col-md-5">
                                            <input type="text" name="social_name[]" class="form-control"
                                                placeholder="Facebook">
                                        </div>

                                        <div class="col-md-5">
                                            <input type="text" name="social_link[]" class="form-control"
                                                placeholder="https://facebook.com">
                                        </div>

                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger removeRow">
                                                Remove
                                            </button>
                                        </div>

                                    </div>

                                @endif

                            </div>

                        </div>

                        <button type="submit" class="btn btn-success">
                            Update Settings
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection


@push('scripts')
    <script>
        $('#addMore').click(function() {

            $('#socialWrapper').append(`
            <div class="row social-row mb-3">

                <div class="col-md-5">
                    <input type="text"
                           name="social_name[]"
                           class="form-control"
                           placeholder="Social Name">
                </div>

                <div class="col-md-5">
                    <input type="text"
                           name="social_link[]"
                           class="form-control"
                           placeholder="Social Link">
                </div>

                <div class="col-md-2">
                    <button type="button"
                            class="btn btn-danger removeRow">
                        Remove
                    </button>
                </div>

            </div>
        `);

        });

        $(document).on('click', '.removeRow', function() {

            $(this).closest('.social-row').remove();

        });
    </script>
@endpush
