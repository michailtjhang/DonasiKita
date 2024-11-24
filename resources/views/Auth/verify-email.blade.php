<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} | Verify Your Email</title>

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

        .verify-container {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            display: flex;
            align-items: stretch;
            height: 95%; /* Adjust to fit the screen */
        }

        .verify-section {
            padding: 40px;
            width: 100%;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: justify;
        }

        .verify-section h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .verify-section p {
            font-size: 1rem;
            color: #606268;
            margin-bottom: 20px;
        }

        .verify-button {
            background-color: #2492CD;
            color: white;
            font-weight: bold;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            margin: 0 auto; /* Center the button */
            display: block; /* Make sure the button behaves as a block element */
        }

        .verify-button:hover {
            background-color: #1c7eb2;
        }

        .image-section {
            background-image: url('{{ asset('images/register.svg') }}');
            background-size: cover;
            background-position: center;
            flex: 1;
        }

        @media (max-width: 768px) {
            .verify-container {
                flex-direction: column;
                height: auto; /* Adjust height for mobile */
            }

            .image-section {
                display: none;
            }

            .verify-section {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="verify-container">
        <!-- Verify Section -->
        <div class="verify-section">
            <h1>Verify Your Email</h1>
            <p>You’ve entered <strong>example@mail.com</strong> as the email address for your account.</p>
            <p>Please verify this email address by clicking the button below:</p>
            <form action="{{ route('verification.resend') }}" method="POST">
                @csrf
                <button type="submit" class="verify-button">Verify Your Email</button>
            </form>
        </div>

        <!-- Image Section -->
        <div class="image-section"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>