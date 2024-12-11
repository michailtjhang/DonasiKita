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
    <div class="confirmation-container">
        <!-- Informasi -->
        <div class="info-section">
            <img src="{{ asset('images/donate/vector_blue.svg') }}" alt="Icon" style="width: 24px; height: 24px;">
            <div>Konfirmasi Donasi Barang Anda</div>
        </div>

        <!-- Form Konfirmasi -->
        <div class="form-section">
            <h2 class="section-title">Konfirmasi Donasi Barang</h2>

            <form action="{{ route('donations.store.item', $donation->slug) }}" method="POST" id="confirmationForm">
                @csrf

                <!-- Deskripsi Barang url -->
                <input type="hidden" name="item" value="true">

                @guest
                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="nama" class="form-label">
                            Nama Lengkap<span class="required">*</span>
                        </label>
                        <input type="text" id="nama" name="name"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label">
                            Email<span class="required">*</span>
                        </label>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Email (example@mail.com)">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endguest

                <!-- Deskripsi Barang -->
                <div class="mb-4">
                    <label for="deskripsi_barang" class="form-label">
                        Deskripsi Barang<span class="required">*</span>
                    </label>
                    <textarea id="deskripsi_barang" name="deskripsi_barang" rows="4"
                        class="form-control @error('deskripsi_barang') is-invalid @enderror"
                        placeholder="Masukkan deskripsi barang yang ingin didonasikan..."></textarea>
                    <!-- update : ux writing -->
                    <div class="text-info">*Pastikan deskripsi barang sesuai untuk mempermudah pengelolaan kami.*</div>

                    @error('deskripsi_barang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Alamat Pengiriman -->
                <div class="mb-4">
                    <label for="alamat_pengiriman" class="form-label">Mohon dikirim ke alamat berikut:</label>
                    <div id="alamat_pengiriman" class="address-box">
                        DonasiKita, Jln. Galak Banget No. 123, Surabaya, Jawa Timur
                    </div>
                    <!-- update : ux writing -->
                    <div class="text-info">*Kirim barang ke alamat yang tertera. Kami tidak bertanggung jawab jika
                        pengiriman dilakukan ke alamat yang salah.*</div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-center">
                    <button type="submit" class="form-button" id="submitConfirmation">Kirim Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
@endsection
