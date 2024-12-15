<?php

namespace App\Http\Controllers\Front;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EventRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventRegistrationNotification;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category', 'thumbnail', 'detailEvent', 'location')
            ->filter(request(['keyword', 'category']))
            ->whereHas('detailEvent', function ($query) {
                $query->where('end', '>=', now()); // Pastikan event belum selesai
            })
            ->latest()
            ->paginate(9); // 9 item per halaman

        return view('front.event.index', [
            'page_title' => 'Events',
            'events' => $events
        ]);
    }

    public function show(string $slug)
    {
        $event = Event::with('category', 'thumbnail', 'detailEvent', 'location')
            ->whereHas('detailEvent', function ($query) {
                $query->where('end', '>=', now()); // Pastikan event belum selesai
            })
            ->whereSlug($slug)
            ->firstOrFail();

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

        // Generate keywords dari deskripsi
        $keywords = $this->generateKeywords($event->description);

        return view('front.event.show', [
            'page_title' => $event->title,
            'event' => $event,
            'partisipan' => $partisipan,
            'userJoined' => $userJoined,
            'keywords' => $keywords
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
        $registration = EventRegistration::create([
            'registration_id' => $registrationId,
            'event_id' => $eventId,
            'user_id' => auth()->id(),
            'status' => $status,
        ]);
        // Kirim email notifikasi
        Mail::to(auth()->user()->email)->send(new EventRegistrationNotification($registration));

        return response()->json(['success' => true, 'message' => "Anda telah bergabung sebagai $status!"]);
    }

    function generateKeywords($description, $limit = 10)
    {
        // Hilangkan karakter spesial
        $description = strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', '', $description));

        // Pisahkan kata-kata
        $words = explode(' ', $description);

        // Hilangkan kata-kata umum (stop words)
        $stopWords = ['dan', 'atau', 'yang', 'di', 'ke', 'dari', 'ini', 'itu', 'adalah', 'sebagai', 'dengan', 'untuk'];
        $filteredWords = array_filter($words, function ($word) use ($stopWords) {
            return !in_array($word, $stopWords) && strlen($word) > 2;
        });

        // Hitung frekuensi kata
        $wordCounts = array_count_values($filteredWords);

        // Urutkan berdasarkan frekuensi
        arsort($wordCounts);

        // Ambil kata-kata paling sering muncul
        $keywords = array_keys(array_slice($wordCounts, 0, $limit, true));

        // Gabungkan menjadi string keyword
        return implode(', ', $keywords);
    }
}
