@extends('Backend.layouts.app')
@section('seoMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <!-- Tambahkan CSS untuk memastikan pagination berada di kanan -->
    <style>
        .pagination-right {
            justify-content: flex-end !important;
        }

        .info-left {
            justify-content: flex-start !important;
        }
    </style>

    <!-- ======================== datatable ========================= -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
@endsection
@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
        <div class="card-body">

            <!-- ======================== Alert Success ========================= -->
            <div class="swal" data-swal="{{ session('success') }}"></div>

            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th>Published Date</th>
                            @if (!empty($data['PermissionEdit']) || !empty($data['PermissionShow']))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th><input type="text" placeholder="Search Title" class="form-control form-control-sm"></th>
                            <th><input type="text" placeholder="Search Category" class="form-control form-control-sm">
                            </th>
                            <th><input type="text" placeholder="Search Views" class="form-control form-control-sm"></th>
                            <th><input type="text" placeholder="Search Status" class="form-control form-control-sm"></th>
                            <th><input type="text" placeholder="Search Date" class="form-control form-control-sm"></th>
                            @if (!empty($data['PermissionEdit']) || !empty($data['PermissionShow']))
                                <th></th>
                            @endif
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <!-- /.modal-content -->
@endsection
@section('js')
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url()->current() }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id'
                    },
                    {
                        data: 'views',
                        name: 'views'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            return moment(data).format('MM-DD-YYYY');
                        }
                    },
                    @if (!empty($data['PermissionEdit']) || !empty($data['PermissionShow']))
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    @endif
                ],
                dom: @if (!empty($data['PermissionAdd']))
                    // Jika PermissionAdd tersedia, tombol tambah muncul di kiri
                    '<"d-flex justify-content-between align-items-center"<"btn-tambah"B><"search-box"f><"length-control"l>>rt<"d-flex justify-content-between align-items-center"<"info-left"i><"pagination-right"p>>'
                @else
                    // Jika PermissionAdd tidak tersedia, search berada di posisi tombol
                    '<"d-flex justify-content-between align-items-center"<"search-box"f><"length-control"l>>rt<"d-flex justify-content-between align-items-center"<"info-left"i><"pagination-right"p>>'
                @endif ,
                buttons: [
                    @if (!empty($data['PermissionAdd']))
                        {
                            text: '<i class="fas fa-plus"></i> Tambah',
                            className: 'btn btn-success btn-sm',
                            action: function() {
                                window.location.href = "{{ route('article.create') }}";
                            }
                        }
                    @endif
                ],
                language: {
                    lengthMenu: "_MENU_ entries per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries available",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                }
            });

            // Tambahkan input search ke setiap kolom footer
            $('#dataTable tfoot th').each(function(i) {
                var title = $('#dataTable thead th').eq(i).text();
                if ($(this).find('input').length) {
                    $('input', this).on('keyup change', function() {
                        if (table.column(i).search() !== this.value) {
                            table
                                .column(i)
                                .search(this.value)
                                .draw();
                        }
                    });
                }
            });
        });
    </script>
@endsection
