@extends('Backend.layouts.app')
@section('seoMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/adminlte') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- leaflet -->
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

            <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-6 form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror" placeholder="Please Enter Title"
                            value="{{ old('title', $event->title) }}">

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
                                    {{ $event->category_id == $item->id ? 'selected' : '' }}>
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
                    <label for="img">Image Cover</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('img') is-invalid @enderror" name="img"
                            id="img" onchange="previewImage(event)">
                        <label class="custom-file-label" for="img">Choose file</label>
                    </div>

                    @error('img')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror

                    <!-- Row for Preview and Existing Image -->
                    <div class="row mt-3 text-center">
                        <!-- Preview Image -->
                        <div class="col-6">
                            <span class="d-block mb-2 text-muted">Preview:</span>
                            <img id="imgPreview" src="" alt="Preview Image" class="img-thumbnail shadow-sm border"
                                style="display: none; max-height: 150px; max-width: 100%; object-fit: cover;">
                        </div>

                        <!-- Existing Image -->
                        @if ($event->thumbnail && $event->thumbnail->file_path)
                            <div class="col-6">
                                <span class="d-block mb-2 text-muted">Existing:</span>
                                <img src="{{ asset('storage/cover/' . $event->thumbnail->file_path) }}"
                                    class="img-thumbnail shadow-sm border" alt="Existing Image"
                                    style="max-height: 150px; max-width: 100%; object-fit: cover;">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="content">Description</label>
                    <textarea id="summernote" name="content" class="form-control @error('content') is-invalid @enderror">
                        {!! old('content', $event->description) !!}
                    </textarea>

                    @error('content')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="row mt-3">
                    <!-- Date Event Input -->
                    <div class="col-md-6 form-group">
                        <label for="reservationtime">Event Date & Time</label>
                        <div class="input-group">
                            <input type="text" class="form-control float-right @error('date') is-invalid @enderror"
                                id="reservationtime" name="date" value="{{ old('date', $date) }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                        </div>

                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
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
                            placeholder="Please Enter Participant" value="{{ old('participant', $event->participant) }}">

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
                            placeholder="Please Enter Volunteer" value="{{ old('volunteer', $event->volunteer) }}">

                        @error('volunteer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="form-group">
                    <label for="location">Location Name</label>
                    <input type="text" id="location" name="location"
                        class="form-control @error('location') is-invalid @enderror" placeholder="Enter a location"
                        value="{{ old('location', $event->location->name_location) }}">

                    @error('location')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div id="map" style="width: 100%; height: 400px; margin-top: 20px;"></div>

                <div class="row mt-3">

                    <div class="col-6 form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" id="latitude" name="latitude" class="form-control" readonly
                            value="{{ old('latitude', $event->location->latitude) }}">
                    </div>

                    <div class="col-6 form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" id="longitude" name="longitude" class="form-control" readonly
                            value="{{ old('longitude', $event->location->longitude) }}">
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <!-- moment -->
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/moment/moment.min.js"></script>
    <!-- tempusdominus-bootstrap-4 -->
    <script
        src="{{ asset('assets/vendor/adminlte') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- date-range-picker -->
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/daterangepicker/daterangepicker.js"></script>
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

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- leaflet -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil data lokasi awal dari input
            const defaultLat = parseFloat(document.getElementById('latitude').value) || -6.200000;
            const defaultLng = parseFloat(document.getElementById('longitude').value) || 106.816666;

            // Inisialisasi peta di div #map
            const map = L.map('map').setView([defaultLat, defaultLng], 17); // Lokasi awal

            // Tambahkan tile layer (peta dasar)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 20,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Tambahkan marker dengan posisi awal dari database
            const marker = L.marker([defaultLat, defaultLng], {
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

        $(function() {
            //Date and time picker
            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
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