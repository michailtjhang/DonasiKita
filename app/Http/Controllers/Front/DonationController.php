<?php

namespace App\Http\Controllers\Front;

use App\Models\Need;
use App\Models\Donation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TemporaryDonations;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Buglinjo\LaravelWebp\Facades\Webp;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Need::with(['donation', 'thumbnail'])
            ->filter(request(['keyword']))
            ->latest()
            ->paginate(9); // 9 item per halaman

        return view('front.donation.index', [
            'page_title' => 'Donations',
            'donations' => $donations,
        ]);
    }

    public function show(String $slug)
    {
        $donation = Need::with(['donation', 'thumbnail'])->whereSlug($slug)->firstOrFail();

        return view('front.donation.show', [
            'page_title' => $donation->title,
            'donation' => $donation,
        ]);
    }

    public function showAmount(Request $request, String $slug)
    {
        // dd($request->all());
        $donation = Need::with(['donation', 'thumbnail'])->whereSlug($slug)->firstOrFail();

        return view('front.donation.donationAmount', [
            'page_title' => $donation->title,
            'donation' => $donation,
        ]);
    }

    public function storeTemporaryAmount(Request $request, String $slug)
    {
        $need = Need::whereSlug($slug)->firstOrFail();

        // Generate temp_id unik
        do {
            $donateNeedId = strtoupper(Str::random(5)); // Membuat 5 karakter acak
        } while (TemporaryDonations::where('temp_id', $donateNeedId)->exists()); // Pastikan unik

        if (Auth::check()) {
            $request->validate([
                'amount' => 'required|numeric|min:1000',
                'bank' => 'required|string|max:50',
            ]);
            $data = $request->all();

            $temporaryDonation = TemporaryDonations::create([
                'temp_id' => $donateNeedId,
                'amount' => $data['amount'],
                'user_id' => Auth::user()->id,
                'need_id' => $need->need_id,
                'bank' => $data['bank'],
                'email' => Auth::user()->email,
                'name' => Auth::user()->name,
                'status' => 'pending',
            ]);
        } else {
            $request->validate([
                'amount' => 'required|numeric|min:1000',
                'bank' => 'required|string|max:50',
                'name' => 'nullable|string|max:30',
                'email' => 'nullable|email|max:30',
            ]);

            $data = $request->all();

            // Data diri untuk guest
            $temporaryDonation = TemporaryDonations::create([
                'temp_id' => $donateNeedId,
                'amount' => $data['amount'],
                'need_id' => $need->need_id,
                'bank' => $data['bank'],
                'email' => $data['email'],
                'name' => $data['name'],
                'status' => 'pending',
            ]);
        }

        return view('front.donation.confirmAmount', [
            'page_title' => $need->title,
            'donation' => $need,
            'amount' => $data['amount'],
            'id' => $donateNeedId
        ]);
    }


    public function showItem(Request $request, String $slug)
    {
        // dd($request->all());
        $donation = Need::with(['donation', 'thumbnail'])->whereSlug($slug)->firstOrFail();

        return view('front.donation.donationItem', [
            'page_title' => $donation->title,
            'donation' => $donation,
        ]);
    }

    public function confirmAmount(Request $request, String $slug, String $id)
    {
        dd($request->all(), $slug, $id);
        $donation = Need::with(['donation', 'thumbnail'])->whereSlug($slug)->firstOrFail();
        $temporaryDonation = TemporaryDonations::where('id', $id)->firstOrFail();

        // Generate donateNeedId unik
        do {
            $donateNeedId = strtoupper(Str::random(5)); // Membuat 5 karakter acak
        } while (Donation::where('donation_id', $donateNeedId)->exists()); // Pastikan unik

        try {
            if (Auth::check()) {
                $request->validate([
                    'nama_rekening' => 'required|string|max:50',
                    'bukti_foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
                $data = $request->all();

                $donation = Donation::create([
                    'donation_id' => $donateNeedId,
                    'amount' => $temporaryDonation->amount,
                    'need_id' => $donation->need_id,
                    'user_id' => Auth::user()->id,
                    'bank' => $temporaryDonation->bank,
                    'email' => Auth::user()->email,
                    'name' => Auth::user()->name,
                    'sender_name' => $data['nama_rekening'],
                    'status' => 'pending',
                ]);

                $file = $request->file('bukti_foto');

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
                    'folder' => 'bukti_foto',
                    'use_filename' => true,
                    'unique_filename' => true,
                ]);

                $cloudinaryUrl = $cloudinaryResponse->getSecurePath();
                $publicId = $cloudinaryResponse->getPublicId();

                // Langsung hapus file sementara setelah upload
                if (file_exists($webpPath)) {
                    unlink($webpPath); // Hapus file
                }

                $donation->receipt()->create([
                    'donation_id' => $donateNeedId,
                    'cloudinary_public_id' => $publicId,
                    'cloudinary_url' => $cloudinaryUrl,
                    'uploaded_at' => now(),
                ]);

                $temporaryDonation->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Donation success',
                ]);
            } else {
                $request->validate([
                    'nomor_resi' => 'required|numeric|min:1000',
                    'bukti_foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    'name' => 'nullable|string|max:30',
                    'email' => 'nullable|email|max:30',
                ]);
                $data = $request->all();

                $donation = Donation::create([
                    'donation_id' => $donateNeedId,
                    'amount' => $temporaryDonation->amount,
                    'need_id' => $donation->need_id,
                    'user_id' => null,
                    'bank' => $temporaryDonation->bank,
                    'email' => $data['email'],
                    'name' => $data['name'],
                    'sender_name' => $data['name'],
                    'status' => 'pending',
                ]);

                $file = $request->file('bukti_foto');

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
                    'folder' => 'bukti_foto',
                    'use_filename' => true,
                    'unique_filename' => true,
                ]);

                $cloudinaryUrl = $cloudinaryResponse->getSecurePath();
                $publicId = $cloudinaryResponse->getPublicId();

                // Langsung hapus file sementara setelah upload
                if (file_exists($webpPath)) {
                    unlink($webpPath); // Hapus file
                }

                $donation->receipt()->create([
                    'donation_id' => $donateNeedId,
                    'cloudinary_public_id' => $publicId,
                    'cloudinary_url' => $cloudinaryUrl,
                    'uploaded_at' => now(),
                ]);

                $temporaryDonation->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Donation success',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
