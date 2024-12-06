<?php

namespace App\Http\Controllers\Front;

use App\Models\Need;
use App\Models\Donation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TemporaryDonations;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Need::with(['donation', 'thumbnail'])
            ->filter(request(['keyword']))
            ->latest()
            ->paginate(9); // 9 item per halaman

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

    public function storeTemporaryAmount(Request $request, String $slug)
    {
        $need = Need::whereSlug($slug)->firstOrFail();
        
        // Generate temp_id unik
        do {
            $donateNeedId = strtoupper(Str::random(5)); // Membuat 5 karakter acak
        } while (TemporaryDonations::where('temp_id', $donateNeedId)->exists()); // Pastikan unik

        if (Auth::check()) {
            $request->validate([
                'amount' => 'required|numeric|min:1000',
                'bank' => 'required|string|max:50',
            ]);
            $data = $request->all();

            $temporaryDonation = TemporaryDonations::create([
                'temp_id' => $donateNeedId,
                'amount' => $data['amount'],
                'user_id' => Auth::user()->id,
                'need_id' => $need->need_id,
                'bank' => $data['bank'],
                'email' => Auth::user()->email,
                'name' => Auth::user()->name,
                'status' => 'pending',
            ]);
        } else {
            $request->validate([
                'amount' => 'required|numeric|min:1000',
                'bank' => 'required|string|max:50',
                'name' => 'nullable|string|max:30',
                'email' => 'nullable|email|max:30',
            ]);

            $data = $request->all();

            // Data diri untuk guest
            $temporaryDonation = TemporaryDonations::create([
                'temp_id' => $donateNeedId,
                'amount' => $data['amount'],
                'need_id' => $need->need_id,
                'bank' => $data['bank'],
                'email' => $data['email'],
                'name' => $data['name'],
                'status' => 'pending',
            ]);
        }

        return redirect()->route('donations.amount', ['id' => $temporaryDonation->id]);
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
