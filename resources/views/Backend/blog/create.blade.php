@extends('Backend.layouts.app')
@section('seoMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <!-- summernote -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.css">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/codemirror/theme/monokai.css">
    <!-- SimpleMDE -->
    {{-- <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/simplemde/simplemde.min.css"> --}}
@endsection
@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Articles & Blogs </a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
        <div class="card-body">

            @include('_message')

            <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-md-6 form-group">
                        <label for="title">Article Title</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Please Enter Article Title" value="{{ old('title') }}">
                        <small class="form-text text-muted">
                            *Masukkan judul yang jelas dan deskriptif untuk memudahkan pemahaman. Judul tidak boleh sama*
                        </small>

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6 form-group">
                        <label for="category_id">Article Category</label>
                        <select class="custom-select rounded-0 @error('category_id') is-invalid @enderror" id="category_id"
                            name="category_id">
                            <option value="" hidden>-- Please select --</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="img">Article Cover Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('img') is-invalid @enderror"
                                name="img" id="img" onchange="previewImage(event)">
                            <label class="custom-file-label" for="img">Choose file</label>
                        </div>
                        <small class="form-text text-muted">
                            *Unggah foto dengan ukuran maksimal 2MB dan format JPG, PNG, atau JPEG. Pastikan foto yang
                            diunggah jelas dan tidak mengandung unsur yang tidak pantas.*
                        </small>

                        @error('img')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror

                        <!-- Preview Image -->
                        <img id="imgPreview" src="" alt="Preview Image" class="img-thumbnail mt-3"
                            style="display: none; max-height: 150px;">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="status">Article Status</label>
                        <select class="custom-select rounded-0 @error('status') is-invalid @enderror" id="status"
                            name="status">
                            <option value="" hidden>-- Please select --</option>
                            <option value="0">Draft</option>
                            <option value="1">Publish</option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="form-group">
                    <label for="content">Article Description</label>
                    <textarea id="summernote" name="content" class="form-control @error('content') is-invalid @enderror">
                        {!! old('content') !!}
                    </textarea>
                    <small class="form-text text-muted">
                        *Maksimal 10.000 karakter untuk deskripsi ini. Tuliskan deskripsi yang singkat dan jelas untuk
                        memudahkan pemahaman. Hindari kata-kata kasar atau tidak pantas.*
                    </small>

                    @error('content')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col d-flex justify-content-between align-items-center mt-3">
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">Back</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <!-- bs-custom-file-input -->
    <script src="https://adminlte.io/themes/v3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Summernote -->
    <script src="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- CodeMirror -->
    <script src="https://adminlte.io/themes/v3/plugins/codemirror/codemirror.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/codemirror/mode/css/css.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/codemirror/mode/xml/xml.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>

    <!-- bs-custom-file-input -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

    <!-- Image Preview -->
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imgPreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function(files) {
                        uploadImage(files[0]);
                    }
                }
            });

            function uploadImage(file) {
                let data = new FormData();
                data.append("file", file);

                $.ajax({
                    url: "{{ route('article.uploadImage') }}", // Route untuk upload
                    method: "POST",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        $('#summernote').summernote('insertImage', url); // Masukkan URL ke editor
                    },
                    error: function(data) {
                        console.error("Upload error:", data);
                    }
                });
            }
        });
    </script>
@endsection
