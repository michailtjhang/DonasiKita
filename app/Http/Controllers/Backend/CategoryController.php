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
        $PermissionRole = PermissionRole::getPermission('Category', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        $data['PermissionAdd'] = PermissionRole::getPermission('Add Category', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRole::getPermission('Edit Category', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRole::getPermission('Delete Category', Auth::user()->role_id);

        $data['category'] = Category::latest()->get();

        return view('Backend.category.index', [
            'data' => $data,
            'page_title' => 'Category List',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
        ]);
        $data = $request->all();

        $data['slug'] = Str::slug($data['name']);
        Category::create($data);

        return back()->with('success', 'Category created successfully');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
        ]);

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
        $category = Category::find($id);
        $category->delete();
        
        return back()->with('success', 'Category deleted successfully');
    }
}