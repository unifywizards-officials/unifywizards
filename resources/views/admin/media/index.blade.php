@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card mb-4">
            <div class="card-header">Upload Media</div>
            <div class="card-body">
                <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data"
                    class="d-flex align-items-center gap-3">
                    @csrf
                    <input type="file" name="image" class="form-control">
                    <button class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>

        <div class="row">
            @foreach ($media as $item)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset($item->file_path) }}" height="180" style="object-fit:cover">
                        <div class="card-body">
                            <div class="d-flex gap-2 mt-2">
                                <button class="btn btn-success btn-sm flex-fill copy-btn" data-url="{{ $item->file_url }}">
                                    📋 Copy URL
                                </button>
                                <form action="{{ route('media.destroy', $item->id) }}" method="POST" class="flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm w-100">
                                        🗑 Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    {{-- Hidden textarea for fallback copy --}}
    <textarea id="copy-helper" style="position:fixed; top:-9999px; left:-9999px; opacity:0;" readonly></textarea>

    {{-- Toast notification --}}
    <div id="toast"
        style="position:fixed; bottom:24px; right:24px; background:#198754; color:#fff;
               padding:10px 18px; border-radius:8px; font-size:14px;
               opacity:0; transition:opacity 0.3s; pointer-events:none; z-index:9999;">
        ✓ URL Copied!
    </div>
@endsection

@push('scripts')
    <script>
        function showToast() {
            const toast = document.getElementById('toast');
            toast.style.opacity = '1';
            setTimeout(() => toast.style.opacity = '0', 2000);
        }

        function fallbackCopy(text) {
            const helper = document.getElementById('copy-helper');
            helper.value = text;
            helper.style.top = '0';
            helper.focus();
            helper.select();
            try {
                const success = document.execCommand('copy');
                if (success) showToast();
                else alert('Copy failed. URL: ' + text);
            } catch (e) {
                alert('Copy failed. URL: ' + text);
            }
            helper.style.top = '-9999px';
        }

        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', function() {
                const url = this.dataset.url;

                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(url)
                        .then(() => showToast())
                        .catch(() => fallbackCopy(url));
                } else {
                    fallbackCopy(url);
                }
            });
        });
    </script>
@endpush
