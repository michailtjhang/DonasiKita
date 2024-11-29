@extends('Backend.layouts.app')
@section('css')
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

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-stripped">
                    <tr>
                        <th>Title</th>
                        <td>: {{ $event->title }}</td>
                    </tr>
                    <tr></tr>
                    <th>Category</th>
                    <td>: {{ $event->category->name }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>: {!! $event->description !!}</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            @if ($event->thumbnail && $event->thumbnail->id_file)
                                <a href="{{ $event->thumbnail->file_path }}" target="_blank" rel="noopener noreferrer">
                                    <x-cld-image public-id="{{ $event->thumbnail->id_file }}" width="500"
                                        alt="Cover Image" />
                                </a>
                            @elseif ($event->thumbnail && $event->thumbnail->file_path)
                                <a href="{{ asset('storage/cover/' . $event->thumbnail->file_path) }}" target="_blank"
                                    rel="noopener noreferrer">
                                    <img src="{{ asset('storage/cover/' . $event->thumbnail->file_path) }}"
                                        alt="Cover Image" width="500">
                                </a>
                            @else
                                <span>No cover image available</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        @if ($event->status == 'finished')
                            <td>: <span class="badge badge-success">Finished</span></td>
                        @else
                            <td>: <span class="badge badge-secondary">Upcoming</span></td>
                        @endif
                    </tr>
                    <tr>
                        <th>Date Events</th>
                        <td>: {{ $event->detailEvent->start->format('d F Y H:i') }} - {{ $event->detailEvent->end->format('d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td>: {{ $event->location->name_location }}</td>
                    </tr>
                    <tr>
                        <th>Capacity Participants</th>
                        <td>: {{ number_format($event->detailEvent->capacity_participants, 0, ',', '.') }} people</th>
                    </tr>
                    @if ($event->detailEvent->capacity_volunteers > 0)
                        <tr>
                            <th>Capacity Volunteers</th>
                            <td>: {{ $event->detailEvent->capacity_volunteers }}</th>
                        </tr>
                    @endif
                </table>
            </div>

            <!-- Back Button -->
            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        </div>
    </div>
@endsection
@section('js')
@endsection
