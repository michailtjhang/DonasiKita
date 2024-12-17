<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function login()
    {
        // Check if user is already logged in
        if (!empty(Auth::check())) {
            if (Auth::user()->role_id == '01j8kkdk3abh0a671dr5rqkshy') {
                return redirect()->intended('/');
            } else {
                return redirect()->intended('admin/dashboard');
            }
        }

        // Check if user is already logged in
        return view('Auth.login');
    }

    public function auth_login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mengatur remember
        $remember = $request->has('remember') ? true : false;

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user ditemukan
        if ($user) {
            // Cek password
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                // Jika user belum memverifikasi email
                if (Auth::user()->email_verified_at === null) {
                    // Redirect ke halaman verifikasi email
                    return redirect()->route('verification.notice');
                }

                // Jika email sudah terverifikasi
                if (Auth::user()->role_id == '01j8kkdk3abh0a671dr5rqkshy') {
                    return redirect()->intended('/');
                } else {
                    return redirect()->intended('admin/dashboard');
                }
            } else {
                // Jika password salah
                return redirect()->back()->with('error', 'Incorrect password. Please try again.');
            }
        } else {
            // Jika user tidak ditemukan
            return redirect()->back()->with('error', 'Email not found. Please register first.');
        }
    }

    public function register()
    {

        // Check if user is already logged in
        if (!empty(Auth::check())) {
            // Jika user sudah login
            if (Auth::user()->role_id == '01j8kkdk3abh0a671dr5rqkshy') {
                return redirect()->intended('login');
            } else {
                // Jika role admin
                return redirect()->intended('admin/dashboard');
            }
        }

        return view('Auth.register');
    }

    public function auth_register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
            'password_confirmation.required' => 'Password confirmation is required',
        ]);

        // Cari user terakhir berdasarkan ID terbaru
        $user = User::latest('id')->first();
        $kodeUser = "US";

        // Jika user terakhir belum ada
        if (!$user || !$user->id_user) {
            $id_user = $kodeUser . "001";
        } else {
            // Ambil id_user terakhir
            $id_user_terakhir = $user->id_user;

            // Pastikan id_user mengikuti format "USXXX"
            if (preg_match('/^US(\d{3})$/', $id_user_terakhir, $matches)) {
                // Ambil angka terakhir, tambahkan 1
                $urutan = (int) $matches[1] + 1;
            } else {
                // Jika format tidak sesuai, reset ke 001
                $urutan = 1;
            }

            // Format ulang ID user dengan padding nol di depan
            $id_user = $kodeUser . sprintf("%03d", $urutan);
        }

        // Membuat user
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['id_user'] = $id_user;
        $user = User::create($data);

        // Kirim verifikasi email
        event(new Registered($user));
        $user->sendEmailVerificationNotification();

        // Login user
        Auth::login($user);

        // Redirect ke halaman dashboard
        return redirect('/login')->with('success', 'Registration successful! Please verify your email.');
    }

    public function logout()
    {
        // Logout user
        Auth::logout();
        return back();
    }
}
