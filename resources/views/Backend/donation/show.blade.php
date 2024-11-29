@extends('Backend.layouts.app')
@section('css')
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

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-stripped">
                    <tr>
                        <th>Title</th>
                        <td>: {{ $donation->title }}</td>
                    </tr>
                    <tr>
                        <th>Towards</th>
                        <td>: {{ $donation->towards }}</td>
                    </tr>
                    <tr>
                        <th>Target Amount</th>
                        <td>: Rp. {{ number_format($donation->target_amount, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>: {{ $donation->description }}</td>
                    </tr>
                    <tr>
                        <th>Description Need</th>
                        <td>: {!! $donation->description_need !!}</td>
                    </tr>
                    <tr>
                        <th>Image Cover</th>
                        <td>
                            @if ($donation->thumbnail && $donation->thumbnail->id_file)
                                <a href="{{ $donation->thumbnail->file_path }}" target="_blank" rel="noopener noreferrer">
                                    <x-cld-image public-id="{{ $donation->thumbnail->id_file }}" width="500"
                                        alt="Cover Image" />
                                </a>
                            @elseif ($donation->thumbnail && $donation->thumbnail->file_path)
                                <a href="{{ asset('storage/cover/' . $donation->thumbnail->file_path) }}" target="_blank"
                                    rel="noopener noreferrer">
                                    <img src="{{ asset('storage/cover/' . $donation->thumbnail->file_path) }}"
                                        alt="Cover Image" width="500">
                                </a>
                            @else
                                <span>No cover image available</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        @if ($donation->status == 'complete')
                            <td>: <span class="badge badge-success">Complete</span></td>
                        @else
                            <td>: <span class="badge badge-secondary">Progress</span></td>
                        @endif
                    </tr>
                </table>
            </div>

            <!-- Back Button -->
            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        </div>
    </div>
@endsection
@section('js')
@endsection
