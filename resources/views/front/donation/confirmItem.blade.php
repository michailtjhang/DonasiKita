@extends('front.layout.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/styles2.css') }}">
    <style>
        .confirmation-container {
            width: 100%;
            padding: 100px 20px 50px;
            background: #E9F4FA;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 30px;
            font-family: 'Poppins', sans-serif;
        }

        .info-section {
            width: 100%;
            max-width: 800px;
            background: #F8FCFF;
            padding: 15px;
            border-radius: 15px;
            border: 1px solid #0F3D56;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section {
            width: 100%;
            max-width: 800px;
            background: #F8FCFF;
            padding: 30px;
            border-radius: 15px;
            border: 1px solid #0F3D56;
        }

        .form-button {
            background: #6CB6DE;
            color: white;
            font-size: 18px;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            padding: 12px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
        }

        .form-button:hover {
            background: #2492CD;
            transform: scale(1.05);
        }

        .address-box {
            background: #F8FCFF;
            border: 1px solid #0F3D56;
            border-radius: 15px;
            padding: 15px;
            font-size: 16px;
            color: #0F3D56;
        }
    </style>
@endsection

@section('content')
    <div class="confirmation-container">
        <!-- Informasi -->
        <div class="info-section">
            <img src="{{ asset('images/donate/vector_blue.svg') }}" alt="Icon" style="width: 24px; height: 24px;">
            <div>Bukti Donasi Barang Anda</div>
        </div>

        <!-- Form Konfirmasi -->
        <div class="form-section">
            <h2 class="section-title">Konfirmasi Pengiriman Barang</h2>
            <form id="confirmationForm"
                action="{{ route('donations.confirm-item', ['slug' => $donation->slug, 'temp_id' => $id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <!-- Nomor Resi -->
                <div class="mb-4">
                    <label for="nomor_resi" class="form-label">Masukan Nomor Resi</label>
                    <input type="text" id="nomor_resi" name="nomor_resi"
                        class="form-control @error('nomor_resi') is-invalid @enderror" placeholder="Masukkan Nomor Resi">
                    @error('nomor_resi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bukti Foto -->
                <div class="mb-4">
                    <label for="bukti_foto" class="form-label">Unggah Foto Resi</label>
                    <input type="file" id="bukti_foto" name="bukti_foto"
                        class="form-control @error('bukti_foto') is-invalid @enderror">
                    @error('bukti_foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="text-center">
                    <button type="button" class="form-button" id="submitConfirmation">Kirim Bukti</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('submitConfirmation').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah submit langsung

            // Menampilkan SweetAlert loading
            Swal.fire({
                title: 'Sedang mengirim bukti...',
                text: 'Harap tunggu beberapa saat.',
                icon: 'info',
                showConfirmButton: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Mengambil form dan data form
            var form = document.getElementById('confirmationForm');
            var formData = new FormData(form);

            // Mengirimkan form menggunakan AJAX
            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest', // Untuk Laravel AJAX handling
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF token
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Response dari server
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil Mengirim Bukti',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Selesai',
                            confirmButtonColor: '#6CB6DE',
                        }).then(() => {
                            // Redirect ke halaman lain setelah sukses
                            window.location.href = '{{ route('donations') }}';
                        });
                    } else {
                        // Menangani error dari server
                        Swal.fire({
                            title: 'Gagal Mengirim Bukti',
                            text: data.message || 'Terjadi kesalahan, silakan coba lagi.',
                            icon: 'error',
                            confirmButtonText: 'Coba Lagi',
                            confirmButtonColor: '#FF6B6B',
                        });
                    }
                })
                .catch(error => {
                    // Menangani error dari sisi client (misalnya masalah koneksi)
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error',
                        confirmButtonText: 'Tutup',
                    });
                });
        });
    </script>
@endsection
