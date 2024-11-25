@extends('Backend.layouts.app')
@section('css')
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
                <a href="{{ route('donation.create') }}" class="btn btn-success mb-2 btn-sm">
                    Tambah
                </a>
                <table id="dataTable" class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Towards</th>
                            <th>Status</th>
                            <th>Target Amount</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th><input type="text" placeholder="Search Title" class="form-control form-control-sm"></th>
                            <th><input type="text" placeholder="Search Towards" class="form-control form-control-sm">
                            </th>
                            <th><input type="text" placeholder="Search Status" class="form-control form-control-sm"></th>
                            <th><input type="text" placeholder="Search Target Amount" class="form-control form-control-sm"></th>
                            <th></th>
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
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
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
