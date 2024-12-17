<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} | Registration</title>
    <!-- ======================== Icon ========================= -->
    <link rel="icon" type="image/x-svg" href="{{ asset('img/icon.svg') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .signup-container {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            display: flex;
        }

        .form-section {
            padding: 40px;
            width: 100%;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-section h1 {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-section p {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .signup-button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border: none;
        }

        .social-auth-links .fab {
            font-size: 1.5rem;
        }

        .signin-text {
            font-size: 0.85rem;
            text-align: center;
            margin-top: 15px;
        }

        .signin-text a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        .image-section {
            background-image: url('https://i.ibb.co.com/B3k4SgN/Whats-App-Image-2024-11-14-at-16-20-01-c739063a.jpg');
            background-size: cover;
            background-position: center;
            flex: 1;
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        @media (max-width: 768px) {
            .signup-container {
                flex-direction: column;
            }

            .image-section {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="signup-container">
        <!-- Form Section -->
        <div class="form-section">

            <h1>Get Started Now!</h1>
            <p>Fill in your details to create an account</p>

            @include('_message')

            <form action="{{ route('register') }}" method="post">

                @csrf

                <!-- Nama dan Email Field Inline -->
                <div class="row g-3 mb-3">
                    <!-- Nama Field -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" id="name" placeholder="Enter your name">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" id="email" placeholder="Enter your email">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            placeholder="Enter your password">
                        <button class="btn btn-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                        
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirm-password"
                            placeholder="Confirm your password">
                        <button class="btn btn-secondary" type="button" id="toggleConfirmPassword">
                            <i class="fas fa-eye" id="toggleConfirmIcon"></i>
                        </button>

                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn signup-button w-100 mb-3">Sign Up</button>
            </form>

            <div class="social-auth-links text-center">
                <p class="pt-2">- OR -</p>
                <a href="{{ route('auth.socialite.redirect') }}" class="btn btn-block btn-danger d-flex align-items-center justify-content-center">
                    <i class="fab fa-google me-2"></i> Sign in using Google
                </a>
            </div>

            <p class="signin-text">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
        </div>

        <!-- Image Section -->
        <div class="image-section"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Password Visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });

        // Toggle Confirm Password Visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPasswordInput = document.getElementById('confirm-password');
            const toggleConfirmIcon = document.getElementById('toggleConfirmIcon');
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                toggleConfirmIcon.classList.remove('fa-eye');
                toggleConfirmIcon.classList.add('fa-eye-slash');
            } else {
                confirmPasswordInput.type = 'password';
                toggleConfirmIcon.classList.remove('fa-eye-slash');
                toggleConfirmIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>
