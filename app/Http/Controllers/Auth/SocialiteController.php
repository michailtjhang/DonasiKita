<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        // Check if the user already exists
        $registeredUser = User::where('provider_id', $socialUser->id)
            ->where('provider_name', $provider)
            ->first();

        if ($registeredUser) {
            // Login the registered user
            Auth::login($registeredUser);
            return redirect()->intended('tickets');
        } else {
            // Generate id_number for new user
            $latestUser = User::latest()->first();
            $kodeUser = "US";

            if ($latestUser == null) {
                $id_number = $kodeUser . "001";
            } else {
                $id_number = $latestUser->id_number;
                $urutan = (int) substr($id_number, 2, 3);
                $urutan++;
                $id_number = $kodeUser . sprintf("%03s", $urutan);
            }

            // Create or update the user with Socialite data and generated id_number
            $user = User::updateOrCreate([
                'provider_id' => $socialUser->id,
                'provider_name' => $provider,
            ], [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => hash('sha256', $socialUser->email),
                'access_token' => $socialUser->token,
                'refresh_token' => $socialUser->refreshToken,
                'id_number' => $id_number, // Set id_number for the user
            ]);
        }

        // Log in the newly created user
        Auth::login($user);

        return redirect()->intended('tickets');
    }
}
