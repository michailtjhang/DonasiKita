@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Pages List</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
        <div class="card-body">

            <form method="POST" action="{{ route('pages.update.section', [$page->name, $section]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if ($section === 'hero_section')
                    <div class="carousel-container">
                        <div class="row">

                            @foreach ($sectionData['carousel'] ?? [] as $key => $carousel)
                                <div class="col-md-4">

                                    <h5>Carousel Item {{ $key + 1 }}</h5>

                                    <div class="form-group">
                                        <label for="carousel_title_{{ $key }}">Title</label>
                                        <input type="text" name="carousel[{{ $key }}][title]"
                                            id="carousel_title_{{ $key }}" value="{{ $carousel['title'] ?? '' }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="carousel_subtitle_{{ $key }}">Subtitle</label>
                                        <textarea name="carousel[{{ $key }}][subtitle]" id="carousel_subtitle_{{ $key }}"
                                            class="form-control">{{ $carousel['subtitle'] ?? '' }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="button_{{ $key }}">Button Link</label>
                                        <input type="text" name="carousel[{{ $key }}][button_link]"
                                            id="button_{{ $key }}" value="{{ $carousel['button_link'] ?? '' }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="carousel_image_{{ $key }}">Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"
                                                name="carousel[{{ $key }}][image]"
                                                id="carousel_image_{{ $key }}"
                                                onchange="previewImage(event, {{ $key }})">
                                            <label class="custom-file-label"
                                                for="carousel_image_{{ $key }}">Choose file</label>
                                        </div>
                                        <small class="form-text text-muted">
                                            *Unggah foto dengan ukuran maksimal 2MB dan format JPG, PNG, atau JPEG. Pastikan
                                            foto yang diunggah jelas dan tidak mengandung unsur yang tidak pantas.*
                                        </small>
                                    </div>

                                    <div class="row mt-3 text-center">
                                        <!-- Preview Image -->
                                        <div class="col-6">
                                            <span class="d-block mb-2 text-muted">Preview:</span>
                                            <img id="imgPreview_{{ $key }}" src="" alt="Preview Image"
                                                class="img-thumbnail shadow-sm border"
                                                style="display: none; max-height: 150px; max-width: 100%; object-fit: cover;">
                                        </div>

                                        <!-- Existing Image -->
                                        <div class="col-6">
                                            <span class="d-block mb-2 text-muted">Existing:</span>
                                            <img src="{{ $carousel['image'] ?? (asset($carousel['image']) ?? '') }}"
                                                class="img-thumbnail shadow-sm border" alt="Existing Image"
                                                style="max-height: 150px; max-width: 100%; object-fit: cover;">
                                        </div>
                                    </div>


                                    <button type="button" class="btn btn-danger mb-4"
                                        onclick="removeCarouselItem({{ $key }})">Remove</button>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <!-- Button to add a new carousel item -->
                    <button type="button" class="btn btn-primary mt-3" onclick="addCarouselItem()">Add Carousel
                        Item</button>
                @elseif($section === 'about_section')
                    <div class="form-group">
                        <label for="about_title">About Section Title</label>
                        <input type="text" name="title" id="about_title" value="{{ $sectionData['title'] ?? '' }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="about_description">About Section Description</label>
                        <textarea name="description" id="about_description" class="form-control">{{ $sectionData['description'] ?? '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="about_image">About Section Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="about_image"
                                onchange="previewImage(event)">
                            <label class="custom-file-label" for="about_image">Choose file</label>
                        </div>
                        <small class="form-text text-muted">
                            *Unggah foto dengan ukuran maksimal 2MB dan format JPG, PNG, atau JPEG. Pastikan foto yang
                            diunggah jelas dan tidak mengandung unsur yang tidak pantas.*
                        </small>
                    </div>

                    <div class="row mt-3 text-center">
                        <!-- Preview Image -->
                        <div class="col-6">
                            <span class="d-block mb-2 text-muted">Preview:</span>
                            <img id="imgPreview" src="" alt="Preview Image" class="img-thumbnail shadow-sm border"
                                style="display: none; max-height: 150px; max-width: 100%; object-fit: cover;">
                        </div>

                        <!-- Existing Image -->
                        <div class="col-6">
                            <span class="d-block mb-2 text-muted">Existing:</span>
                            <img src="{{ $sectionData['image'] ?? (asset($sectionData['image']) ?? '') }}"
                                class="img-thumbnail shadow-sm border" alt="Existing Image"
                                style="max-height: 150px; max-width: 100%; object-fit: cover;">
                        </div>
                    </div>
                @elseif($section === 'quote_section')
                    <div class="form-group">
                        <label for="quote">Quote</label>
                        <input type="text" name="quote" id="quote" value="{{ $sectionData['quote'] ?? '' }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="author" id="author" value="{{ $sectionData['author'] ?? '' }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="background_image">Background Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="background_image"
                                onchange="previewImage(event)">
                            <label class="custom-file-label" for="background_image">Choose file</label>
                        </div>
                        <small class="form-text text-muted">
                            *Unggah foto dengan ukuran maksimal 2MB dan format JPG, PNG, atau JPEG. Pastikan foto yang
                            diunggah jelas dan tidak mengandung unsur yang tidak pantas.*
                        </small>
                    </div>

                    <div class="row mt-3 text-center">
                        <!-- Preview Image -->
                        <div class="col-6">
                            <span class="d-block mb-2 text-muted">Preview:</span>
                            <img id="imgPreview" src="" alt="Preview Image"
                                class="img-thumbnail shadow-sm border"
                                style="display: none; max-height: 150px; max-width: 100%; object-fit: cover;">
                        </div>

                        <!-- Existing Image -->
                        <div class="col-6">
                            <span class="d-block mb-2 text-muted">Existing:</span>
                            <img src="{{ $sectionData['image'] ?? asset($sectionData['background_image']) }}"
                                class="img-thumbnail shadow-sm border" alt="Existing Image"
                                style="max-height: 150px; max-width: 100%; object-fit: cover;">
                        </div>
                    </div>
                @elseif($section === 'faq_section')
                    <div class="faq-container">
                        <div class="row">

                            @foreach ($sectionData['faq'] ?? [] as $key => $faq)
                                <div class="col-md-4">
                                    <h5>Faq Item {{ $key + 1 }}</h5>

                                    <div class="form-group">
                                        <label for="questions_{{ $key }}">Questions</label>
                                        <input type="text" name="questions[{{ $key }}]"
                                            id="questions_{{ $key }}" value="{{ $faq['questions'] ?? '' }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="answers_{{ $key }}">Answers</label>
                                        <textarea name="answers[{{ $key }}]" id="answers_{{ $key }}" class="form-control">{{ $faq['answers'] ?? '' }}</textarea>
                                    </div>

                                    <button type="button" class="btn btn-danger mb-4"
                                        onclick="removeFaqItem({{ $key }})">Remove</button>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- Button to add a new carousel item -->
                    <button type="button" class="btn btn-primary mt-3" onclick="addFaqItem()">Add New Faq</button>
                @endif

                <div class="col d-flex justify-content-between align-items-center mt-3">
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">Back</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    @if ($section === 'hero_section')
        <!-- bs-custom-file-input -->
        <script src="https://adminlte.io/themes/v3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

        <!-- Image Preview -->
        <script>
            function previewImage(event, index) {
                const input = event.target;
                const preview = document.getElementById(`imgPreview_${index}`);

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
            let carouselIndex = {{ count($sectionData['carousel'] ?? []) }};
            let carouselCounter = {{ count($sectionData['carousel'] ?? []) }}; // Hitung carousel yang sudah ada

            function addCarouselItem() {
                // Cari baris aktif
                let row = document.querySelector('.carousel-container .row:last-child');
                let totalInRow = row ? row.children.length : 0; // Hitung jumlah kolom dalam baris saat ini

                // Jika jumlah anggota lebih dari 3, buat baris baru
                if (totalInRow >= 3) {
                    row = document.createElement('div');
                    row.classList.add('row');
                    document.querySelector('.carousel-container').appendChild(row); // Tempatkan baris baru di dalam container
                }

                // Buat form carousel baru
                const formGroup = document.createElement('div');
                formGroup.classList.add('col-md-4'); // Pastikan form ditempatkan dalam kolom 3 per baris
                formGroup.innerHTML = `
                <h5>Carousel Item ${carouselIndex + 1}</h5>
                <div class="form-group">
                    <label for="carousel_title_${carouselIndex}">Title</label>
                    <input type="text" name="carousel[${carouselIndex}][title]" id="carousel_title_${carouselIndex}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="carousel_subtitle_${carouselIndex}">Subtitle</label>
                    <textarea name="carousel[${carouselIndex}][subtitle]" id="carousel_subtitle_${carouselIndex}" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="carousel_image_${carouselIndex}">Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="carousel[${carouselIndex}][image]" id="carousel_image_${carouselIndex}" onchange="previewImage(event, ${carouselIndex})">
                        <label class="custom-file-label" for="carousel_image_${carouselIndex}">Choose file</label>
                    </div>
                    <small class="form-text text-muted">
                        *Unggah foto dengan ukuran maksimal 2MB dan format JPG, PNG, atau JPEG. Pastikan foto yang diunggah jelas dan tidak mengandung unsur yang tidak pantas.*
                    </small>
                </div>

                <div class="row mt-3 text-center">
                    <div class="col-6">
                        <span class="d-block mb-2 text-muted">Preview:</span>
                        <img id="imgPreview_${carouselIndex}" src="" alt="Preview Image" class="img-thumbnail shadow-sm border" style="display: none; max-height: 150px; max-width: 100%; object-fit: cover;">
                    </div>
                </div>

                <button type="button" class="btn btn-danger mt-4" onclick="removeCarouselItem(${carouselIndex})">Remove</button>
            `;
                row.appendChild(formGroup); // Menambahkan carousel ke baris yang sesuai
                carouselIndex++;
            }

            function removeCarouselItem(index) {
                const item = document.querySelector(`#carousel_title_${index}`).closest('.col-md-4');
                item.remove();
            }
        </script>
    @elseif($section === 'faq_section')
        <script>
            let faqIndex = {{ count($sectionData['faq'] ?? []) }};
            let faqCounter = {{ count($sectionData['faq'] ?? []) }}; // Hitung carousel yang sudah ada

            function addFaqItem() {
                // Cari baris aktif
                let row = document.querySelector('.faq-container .row:last-child');
                let totalInRow = row ? row.children.length : 0; // Hitung jumlah kolom dalam baris saat ini

                // Jika jumlah anggota lebih dari 3, buat baris baru
                if (totalInRow >= 3) {
                    row = document.createElement('div');
                    row.classList.add('row');
                    document.querySelector('.faq-container').appendChild(row); // Tempatkan baris baru di dalam container
                }

                // Buat form carousel baru
                const formGroup = document.createElement('div');
                formGroup.classList.add('col-md-4'); // Pastikan form ditempatkan dalam kolom 3 per baris
                formGroup.innerHTML = `
                    <h5>Faq Item ${faqIndex + 1}</h5>
                    <div class="form-group">
                        <label for="questions_${faqIndex}">Questions</label>
                        <input type="text" name="questions[${faqIndex}]" id="questions_${faqIndex}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="answers_${faqIndex}">Answers</label>
                        <textarea name="answers[${faqIndex}]" id="answers_${faqIndex}" class="form-control"></textarea>
                    </div>
                    <button type="button" class="btn btn-danger mt-2" onclick="removeFaqItem(${faqIndex})">Remove</button>
                `;
                row.appendChild(formGroup); // Menambahkan carousel ke baris yang sesuai
                faqIndex++;
            }

            function removeFaqItem(index) {
                const item = document.querySelector(`#questions_${index}`).closest('.col-md-4');
                item.remove();

                // Update faqIndex
                for (let i = index; i < faqIndex; i++) {
                    document.querySelector(`#questions_${i}`).id = `questions_${i}`;
                    document.querySelector(`#answers_${i}`).id = `answers_${i}`;
                }
            }
        </script>
    @elseif($section === 'about_section' || $section === 'quote_section')
        <!-- bs-custom-file-input -->
        <script src="https://adminlte.io/themes/v3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

        <!-- Image Preview -->
        <script>
            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('imgPreview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block'; // Tampilkan gambar setelah berhasil di-load
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.style.display = 'none'; // Sembunyikan jika tidak ada file
                }
            }
        </script>
    @endif
@endsection
