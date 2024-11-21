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
    public function detail_event()
    {
        return view('front.detail_event.detail_event');
    }
    public function detail_donation()
    {
        return view('front.detail_donation.detail_donation');
    }
}
