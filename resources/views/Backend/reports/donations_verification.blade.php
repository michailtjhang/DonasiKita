@extends('Backend.layouts.app')

@section('seoMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('css')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Tambahkan CSS untuk memastikan pagination berada di kanan -->
    <style>
        .pagination-right {
            justify-content: flex-end !important;
        }

        #daterange_textbox {
            max-width: 100%;
            /* Sesuaikan ukuran agar rapi */
        }
    </style>

    <!-- ======================== datatable ========================= -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
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

            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Type Donation</th>
                            <th>Bukti</th>
                            <th>Konfirmasi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th><input type="text" placeholder="Search Nama" class="form-control form-control-sm"></th>
                            <th><input type="text" placeholder="Search Email" class="form-control form-control-sm"></th>
                            <th><input type="text" placeholder="Search Type Donation"
                                    class="form-control form-control-sm"></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>

    <!-- Modal untuk Bukti -->
    <div class="modal fade" id="proofModal" tabindex="-1" role="dialog" aria-labelledby="proofModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bukti Donasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="proofImage" src="" alt="Bukti Donasi" class="img-fluid img-thumbnail">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Konfirmasi -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Donasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apakah donasi ini sudah terverifikasi dengan bukti yang ada?</p>
                    <div class="d-flex justify-content-center">
                        <button id="confirmYes" class="btn btn-success mr-2">Iya</button>
                        <button id="confirmNo" class="btn btn-danger">Tidak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- Load Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Load DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://adminlte.io/themes/v3/plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url()->current() }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'type_donation',
                        name: 'type_donation'
                    },
                    {
                        data: 'proof',
                        name: 'proof',
                        orderable: false,
                        render: function(data) {
                            return `<button class="btn btn-info btn-sm view-proof" data-proof="${data}">
                        Lihat Bukti
                    </button>`;
                        }
                    },
                    {
                        data: 'confirmation',
                        name: 'confirmation',
                        orderable: false,
                        render: function(data, type, row) {
                            return `<button class="btn btn-success btn-sm confirm-donation" data-id="${row.id}">
                        Konfirmasi
                    </button>`;
                        }
                    },
                ]
            });

            // Tambahkan input search ke setiap kolom footer
            $('#dataTable tfoot th').each(function(i) {
                var title = $('#dataTable thead th').eq(i).text();
                if ($(this).find('input').length) {
                    $('input', this).on('keyup change', function() {
                        if (table.column(i).search() !== this.value) {
                            table.column(i).search(this.value).draw();
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Fungsi untuk menangani ekspor PDF
            $('#exportPdf').on('click', function() {
                let start_date = $('#daterange_textbox').data('daterangepicker')?.startDate.format(
                    'YYYY-MM-DD');
                let end_date = $('#daterange_textbox').data('daterangepicker')?.endDate.format(
                    'YYYY-MM-DD');

                window.location.href =
                    `?start_date=${start_date}&end_date=${end_date}`;
            });

            // Fungsi untuk menangani ekspor Excel
            $('#exportExcel').on('click', function() {
                let start_date = $('#daterange_textbox').data('daterangepicker')?.startDate.format(
                    'YYYY-MM-DD');
                let end_date = $('#daterange_textbox').data('daterangepicker')?.endDate.format(
                    'YYYY-MM-DD');

                window.location.href =
                    `?start_date=${start_date}&end_date=${end_date}`;
            });
        });
    </script>

    <script>
        $(document).on('click', '.view-proof', function() {
            const proofImageUrl = $(this).data('proof');
            $('#proofImage').attr('src', proofImageUrl);
            $('#proofModal').modal('show'); // Menampilkan modal
        });

        $(document).on('click', '.confirm-donation', function() {
            const donationId = $(this).data('id');
            $('#confirmationModal').modal('show'); // Menampilkan modal

            // Klik tombol Yes (Konfirmasi)
            $('#confirmYes').off().on('click', function() {
                // Menampilkan SweetAlert yang menunjukkan proses upload
                Swal.fire({
                    title: 'Sedang menyimpan konfirmasi...',
                    text: 'Harap tunggu beberapa saat.',
                    icon: 'info',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading(); // Menampilkan indikator loading
                    }
                });

                // Kirim request untuk konfirmasi
                $.ajax({
                    url: `verification/confirm/${donationId}`,
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        status: 'confirmed'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Donasi telah dikonfirmasi!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: xhr.responseJSON?.message ||
                                'Terjadi kesalahan saat memproses data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Klik tombol No (Reject)
            $('#confirmNo').off().on('click', function() {
                Swal.fire({
                    title: 'Tolak Donasi?',
                    text: 'Apakah Anda yakin ingin menolak donasi ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Tolak',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Menampilkan SweetAlert yang menunjukkan proses upload
                        Swal.fire({
                            title: 'Sedang menolak donasi...',
                            text: 'Harap tunggu beberapa saat.',
                            icon: 'info',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading(); // Menampilkan indikator loading
                            }
                        });

                        // Kirim request untuk menolak donasi
                        $.ajax({
                            url: `verification/confirm/${donationId}`,
                            method: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                status: 'rejected'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Donasi telah ditolak!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: xhr.responseJSON?.message ||
                                        'Terjadi kesalahan saat memproses data.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
