<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    // Tampilkan halaman notifikasi untuk memverifikasi email
    public function notice()
    {
        // Pastikan data email berasal dari user yang sedang login
        $email = auth()->user()->email;
        return view('auth.verify-email', ['email' => $email]);
    }

    // Tangani verifikasi email menggunakan ID dan hash
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/login')->with('success', 'Email successfully verified!');
    }

    // Kirim ulang email verifikasi
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/admin/dashboard')->with('info', 'Your email is already verified.');
        }

        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification email sent!');
    }
}
