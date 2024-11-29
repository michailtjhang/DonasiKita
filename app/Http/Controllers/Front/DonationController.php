<?php

namespace App\Http\Controllers\Front;

use App\Models\Need;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Need::with(['donation', 'thumbnail'])
            ->filter(request(['keyword']))
            ->latest()
            ->paginate(8);

        return view('front.donation.index', [
            'page_title' => 'Donations',
            'donations' => $donations,
        ]);
    }
}
