@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Pages List </a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
        <div class="card-body">

            <form method="POST" action="{{ route('pages.update.section', [$page->name, $section]) }}" enctype="multipart/form-data">
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
                @elseif($section === 'team_section')
                    @foreach ($sectionData as $key => $team)
                        <div class="form-group">
                            <label for="team_name_{{ $key }}">Team Member Name</label>
                            <input type="text" name="team[{{ $key }}][name]" id="team_name_{{ $key }}"
                                value="{{ $team['name'] }}" class="form-control">
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
                                id="team_image_{{ $key }}" value="{{ $team['image'] }}" class="form-control">
                        </div>
                    @endforeach
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
                @endif

                <button type="submit" class="btn btn-success mt-3">Save</button>
            </form>
        </div>
    </div>
@endsection
