@extends('Backend.layouts.app')

@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
        <div class="card-body">

            @include('_message')

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Value</th>
                            @if (!empty($data['PermissionEdit']))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['config'] as $item => $row)
                            <tr>
                                {{-- Periksa jika method firstItem() tersedia --}}
                                <td>{{ $data['config']->firstItem() + $item }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ Str::limit(strip_tags($row->value), 50, '...') }}</td>
                                @if (!empty($data['PermissionEdit']))
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                            data-target="#modalUpdate{{ $row->id }}">
                                            <i class="fas fa-fw fa-edit"></i>
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $data['config']->onEachSide(1)->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>


    <!-- /.modal-content -->
    @include('Backend.config.edit-modal')
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
