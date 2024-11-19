<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('front.home');
    }
    public function about()
    {
        return view('front.about');
    }
    public function donation()
    {
        return view('front.donation.index');
    }
    public function event()
    {
        return view('front.event.index');
    }
}
