@extends('Backend.layouts.app')
@section('seoMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.css">
    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
                <li class="breadcrumb-item"><a href="{{ route('donation.index') }}">Donation List </a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
        <div class="card-body">

            @include('_message')

            <form action="{{ route('donation.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="towards">Towards</label>
                        <input type="text" name="towards" id="towards"
                            class="form-control @error('towards') is-invalid @enderror" placeholder="Please Enter Towards"
                            value="{{ old('towards') }}">

                        @error('towards')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="img">Image Cover</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('img') is-invalid @enderror"
                                name="img" id="img" onchange="previewImage(event)">
                            <label class="custom-file-label" for="img">Choose file</label>
                        </div>

                        @error('img')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror

                        <!-- Preview Image -->
                        <img id="imgPreview" src="" alt="Preview Image" class="img-thumbnail mt-3"
                            style="display: none; max-height: 150px;">
                    </div>

                    <div class="col-6 form-group">
                        <label for="amount">Amount Needed</label>
                        <input type="text" inputmode="numeric" name="amount" id="amount"
                            class="form-control @error('amount') is-invalid @enderror" placeholder="Please Enter Amount"
                            value="{{ old('amount') }}">

                        @error('amount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="days_left">Deadline Date</label>
                        <input type="date" name="days_left" id="days_left"
                            class="form-control @error('days_left') is-invalid @enderror" value="{{ old('days_left') }}">

                        @error('days_left')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group col-6">
                        <label for="description">Description Towards</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{!! old('description') !!}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                </div>

                <div class="form-group">
                    <label for="description_need">Description Towards Needs</label>
                    <textarea id="summernote" name="description_need" class="form-control @error('description_need') is-invalid @enderror">
                        {!! old('description_need') !!}
                    </textarea>

                    @error('description_need')
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
    <!-- tempusdominus-bootstrap-4 -->
    <script src="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- bs-custom-file-input -->
    <script src="https://adminlte.io/themes/v3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Summernote -->
    <script src="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- CodeMirror -->
    <script src="https://adminlte.io/themes/v3/plugins/codemirror/codemirror.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/codemirror/mode/css/css.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/codemirror/mode/xml/xml.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>

    <script>
        // bs-custom-file-input
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

    <!-- Summernote -->
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
