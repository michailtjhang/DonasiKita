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
            if (Auth::user()->role_id == '01j8kkd0j357ddxkdq75etr7q2') {
                return redirect()->intended('admin/dashboard');
            } else {
                return redirect()->intended('/');
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
                // Jika password benar
                if (Auth::user()->role_id == '01j8kkd0j357ddxkdq75etr7q2') {
                    return redirect()->intended('admin/dashboard');
                } else {
                    return redirect()->intended('/');
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
        return view('Auth.register');
    }

    public function auth_register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
        ]);

        // Cari user terakhir
        $user = User::latest()->first();
        $kodeUser = "US";

        // Jika user terakhir belum ada
        if ($user == null) {
            $id_user = $kodeUser . "001";
        } else {
            // Jika user terakhir sudah ada
            $id_user = $user->id_user;
            $urutan = (int) substr($id_user, 3, 3);
            $urutan++;
            $id_user = $kodeUser . sprintf("%03s", $urutan);
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
        return redirect('/');
    }
}
