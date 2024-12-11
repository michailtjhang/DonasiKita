<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Need;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Visitors;
use App\Models\PermissionRole;
use App\Models\EventRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Dashboard', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        $currentMonthStart = Carbon::now()->startOfMonth();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = $currentMonthStart->copy()->subDay();

        // Total pengunjung bulan ini
        $currentMonthVisitors = Visitors::whereBetween('date', [$currentMonthStart, Carbon::now()])->sum('count');

        // Total pengunjung bulan lalu
        $lastMonthVisitors = Visitors::whereBetween('date', [$lastMonthStart, $lastMonthEnd])->sum('count');

        // Hitung persentase perubahan
        $percentageChange = $lastMonthVisitors > 0
            ? (($currentMonthVisitors - $lastMonthVisitors) / $lastMonthVisitors) * 100
            : 0;

        // Total donasi bulan ini
        $currentMonthDonations = Donation::where('status', 'approved')
            ->whereBetween('created_at', [$currentMonthStart, Carbon::now()])
            ->sum('amount');

        // Total donasi bulan lalu
        $lastMonthDonations = Donation::where('status', 'approved')
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->sum('amount');

        // Hitung persentase perubahan donasi
        $donationPercentageChange = $lastMonthDonations > 0
            ? (($currentMonthDonations - $lastMonthDonations) / $lastMonthDonations) * 100
            : 0;

        return view('Backend.dashboard', [
            'page_title' => 'Dashboard',
            'total_Partisipan' => EventRegistration::whereBetween('created_at', [$currentMonthStart, Carbon::now()])->count(),
            'total_user' => User::where('role_id', '=', '01j8kkdk3abh0a671dr5rqkshy')->count(),
            'last_article' => Blog::latest()->with('category')->whereStatus(1)->limit(5)->get(),
            'last_event' => Event::latest()->with('category')->whereStatus(0)->limit(5)->get(),
            'last_donation' => Need::latest()->where('days_left', '>', now())->limit(5)->get(),
            'last_category' => Category::latest()->limit(5)->get(),
            'currentMonthVisitors' => $currentMonthVisitors,
            'percentageChange' => $percentageChange,
            'currentMonthDonations' => $currentMonthDonations,
            'donationPercentageChange' => $donationPercentageChange,
        ]);
    }

    public function getVisitorStats()
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = $currentMonthStart->copy()->subDay();

        // Data bulan ini
        $currentMonthData = Visitors::whereBetween('date', [$currentMonthStart, Carbon::now()])
            ->selectRaw('DATE_FORMAT(date, "%d %b") as date, count')
            ->orderBy('date', 'asc')
            ->get();

        // Data bulan lalu
        $lastMonthData = Visitors::whereBetween('date', [$lastMonthStart, $lastMonthEnd])
            ->selectRaw('DATE_FORMAT(date, "%d %b") as date, count')
            ->orderBy('date', 'asc')
            ->get();

        return response()->json([
            'currentMonth' => $currentMonthData,
            'lastMonth' => $lastMonthData,
        ]);
    }

    public function getDonationStats()
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = $currentMonthStart->copy()->subDay();

        // Data donasi bulan ini
        $currentMonthData = Donation::where('status', 'approved')
            ->whereBetween('created_at', [$currentMonthStart, Carbon::now()])
            ->selectRaw('DATE(created_at) as date, sum(amount) as amount')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Data donasi bulan lalu
        $lastMonthData = Donation::where('status', 'approved')
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->selectRaw('DATE(created_at) as date, sum(amount) as amount')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Format tanggal menjadi format "%d %b"
        $currentMonthData->transform(function ($item) {
            $item->date = Carbon::parse($item->date)->format('d M');
            return $item;
        });

        $lastMonthData->transform(function ($item) {
            $item->date = Carbon::parse($item->date)->format('d M');
            return $item;
        });

        return response()->json([
            'currentMonth' => $currentMonthData,
            'lastMonth' => $lastMonthData,
        ]);
    }
}
