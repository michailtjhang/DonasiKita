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
                                            id="carousel_title_{{ $key }}" value="{{ $carousel['title'] }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="carousel_subtitle_{{ $key }}">Subtitle</label>
                                        <textarea name="carousel[{{ $key }}][subtitle]" id="carousel_subtitle_{{ $key }}"
                                            class="form-control">{{ $carousel['subtitle'] }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="carousel_image_{{ $key }}">Image</label>
                                        <input type="text" name="carousel[{{ $key }}][image]"
                                            id="carousel_image_{{ $key }}" value="{{ $carousel['image'] }}"
                                            class="form-control">
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
                        <input type="text" name="image" id="about_image" value="{{ $sectionData['image'] ?? '' }}"
                            class="form-control">
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
                        <input type="text" name="background_image" id="background_image"
                            value="{{ $sectionData['background_image'] ?? '' }}" class="form-control">
                    </div>

                @elseif($section === 'invitation_section')
                    <div class="form-group">
                        <label for="invitation_title">Invitation Title</label>
                        <input type="text" name="title" id="invitation_title"
                            value="{{ $sectionData['title'] ?? '' }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="invitation_description">Invitation Description</label>
                        <textarea name="description" id="invitation_description" class="form-control">{{ $sectionData['description'] ?? '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="invitation_buttons">Buttons</label>
                        <input type="text" name="buttons" id="invitation_buttons"
                            value="{{ json_encode($sectionData['buttons'] ?? []) }}" class="form-control">
                    </div>

                @elseif($section === 'faq_section')
                    <div class="faq-container">
                        <div class="row">

                            @foreach ($sectionData['faq'] ?? [] as $key => $faq)
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
                            @endforeach
                            
                        </div>
                    </div>
                    <!-- Button to add a new carousel item -->
                    <button type="button" class="btn btn-primary mt-3" onclick="addFaqItem()">Add New Faq</button>
                @endif

                <button type="submit" class="btn btn-success mt-3">Save</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    @if ($section === 'hero_section')
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
                    <input type="text" name="carousel[${carouselIndex}][image]" id="carousel_image_${carouselIndex}" class="form-control">
                </div>
                <button type="button" class="btn btn-danger mt-2" onclick="removeCarouselItem(${carouselIndex})">Remove</button>
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
                        <input type="text" name="faq[${faqIndex}][questions]" id="questions_${faqIndex}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="answers_${faqIndex}">Answers</label>
                        <textarea name="faq[${faqIndex}][answers]" id="answers_${faqIndex}" class="form-control"></textarea>
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
    @endif
@endsection
