@extends('front.layout.navigator')

@section('style')
<link rel="stylesheet" href="{{ asset('css/styles2.css') }}">
<style>
    .donasi-container {
        width: 100%;
        padding: 100px 20px 50px; /* Tambahkan padding atas untuk mencegah tabrakan dengan header */
        background: #E9F4FA;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 30px;
        font-family: 'Poppins', sans-serif; /* Menyamakan font */
        font-size: 16px; /* Menyamakan ukuran font */
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
        gap: 10px; /* Sesuaikan jarak */
    }

    .info-section img {
        width: 24px; /* Memperkecil ukuran gambar */
        height: 24px; /* Memperkecil ukuran gambar */
    }

    .info-title {
        color: #0F3D56;
        font-size: 17px; /* Menyamakan ukuran font dengan isi deskripsi */
        font-family: 'Poppins', sans-serif;
        font-weight: 400; /* Mengurangi ketebalan */
    }

    .form-section {
        width: 100%;
        max-width: 800px;
        background: #F8FCFF;
        padding: 30px;
        border-radius: 15px;
        border: 1px solid #0F3D56;
    }

    .form-label {
        font-weight: bold;
        color: #0F3D56;
        display: inline-block;
    }

    .required {
        color: red;
        margin-left: 5px;
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
        width: 100%; /* Membuat tombol lebih panjang */
        max-width: 300px; /* Membatasi panjang maksimum */
    }

    .form-button:hover {
        background: #2492CD;
        transform: scale(1.05);
    }
</style>
@endsection

@section('content')
<div class="donasi-container">
    <!-- Informasi Tambahan -->
    <div class="info-section">
        <img src="{{ asset('images/donate/vector_blue.svg') }}" alt="Icon">
        <div class="info-title">Bantuan Kemanusiaan untuk Palestina</div>
    </div>

    <!-- Form Section -->
    <div class="form-section">
        <h2 class="section-title">Formulir Donasi Barang</h2>
        <p class="section-subtitle">Isi detail barang yang ingin Anda donasikan di bawah ini.</p>
        <form id="donationForm">
            @csrf
            <!-- Deskripsi Barang -->
            <div class="mb-4">
                <label for="deskripsi_barang" class="form-label">Deskripsi Barang<span class="required">*</span></label>
                <textarea id="deskripsi_barang" name="deskripsi_barang" rows="4" class="form-control" placeholder="Masukkan deskripsi barang yang ingin didonasikan..."></textarea>
            </div>

            <!-- Alamat Pengiriman -->
            <div class="mb-4">
                <label for="alamat_pengiriman" class="form-label">Mohon dikirim ke alamat berikut:</label>
                <div id="alamat_pengiriman" class="address-box">
                    DonasiKita, Jln. Galak Banget No. 123, Surabaya, Jawa Timur
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center">
                <button type="button" class="form-button" id="submitDonation">Lanjut</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('submitDonation').addEventListener('click', function () {
        const deskripsiBarang = document.getElementById('deskripsi_barang').value.trim();

        if (deskripsiBarang === "") {
            Swal.fire({
                title: 'Gagal',
                text: 'Harap isi deskripsi barang yang ingin didonasikan!',
                icon: 'error',
                confirmButtonText: 'Coba Lagi',
                confirmButtonColor: '#6CB6DE',
            });
            return;
        }

        // Swal.fire({
        //     title: 'Berhasil',
        //     text: 'Terima kasih atas donasi Anda!',
        //     icon: 'success',
        //     confirmButtonText: 'Selesai',
        //     confirmButtonColor: '#6CB6DE',
        // }).then(() => {
        //     document.getElementById('donationForm').submit();
        // });
    });
</script>
@endsection
