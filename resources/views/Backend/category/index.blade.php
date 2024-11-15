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
                <button type="button" class="btn btn-success mb-2 btn-sm" data-toggle="modal" data-target="#modalCreate">
                    Tambah
                </button>
                <table class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Created at</th>
                            @if (!empty($data['PermissionEdit']) || !empty($data['PermissionDelete']))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['category'] as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->slug }}</td>
                                <td>{{ $row->created_at }}</td>
                                @if (!empty($data['PermissionEdit']) || !empty($data['PermissionDelete']))
                                    <td>
                                        @if (!empty($data['PermissionEdit']))
                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#modalUpdate{{ $row->id }}">
                                                <i class="fas fa-fw fa-edit"></i>
                                            </button>
                                        @endif

                                        @if (!empty($data['PermissionDelete']))
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="confirmDelete('{{ route('category.destroy', $row->id) }}', '{{ $row->name }}')">
                                                <i class="fas fa-fw fa-trash"></i>
                                            </button>
                                        @endif

                                        <script>
                                            function confirmDelete(deleteUrl, name) {
                                                Swal.fire({
                                                    title: "Are you sure?",
                                                    text: `You won't be able to revert this! This will delete ${name}.`,
                                                    icon: "warning",
                                                    showCancelButton: true,
                                                    confirmButtonColor: "#d33",
                                                    cancelButtonColor: "#3085d6",
                                                    confirmButtonText: "Yes, delete it!"
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        var form = document.createElement('form');
                                                        form.method = 'POST';
                                                        form.action = deleteUrl;

                                                        var csrfToken = document.createElement('input');
                                                        csrfToken.type = 'hidden';
                                                        csrfToken.name = '_token';
                                                        csrfToken.value = '{{ csrf_token() }}';
                                                        form.appendChild(csrfToken);

                                                        var methodField = document.createElement('input');
                                                        methodField.type = 'hidden';
                                                        methodField.name = '_method';
                                                        methodField.value = 'DELETE';
                                                        form.appendChild(methodField);

                                                        document.body.appendChild(form);
                                                        form.submit();
                                                    }
                                                });
                                            }
                                        </script>

                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- /.modal-content -->
    @include('Backend.category.create-modal')
    @include('Backend.category.edit-modal')
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
