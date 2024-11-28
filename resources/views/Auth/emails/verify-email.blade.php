<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
</head>

<body
    style="margin: 0; padding: 20px 0; font-family: 'Poppins', sans-serif; background-color: #f5f5f5; display: flex; justify-content: center; align-items: center;">
    <table
        style="width:100%; max-width:600px; margin:auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
        <tr>
            <td style="padding:30px; font-family:'Poppins', sans-serif; color:#606268; font-size:16px; line-height:1.5;">
                <h1 style="color:#182035; font-size:24px; font-weight:600; margin:0 0 10px;">Welcome to {{ config('app.name') }}!
                </h1>
                <p>Hi there,</p>
                <p>Thank you for registering with <strong>{{ config('app.name') }}</strong>. To complete your registration and
                    activate your account, we need you to verify your email address.</p>
                <p>Please click the button below to verify your email:</p>
                <a href="{{ $url }}"
                    style="display:inline-block; background-color:#2492CD; color:#ffffff; text-decoration:none; font-size:16px; font-weight:bold; padding:15px 30px; border-radius:5px; margin-top: 20px;">Verify
                    Your Email</a>
                <p style="margin-top:20px;">If you didn’t create an account, you can ignore this email.</p>
                <p>Thank you,<br>The {{ config('app.name') }} Team</p>
            </td>
        </tr>
    </table>
</body>

</html>
