<?php

namespace App\Http\Controllers\Backend;

use App\Models\Need;
use App\Models\Thumbnail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Buglinjo\LaravelWebp\Facades\Webp;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Donation', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // Cek masing-masing izin untuk Add, Edit, dan Delete
        $data['PermissionAdd'] = PermissionRole::getPermission('Add Donation', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRole::getPermission('Edit Donation', Auth::user()->role_id);
        $data['PermissionShow'] = PermissionRole::getPermission('View Donation', Auth::user()->role_id);

        // Jika request adalah Ajax untuk DataTables
        if (request()->ajax()) {
            $donation = Need::get();

            return DataTables::of($donation)
                ->addIndexColumn()
                ->addColumn('status', function ($donation) {
                    if ($donation->status == 'complete') {
                        return '<span class="badge badge-success">Complete</span>';
                    } else {
                        return '<span class="badge badge-secondary">Progress</span>';
                    }
                })
                ->addColumn('action', function ($donation) use ($data) {
                    $buttons = '';

                    // Tambahkan tombol show jika izin Show ada
                    if (!empty($data['PermissionShow'])) {
                        $buttons .= '<a href="donation/' . $donation->id . '" class="btn btn-sm btn-primary m-1"><i class="fas fa-fw fa-eye"></i></a>';
                    }

                    // Tambahkan tombol Edit jika izin Edit ada
                    if (!empty($data['PermissionEdit'])) {
                        $buttons .= '<a href="donation/' . $donation->id . '/edit" class="btn btn-sm btn-warning m-1"><i class="fas fa-fw fa-edit"></i></a>';
                    }

                    return $buttons;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('Backend.donation.index', [
            'page_title' => 'Donation',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Add Donation', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        return view('Backend.donation.create', [
            'page_title' => 'Create Donation',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Add Donation', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        $request->validate([
            'title' => 'required|string|max:200|unique:needs',
            'towards' => 'required|string|max:200',
            'description' => 'required|max:2000',
            'img' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'amount' => 'required|numeric',
            'description_need' => 'required|max:5000',
            'days_left' => 'required|date|min:1',
        ]);

        $data = $request->all();

        // Generate need_id unik
        do {
            $donateNeedId = strtoupper(Str::random(5)); // Membuat 5 karakter acak
        } while (Need::where('need_id', $donateNeedId)->exists()); // Pastikan unik

        try {
            // Tambahkan slug dan status
            $needData = [
                'need_id' => $donateNeedId,
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'description' => $data['description'],
                'description_need' => $data['description_need'],
                'target_amount' => $data['amount'],
                'towards' => $data['towards'],
                'days_left' => $data['days_left'],
                'status' => 'ongoing', // Default status
            ];

            // Simpan data ke tabel `needs`
            $need = Need::create($needData);

            // Upload image ke Cloudinary
            $file = $request->file('img');

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
                'folder' => 'cover',
                'use_filename' => true,
                'unique_filename' => true,
            ]);

            // Simpan URL dan Public ID dari Cloudinary
            $cloudinaryUrl = $cloudinaryResponse->getSecurePath();
            $publicId = $cloudinaryResponse->getPublicId();

            // Langsung hapus file sementara setelah upload
            if (file_exists($webpPath)) {
                unlink($webpPath); // Hapus file
            }

            // Simpan data Thumbnail ke tabel Thumbnail
            Thumbnail::create([
                'file_path' => $cloudinaryUrl,
                'id_file' => $publicId,
                'type' => 'Image',
                'need_id' => $need->need_id,
            ]);

            return redirect()->route('donation.index')->with('success', 'Data added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('View Donation', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // Cari event berdasarkan ID
        $need = Need::findOrFail($id);

        // Kirim data ke view
        return view('Backend.donation.show', [
            'page_title' => 'Detail Donation Page',
            'donation' => $need,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Edit Donation', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        $need = Need::with('thumbnail')->find($id);
        if ($need->whereStatus('completed')->exists()) {
            return back()->with('error', 'Donation already completed and cannot be edited');
        }

        return view('Backend.donation.edit', [
            'page_title' => 'Edit Donation',
            'donation' => $need,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Edit Donation', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        $request->validate([
            'title' => [
                'required',
                'string',
                'max:200',
                Rule::unique('needs')->ignore($id),
            ],
            'towards' => 'required|string|max:200',
            'description' => 'required|max:2000',
            'img' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'amount' => 'required|numeric',
            'description_need' => 'required|max:5000',
            'days_left' => 'required|date',
        ]);

        $need = Need::with('thumbnail')->findOrFail($id); // Ambil data Need Donasi dengan relasi terkait
        $data = $request->all();

        try {
            // Update file gambar jika ada file baru yang diupload
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                
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
                    'folder' => 'cover',
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
                if (!empty($need->thumbnail->id_file)) {
                    cloudinary()->destroy($need->thumbnail->id_file);
                }

                // Update data Thumbnail
                $need->thumbnail->update([
                    'file_path' => $cloudinaryUrl,
                    'id_file' => $publicId,
                    'type' => 'Image',
                ]);
            }

            // Update slug
            $data['slug'] = Str::slug($data['title']);

            // Update data `needs Donasi` 
            $need->update([
                'title' => $data['title'],
                'slug' => $data['slug'],
                'description' => $data['description'],
                'description_need' => $data['description_need'],
                'target_amount' => $data['amount'],
                'towards' => $data['towards'],
                'days_left' => $data['days_left'],
            ]);

            return redirect()->route('donation.index')->with('success', 'Data updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
