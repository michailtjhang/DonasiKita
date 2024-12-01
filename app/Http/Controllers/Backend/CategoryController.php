<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Thumbnail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            abort(404);
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
            'name' => 'required|min:3',
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

            // upload image
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
            'name' => 'required|min:3',
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

                // // Upload file baru
                // $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                // $file->move(storage_path('app/public/cover'), $filename);

                // // Hapus file lama jika ada
                // if (!empty($category->thumbnail->file_path)) {
                //     $oldFilePath = storage_path('app/public/cover/' . $category->thumbnail->file_path);
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
