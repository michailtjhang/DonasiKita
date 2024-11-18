<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        return view('front.home.home');
    }
}
