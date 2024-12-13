<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} | Log in</title>
    <!-- ======================== Icon ========================= -->
    <link rel="icon" type="image/x-svg" href="{{ asset('img/icon.svg') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">

    <style>
        body {
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
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
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-section p {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .form-section form .form-label {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-section form .form-check-label {
            font-size: 0.85rem;
        }

        .login-button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border: none;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ddd;
        }

        .divider:not(:empty)::before {
            margin-right: .25em;
        }

        .divider:not(:empty)::after {
            margin-left: .25em;
        }

        .btn-block {
            width: 100%;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            font-size: 1rem;
            padding: 10px;
            font-weight: bold;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
            color: #fff;
        }

        .social-auth-links .fab {
            font-size: 1.5rem;
        }

        .signup-text {
            font-size: 0.9rem;
            text-align: center;
            margin-top: 20px;
        }

        .signup-text a {
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
            .login-container {
                flex-direction: column;
            }

            .image-section {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">

        <!-- Form Section -->
        <div class="form-section">

            <h1>Welcome back!</h1>

            <p>Enter your Credentials to access your account</p>

            @include('_message')

            <form action="" method="post">

                @csrf

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" id="email" placeholder="Enter your email">

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
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

                <!-- Remember Checkbox Field && Forgot Password -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember Me!!</label>
                    </div>
                    <a href="#" class="text-decoration-none text-primary">Forgot password?</a>
                </div>

                <button type="submit" class="btn login-button w-100 mb-3 border">Login</button>

            </form>

            <div class="social-auth-links text-center">
                <p class="pt-2">- OR -</p>
                <a href="#" class="btn btn-block btn-danger d-flex align-items-center justify-content-center">
                    <i class="fab fa-google me-2"></i> Sign in using Google
                </a>
            </div>

            <p class="signup-text">Don’t have an account? <a href="{{ route('register') }}">Sign Up</a></p>
        </div>

        <!-- Image Section -->
        <div class="image-section"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            // Toggle the type attribute
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
    </script>

</body>

</html>
