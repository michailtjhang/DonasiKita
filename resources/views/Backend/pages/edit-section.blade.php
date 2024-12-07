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
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="{{ $sectionData['title'] ?? '' }}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="subtitle">Subtitle</label>
                        <textarea name="subtitle" id="subtitle" class="form-control">{{ $sectionData['subtitle'] ?? '' }}</textarea>
                    </div>
                @elseif($section === 'company_section')
                    <div class="form-group">
                        <label for="name">Company Name</label>
                        <input type="text" name="name" id="name" value="{{ $sectionData['name'] ?? '' }}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control">{{ $sectionData['description'] ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="text" name="logo" id="logo" value="{{ $sectionData['logo'] ?? '' }}"
                            class="form-control">
                    </div>
                @elseif($section === 'founder_section')
                    <div class="form-group">
                        <label for="name">Founder Name</label>
                        <input type="text" name="name" id="name" value="{{ $sectionData['name'] ?? '' }}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" name="position" id="position" value="{{ $sectionData['position'] ?? '' }}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="text" name="image" id="image" value="{{ $sectionData['image'] ?? '' }}"
                            class="form-control">
                    </div>
                @elseif($section === 'team_section')
                    <div class="team-container">
                        <div class="row">
                            @foreach ($sectionData as $key => $team)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="team_name_{{ $key }}">Team Member Name</label>
                                        <input type="text" name="team[{{ $key }}][name]"
                                            id="team_name_{{ $key }}" value="{{ $team['name'] }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="team_position_{{ $key }}">Position</label>
                                        <input type="text" name="team[{{ $key }}][position]"
                                            id="team_position_{{ $key }}" value="{{ $team['position'] }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="team_image_{{ $key }}">Image</label>
                                        <input type="text" name="team[{{ $key }}][image]"
                                            id="team_image_{{ $key }}" value="{{ $team['image'] }}"
                                            class="form-control">
                                    </div>
                                    <button type="button" class="btn btn-danger mb-4"
                                        onclick="removeTeamMember({{ $key }})">Remove</button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Button to add a new team member -->
                    <button type="button" class="btn btn-primary mt-3" onclick="addTeamMember()">Add Team Member</button>
                @endif

                <button type="submit" class="btn btn-success mt-3">Save</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    @if ($section === 'team_section')
        <script>
            let teamIndex = {{ count($sectionData) }};
            let teamCounter = {{ count($sectionData) }}; // Hitung anggota yang sudah ada

            function addTeamMember() {
                // Cari baris aktif
                let row = document.querySelector('.team-container .row:last-child');
                let totalInRow = row ? row.children.length : 0; // Hitung jumlah kolom dalam baris saat ini

                // Jika jumlah anggota lebih dari 3, buat baris baru
                if (totalInRow >= 3) {
                    row = document.createElement('div');
                    row.classList.add('row');
                    document.querySelector('.team-container').appendChild(row); // Tempatkan baris baru di dalam container
                }

                // Buat form anggota baru
                const formGroup = document.createElement('div');
                formGroup.classList.add('col-md-4'); // Pastikan form ditempatkan dalam kolom 3 per baris
                formGroup.innerHTML = `
                <div class="form-group">
                    <label for="team_name_${teamIndex}">Team Member Name</label>
                    <input type="text" name="team[${teamIndex}][name]" id="team_name_${teamIndex}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="team_position_${teamIndex}">Position</label>
                    <input type="text" name="team[${teamIndex}][position]" id="team_position_${teamIndex}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="team_image_${teamIndex}">Image</label>
                    <input type="text" name="team[${teamIndex}][image]" id="team_image_${teamIndex}" class="form-control">
                </div>
                <button type="button" class="btn btn-danger mt-2" onclick="removeTeamMember(${teamIndex})">Remove</button>
            `;
                row.appendChild(formGroup); // Menambahkan anggota ke baris yang sesuai
                teamIndex++;
            }

            function removeTeamMember(index) {
                const member = document.querySelector(`#team_name_${index}`).closest('.col-md-4');
                member.remove();
            }
        </script>
    @endif
@endsection