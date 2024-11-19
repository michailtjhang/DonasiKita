@extends('Backend.layouts.app')
@section('seoMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte') }}/plugins/summernote/summernote-bs4.min.css">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/theme/monokai.css">
    <!-- SimpleMDE -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte') }}/plugins/simplemde/simplemde.min.css"> --}}
@endsection
@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('event.index') }}">Event List </a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
        <div class="card-body">

            @include('_message')

            <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label for="img">Image Cover</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img" id="img">
                            <label class="custom-file-label" for="img">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>

                    @error('img')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Description</label>
                    <textarea id="summernote" name="content" class="form-control @error('content') is-invalid @enderror">
                        {!! old('content') !!}
                    </textarea>

                    @error('content')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="location">Location Name</label>
                    <input type="text" id="location" name="location" class="form-control"
                        placeholder="Enter a location">
                </div>

                <div id="map" style="width: 100%; height: 400px; margin-top: 20px;"></div>

                <div class="row mt-3">

                    <div class="col-6 form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" id="latitude" name="latitude" class="form-control" readonly>
                    </div>

                    <div class="col-6 form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" id="longitude" name="longitude" class="form-control" readonly>
                    </div>

                </div>

                <div class="row mt-3">
                    <!-- Date Event Input -->
                    <div class="col-md-6 form-group">
                        <label for="date">Date Event</label>
                        <input type="date" name="date" id="date"
                            class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                        @error('date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Volunteer Switch -->
                    <div class="col-md-6 form-group">
                        <label for="when_volunteer">When Volunteer?</label>
                        <div>
                            <input type="checkbox" id="when_volunteer" name="when_volunteer" checked data-bootstrap-switch
                                data-off-color="danger" data-on-color="success">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">

                    <div class="col-6 form-group">
                        <label for="participant">Capacity Participant</label>
                        <input type="text" id="participant" name="participant"
                            class="form-control @error('participant') is-invalid @enderror"
                            placeholder="Please Enter Participant">

                        @error('participant')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-6 form-group" style="display: none;">
                        <label for="Volunteer">Capacity Volunteer</label>
                        <input type="text" id="Volunteer" name="volunteer"
                            class="form-control @error('volunteer') is-invalid @enderror"
                            placeholder="Please Enter Volunteer">
                    
                        @error('volunteer')
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
    <!-- Bootstrap Switch -->
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- CodeMirror -->
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/codemirror.js"></script>
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/mode/css/css.js"></script>
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/mode/xml/xml.js"></script>
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi peta di div #map
            const map = L.map('map').setView([-6.200000, 106.816666], 13); // Lokasi awal Jakarta

            // Tambahkan tile layer (peta dasar)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Marker default
            const marker = L.marker([-6.200000, 106.816666], {
                draggable: true
            }).addTo(map);

            // Event untuk menangkap posisi marker saat dipindahkan
            marker.on('dragend', function(e) {
                const position = marker.getLatLng();
                document.getElementById('latitude').value = position.lat.toFixed(6);
                document.getElementById('longitude').value = position.lng.toFixed(6);
            });

            // Event untuk mencari lokasi manual
            const locationInput = document.getElementById('location');
            locationInput.addEventListener('blur', function() {
                const location = locationInput.value.trim();
                if (location) {
                    // Gunakan API Geocoding OpenStreetMap untuk mencari lokasi
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${location}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.length > 0) {
                                const {
                                    lat,
                                    lon
                                } = data[0];
                                map.setView([lat, lon], 13); // Pusatkan peta ke lokasi baru
                                marker.setLatLng([lat, lon]); // Pindahkan marker ke lokasi baru
                                document.getElementById('latitude').value = parseFloat(lat).toFixed(6);
                                document.getElementById('longitude').value = parseFloat(lon).toFixed(6);
                            } else {
                                // Gunakan SweetAlert untuk menampilkan error
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Location not found!',
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            // Tampilkan error jika terjadi masalah saat fetch
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to fetch location data. Please try again later.',
                                confirmButtonText: 'OK'
                            });
                        });
                }
            });
        });
    </script>

    <script>
        // bs-custom-file-input
        $(function() {
            bsCustomFileInput.init();
        });

        // bootstrap switch
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    </script>

    <script>
        $(document).ready(function() {
            // Initialize Bootstrap Switch
            $("input[data-bootstrap-switch]").bootstrapSwitch();

            // Check the state of the "when_volunteer" checkbox on page load
            toggleVolunteerInput($("#when_volunteer").is(":checked"));

            // Add event listener for toggle change
            $("#when_volunteer").on("switchChange.bootstrapSwitch", function(event, state) {
                toggleVolunteerInput(state);
            });

            // Function to toggle visibility of the "Capacity Volunteer" input
            function toggleVolunteerInput(isChecked) {
                if (isChecked) {
                    $("#Volunteer").closest(".form-group").show();
                } else {
                    $("#Volunteer").closest(".form-group").hide();
                }
            }
        });
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
