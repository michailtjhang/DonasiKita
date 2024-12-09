<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Category;
use App\Models\Locations;
use App\Models\Thumbnail;
use App\Models\DetailEvent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Buglinjo\LaravelWebp\Facades\Webp;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Event', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // Cek masing-masing izin untuk Add, Edit, dan Delete
        $data['PermissionAdd'] = PermissionRole::getPermission('Add Event', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRole::getPermission('Edit Event', Auth::user()->role_id);
        $data['PermissionShow'] = PermissionRole::getPermission('View Event', Auth::user()->role_id);

        // Jika request adalah Ajax untuk DataTables
        if (request()->ajax()) {
            $events = Event::get();
            return DataTables::of($events)
                ->addIndexColumn()
                ->addColumn('category_id', function ($events) {
                    return $events->category->name;
                })
                ->addColumn('status', function ($events) {
                    if ($events->status == 'finished') {
                        return '<span class="badge badge-success">Finished</span>';
                    } else if ($events->status == 'ongoing') {
                        return '<span class="badge badge-warning">Ongoing</span>';
                    } else {
                        return '<span class="badge badge-secondary">Upcoming</span>';
                    }
                })
                ->addColumn('date', function ($events) {
                    // Format start dan end menjadi rentang tanggal
                    $start = Carbon::parse($events->start)->format('d M Y h:i A');
                    $end = Carbon::parse($events->end)->format('d M Y h:i A');
                    return "$start - $end";
                })
                ->addColumn('action', function ($events) use ($data) {
                    $buttons = '';

                    // Tambahkan tombol show jika izin Show ada
                    if (!empty($data['PermissionShow'])) {
                        $buttons .= '<a href="event/' . $events->id . '" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-eye"></i></a>';
                    }

                    // Tambahkan tombol Edit jika izin Edit ada
                    if (!empty($data['PermissionEdit'])) {
                        $buttons .= '<a href="event/' . $events->id . '/edit" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i></a>';
                    }

                    return $buttons;
                })
                ->rawColumns(['category_id', 'status', 'action'])
                ->make(true);
        }
        return view('Backend.event.index', [
            'page_title' => 'Events',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Add Event', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        return view('Backend.event.create', [
            'categories' => Category::get(),
            'page_title' => 'Create Event',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Add Event', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|max:5000',
            'organizer' => 'required|string|max:255',
            'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'date' => 'required|string',
            'participant' => 'required|integer|min:1',
            'participant_description' => 'required|string|max:500',
            'volunteer' => 'nullable|integer|min:0',
            'volunteer_description' => 'nullable|string|max:500',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'when_volunteer' => 'required|boolean',
        ]);

        $data = $request->all();

        // Generate event_id unik
        do {
            $eventId = strtoupper(Str::random(5)); // Membuat 5 karakter acak
        } while (Event::where('event_id', $eventId)->exists()); // Pastikan unik

        try {
            // Tambahkan slug dan views
            $eventData = [
                'event_id' => $eventId,
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'description' => $data['content'],
                'organizer' => $data['organizer'],
                'user_id' => auth()->user()->id,
                'category_id' => $data['category_id'],
                'status' => 'upcoming', // Default status
            ];

            // Simpan data ke tabel Blog
            $event = Event::create($eventData);

            // Proses tanggal dari input 'date'
            $dateRange = explode(' - ', $data['date']);

            // Data untuk tabel `detail_events`
            $detailData = [
                'event_id' => $event->event_id, // id dari event
                'start' => Carbon::createFromFormat('m/d/Y h:i A', trim($dateRange[0])),
                'end' => Carbon::createFromFormat('m/d/Y h:i A', trim($dateRange[1])),
                'capacity_participants' => $data['participant'],
                'description_participants' => $data['participant_description'] ?? '',
                'requires_volunteers' => $data['when_volunteer'],
            ];

            if (!empty($data['volunteer'])) {
                $detailData['capacity_volunteers'] = $data['volunteer'];
                $detailData['description_volunteers'] = $data['volunteer_description'] ?? '';
            }

            // Simpan ke tabel `detail_events`
            DetailEvent::create($detailData);

            // Upload image ke Cloudinary
            $file = $request->file('img');

            // Nama file WebP
            $webpFileName = time() . '.webp';

            // Path folder tujuan
            $tempFolder = public_path('temp');

            // Pastikan folder `temp` ada, jika tidak, buat folder
            if (!file_exists($tempFolder)) {
                mkdir($tempFolder, 0755, true); // Membuat folder dengan izin baca/tulis
            }

            // Path tujuan penyimpanan sementara file WebP
            $webpPath = $tempFolder . '/' . $webpFileName;

            // Konversi gambar ke WebP
            WebP::make($file)
                ->quality(65) // Atur kualitas gambar (opsional, default: 70)
                ->save($webpPath);

            // Upload image baru ke Cloudinary
            $cloudinaryResponse = cloudinary()->upload($webpPath, [
                'folder' => 'cover',
                'use_filename' => true,
                'unique_filename' => true,
            ]);

            // Simpan URL dan Public ID dari Cloudinary
            $cloudinaryUrl = $cloudinaryResponse->getSecurePath();
            $publicId = $cloudinaryResponse->getPublicId();

            // Simpan data Thumbnail ke tabel Thumbnail
            Thumbnail::create([
                'file_path' => $cloudinaryUrl,
                'id_file' => $publicId,
                'type' => 'Image',
                'event_id' => $event->event_id,
            ]);

            // Tambahkan data location
            $datalocation['name_location'] = $data['location'];
            $datalocation['latitude'] = $data['latitude'];
            $datalocation['longitude'] = $data['longitude'];
            $datalocation['event_id'] = $event->event_id;

            // Simpan data ke tabel Locations
            Locations::create($datalocation);

            return redirect()->route('event.index')->with('success', 'Data added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('View Event', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // Cari event berdasarkan ID
        $event = Event::with(['category', 'thumbnail', 'location'])->findOrFail($id);

        // Konversi start dan end menjadi instance Carbon
        $event->start = Carbon::parse($event->start);
        $event->end = Carbon::parse($event->end);

        // Kirim data ke view
        return view('Backend.event.show', [
            'page_title' => 'Detail Event Blog',
            'event' => $event,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Edit Event', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        $event = Event::find($id);
        if ($event->whereStatus('finished')->exists()) {
            return back()->with('error', 'Event already finished');
        }

        // Make sure the start and end fields are Carbon instances
        $startDate = Carbon::parse($event->detailEvent->start)->format('m/d/Y h:i A');
        $endDate = Carbon::parse($event->detailEvent->end)->format('m/d/Y h:i A');

        return view('Backend.event.edit', [
            'page_title' => 'Edit Event',
            'event' => $event,
            'categories' => Category::get(),
            'date' => $startDate . ' - ' . $endDate, // Passing formatted date range
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Edit Event', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('events')->ignore($id),
            ],
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|max:5000',
            'organizer' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'date' => 'required|string',
            'participant' => 'required|integer|min:1',
            'participant_description' => 'required|string|max:500',
            'volunteer' => 'nullable|integer|min:0',
            'volunteer_description' => 'nullable|string|max:500',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'when_volunteer' => 'required|boolean',
            'status' => 'required|string|in:ongoing,finished',
        ]);

        $event = Event::with('thumbnail', 'location', 'detailEvent')->findOrFail($id); // Ambil event dengan relasi terkait
        $data = $request->all();

        try {
            // Update file gambar jika ada file baru yang diupload
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                
                // Nama file WebP
                $webpFileName = time() . '.webp';

                // Path folder tujuan
                $tempFolder = public_path('temp');

                // Pastikan folder `temp` ada, jika tidak, buat folder
                if (!file_exists($tempFolder)) {
                    mkdir($tempFolder, 0755, true); // Membuat folder dengan izin baca/tulis
                }

                // Path tujuan penyimpanan sementara file WebP
                $webpPath = $tempFolder . '/' . $webpFileName;

                // Konversi gambar ke WebP
                WebP::make($file)
                    ->quality(65) // Atur kualitas gambar (opsional, default: 70)
                    ->save($webpPath);

                // Upload image baru ke Cloudinary
                $cloudinaryResponse = cloudinary()->upload($webpPath, [
                    'folder' => 'cover',
                    'use_filename' => true,
                    'unique_filename' => true,
                ]);

                $cloudinaryUrl = $cloudinaryResponse->getSecurePath();
                $publicId = $cloudinaryResponse->getPublicId();

                // Hapus file lama dari Cloudinary jika ada
                if (!empty($event->thumbnail->id_file)) {
                    cloudinary()->destroy($event->thumbnail->id_file);
                }

                // Update data Thumbnail
                $event->thumbnail->update([
                    'file_path' => $cloudinaryUrl,
                    'id_file' => $publicId,
                    'type' => 'Image',
                ]);
            }

            // Update slug
            $data['slug'] = Str::slug($data['title']);

            // Proses tanggal dari input 'date'
            $dateRange = explode(' - ', $data['date']);
            $data['start'] = Carbon::createFromFormat('m/d/Y h:i A', trim($dateRange[0]));
            $data['end'] = Carbon::createFromFormat('m/d/Y h:i A', trim($dateRange[1]));

            // Update data event
            $event->update([
                'title' => $data['title'],
                'slug' => $data['slug'],
                'description' => $data['content'],
                'organizer' => $data['organizer'],
                'category_id' => $data['category_id'],
                'status' => $data['status'] ?? $event->status, // Pertahankan status jika tidak ada
            ]);

            // Update Detail Event (Tabel detail_events)
            $event->detailEvent()->updateOrCreate(
                ['event_id' => $event->event_id], // Gunakan event_id yang sesuai
                [
                    'start' => $data['start'],
                    'end' => $data['end'],
                    'capacity_participants' => $data['participant'],
                    'description_participants' => $data['participant_description'],
                    'capacity_volunteers' => $data['volunteer'] ?? 0,
                    'description_volunteers' => $data['volunteer_description'] ?? '',
                    'requires_volunteers' => $data['when_volunteer'],
                ]
            );

            // Update lokasi
            $event->location()->updateOrCreate(
                ['event_id' => $event->event_id],
                [
                    'name_location' => $data['location'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                ]
            );

            return redirect()->route('event.index')->with('success', 'Data updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
