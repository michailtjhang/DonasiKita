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

        .form-label {
            font-weight: bold;
            font-size: 16px;
            color: #0F3D56;
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
            width: 100%;
        }

        .form-button:hover {
            background: #2492CD;
            transform: scale(1.05);
        }
    </style>
@endsection

@section('content')
    <div class="confirmation-container">
        <!-- Informasi -->
        <div class="info-section">
            <img src="{{ asset('images/donate/vector_blue.svg') }}" alt="Icon" style="width: 24px; height: 24px;">
            <div>Konfirmasi Donasi Barang Anda</div>
        </div>

        <!-- Form Konfirmasi -->
        <div class="form-section">
            <h2 class="section-title">Konfirmasi Donasi Barang</h2>

            @Auth
                <form action="{{ route('donations.confirm', $donation->slug) }}" method="POST" id="confirmationForm">
                    @csrf

                    <!-- Deskripsi Barang url -->
                    <input type="hidden" name="item" value="true">
                    <!-- Deskripsi Barang -->
                    <div class="mb-4">
                        <label for="deskripsi_barang" class="form-label">Deskripsi Barang<span class="required">*</span></label>
                        <textarea id="deskripsi_barang" name="deskripsi_barang" rows="4" class="form-control"
                            placeholder="Masukkan deskripsi barang yang ingin didonasikan..."></textarea>
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
            @else
                <form action="{{ route('donations.confirm', $donation->slug) }}" method="POST" id="confirmationForm">
                    @csrf

                    <!-- Deskripsi Barang url -->
                    <input type="hidden" name="item" value="true">

                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="nama" class="form-label">
                            Nama Lengkap<span class="required">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label">
                            Email<span class="required">*</span>
                        </label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="Email (example@mail.com)">
                    </div>

                    <!-- Nomor Handphone -->
                    <div class="mb-4">
                        <label for="nomor_hp" class="form-label">
                            Nomor Handphone<span class="required">*</span>
                        </label>
                        <input type="text" id="nomor_hp" name="nomor_hp" class="form-control" placeholder="Nomor Handphone">
                    </div>

                    <!-- Deskripsi Barang -->
                    <div class="mb-4">
                        <label for="deskripsi_barang" class="form-label">
                            Deskripsi Barang<span class="required">*</span>
                        </label>
                        <textarea id="deskripsi_barang" name="deskripsi_barang" rows="4" class="form-control"
                            placeholder="Masukkan deskripsi barang yang ingin didonasikan..."></textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="text-center">
                        <button type="submit" class="form-button" id="submitConfirmation">Kirim Konfirmasi</button>
                    </div>
                </form>
            @endAuth
        </div>
    </div>
@endsection
