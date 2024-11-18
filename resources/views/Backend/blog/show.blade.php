@extends('Backend.layouts.app')
@section('css')
@endsection
@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article List </a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-stripped">
                    <tr>
                        <th>Title</th>
                        <td>: {{ $article->title }}</td>
                    </tr>
                    <tr></tr>
                    <th>Category</th>
                    <td>: {{ $article->category->name }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>: {!! $article->content !!}</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            @if ($article->thumbnail && $article->thumbnail->file_path)
                                <a href="{{ asset('storage/cover/' . $article->thumbnail->file_path) }}" target="_blank"
                                    rel="noopener noreferrer">
                                    <img src="{{ asset('storage/cover/' . $article->thumbnail->file_path) }}"
                                        alt="Cover Image" width="500">
                                </a>
                            @else
                                <span>No cover image available</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Views</th>
                        <td>: {{ $article->views }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        @if ($article->status == 1)
                            <td>: <span class="badge badge-success">Published</span></td>
                        @else
                            <td>: <span class="badge badge-danger">Draft</span></td>
                        @endif
                    </tr>
                    {{-- <tr>
                        <th>Published Date</th>
                        <td>: {{ $article->published_date }}</td>
                    </tr>
                    <tr>
                        <th>Writer</th>
                        <td>: {{ $article->user->name ?? '' }}</td>
                    </tr> --}}
                </table>
            </div>

            <!-- Back Button -->
            <a href="{{ route('article.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
@endsection
@section('js')
@endsection
