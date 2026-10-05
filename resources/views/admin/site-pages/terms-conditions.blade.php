<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" />
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Terms & Conditions</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.terms_conditions.save') }}" method="POST">
                @csrf

                <textarea name="description" id="summernote" class="summernote">{!! $page->description ?? '' !!}</textarea>


                <button type="submit" class="btn btn-primary mt-3">
                    Save
                </button>

            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.summernote').summernote({

                placeholder: 'Write blog content...',

                height: 300,

                tabsize: 2

            });


        });
    </script>
@endpush
