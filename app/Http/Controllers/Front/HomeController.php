<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use App\Models\Need;
use App\Models\Event;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $last_articles = Blog::whereStatus(1)->take(3)->latest()->get();
            $last_events = Event::whereStatus('upcoming')->take(3)->latest()->get();
            $last_donation = Need::take(3)->latest()->get();
            
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
