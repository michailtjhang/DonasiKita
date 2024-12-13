<?php

namespace App\Http\Controllers\Backend;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Thumbnail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use Illuminate\Validation\Rule;
use Buglinjo\LaravelWebp\Facades\Webp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Blog & Article', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // Cek masing-masing izin untuk Add, Edit, dan Delete
        $data['PermissionAdd'] = PermissionRole::getPermission('Add Blog', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRole::getPermission('Edit Blog', Auth::user()->role_id);
        $data['PermissionShow'] = PermissionRole::getPermission('View Blog', Auth::user()->role_id);

        // Jika request adalah Ajax untuk DataTables
        if (request()->ajax()) {
            $blogs = Blog::get();

            // Tampilkan data blog
            return DataTables::of($blogs)
                // Tampilkan kolom yang diinginkan
                ->addIndexColumn()
                // Tambahkan kolom category_id
                ->addColumn('category_id', function ($blog) {
                    return $blog->category->name ?? '-';
                })
                // Tambahkan kolom status
                ->addColumn('status', function ($blogs) {
                    if ($blogs->status == 1) {
                        return '<span class="badge badge-success">Published</span>';
                    } else {
                        return '<span class="badge badge-danger">Draft</span>';
                    }
                })
                // Tambahkan kolom action
                ->addColumn('action', function ($blogs) use ($data) {
                    $buttons = '';

                    // Tambahkan tombol show jika izin Show ada
                    if (!empty($data['PermissionShow'])) {
                        $buttons .= '<a href="article/' . $blogs->id . '" class="btn btn-sm btn-primary m-1"><i class="fas fa-fw fa-eye"></i></a>';
                    }

                    // Tambahkan tombol Edit jika izin Edit ada
                    if (!empty($data['PermissionEdit'])) {
                        $buttons .= '<a href="article/' . $blogs->id . '/edit" class="btn btn-sm btn-warning m-1"><i class="fas fa-fw fa-edit"></i></a>';
                    }

                    return $buttons;
                })
                // Konfigurasi DataTables
                ->rawColumns(['status', 'action'])
                // Tampilkan DataTables
                ->make(true);
        }

        // Kirim data ke view
        return view('Backend.blog.index', [
            'page_title' => 'Blog Article',
            'data' => $data
        ]);
    }

    public function create()
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Add Blog', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        return view('Backend.blog.create', [
            'categories' => Category::get(),
            'page_title' => 'Create Blog Article',
        ]);
    }

    public function store(Request $request)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Add Blog', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // Validasi
        $request->validate([
            'title' => 'required|unique:blogs',
            'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'content' => 'required|min:10|max:10000',
            'category_id' => 'required',
            'status' => 'required',
        ]);

        $data = $request->all();

        // Generate blog_id unik
        do {
            $blogId = strtoupper(Str::random(5)); // Membuat 5 karakter acak
        } while (Blog::where('blog_id', $blogId)->exists()); // Pastikan unik

        $data['blog_id'] = $blogId;

        try {
            // Tambahkan slug dan views
            $data['slug'] = Str::slug($data['title']);
            $data['views'] = 0;
            $data['user_id'] = auth()->user()->id;

            // Simpan data ke tabel Blog
            $blog = Blog::create($data);

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
                'blog_id' => $blog->blog_id,
            ]);

            return redirect()->route('article.index')->with('success', 'Data added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('View Blog', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // Cari artikel berdasarkan ID
        $Blog = Blog::with(['category', 'thumbnail'])->findOrFail($id);

        // Kirim data ke view
        return view('Backend.blog.show', [
            'page_title' => 'Detail Article Blog',
            'article' => $Blog,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Edit Blog', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        return view('Backend.blog.edit', [
            'page_title' => 'Edit Article',
            'article' => Blog::find($id),
            'categories' => Category::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Edit Blog', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // Validasi data
        $request->validate([
            'title' => [
                'required',
                Rule::unique('blogs', 'title')->ignore($id),
            ],
            'img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'content' => 'required|min:10|max:10000',
            'category_id' => 'required',
            'status' => 'required',
        ]);

        $data = $request->all();
        $blog = Blog::findOrFail($id); // Pastikan blog ditemukan

        try {
            // Cek apakah ada file baru yang diupload
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
                if (!empty($blog->thumbnail->id_file)) {
                    cloudinary()->destroy($blog->thumbnail->id_file);
                }

                // Update data Thumbnail
                $blog->thumbnail->update([
                    'file_path' => $cloudinaryUrl,
                    'id_file' => $publicId,
                    'type' => 'Image',
                ]);
            }

            // Update slug
            $data['slug'] = Str::slug($data['title']);

            // Update data blog
            $blog->update([
                'title' => $data['title'],
                'slug' => $data['slug'],
                'content' => $data['content'],
                'category_id' => $data['category_id'],
                'status' => $data['status'],
            ]);

            return redirect()->route('article.index')->with('success', 'Data updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $blog = Blog::findOrFail($id); // Pastikan blog ditemukan

        // // Hapus file gambar jika ada
        // if (!empty($blog->thumbnail->file_path)) {
        //     $filePath = storage_path('app/public/cover/' . $blog->thumbnail->file_path);

        //     if (file_exists($filePath)) {
        //         unlink($filePath);
        //     }
        // }

        // // Hapus data thumbnail
        // if ($blog->thumbnail) {
        //     $blog->thumbnail->delete();
        // }

        // // Hapus data blog
        // $blog->delete();

        // return response()->json([
        //     'message' => 'Data deleted successfully',
        // ]);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            // Ambil file dari request
            $file = $request->file('file');

            // // Tentukan folder tujuan
            // $destinationPath = public_path('storage/uploads');

            // // Buat folder jika belum ada
            // if (!file_exists($destinationPath)) {
            //     mkdir($destinationPath, 0755, true);
            // }

            // // Pindahkan file ke folder tujuan
            // $fileName = time() . '_' . $file->getClientOriginalName();
            // $file->move($destinationPath, $fileName);

            // // Buat URL file
            // $url = asset('storage/uploads/' . $fileName);

            // Upload file ke Cloudinary
            $cloudinaryResponse = cloudinary()->upload($file->getRealPath(), [
                'folder' => 'uploads',
                'use_filename' => true,
                'unique_filename' => true,
            ]);

            // Dapatkan URL aman dari Cloudinary
            $url = $cloudinaryResponse->getSecurePath();

            return response()->json($url);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to upload image: ' . $e->getMessage(),
            ], 500);
        }
    }
}
