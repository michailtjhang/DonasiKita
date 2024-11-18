@extends('Backend.layouts.app')
<<<<<<< HEAD
=======
@section('seoMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
@section('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte') }}/plugins/summernote/summernote-bs4.min.css">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/theme/monokai.css">
    <!-- SimpleMDE -->
<<<<<<< HEAD
    <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte') }}/plugins/simplemde/simplemde.min.css">
=======
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte') }}/plugins/simplemde/simplemde.min.css"> --}}
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
@endsection
@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article List </a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
        <div class="card-body">

            @include('_message')

            <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-6 form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror" placeholder="Please Enter Title"
                            value="{{ old('title') }}">

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-6 form-group">
                        <label for="category_id">Category</label>
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

                <div class="form-group">
<<<<<<< HEAD
                    <label for="desc">Description</label>
                    <textarea id="summernote" name="desc" class="form-control @error('desc') is-invalid @enderror">
                        {!! old('desc') !!}
                    </textarea>

                    @error('desc')
=======
                    <label for="content">Description</label>
                    <textarea id="summernote" name="content" class="form-control @error('content') is-invalid @enderror">
                        {!! old('content') !!}
                    </textarea>

                    @error('content')
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="form-group">
<<<<<<< HEAD
                    <label for="img">Image</label>
=======
                    <label for="img">Image Cover</label>
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img" id="img">
                            <label class="custom-file-label" for="img">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>

                    <div class="mt-2">
                        <img src="" id="img_preview" class="img-thumbnail img_preview" alt=""
                            width="60px">
                    </div>

                    @error('img')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="row">
                    <div class="col-6 form-group">
                        <label for="status">Status</label>
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

                    <div class="col-6 form-group">
                        <label for="publish_date">Publish Date</label>
                        <input type="date" name="published_date" id="publish_date"
                            class="form-control @error('publish_date') is-invalid @enderror"
                            value="{{ old('published_date') }}">

                        @error('published_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <!-- Summernote -->
<<<<<<< HEAD
=======
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- CodeMirror -->
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/codemirror.js"></script>
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/mode/css/css.js"></script>
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/mode/xml/xml.js"></script>
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>

    <script>
        $(function() {
<<<<<<< HEAD
            // Summernote
            $('#summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
=======
            bsCustomFileInput.init();
        });
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
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
    </script>
@endsection
