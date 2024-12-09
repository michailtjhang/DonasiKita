<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\EventRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Buglinjo\LaravelWebp\Facades\Webp;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!empty(Auth::check())) {
            // Ambil data pengguna
            $profile = User::findOrFail(Auth::user()->id);
            // dd(EventRegistration::where('user_id', Auth::id())->with(['event', 'event.thumbnail', 'event.detailEvent'])->get());

            // Ambil daftar event yang diikuti oleh user (event yang belum selesai)
            $futureEvents = EventRegistration::where('user_id', Auth::id())
                ->whereHas('event.detailEvent', function ($query) {
                    $query->where('end', '>=', now()); // Ambil event yang belum selesai
                })
                ->with(['event', 'event.thumbnail', 'event.category'])
                ->get();

            // Ambil daftar event yang diikuti oleh user (event yang sudah selesai)
            $pastEvents = EventRegistration::where('user_id', Auth::id())
                ->whereHas('event.detailEvent', function ($query) {
                    $query->where('end', '<', now()); // Ambil event yang sudah selesai
                })
                ->with(['event', 'event.thumbnail', 'event.category'])
                ->get();

            return view('front.profile.profile', [
                'profile' => $profile,
                'futureEvents' => $futureEvents,
                'pastEvents' => $pastEvents,
                'page_title' => 'Profile',
            ]);
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'nullable | min:6',
                'email' => [
                    'nullable',
                    'email',
                    Rule::unique('users')->ignore(Auth::user()->id), // Abaikan email milik user yang sedang login
                ],
                'password' => 'nullable | required_with:old_password | string  | min:8',
                'profile_image' => 'nullable | image | mimes:jpg,jpeg,gif,png,svg | max:2048',
            ],
            [
                'profile_image.max' => 'Maksimal 2 MB',
                'profile_image.image' => 'File ekstensi harus jpg, jpeg, gif, png, svg',
            ]
        );

        $users = User::find($id);

        try {
            if ($request->hasFile('profile_image')) {

                $file = $request->file('profile_image');

                // Nama file WebP
                $webpFileName = time() . '.webp';

                // Path folder tujuan
                $tempFolder = public_path('temp');

                // Pastikan folder `temp` ada, jika tidak, buat folder
                if (!file_exists($tempFolder)) {
                    mkdir($tempFolder, 0755, true); // Membuat folder dengan izin baca/tulis
                }

                // Path tujuan penyimpanan sementara file WebP
                $webpPath = $tempFolder . '/' . $webpFileName;

                // Konversi gambar ke WebP
                WebP::make($file)
                    ->quality(65) // Atur kualitas gambar (opsional, default: 70)
                    ->save($webpPath);

                // Upload image baru ke Cloudinary
                $cloudinaryResponse = cloudinary()->upload($webpPath, [
                    'folder' => 'profile',
                    'use_filename' => true,
                    'unique_filename' => true,
                ]);

                $cloudinaryUrl = $cloudinaryResponse->getSecurePath();
                $publicId = $cloudinaryResponse->getPublicId();

                // Langsung hapus file sementara setelah upload
                if (file_exists($webpPath)) {
                    unlink($webpPath); // Hapus file
                }

                // Hapus file lama dari Cloudinary jika ada
                if (!empty($users->media->cloudinary_public_id)) {
                    cloudinary()->destroy($users->media->cloudinary_public_id);
                }

                // Simpan informasi gambar baru ke database
                $users->media()->updateOrCreate(
                    ['user_id' => $users->id],
                    [
                        'cloudinary_public_id' => $publicId,
                        'cloudinary_url' => $cloudinaryUrl,
                        'type' => 'image',
                    ]
                );

                return response()->json(['message' => 'Profile image updated successfully.']);
            } else {
                $users->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                return back()->with('success', 'Profile Update!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->media && $user->media->cloudinary_public_id) {
            // Hapus file dari Cloudinary
            cloudinary()->destroy($user->media->cloudinary_public_id);

            // Hapus data media dari database
            $user->media()->delete();

            return response()->json(['message' => 'Profile picture removed successfully.']);
        } else {
            return response()->json(['error' => 'No profile picture found.'], 404);
        }
    }
}
