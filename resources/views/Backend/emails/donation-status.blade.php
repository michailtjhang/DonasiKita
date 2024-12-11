<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Donasi - {{ config('app.name') }}</title>
</head>

<body
    style="margin: 0; padding: 20px 0; font-family: 'Poppins', sans-serif; background-color: #f5f5f5; display: flex; justify-content: center; align-items: center;">
    <table
        style="width:100%; max-width:600px; margin:auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
        <tr>
            <td style="padding:30px; font-family:'Poppins', sans-serif; color:#606268; font-size:16px; line-height:1.5;">
                <h1 style="color:#182035; font-size:24px; font-weight:600; margin:0 0 10px;">
                    Terima Kasih dari {{ config('app.name') }}
                </h1>
                <p>Hi {{ $donorName }},</p>
                @if ($status === 'approved')
                    <p>Terima kasih atas donasi Anda yang sangat berarti. Kami senang mengabarkan bahwa donasi Anda
                        telah diterima dengan baik dan akan digunakan untuk tujuan yang mulia.</p>
                    <p>Semoga Allah membalas kebaikan hati Anda. Kami sangat menghargai dukungan Anda untuk
                        {{ config('app.name') }}.</p>
                @else
                    <p>Terima kasih atas niat baik Anda untuk mendukung kami. Namun, kami mohon maaf bahwa donasi Anda
                        belum dapat kami terima saat ini. Setelah kami melakukan verifikasi, kami mendapati bahwa bukti
                        transfer yang Anda kirimkan belum dapat kami proses karena beberapa ketidakjelasan.</p>
                    <p>Untuk memastikan kelancaran proses donasi Anda di masa mendatang, kami mohon untuk dapat
                        memeriksa kembali bukti transfer atau melakukan klarifikasi lebih lanjut. Kami sangat menghargai
                        perhatian Anda dan berharap Anda tetap mendukung kami di kesempatan berikutnya.</p>
                @endif

                <p style="margin-top:20px;">Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi
                    kami.</p>
                <p>Salam hangat,<br>Tim {{ config('app.name') }}</p>
            </td>
        </tr>
    </table>
</body>

</html>
