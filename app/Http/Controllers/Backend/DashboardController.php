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
            return back();
        }
        
        return view('Backend.dashboard', [
            'page_title' => 'Dashboard',
            'total_article' => Blog::count(),
            'total_event' => Event::count(),
            'total_donation' => Need::count(),
            'last_article' => Blog::latest()->with('category')->whereStatus(1)->limit(5)->get(),
            'last_event' => Event::latest()->with('category')->whereStatus(0)->limit(5)->get(),
            'last_donation' => Need::latest()->where('days_left', '>', now())->limit(5)->get(),
        ]);
    }
}