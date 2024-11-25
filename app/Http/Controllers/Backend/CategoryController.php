<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
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
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
        ]);
        $data = $request->all();

        // Buat kategori
        $data['slug'] = Str::slug($data['name']);
        Category::create($data);

        return back()->with('success', 'Category created successfully');
    }

    public function update(Request $request, string $id)
    {
        // Validasi
        $request->validate([
            'name' => 'required|min:3',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
        ]);

        // Update kategori
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        $category = Category::find($id);
        $category->update($data);

        return back()->with('success', 'Category updated successfully');
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