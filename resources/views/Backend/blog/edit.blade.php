@extends('Backend.layouts.app')
@section('seoMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte') }}/plugins/summernote/summernote-bs4.min.css">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/theme/monokai.css">
@endsection
@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article List</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
        <div class="card-body">

            @include('_message')

            <form action="{{ route('article.update', $article->blog_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-6 form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror" placeholder="Please Enter Title"
                            value="{{ old('title', $article->title) }}">

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
                                <option value="{{ $item->id }}"
                                    {{ $article->category_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
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
                    <label for="content">Description</label>
                    <textarea id="summernote" name="content" class="form-control @error('content') is-invalid @enderror">
                        {!! old('content', $article->content) !!}
                    </textarea>

                    @error('content')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="img">Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img" id="img">
                            <label class="custom-file-label" for="img">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>

                    @if ($article->image_path)
                        <div class="mt-2">
                            <img src="{{ asset($article->image_path) }}" id="img_preview" class="img-thumbnail img_preview"
                                alt="" width="100px">
                        </div>
                    @endif

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
                            <option value="0" {{ $article->status == 0 ? 'selected' : '' }}>Draft</option>
                            <option value="1" {{ $article->status == 1 ? 'selected' : '' }}>Publish</option>
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
                            class="form-control @error('published_date') is-invalid @enderror"
                            value="{{ old('published_date', $article->published_date) }}">

                        @error('published_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <!-- Summernote -->
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- CodeMirror -->
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/codemirror.js"></script>
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/mode/css/css.js"></script>
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/mode/xml/xml.js"></script>
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>

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
