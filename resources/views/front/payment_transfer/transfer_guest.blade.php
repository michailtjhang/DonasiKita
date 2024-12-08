@extends('front.layout.app')

@section('style')
<style>
    /* General Styling */
    body {
        font-family: 'Poppins', sans-serif;
    }

    .container-form {
        margin-top: 50px;
        margin-bottom: 50px;
    }

    .form-section {
        padding: 20px;
        background: #f8fcff;
        border-radius: 10px;
        border: 1px solid #0f3d56;
        margin-bottom: 20px;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }

    .form-section h4 {
        font-size: 16px;
        color: #0f3d56;
        font-weight: bold;
        margin-bottom: 15px;
    }

    /* update : ux writing */
    .text-info {
        font-size: 10px;
        font-weight: 600;
        color: #0f3d56 !important;
    }

    /* Info Section */
    .info-section {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        padding: 15px;
        background: #f8fcff;
        border: 1px solid #0f3d56;
        border-radius: 10px;
        margin-top: 100px;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }

    .info-section img {
        width: 25px;
        height: 25px;
    }

    .info-title {
        font-size: 18px;
        font-weight: light;
        color: #0f3d56;
    }

    .title-info-section {
        font-size: 18px;
        font-weight: 600;
        color: #0f3d56;
    }

    /* Identitas Diri Section */
    .form-group {
    margin-top: 10px;
    }

    .form-group label {
        font-size: 14px;
        font-weight: 600;
        color: #0f3d56;
        display: block;
        margin-bottom: 5px;
    }

    .required {
        color: red;
        font-weight: bold;
    }

    .input-field {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #0f3d56;
        background: #f8fcff;
        font-size: 14px;
        color: #0f3d56;
        margin-bottom: 15px;
    }

    .input-field:focus {
        outline: none;
        border-color: #007bff; /* Warna biru saat fokus */
    }

    /* Nominal Donasi Section */
    .nominal-buttons {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .nominal-buttons button {
        background: #f8fcff;
        border: 2px solid #2492cd;
        border-radius: 8px;
        color: #2492cd;
        font-size: 14px;
        padding: 8px 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .nominal-buttons button.active {
        background: #2492cd;
        color: #fff;
    }

    .input-field {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #0f3d56;
        background: #f8fcff;
        font-size: 14px;
        color: #0f3d56;
        margin-bottom: 15px;
    }

    /* Dropdown Bank Section */
    .dropdown-container {
        position: relative;
        margin-bottom: 20px;
    }

    .dropdown-selected {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f8fcff;
        border: 1px solid #0f3d56;
        border-radius: 8px;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 16px;
        color: #0f3d56;
        font-weight: 600;
    }

    .dropdown-selected img {
        width: 40px;
        height: auto;
        margin-right: 10px;
    }

    .dropdown-options {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #f8fcff;
        border: 1px solid #0f3d56;
        border-radius: 8px;
        overflow: hidden;
        z-index: 10;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.3s ease;
    }

    .dropdown-options.show {
        display: block;
    }

    .dropdown-option {
        display: flex;
        align-items: center;
        padding: 10px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .dropdown-option img {
        width: 40px;
        height: auto;
        margin-right: 10px;
    }

    .dropdown-option:hover {
        background: #6cb6de;
        color: #fff;
    }

    /* Total Section */
    .total-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        background: #f8fcff;
        border: 1px solid #0f3d56;
        border-radius: 8px;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 20px;
    }

    .total-section span {
        font-size: 16px;
        font-weight: bold;
        color: #0f3d56;
    }

    /* Pay Button */
    .pay-button {
        width: 80%;
        background: #6cb6de;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        padding: 12px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        margin-left: auto;
        margin-right: auto;
        display: block;
        transition: background-color 0.3s ease;
    }

    .pay-button:hover {
        background: #2492cd;
    }

    .radio-button {
        margin-left: auto;
    }

    .radio-button input {
        cursor: pointer;
        margin-left: 10px;
    }

    @media (max-width: 768px) {
        .form-section, .info-section, .total-section {
            width: 95%;
        }

        .nominal-buttons {
            flex-direction: column;
        }

        .bank-icon {
            width: 50px;
        }
    }
</style>
@endsection

@section('content')

<!-- <div class="space-section"></div> -->

<div class="container-form py-1">
    <!-- Info Section -->
    <div class="info-section">
        <img src="/images/donate/vector_blue.svg" alt="Icon">
        <div class="title-info-section">Bantuan Kemanusiaan untuk Palestina</div>
    </div>

    <!-- Nominal Donasi Section -->
    <div class="form-section">
        <div class="info-title">Nominal Donasi</div>
        <div class="nominal-buttons py-2">  <!-- update jarak -->
            <button class="nominal" data-value="10000">Rp 10.000</button>
            <button class="nominal" data-value="30000">Rp 30.000</button>
            <button class="nominal" data-value="50000">Rp 50.000</button>
            <button class="nominal" data-value="100000">Rp 100.000</button>
        </div>
        <input type="text" id="custom-nominal" class="input-field" placeholder="Input donasi minimal Rp 1.000">
        <!-- update : ux writing -->
        <div class="text-info">*Masukkan nominal donasi Anda (minimal Rp1000) untuk melanjutkan.*</div> 
    </div>

    <!-- UPDATE : UNTUK SECTION DATA DIRI KHUSUS UNTUK GUEST (NON LOGIN) -->
    <!-- Data Diri Section -->
    <div class="form-section">
        <div class="info-title">Identitas Kamu</div>
            <!-- Nama Lengkap -->
            <div class="form-group">
                <label for="name">Nama Lengkap <span class="required">*</span></label>
                <input type="text" id="name" class="input-field" placeholder="Nama Anda">
            </div>
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" id="email" class="input-field" placeholder="Contoh: email@domain.com">
            </div>
            <!-- No Telepon -->
            <div class="form-group">
                <label for="phone">No Telepon <span class="required">*</span></label>
                <input type="text" id="phone" class="input-field" placeholder="Contoh: 081234567890">
            </div>
    </div>


    <!-- Pilih Bank Section -->
    <div class="form-section">
        <div class="info-title">Pembayaran</div>  <!-- update : styling -->
        <div class="dropdown-container py-2">
            <div class="dropdown-selected" onclick="toggleDropdown()">
                <span id="selected-bank-name">Pilih Bank</span>
                <i class="fa fa-chevron-down"></i>
            </div>
            <div class="dropdown-options" id="dropdown-options">
                <div class="dropdown-option" onclick="selectBank('mandiri', 'Bank Mandiri', '/images/payment/mandiri.svg')">
                    <img src="/images/payment/mandiri.svg" alt="Bank Mandiri">
                    <span>Bank Mandiri - 1234567890987</span>
                    <label class="radio-button"><input type="radio" name="bank" value="mandiri"> </label>
                </div>
                <div class="dropdown-option" onclick="selectBank('bca', 'Bank Central Asia (BCA)', '/images/payment/bca.svg')">
                    <img src="/images/payment/bca.svg" alt="Bank Central Asia (BCA)">
                    <span>Bank Central Asia (BCA) - 1234567890987 </span>
                    <label class="radio-button"><input type="radio" name="bank" value="bca"> </label>
                </div>
                <div class="dropdown-option" onclick="selectBank('bni', 'Bank Negara Indonesia (BNI)', '/images/payment/bni.svg')">
                    <img src="/images/payment/bni.svg" alt="Bank Negara Indonesia (BNI)">
                    <span>Bank Negara Indonesia (BNI) - 1234567890987</span>
                    <label class="radio-button"><input type="radio" name="bank" value="bni"> </label>
                </div>
                <div class="dropdown-option" onclick="selectBank('bri', 'Bank Rakyat Indonesia (BRI)', '/images/payment/bri.svg')">
                    <img src="/images/payment/bri.svg" alt="Bank Rakyat Indonesia (BRI)">
                    <span>Bank Rakyat Indonesia (BRI) - 1234567890987</span>
                    <label class="radio-button"><input type="radio" name="bank" value="bri"> </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Section -->
    <div class="total-section">
        <span>Total Donasi</span>
        <span id="total-amount">Rp 0</span>
    </div>

    <!-- Payment Button -->
    <button class="pay-button my-5">Bayar Sekarang</button>
</div>

<script>
    let selectedNominal = 0;

    document.querySelectorAll('.nominal').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.nominal').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            selectedNominal = parseInt(this.getAttribute('data-value'));
            document.getElementById('custom-nominal').value = ''; // Clear the custom input
            updateTotal();
        });
    });

    document.getElementById('custom-nominal').addEventListener('input', function() {
        selectedNominal = parseInt(this.value) || 0;
        document.querySelectorAll('.nominal').forEach(b => b.classList.remove('active'));
        updateTotal();
    });

    function updateTotal() {
        document.getElementById('total-amount').textContent = `Rp ${selectedNominal.toLocaleString()}`;
    }

    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown-options');
        dropdown.classList.toggle('show');
    }

    function selectBank(bankId, bankName, bankLogo) {
        document.getElementById('selected-bank-name').textContent = bankName;
        const dropdown = document.getElementById('dropdown-options');
        dropdown.classList.remove('show');
    }
</script>
@endsection
