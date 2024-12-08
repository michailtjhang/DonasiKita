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
        padding: 20px;
        border-radius: 15px;
        border: 1px solid #0F3D56;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 50px;
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

    /* update : ux writing */
    .text-info {
        font-size: 10px;
        font-weight: 600;
        color: #0f3d56 !important;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')

<div class="confirmation-container my-5 pt-5">
    <!-- Informasi -->
    <div class="info-section">
        <img src="{{ asset('images/donate/vector_blue.svg') }}" alt="Icon" style="width: 24px; height: 24px;">
        <div>Bukti Donasi Barang Anda</div>
    </div>

    <!-- Form Konfirmasi -->
    <div class="form-section">
        <!-- UPDATE : DELETE SELECTION TITLE -->
        <!-- <h2 class="section-title">Konfirmasi Pengiriman Barang</h2> -->
        <form id="confirmationForm" action="{{ route('confirmation.barang.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Nomor Resi -->
            <div class="mb-4">
                <label for="nomor_resi" class="form-label">Masukan Nomor Resi</label>
                <input type="text" id="nomor_resi" name="nomor_resi" class="form-control" placeholder="Masukkan Nomor Resi">
                <!-- update : ux writing -->
                <div class="text-info">*Masukkan nomor resi yang valid agar kami dapat melakukan pengecekan dengan mudah.*</div> 
            </div>

            <!-- Bukti Foto -->
            <div class="mb-4">
                <label for="bukti_foto" class="form-label">Unggah Foto Resi</label>
                <input type="file" id="bukti_foto" name="bukti_foto" class="form-control">
                <!-- update : ux writing -->
                <div class="text-info">*Unggah gambar bukti pembayaran yang jelas dan valid untuk mempermudah proses verifikasi.*</div>
                <div class="text-info">*Pastikan gambar tidak buram agar kami dapat memproses pembayaran Anda dengan cepat.*</div> 
                <div class="text-info">*Unggah bukti pembayaran sesuai format yang diminta untuk menghindari penolakan.*</div>
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
    document.getElementById('submitConfirmation').addEventListener('click', function () {
        Swal.fire({
            title: 'Berhasil Dikonfirmasi',
            text: 'Kami akan memberikan notifikasi di email Anda jika barang sudah sampai.',
            icon: 'success',
            confirmButtonText: 'Selesai',
            confirmButtonColor: '#6CB6DE',
        }).then(() => {
            document.getElementById('confirmationForm').submit();
        });
    });
</script>
@endsection
