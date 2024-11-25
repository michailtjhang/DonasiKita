<?php

namespace App\Http\Controllers\Backend;

use App\Models\Blog;
use App\Models\Event;
use App\Models\PermissionRole;
use App\Http\Controllers\Controller;
use App\Models\Need;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Dashboard', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }
        
        return view('Backend.dashboard', [
            'page_title' => 'Dashboard',
            'total_article' => Blog::count(),
            'total_event' => Event::count(),
            'total_donation' => Need::count(),
            'last_article' => Blog::latest()->with('category')->whereStatus(1)->limit(5)->get(),
            'popular_article' => Blog::orderBy('views', 'DESC')->with('category')->whereStatus(1)->limit(5)->get()
        ]);
    }
}