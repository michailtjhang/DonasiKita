<?php

namespace App\Http\Controllers\Backend;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Thumbnail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
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
            abort(404);
        }

        // Cek masing-masing izin untuk Add, Edit, dan Delete
        $data['PermissionAdd'] = PermissionRole::getPermission('Add Blog', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRole::getPermission('Edit Blog', Auth::user()->role_id);
        $data['PermissionShow'] = PermissionRole::getPermission('View Blog', Auth::user()->role_id);
        // Jika request adalah Ajax untuk DataTables
        if (request()->ajax()) {
            // $blogs = Blog::where('user_id', auth()->user()->id)->get();
            $blogs = Blog::get();
            return DataTables::of($blogs)
                ->addIndexColumn()
                ->addColumn('category_id', function ($blog) {
                    return $blog->category->name ?? '-';
                })
                ->addColumn('status', function ($blogs) {
                    if ($blogs->status == 1) {
                        return '<span class="badge badge-success">Published</span>';
                    } else {
                        return '<span class="badge badge-danger">Draft</span>';
                    }
                })
                ->addColumn('action', function ($blogs) use ($data) {
                    $buttons = '';

                    // Tambahkan tombol show jika izin Show ada
                    if (!empty($data['PermissionShow'])) {
                        $buttons .= '<a href="event/' . $blogs->id . '" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-eye"></i></a>';
                    }

                    // Tambahkan tombol Edit jika izin Edit ada
                    if (!empty($data['PermissionEdit'])) {
                        $buttons .= '<a href="event/' . $blogs->id . '/edit" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i></a>';
                    }

                    return $buttons;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('Backend.blog.index', [
            'page_title' => 'Blog Article',
            'data' => $data
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
        $request->validate([
            'title' => 'required',
            'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'content' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ]);

        $data = $request->all();

        // Generate blog_id unik
        do {
            $blogId = strtoupper(Str::random(5)); // Membuat 5 karakter acak
        } while (Blog::where('blog_id', $blogId)->exists()); // Pastikan unik

        $data['blog_id'] = $blogId;

        // upload image
        $file = $request->file('img'); // get file
        $filename = uniqid() . '.' . $file->getClientOriginalExtension(); // generate filename randomnes and extension
        $file->move(storage_path('app/public/cover'), $filename); // path file

        // Tambahkan slug dan views
        $data['slug'] = Str::slug($data['title']);
        $data['views'] = 0;
        $data['user_id'] = auth()->user()->id;

        // Simpan data ke tabel Blog
        $blog = Blog::create($data);

        // Tambahkan data thumbnail 
        $dataThumbnail['file_path'] = $filename;
        $dataThumbnail['type'] = 'Image';
        $dataThumbnail['blog_id'] = $blog->blog_id;

        // Simpan data ke tabel Thumbnail
        Thumbnail::create($dataThumbnail);

        return redirect()->route('article.index')->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
        // Validasi data
        $request->validate([
            'title' => 'required',
            'img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'content' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ]);

        $data = $request->all();
        $blog = Blog::findOrFail($id); // Pastikan blog ditemukan

        // Cek apakah ada file baru yang diupload
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/cover'), $filename);

            // Hapus file lama jika ada
            if (!empty($blog->thumbnail->file_path)) {
                $oldFilePath = storage_path('app/public/cover/' . $blog->thumbnail->file_path);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Update nama file ke $data
            $data['img'] = $filename;

            // Update data thumbnail
            $blog->thumbnail->update([
                'file_path' => $filename,
                'type' => 'Image',
            ]);
        } else {
            $data['img'] = $blog->thumbnail->file_path; // Pertahankan file lama
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

        // Ambil file dari request
        $file = $request->file('file');

        // Tentukan folder tujuan
        $destinationPath = public_path('storage/uploads');

        // Buat folder jika belum ada
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Pindahkan file ke folder tujuan
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        // Buat URL file
        $url = asset('storage/uploads/' . $fileName);

        return response()->json($url);
    }
}
