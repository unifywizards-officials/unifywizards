@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">

        <form action="{{ route('admin.home.cta.update') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="panel panel-inverse">

                <div class="panel-heading d-flex justify-content-between align-items-center">

                    <h4 class="panel-title">
                        Home CTA Section
                    </h4>

                    <button type="submit" class="btn btn-success">

                        Save CTA

                    </button>

                </div>

                <div class="panel-body">

                    <div class="card">

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12 mb-3">

                                    <label class="form-label">
                                        Title
                                    </label>

                                    <input type="text" name="title" class="form-control"
                                        value="{{ $cta->title ?? '' }}">

                                </div>

                                <div class="col-md-12 mb-3">

                                    <label class="form-label">
                                        Description
                                    </label>

                                    <textarea name="description" class="form-control" rows="3">{{ $cta->description ?? '' }}</textarea>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Button Text
                                    </label>

                                    <input type="text" name="button_text" class="form-control"
                                        value="{{ $cta->button_text ?? '' }}">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Button Link
                                    </label>

                                    <input type="text" name="button_link" class="form-control"
                                        value="{{ $cta->button_link ?? '' }}">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        CTA Image
                                    </label>

                                    <input type="file" name="image" class="form-control">

                                </div>

                                <div class="col-md-6 mb-3">

                                    @if (isset($cta->image))
                                        <img src="{{ asset($cta->image) }}" width="200" class="img-fluid rounded border">
                                    @endif

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Status
                                    </label>

                                    <select name="status" class="form-control">

                                        <option value="1" {{ ($cta->status ?? 1) == 1 ? 'selected' : '' }}>
                                            Active
                                        </option>

                                        <option value="0" {{ ($cta->status ?? 1) == 0 ? 'selected' : '' }}>
                                            Inactive
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>
@endsection
