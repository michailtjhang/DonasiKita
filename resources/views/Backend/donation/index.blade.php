@extends('Backend.layouts.app')
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
                            <th>Towards</th>
                            <th>Status</th>
                            <th>Target Amount</th>
                            @if (!empty($data['PermissionEdit']) || !empty($data['PermissionShow']))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th><input type="text" placeholder="Search Title" class="form-control form-control-sm"></th>
                            <th><input type="text" placeholder="Search Towards" class="form-control form-control-sm">
                            </th>
                            <th><input type="text" placeholder="Search Status" class="form-control form-control-sm"></th>
                            <th><input type="text" placeholder="Search Target Amount"
                                    class="form-control form-control-sm"></th>
                            @if (!empty($data['PermissionEdit']) || !empty($data['PermissionShow']))
                                <th></th>
                            @endif
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- /.modal-content -->
@endsection
@section('js')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>

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
                        data: 'towards',
                        name: 'towards'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'target_amount',
                        name: 'target_amount',
                        render: function(data, type, row) {
                            // Format angka menjadi format uang
                            return new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(data);
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
                                window.location.href = "{{ route('donation.create') }}";
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
