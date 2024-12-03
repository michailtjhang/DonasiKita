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
        // Ambil halaman berdasarkan nama
        $page = Pages::where('name', $page)->firstOrFail();
        $content = json_decode($page->content, true);
        
        // Periksa jika section yang diminta ada
        if (!isset($content[$section])) {
            // Jika section tidak ada dalam konten, berikan nilai default atau kosong
            $sectionData = [];
        } else {
            // Jika ada, ambil data dari section tersebut
            $sectionData = $content[$section];
        }

        // Kondisi untuk memilih view berdasarkan nama page
        if ($page->name == 'home') {
            return view('backend.pages.edit-home-section', [
                'page_title' => 'Edit Section: ' . ucfirst($section) . ' (' . ucfirst($page->name) . ')',
                'page' => $page,
                'section' => $section,
                'sectionData' => $sectionData,
            ]);
        } elseif ($page->name == 'about') {
            return view('backend.pages.edit-about-section', [
                'page_title' => 'Edit Section: ' . ucfirst($section) . ' (' . ucfirst($page->name) . ')',
                'page' => $page,
                'section' => $section,
                'sectionData' => $sectionData,
            ]);
        }
        // Tambahkan kondisi lain untuk halaman lain jika perlu
        else {
            return view('backend.pages.edit-section', [
                'page_title' => 'Edit Section: ' . ucfirst($section) . ' (' . ucfirst($page->name) . ')',
                'page' => $page,
                'section' => $section,
                'sectionData' => $sectionData,
            ]);
        }
    }

    public function updateSection(Request $request, $page, $section)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Edit page', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }
        dd($request->all(), $page, $section);

        $page = Pages::where('name', $page)->firstOrFail();
        $content = json_decode($page->content, true);

        // Jika section adalah team_section, lakukan penyesuaian array anggota tim
        if ($section === 'team_section') {
            $team = $request->input('team', []);
            $content[$section] = array_filter($team, function ($member) {
                return !empty($member['name']); // Hanya anggota yang memiliki nama
            });
        } else {
            $content[$section] = $request->all();
        }

        $page->content = json_encode($content);
        $page->save();

        return redirect()->route('pages.index')->with('success', 'Section updated successfully');
    }
}
