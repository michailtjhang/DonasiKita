<?php

namespace App\Http\Controllers\Backend;

use App\Models\Need;
use App\Models\Donation;
use App\Models\Thumbnail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Blog & Article', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        // Cek masing-masing izin untuk Add, Edit, dan Delete
        $data['PermissionAdd'] = PermissionRole::getPermission('Add Blog', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRole::getPermission('Edit Blog', Auth::user()->role_id);
        $data['PermissionShow'] = PermissionRole::getPermission('View Blog', Auth::user()->role_id);

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
                        $buttons .= '<a href="donation/' . $donation->id . '" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-eye"></i></a>';
                    }

                    // Tambahkan tombol Edit jika izin Edit ada
                    if (!empty($data['PermissionEdit'])) {
                        $buttons .= '<a href="donation/' . $donation->id . '/edit" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i></a>';
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
        return view('Backend.donation.create', [
            'page_title' => 'Create Donation',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'towards' => 'required|string|max:200',
            'description' => 'required|max:2000',
            'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
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

            // // upload image
            // $file = $request->file('img'); // get file
            // $filename = uniqid() . '.' . $file->getClientOriginalExtension(); // generate filename randomnes and extension
            // $file->move(storage_path('app/public/cover'), $filename); // path file

            // Upload image ke Cloudinary
            $file = $request->file('img');
            $cloudinaryResponse = cloudinary()->upload($file->getRealPath(), [
                'folder' => 'cover',
                'use_filename' => true,
                'unique_filename' => true,
            ]);

            // Simpan URL dan Public ID dari Cloudinary
            $cloudinaryUrl = $cloudinaryResponse->getSecurePath();
            $publicId = $cloudinaryResponse->getPublicId();

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
        $request->validate([
            'title' => 'required|string|max:200',
            'towards' => 'required|string|max:200',
            'description' => 'required|max:2000',
            'img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
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

                // // Upload file ke folder public
                // $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                // $file->move(storage_path('app/public/cover'), $filename);

                // // Hapus file lama jika ada
                // if ($need->thumbnail && $need->thumbnail->file_path) {
                //     $oldFilePath = storage_path('app/public/cover/' . $need->thumbnail->file_path);
                //     if (file_exists($oldFilePath)) {
                //         unlink($oldFilePath);
                //     }
                // }

                // Upload image baru ke Cloudinary
                $cloudinaryResponse = cloudinary()->upload($file->getRealPath(), [
                    'folder' => 'cover',
                    'use_filename' => true,
                    'unique_filename' => true,
                ]);

                $cloudinaryUrl = $cloudinaryResponse->getSecurePath();
                $publicId = $cloudinaryResponse->getPublicId();

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
                'amount' => $data['amount'],
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
