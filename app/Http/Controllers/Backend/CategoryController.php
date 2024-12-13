<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Thumbnail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Buglinjo\LaravelWebp\Facades\Webp;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Category', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // Cek masing-masing izin untuk Add, Edit, dan Delete
        $data['PermissionAdd'] = PermissionRole::getPermission('Add Category', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRole::getPermission('Edit Category', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRole::getPermission('Delete Category', Auth::user()->role_id);

        // Ambil data kategori
        $data['category'] = Category::latest()->get();

        return view('Backend.category.index', [
            'data' => $data,
            'page_title' => 'Category List',
        ]);
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'required|unique:categories|min:3',
            'description' => 'required',
            'img' => 'required',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
        ]);
        $data = $request->all();
        try {
            // Buat kategori
            $data['slug'] = Str::slug($data['name']);
            $category = Category::create($data);

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

            Thumbnail::create([
                'file_path' => $cloudinaryUrl,
                'id_file' => $publicId,
                'type' => 'Image',
                'category_id' => $category->id,
            ]);

            return back()->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create category:' . $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        // Validasi
        $request->validate([
            'name' => [
                'required',
                'min:3',
                Rule::unique('categories', 'name')->ignore($id),
            ],
            'description' => 'required',
            'img' => 'required',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
        ]);

        $data = $request->all();
        $category = Category::find($id);

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
                    cloudinary()->destroy($category->thumbnail->id_file);
                }

                // Update data Thumbnail
                $category->thumbnail->update([
                    'file_path' => $cloudinaryUrl,
                    'id_file' => $publicId,
                    'type' => 'Image',
                ]);
            }

            // Update kategori
            $data['slug'] = Str::slug($data['name']);
            $category->update($data);

            return back()->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update category:' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus kategori
        $category = Category::find($id);
        $category->delete();

        return back()->with('success', 'Category deleted successfully');
    }
}
