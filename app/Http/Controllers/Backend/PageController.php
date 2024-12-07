<?php

namespace App\Http\Controllers\Backend;

use App\Models\Media;
use App\Models\pages;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Buglinjo\LaravelWebp\Facades\Webp;

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
        // Periksa izin pengguna
        $PermissionRole = PermissionRole::getPermission('Edit page', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // Ambil data halaman
        $page = Pages::where('name', $page)->firstOrFail();
        $content = json_decode($page->content, true);

        // Penanganan khusus berdasarkan section
        if ($section === 'hero_section') {
            $carousel = $request->input('carousel', []);

            if (empty($carousel)) {
                $content[$section] = $request->all();
            } else {
                foreach ($carousel as $key => $item) {
                    $carousel[$key]['image'] = $request->hasFile("carousel.$key.image")
                        ? $this->processImage($request->file("carousel.$key.image"), $content['hero_section']['carousel'][$key]['image'] ?? null)
                        : ($content['hero_section']['carousel'][$key]['image'] ?? '/images/about/leader.svg');
                }

                // Perbarui data carousel di konten
                $content[$section]['carousel'] = $carousel;
            }
        } elseif ($section === 'team_section') {
            $team = $request->input('team', []);

            foreach ($team as $key => $member) {
                $team[$key]['image'] = $request->hasFile("team.$key.image")
                    ? $this->processImage($request->file("team.$key.image"), $content['team_section'][$key]['image'] ?? null)
                    : ($content['team_section'][$key]['image'] ?? '/images/about/dika.svg');
            }

            $content[$section] = $team;
        } elseif ($section === 'faq_section') {
            // Ambil data pertanyaan dan jawaban dari request
            $questions = $request->input('questions', []);
            $answers = $request->input('answers', []);

            // Gabungkan pertanyaan dan jawaban menjadi satu array dengan struktur yang benar
            $faq = [];
            foreach ($questions as $key => $question) {
                $faq[] = [
                    'questions' => $question ?? '',
                    'answers' => $answers[$key] ?? '',
                ];
            }

            // Simpan data FAQ ke konten
            $content[$section]['faq'] = $faq;
        } elseif (in_array($section, ['founder_section', 'company_section', 'about_section', 'quote_section'])) {
            if ($request->hasFile('image')) {
                $content[$section]['image'] = $this->processImage($request->file('image'), $content[$section]['image'] ?? null);
            } else {
                // Gunakan gambar lama atau fallback ke gambar default
                $content[$section]['image'] = $content[$section]['image'] ?? '/images/about/dika.svg';
            }

            // Perbarui data lainnya
            $content[$section]['name'] = $request->input('name', $content[$section]['name'] ?? '');
            $content[$section]['description'] = $request->input('description', $content[$section]['description'] ?? '');
            $content[$section]['position'] = $request->input('position', $content[$section]['position'] ?? '');
            $content[$section]['title'] = $request->input('title', $content[$section]['title'] ?? '');
        } else {
            // Default update untuk section lain
            $content[$section] = $request->all();
        }
        // Simpan perubahan ke database
        $page->content = json_encode($content);
        $page->save();

        return redirect()->route('pages.index')->with('success', 'Section updated successfully');
    }

    private function processImage($file, $oldImage = null)
    {
        // Hapus gambar lama jika ada
        if (!empty($oldImage)) {
            $publicId = Media::where('cloudinary_url', $oldImage)->value('cloudinary_public_id');
            if ($publicId) {
                cloudinary()->destroy($publicId);
                Media::where('cloudinary_public_id', $publicId)->delete();
            }
        }

        // Nama file WebP
        $webpFileName = time() . '.webp';

        // Path folder tujuan
        $tempFolder = public_path('temp');

        // Pastikan folder `temp` ada, jika tidak, buat folder
        if (!file_exists($tempFolder)) {
            mkdir($tempFolder, 0755, true);
        }

        // Path tujuan penyimpanan sementara file WebP
        $webpPath = $tempFolder . '/' . $webpFileName;

        // Konversi gambar ke WebP
        WebP::make($file)
            ->quality(65) // Atur kualitas gambar (opsional)
            ->save($webpPath);

        $cloudinaryResponse = cloudinary()->upload($webpPath, [
            'folder' => 'image_pages/team',
            'use_filename' => true,
            'unique_filename' => true,
        ]);

        // Dapatkan URL dari Cloudinary
        $cloudinaryUrl = $cloudinaryResponse->getSecurePath();
        $cloudinaryPublicId = $cloudinaryResponse->getPublicId();

        // Langsung hapus file sementara setelah upload
        if (file_exists($webpPath)) {
            unlink($webpPath); // Hapus file
        }

        // Simpan metadata gambar ke tabel media (opsional)
        Media::create([
            'cloudinary_public_id' => $cloudinaryPublicId,
            'cloudinary_url' => $cloudinaryUrl,
            'type' => 'image',
        ]);

        // Kembalikan URL gambar baru
        return $cloudinaryUrl;
    }
}
