<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Config;

class HomeController extends Controller
{
    public function home()
    {
        return view('front.home.home');
    }
    public function about()
    {
        return view('front.about.about');
    }
    public function donation()
    {
        return view('front.donation.index');
    }
    public function event()
    {
        return view('front.event.event');
    }
    public function detail_event()
    {
        return view('front.detail_event.detail_event');
    }
    public function event_category_specific()
    {
        return view('front.event_category_specific.event_category_specific');
    }
    public function detail_donation()
    {
        return view('front.detail_donation.detail_donation');
    }
}
