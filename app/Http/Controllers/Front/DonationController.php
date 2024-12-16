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
            ->where('days_left', '>', now())
            ->latest()
            ->paginate(9); // 9 item per halaman

        // Hitung total donasi yang disetujui untuk setiap "Need"
        $donations->getCollection()->transform(function ($donation) {
            $donation->total_donated = Donation::where('need_id', $donation->need_id)
                ->where('status', 'approved')
                ->sum('amount');
            $donation->donator_count = Donation::where('need_id', $donation->need_id)
                ->where('status', 'approved')
                ->count(); // Hitung jumlah donatur (status disetujui)
            return $donation;
        });

        return view('front.donation.index', [
            'page_title' => 'Donations',
            'donations' => $donations,
        ]);
    }

    public function show(String $slug)
    {
        $donation = Need::with(['donation', 'thumbnail'])
            ->whereSlug($slug)
            ->where('days_left', '>', now())
            ->firstOrFail();
        $amoutDonated = Donation::where('need_id', $donation->need_id)
            ->where('status', 'approved')
            ->sum('amount');
        $donatorCount = Donation::where('need_id', $donation->need_id)
            ->where('status', 'approved')
            ->count();

        // Generate keywords dari deskripsi
        $keywords = $this->generateKeywords($donation->description);

        return view('front.donation.show', [
            'page_title' => $donation->title,
            'donation' => $donation,
            'amoutDonated' => $amoutDonated,
            'donatorCount' => $donatorCount,
            'keywords' => $keywords,
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

            return view('front.donation.confirmAmount', [
                'page_title' => $need->title,
                'donation' => $need,
                'id' => $temporaryDonation->temp_id
            ]);
        } else {
            $request->validate([
                'amount' => 'required|numeric|min:1000',
                'bank' => 'required|string|max:50',
                'name' => 'required|string|max:30',
                'email' => 'required|email|max:30',
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
            'id' => $temporaryDonation->temp_id
        ]);
    }

    public function storeTemporaryItem(Request $request, String $slug)
    {
        $need = Need::whereSlug($slug)->firstOrFail();

        // Generate temp_id unik
        do {
            $donateNeedId = strtoupper(Str::random(5)); // Membuat 5 karakter acak
        } while (TemporaryDonations::where('temp_id', $donateNeedId)->exists()); // Pastikan unik

        if (Auth::check()) {
            $request->validate([
                'deskripsi_barang' => 'required|string|max:150',
            ]);
            $data = $request->all();

            $temporaryDonation = TemporaryDonations::create([
                'temp_id' => $donateNeedId,
                'user_id' => Auth::user()->id,
                'need_id' => $need->need_id,
                'description_item' => $data['deskripsi_barang'],
                'email' => Auth::user()->email,
                'name' => Auth::user()->name,
                'status' => 'pending',
            ]);

            return view('front.donation.confirmItem', [
                'page_title' => $need->title,
                'donation' => $need,
                'id' => $temporaryDonation->temp_id
            ]);
        } else {
            $request->validate([
                'deskripsi_barang' => 'required|string|max:150',
                'name' => 'required|string|max:30',
                'email' => 'required|email|max:30',
            ]);

            $data = $request->all();

            // Data diri untuk guest
            $temporaryDonation = TemporaryDonations::create([
                'temp_id' => $donateNeedId,
                'need_id' => $need->need_id,
                'description_item' => $data['deskripsi_barang'],
                'email' => $data['email'],
                'name' => $data['name'],
                'status' => 'pending',
            ]);
        }

        return view('front.donation.confirmItem', [
            'page_title' => $need->title,
            'donation' => $need,
            'id' => $temporaryDonation->temp_id
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

    public function confirmAmount(Request $request, String $slug, $temp_id)
    {
        $donation = Need::with(['donation', 'thumbnail'])->whereSlug($slug)->firstOrFail();
        $temporaryDonation = TemporaryDonations::where('temp_id', $temp_id)->firstOrFail();

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
                    'message' => 'Bukti Donation success',
                ]);
            } else {
                $request->validate([
                    'nama_rekening' => 'required|string|max:50',
                    'bukti_foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
                $data = $request->all();

                $donation = Donation::create([
                    'donation_id' => $donateNeedId,
                    'amount' => $temporaryDonation->amount,
                    'need_id' => $donation->need_id,
                    'user_id' => null,
                    'bank' => $temporaryDonation->bank,
                    'email' => $temporaryDonation->email,
                    'name' => $temporaryDonation->name,
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
                    'message' => 'Bukti Donation success',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function confirmItem(Request $request, String $slug, $temp_id)
    {
        $donation = Need::with(['donation', 'thumbnail'])->whereSlug($slug)->firstOrFail();
        $temporaryDonation = TemporaryDonations::where('temp_id', $temp_id)->firstOrFail();

        // Generate donateNeedId unik
        do {
            $donateNeedId = strtoupper(Str::random(5)); // Membuat 5 karakter acak
        } while (Donation::where('donation_id', $donateNeedId)->exists()); // Pastikan unik

        try {
            if (Auth::check()) {
                $request->validate([
                    'nomor_resi' => 'required|string|max:50',
                    'bukti_foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
                $data = $request->all();


                $donation = Donation::create([
                    'donation_id' => $donateNeedId,
                    'need_id' => $donation->need_id,
                    'user_id' => Auth::user()->id,
                    'description_item' => $temporaryDonation->description_item,
                    'email' => Auth::user()->email,
                    'name' => Auth::user()->name,
                    'tracking_number' => $data['nomor_resi'],
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
                    'message' => 'Bukti Donation success',
                ]);
            } else {
                $request->validate([
                    'nomor_resi' => 'required|string|max:50',
                    'bukti_foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
                $data = $request->all();

                $donation = Donation::create([
                    'donation_id' => $donateNeedId,
                    'need_id' => $donation->need_id,
                    'user_id' => null,
                    'description_item' => $temporaryDonation->description_item,
                    'email' => $temporaryDonation->email,
                    'name' => $temporaryDonation->name,
                    'tracking_number' => $data['nomor_resi'],
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
                    'message' => 'Bukti Donation success',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    function generateKeywords($description, $limit = 10)
    {
        // Hilangkan karakter spesial
        $description = strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', '', $description));

        // Pisahkan kata-kata
        $words = explode(' ', $description);

        // Hilangkan kata-kata umum (stop words)
        $stopWords = ['dan', 'atau', 'yang', 'di', 'ke', 'dari', 'ini', 'itu', 'adalah', 'sebagai', 'dengan', 'untuk'];
        $filteredWords = array_filter($words, function ($word) use ($stopWords) {
            return !in_array($word, $stopWords) && strlen($word) > 2;
        });

        // Hitung frekuensi kata
        $wordCounts = array_count_values($filteredWords);

        // Urutkan berdasarkan frekuensi
        arsort($wordCounts);

        // Ambil kata-kata paling sering muncul
        $keywords = array_keys(array_slice($wordCounts, 0, $limit, true));

        // Gabungkan menjadi string keyword
        return implode(', ', $keywords);
    }
}
