<?php

namespace App\Http\Controllers\Backend;

use App\Models\pages;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    public function index()
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Pages', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // Cek masing-masing izin untuk Add, Edit, dan Delete
        $data['PermissionEdit'] = PermissionRole::getPermission('Edit Page', Auth::user()->role_id);

        // Jika request adalah Ajax untuk DataTables
        if (request()->ajax()) {
            // Ambil semua halaman
            $pages = pages::all();

            return DataTables::of($pages)
                ->addIndexColumn()
                ->addColumn('action', function ($pages) use ($data) {
                    $actions = '';

                    // Loop untuk section
                    $content = json_decode($pages->content, true);

                    if ($content) {
                        foreach ($content as $section => $sectionData) {
                            // Menambahkan tombol edit untuk setiap section
                            if (!empty($data['PermissionEdit'])) {
                                $actions .= '<a href="' . route('pages.edit.section', ['page' => $pages->name, 'section' => $section]) . '" class="btn btn-sm btn-warning">
                                    <i class="fas fa-fw fa-edit"></i> Edit ' . ucfirst($section) . '
                                </a> ';
                            }
                        }
                    }

                    return $actions;
                })
                ->rawColumns(['action']) // Kolom 'action' bisa di-render HTML
                ->make(true);
        }

        return view('backend.pages.index', [
            'page_title' => 'Pages List',
            'data' => $data
        ]);
    }


    public function editSection($page, $section)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Edit page', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        $page = pages::where('name', $page)->firstOrFail();
        $content = json_decode($page->content, true);

        // Ambil data sesuai section
        $sectionData = $content[$section] ?? [];

        return view('backend.pages.edit-section', [
            'page_title' => 'Edit Section: ' . ucfirst($section) . ' (' . ucfirst($page->name) . ')',
            'page' => $page,
            'section' => $section,
            'sectionData' => $sectionData,
        ]);
    }

    public function updateSection(Request $request, $page, $section)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Edit page', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        $page = Pages::where('name', $page)->firstOrFail();
        $content = json_decode($page->content, true);

        // Update data section
        $content[$section] = $request->all();

        $page->content = json_encode($content);
        $page->save();

        return redirect()->route('pages.index')->with('success', 'Section updated successfully');
    }
}
