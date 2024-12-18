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
            font-weight: 600;
            color: #0f3d56;
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

            .form-section,
            .info-section,
            .total-section {
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
    <div class="container-form py-1">
        <!-- Info Section -->
        <div class="info-section">
            <img src="/images/donate/vector_blue.svg" alt="Icon">
            <div class="info-title">Donasi Uang</div>
        </div>

        <form action="{{ route('donations.store.amount', $donation->slug) }}" method="POST" id="confirmationForm">
            @csrf
            <!-- Nominal Donasi Section -->
            <div class="form-section">
                <h4>Nominal Donasi</h4>
                <div class="nominal-buttons">
                    <button class="nominal" type="button" data-value="10000">Rp 10.000</button>
                    <button class="nominal" type="button" data-value="30000">Rp 30.000</button>
                    <button class="nominal" type="button" data-value="50000">Rp 50.000</button>
                    <button class="nominal" type="button" data-value="100000">Rp 100.000</button>
                </div>
                <input type="text" id="custom-nominal" name="amount" class="input-field"
                    placeholder="Input donasi minimal Rp 10.000" value="{{ old('amount') }}">
                <!-- update : ux writing -->
                <div class="text-info">*Masukkan nominal donasi Anda (minimal Rp. 10.000) untuk melanjutkan.*</div>

                @error('amount')
                    <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            @guest
                <!-- Data Diri Section -->
                <div class="form-section">
                    <h4>Identitas Kamu</h4>
                    <input type="text" class="input-field" name="name" placeholder="Nama Lengkap"
                        value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                    @enderror
                    <input type="email" class="input-field" name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                    @enderror
                </div>
            @endguest

            <!-- Pilih Bank Section -->
            <div class="form-section">
                <h4>Pilih Bank</h4>
                <div class="dropdown-container">
                    <div class="dropdown-selected" onclick="toggleDropdown()">
                        <span id="selected-bank-name">Pilih Bank</span>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <div class="dropdown-options" id="dropdown-options">
                        <div class="dropdown-option"
                            onclick="selectBank('mandiri', 'Bank Mandiri', '/images/payment/mandiri.svg')">
                            <img src="/images/payment/mandiri.svg" alt="Bank Mandiri">
                            <span>Bank Mandiri - 1234567890987</span>
                            <label class="radio-button"><input type="radio" name="bank" value="mandiri"
                                    {{ old('bank') == 'mandiri' ? 'checked' : '' }}> </label>
                        </div>
                        <div class="dropdown-option"
                            onclick="selectBank('bca', 'Bank Central Asia (BCA)', '/images/payment/bca.svg')">
                            <img src="/images/payment/bca.svg" alt="Bank Central Asia (BCA)">
                            <span>Bank Central Asia (BCA) - 1234567890987</span>
                            <label class="radio-button"><input type="radio" name="bank" value="bca"
                                    {{ old('bank') == 'bca' ? 'checked' : '' }}> </label>
                        </div>
                        <div class="dropdown-option"
                            onclick="selectBank('bni', 'Bank Negara Indonesia (BNI)', '/images/payment/bni.svg')">
                            <img src="/images/payment/bni.svg" alt="Bank Negara Indonesia (BNI)">
                            <span>Bank Negara Indonesia (BNI) - 1234567890987</span>
                            <label class="radio-button"><input type="radio" name="bank" value="bni"
                                    {{ old('bank') == 'bni' ? 'checked' : '' }}> </label>
                        </div>
                        <div class="dropdown-option"
                            onclick="selectBank('bri', 'Bank Rakyat Indonesia (BRI)', '/images/payment/bri.svg')">
                            <img src="/images/payment/bri.svg" alt="Bank Rakyat Indonesia (BRI)">
                            <span>Bank Rakyat Indonesia (BRI) - 1234567890987</span>
                            <label class="radio-button"><input type="radio" name="bank" value="bri"
                                    {{ old('bank') == 'bri' ? 'checked' : '' }}> </label>
                        </div>
                    </div>
                </div>
                @error('bank')
                    <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Total Section -->
            <div class="total-section">
                <span>Total Donasi</span>
                <span id="total-amount">Rp 0</span>
            </div>

            <!-- Payment Button -->
            <button class="pay-button my-5" type="submit">Bayar Sekarang</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        let selectedNominal = 0;
        let transferFee = 0;
        const bankFees = {
            mandiri: 0,
            bca: 0,
            bni: 0,
            bri: 0
        };

        // Event listener untuk tombol nominal
        document.querySelectorAll('.nominal').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah refresh halaman
                document.querySelectorAll('.nominal').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                selectedNominal = parseInt(this.getAttribute('data-value'));
                document.getElementById('custom-nominal').value = selectedNominal; // Isi input field
                updateTotal();
            });
        });

        // Event listener untuk input manual nominal
        document.getElementById('custom-nominal').addEventListener('input', function() {
            const value = parseInt(this.value) || 0;
            if (value >= 10000) { // Validasi minimal Rp 10.000
                selectedNominal = value;
                document.querySelectorAll('.nominal').forEach(b => b.classList.remove('active'));
                updateTotal();
            } else {
                selectedNominal = 0;
                updateTotal();
            }
        });

        // Fungsi untuk memilih bank
        function selectBank(bankId, bankName, bankLogo) {
            // Perbarui label dropdown
            document.getElementById('selected-bank-name').textContent = bankName;

            // Update biaya transfer berdasarkan bank
            transferFee = bankFees[bankId] || 0;

            // Pilih radio button yang sesuai
            const radioButton = document.querySelector(`input[name="bank"][value="${bankId}"]`);
            if (radioButton) {
                radioButton.checked = true;
            }

            // Perbarui total donasi
            updateTotal();

            // Tutup dropdown
            const dropdown = document.getElementById('dropdown-options');
            dropdown.classList.remove('show');
        }

        // Fungsi untuk memperbarui total donasi
        function updateTotal() {
            const totalAmount = selectedNominal + transferFee;
            const totalAmountElement = document.getElementById('total-amount');
            totalAmountElement.innerHTML = `
            <span>Total Donasi:</span>
            <span>Rp ${totalAmount.toLocaleString()}</span>
            <div style="font-size: 10px; color: #6c757d;">(Tidak termasuk biaya Admin & Transfer)</div>
        `;
        }

        // Fungsi untuk menampilkan/menyembunyikan dropdown
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-options');
            dropdown.classList.toggle('show');
        }
    </script>

    <script>
        // SweetAlert konfirmasi sebelum kirim
        document.getElementById('confirmationForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah submit form langsung
            
            const selectedBank = document.querySelector('input[name="bank"]:checked');
            const totalAmount = selectedNominal + transferFee;

            if (!selectedBank || totalAmount <= 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Silakan pilih bank dan masukkan nominal donasi minimal Rp 10.000.',
                });
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Donasi',
                text: `Apakah Anda yakin ingin mengirim donasi sebesar Rp ${totalAmount.toLocaleString()} ke ${selectedBank.value.toUpperCase()}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Lanjutkan kirim form
                }
            });
        });
    </script>
@endsection
