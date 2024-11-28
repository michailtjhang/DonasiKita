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
        return view('front.donation.donation');
    }
    public function detail_event()
    {
        return view('front.detail_event.detail_event');
    }
    public function event_category_all()
    {
        return view('front.event_category_all.event_category_all');
    }
    public function event_category_specific()
    {
        return view('front.event_category_specific.event_category_specific');
    }
    public function detail_donation()
    {
        return view('front.detail_donation.detail_donation');
    }
    public function blog_categories_specific()
    {
        return view('front.blog_categories.blog_categories_specific');
    }
    public function transfer_guest()
    {
        return view('front.payment_transfer.transfer_guest');
    }
    public function transfer_login()
    {
        return view('front.payment_transfer.transfer_login');
    }
    public function confirmationtransfer()
    {
        return view('front.payment_transfer.confirmationtransfer');
    }
}
