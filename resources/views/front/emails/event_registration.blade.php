<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Event - {{ config('app.name') }}</title>
</head>

<body
    style="margin: 0; padding: 20px 0; font-family: 'Poppins', sans-serif; background-color: #f5f5f5; display: flex; justify-content: center; align-items: center;">
    <table
        style="width: 100%; max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <tr>
            <td style="padding: 30px; font-family: 'Poppins', sans-serif; color: #606268; font-size: 16px; line-height: 1.5;">
                <h1 style="color: #182035; font-size: 24px; font-weight: 600; margin: 0 0 10px;">
                    Pendaftaran Event Berhasil
                </h1>
                <p>Hi {{ auth()->user()->name }},</p>
                <p>Selamat! Anda telah berhasil mendaftar sebagai <strong>{{ $status }}</strong> pada event berikut:</p>

                <table style="width: 100%; margin: 20px 0; background-color: #f9f9f9; border-radius: 8px; padding: 15px;">
                    <tr>
                        <td style="color: #606268; font-size: 14px; font-weight: 600; padding-bottom: 5px;">Nama Event:</td>
                        <td style="color: #182035; font-size: 14px;">{{ $eventTitle }}</td>
                    </tr>
                    <tr>
                        <td style="color: #606268; font-size: 14px; font-weight: 600; padding-bottom: 5px;">Tanggal Event:</td>
                        <td style="color: #182035; font-size: 14px;">
                            {{ $registration->event->detailEvent->start->format('d M Y') }} - 
                            {{ $registration->event->detailEvent->end->format('d M Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #606268; font-size: 14px; font-weight: 600; padding-bottom: 5px;">Lokasi:</td>
                        <td style="color: #182035; font-size: 14px;">{{ $registration->event->location->name_location }}</td>
                    </tr>
                    <tr>
                        <td style="color: #606268; font-size: 14px; font-weight: 600; padding-bottom: 5px;">Registration ID:</td>
                        <td style="color: #182035; font-size: 14px;">{{ $registrationId }}</td>
                    </tr>
                </table>

                <h3 style="color: #182035; font-size: 18px; font-weight: 600; margin-top: 20px;">Informasi untuk {{ $status }}:</h3>
                <p style="margin-bottom: 20px; color: #606268;">{{ $description }}</p>

                <p style="margin-top: 20px;">Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi tim kami.</p>
                <p style="color: #606268;">Salam hangat,<br>Tim {{ config('app.name') }}</p>
            </td>
        </tr>
    </table>
</body>

</html>
