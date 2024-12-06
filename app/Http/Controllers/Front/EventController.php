<?php

namespace App\Http\Controllers\Front;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\EventRegistration;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category', 'thumbnail', 'detailEvent', 'location')
            ->filter(request(['keyword', 'category']))
            ->latest();

        return view('front.event.index', [
            'page_title' => 'Events',
            'events' => $events
        ]);
    }

    public function show(string $slug)
    {
        $event = Event::with('category', 'thumbnail', 'detailEvent', 'location')->whereSlug($slug)->firstOrFail();

        $partisipanPeserta = EventRegistration::where('event_id', $event->event_id)
            ->where('status', 'peserta')->get();
        $partisipanSukarelawan = EventRegistration::where('event_id', $event->event_id)
            ->where('status', 'sukarelawan')->get();

        // Periksa apakah user saat ini sudah join
        $userJoined = EventRegistration::where('event_id', $event->event_id)
            ->where('user_id', auth()->id())
            ->first();

        $partisipan = [
            'peserta' => $partisipanPeserta,
            'sukarelawan' => $partisipanSukarelawan
        ];

        return view('front.event.show', [
            'page_title' => $event->title,
            'event' => $event,
            'partisipan' => $partisipan,
            'userJoined' => $userJoined
        ]);
    }

    public function join(Request $request)
    {
        $request->validate([
            'event_id' => 'required|string',
            'status' => 'required|string|in:peserta,sukarelawan',
        ]);

        // Simpan data partisipasi ke database
        $status = $request->input('status');
        $eventId = $request->input('event_id');

        // Generate registration_id unik
        do {
            $registrationId = strtoupper(Str::random(5)); // Membuat 5 karakter acak
        } while (EventRegistration::where('registration_id', $registrationId)->exists()); // Pastikan unik

        // Contoh penyimpanan ke tabel "event_participants"
        EventRegistration::create([
            'registration_id' => $registrationId,
            'event_id' => $eventId,
            'user_id' => auth()->id(),
            'status' => $status,
        ]);

        return response()->json(['success' => true, 'message' => "Anda telah bergabung sebagai $status!"]);
    }
}
