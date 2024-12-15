<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use App\Models\Need;
use App\Models\Event;
use App\Models\Donation;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $last_articles = Blog::whereStatus(1)->take(3)->latest()->get();
        $last_events = Event::whereStatus('upcoming')->take(3)->latest()->get();
        $last_donation = Need::with(['donation', 'thumbnail'])
            ->where('days_left', '>', now())
            ->take(3)->latest()->get();

        // Hitung total donasi yang disetujui untuk setiap "Need"
        $last_donation->transform(function ($donation) {
            $donation->total_donated = Donation::where('need_id', $donation->need_id)
                ->where('status', 'approved')
                ->sum('amount');
            $donation->donator_count = Donation::where('need_id', $donation->need_id)
                ->where('status', 'approved')
                ->count(); // Hitung jumlah donatur (status disetujui)
            return $donation;
        });

        return view('front.home.home', [
            'last_articles' => $last_articles,
            'last_events' => $last_events,
            'last_donations' => $last_donation,
        ]);
    }
    public function about()
    {
        return view('front.about.about', [
            'page_title' => 'About Us',
        ]);
    }
}
