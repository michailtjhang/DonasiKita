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
            ->latest();

        return view('front.donation.index', [
            'page_title' => 'Donations',
            'donations' => $donations,
        ]);
    }

    public function show(String $slug)
    {
        $donation = Need::with(['donation', 'thumbnail'])->whereSlug($slug)->firstOrFail();

        return view('front.donation.show', [
            'page_title' => $donation->title,
            'donation' => $donation,
        ]);
    }

    public function showAmount(Request $request, String $slug)
    {
        // dd($request->all());
        $donation = Need::with(['donation', 'thumbnail'])->whereSlug($slug)->firstOrFail();

        return view('front.donation.donationAmount', [
            'page_title' => $donation->title,
            'donation' => $donation,
        ]);
    }

    public function showItem(Request $request, String $slug)
    {
        // dd($request->all());
        $donation = Need::with(['donation', 'thumbnail'])->whereSlug($slug)->firstOrFail();

        return view('front.donation.donationItem', [
            'page_title' => $donation->title,
            'donation' => $donation,
        ]);
    }

    public function confirm(Request $request, String $slug)
    {
        // dd($request->all());
        $donation = Need::with(['donation', 'thumbnail'])->whereSlug($slug)->firstOrFail();

        if ($request->amount) {
            return view('front.donation.confirmAmount', [
                'page_title' => $donation->title,
                'donation' => $donation,
                'amount' => $request->amount,
            ]);
        } else if ($request->item) {
            return view('front.donation.confirmItem', [
                'page_title' => $donation->title,
                'donation' => $donation,
                'amount' => $request->amount,
            ]);
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }
}
