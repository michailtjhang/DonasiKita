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
                            @if ($event->thumbnail && $event->thumbnail->file_path)
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
                        @if ($event->status == 1)
                            <td>: <span class="badge badge-success">Published</span></td>
                        @else
                            <td>: <span class="badge badge-danger">Draft</span></td>
                        @endif
                    </tr>
                    <tr>
                        <th>Date Events</th>
                        <td>: {{ $event->start->format('d F Y H:i') }} - {{ $event->end->format('d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td>: {{ $event->location->name_location }}</td>
                    </tr>
                </table>
            </div>

            <!-- Back Button -->
            <a href="{{ route('article.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
@endsection
@section('js')
@endsection
