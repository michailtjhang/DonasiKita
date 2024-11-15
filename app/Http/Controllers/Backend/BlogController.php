<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateArticteRequest;
use App\Models\Blog;
use App\Models\Thumbnail;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $blogs = Blog::get();
            return DataTables::of($blogs)
                ->addIndexColumn()
                ->addColumn('category_id', function ($blogs) {
                    return $blogs->category->name;
                })
                ->addColumn('status', function ($blogs) {
                    if ($blogs->status == 1) {
                        return '<span class="badge badge-success">Published</span>';
                    } else {
                        return '<span class="badge badge-danger">Draft</span>';
                    }
                })
                ->addColumn('action', function ($blogs) {
                    return '
                    <th>
                        <a href="article/' . $blogs->blog_id . '" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-eye"></i></a>
                        <a href="article/' . $blogs->blog_id . '/edit" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i></a>
                        <a href="#" onclick="deleteData(this)" data-id="' . $blogs->blog_id . '" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></a>
                    </th>';
                })
                ->rawColumns(['category_id', 'status', 'action'])
                ->make();
        }
        return view('Backend.blog.index', [
            'page_title' => 'Blog Article',
        ]);
    }

    public function create()
    {
        return view('Backend.blog.create', [
            'categories' => Category::get(),
            'page_title' => 'Create Blog Article',
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $data = $request->all();

        // upload image
        $file = $request->file('img'); // get file
        $filename = uniqid() . '.' . $file->getClientOriginalExtension(); // generate filename randomnes and extension
        $file->move(storage_path('app/public/article'), $filename); // path file

        // table blog
        $data['slug'] = Str::slug($data['title']);
        $data['views'] = 0;
        Blog::create($data);

        // table thumbnail 
        $dataThumbnail['file_path'] = $filename;
        $dataThumbnail['type'] = 'Image';
        $dataThumbnail['blog_id'] = Blog::latest()->first()->blog_id;
        Thumbnail::create($dataThumbnail);

        return redirect()->route('article.index')->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
