{{-- resources/views/admin/about-us/cta/index.blade.php --}}

@extends('layouts.app')

@section('title', 'CTA CMS')

@section('content')

    {{-- Breadcrumb --}}
    <ol class="breadcrumb float-xl-end">

        <li class="breadcrumb-item">
            <a href="{{ route('admin.home') }}">
                Home
            </a>
        </li>

        <li class="breadcrumb-item active">
            CTA CMS
        </li>

    </ol>

    {{-- Page Header --}}
    <h1 class="page-header">
        CTA CMS
    </h1>

    <div class="row">

        <div class="col-xl-12">

            <div class="panel panel-inverse">

                {{-- Panel Heading --}}
                <div class="panel-heading">

                    <h4 class="panel-title">
                        CTA Section Settings
                    </h4>

                </div>

                {{-- Panel Body --}}
                <div class="panel-body">

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

                    <form action="{{ route('admin.about-us.cta.update', $cta->id ?? 1) }}" method="POST">

                        @csrf

                        {{-- ===================================================== --}}
                        {{-- CTA CONTENT --}}
                        {{-- ===================================================== --}}
                        <div class="card border-0 shadow-sm mb-4">

                            <div class="card-header bg-white">

                                <h4 class="mb-0 fw-bold">
                                    CTA Content
                                </h4>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    {{-- Small Label --}}
                                    <div class="col-md-6 mb-4">

                                        <label class="form-label fw-semibold">
                                            Small Label
                                        </label>

                                        <input type="text" name="small_label" class="form-control"
                                            value="{{ old('small_label', $cta->small_label ?? '') }}"
                                            placeholder="LET'S BUILD TOGETHER">

                                    </div>

                                    {{-- Main Heading --}}
                                    <div class="col-md-6 mb-4">

                                        <label class="form-label fw-semibold">
                                            Main Heading
                                        </label>

                                        <input type="text" name="main_heading" class="form-control"
                                            value="{{ old('main_heading', $cta->main_heading ?? '') }}"
                                            placeholder="Main Heading">

                                    </div>

                                    {{-- Description --}}
                                    <div class="col-md-12 mb-4">

                                        <label class="form-label fw-semibold">
                                            Description
                                        </label>

                                        <textarea name="description" class="form-control" rows="5" placeholder="Enter Description">{{ old('description', $cta->description ?? '') }}</textarea>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- ===================================================== --}}
                        {{-- BUTTON SETTINGS --}}
                        {{-- ===================================================== --}}
                        <div class="card border-0 shadow-sm mb-4">

                            <div class="card-header bg-white">

                                <h4 class="mb-0 fw-bold">
                                    CTA Buttons
                                </h4>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    {{-- Button 1 Text --}}
                                    <div class="col-md-3 mb-4">

                                        <label class="form-label fw-semibold">
                                            Button 1 Text
                                        </label>

                                        <input type="text" name="button_1_text" class="form-control"
                                            value="{{ old('button_1_text', $cta->button_1_text ?? '') }}"
                                            placeholder="Button Text">

                                    </div>

                                    {{-- Button 1 URL --}}
                                    <div class="col-md-3 mb-4">

                                        <label class="form-label fw-semibold">
                                            Button 1 URL
                                        </label>

                                        <input type="text" name="button_1_url" class="form-control"
                                            value="{{ old('button_1_url', $cta->button_1_url ?? '') }}"
                                            placeholder="https://">

                                    </div>

                                    {{-- Button 2 Text --}}
                                    <div class="col-md-3 mb-4">

                                        <label class="form-label fw-semibold">
                                            Button 2 Text
                                        </label>

                                        <input type="text" name="button_2_text" class="form-control"
                                            value="{{ old('button_2_text', $cta->button_2_text ?? '') }}"
                                            placeholder="Button Text">

                                    </div>

                                    {{-- Button 2 URL --}}
                                    <div class="col-md-3 mb-4">

                                        <label class="form-label fw-semibold">
                                            Button 2 URL
                                        </label>

                                        <input type="text" name="button_2_url" class="form-control"
                                            value="{{ old('button_2_url', $cta->button_2_url ?? '') }}"
                                            placeholder="https://">

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- ===================================================== --}}
                        {{-- LIVE PREVIEW --}}
                        {{-- ===================================================== --}}
                        <div class="card border-0 shadow-sm mb-4">

                            <div class="card-header bg-white">

                                <h4 class="mb-0 fw-bold">
                                    Live Preview
                                </h4>

                            </div>

                            <div class="card-body bg-dark rounded p-5 text-center position-relative overflow-hidden">

                                <div class="position-absolute top-0 start-0 w-100 h-100"
                                    style="opacity:0.05;background:radial-gradient(circle,#fff 1px,transparent 1px);background-size:20px 20px;">
                                </div>

                                {{-- Label --}}
                                <div class="mb-3 position-relative">

                                    <span class="badge bg-success px-3 py-2">

                                        {{ $cta->small_label ?? "LET'S BUILD TOGETHER" }}

                                    </span>

                                </div>

                                {{-- Heading --}}
                                <h2 class="text-white fw-bold mb-3 position-relative"
                                    style="font-size:42px;line-height:1.3;">

                                    {!! nl2br(e($cta->main_heading ?? 'Ready to Build Something Extraordinary?')) !!}

                                </h2>

                                {{-- Description --}}
                                <p class="text-light mb-4 mx-auto position-relative" style="max-width:750px;">

                                    {{ $cta->description ?? "Let's discuss how Unify Wizards can help your business grow with tailor-made digital solutions that truly deliver results." }}

                                </p>

                                {{-- Buttons --}}
                                <div class="d-flex justify-content-center gap-3 flex-wrap position-relative">

                                    <a href="{{ $cta->button_1_url ?? '#' }}" class="btn btn-success px-4 py-2">

                                        {{ $cta->button_1_text ?? 'Get a Free Consultation' }}

                                    </a>

                                    <a href="{{ $cta->button_2_url ?? '#' }}" class="btn btn-outline-light px-4 py-2">

                                        {{ $cta->button_2_text ?? 'View Our Portfolio' }}

                                    </a>

                                </div>

                            </div>

                        </div>

                        {{-- Submit --}}
                        <div class="text-end">

                            <button type="submit" class="btn btn-success px-4">

                                <i class="fa fa-save me-1"></i>
                                Update CTA Section

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
