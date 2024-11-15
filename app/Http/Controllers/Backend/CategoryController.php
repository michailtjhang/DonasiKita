<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Backend.category.index', [
            'data' => Category::latest()->get(),
            'page_title' => 'Category',
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