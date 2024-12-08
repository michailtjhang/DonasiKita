@extends('Backend.layouts.app')

@section('seoMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
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
            @include('_message')

            <div class="row mb-3">
                <div class="col-md-3">
                    <!-- Date Range Picker -->
                    <input type="text" id="daterange_textbox" class="form-control" placeholder="Select Date Range"
                        autocomplete="off" readonly>
                </div>
                <div class="col-md-9 d-flex justify-content-end align-items-center">
                    <!-- Export Buttons -->
                    <button id="exportPdf" class="btn btn-danger btn-sm m-2 p-2 d-flex align-items-center">
                        <i class="fas fa-file-pdf pr-2"></i> PDF
                    </button>
                    <button id="exportExcel" class="btn btn-success btn-sm p-2 d-flex align-items-center">
                        <i class="fas fa-file-excel pr-2"></i> Excel
                    </button>
                </div>
            </div>


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
    <!-- moment -->
    <script src="https://adminlte.io/themes/v3/plugins/moment/moment.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://adminlte.io/themes/v3/plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            var table;

            // Fungsi untuk memuat data dengan rentang tanggal
            function fetch_data(start_date = '', end_date = '') {
                table = $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true, // Hapus instansi DataTable sebelumnya
                    ajax: {
                        url: "{{ url()->current() }}",
                        type: "GET",
                        data: {
                            start_date: start_date,
                            end_date: end_date
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false
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
                        }
                    ],
                    dom: '<"d-flex justify-content-between align-items-center"<"search-box"f><"length-control"l>>rt<"d-flex justify-content-between align-items-center"<"info-left"i><"pagination-right"p>>',
                    language: {
                        lengthMenu: "_MENU_ entries per page",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "No entries available",
                        infoFiltered: "(filtered from _MAX_ total entries)"
                    }
                });
            }

            // Inisialisasi DataTable pertama kali
            fetch_data();

            // Inisialisasi Date Range Picker
            $('#daterange_textbox').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                locale: {
                    format: 'YYYY-MM-DD'
                }
            }, function(start, end) {
                $('#dataTable').DataTable().destroy(); // Hancurkan DataTable sebelumnya
                fetch_data(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD')); // Muat ulang data
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
