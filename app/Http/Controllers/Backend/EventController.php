<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Category;
use App\Models\Locations;
use App\Models\Thumbnail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $events = Event::where('user_id', auth()->user()->id)->get();
            return DataTables::of($events)
                ->addIndexColumn()
                ->addColumn('category_id', function ($events) {
                    return $events->category->name;
                })
                ->addColumn('status', function ($events) {
                    if ($events->status == 2) {
                        return '<span class="badge badge-success">Finished</span>';
                    } else if ($events->status == 1) {
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
                ->addColumn('action', function ($events) {
                    return '
                    <th>
                        <a href="event/' . $events->id . '" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-eye"></i></a>
                        <a href="event/' . $events->id . '/edit" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i></a>
                    </th>';
                })
                ->rawColumns(['category_id', 'status', 'action'])
                ->make();
        }
        return view('Backend.event.index', [
            'page_title' => 'Events',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'date' => 'required',
            'participant' => 'required|integer',
            'volunteer' => 'nullable|integer',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $data = $request->all();

        // Generate event_id unik
        do {
            $eventId = strtoupper(Str::random(5)); // Membuat 5 karakter acak
        } while (Event::where('event_id', $eventId)->exists()); // Pastikan unik

        $data['event_id'] = $eventId;

        // upload image
        $file = $request->file('img'); // get file
        $filename = uniqid() . '.' . $file->getClientOriginalExtension(); // generate filename randomnes and extension
        $file->move(storage_path('app/public/cover'), $filename); // path file

        // Tambahkan slug dan views
        $data['slug'] = Str::slug($data['title']);
        $data['views'] = 0;
        $data['description'] = $data['content'];
        $data['user_id'] = auth()->user()->id;
        $data['capacity_participants'] = $data['participant'];

        // Jika ada input 'volunteer'
        if ($data['volunteer']) {
            $data['capacity_volunteers'] = $data['volunteer'];
        }

        // Proses tanggal dari input 'date'
        $dateRange = explode(' - ', $data['date']);
        $data['start'] = Carbon::createFromFormat('m/d/Y h:i A', trim($dateRange[0]));
        $data['end'] = Carbon::createFromFormat('m/d/Y h:i A', trim($dateRange[1]));

        // Simpan data ke tabel Blog
        $event = Event::create($data);

        // Tambahkan data thumbnail 
        $dataThumbnail['file_path'] = $filename;
        $dataThumbnail['type'] = 'Image';
        $dataThumbnail['event_id'] = $event->event_id;

        // Simpan data ke tabel Thumbnail
        Thumbnail::create($dataThumbnail);

        // Tambahkan data location
        $datalocation['name_location'] = $data['location'];
        $datalocation['latitude'] = $data['latitude'];
        $datalocation['longitude'] = $data['longitude'];
        $datalocation['event_id'] = $event->event_id;

        // Simpan data ke tabel Locations
        Locations::create($datalocation);

        return redirect()->route('event.index')->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
        $event = Event::find($id);
        return view('Backend.event.edit', [
            'page_title' => 'Edit Event',
            'event' => $event,
            'categories' => Category::get(),
            'date' => Carbon::parse($event->start)->format('m/d/Y h:i A') . ' - ' . Carbon::parse($event->end)->format('m/d/Y h:i A'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'date' => 'required',
            'participant' => 'required|integer',
            'volunteer' => 'nullable|integer',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $event = Event::with('thumbnail', 'location')->findOrFail($id); // Ambil event dengan relasi terkait
        $data = $request->all();

        // Update file gambar jika ada file baru yang diupload
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/cover'), $filename);

            // Hapus file lama jika ada
            if ($event->thumbnail && $event->thumbnail->file_path) {
                $oldFilePath = storage_path('app/public/cover/' . $event->thumbnail->file_path);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Update atau buat thumbnail baru
            $event->thumbnail()->updateOrCreate(
                ['event_id' => $event->event_id],
                [
                    'file_path' => $filename,
                    'type' => 'Image',
                ]
            );
        }

        // Update slug
        $data['slug'] = Str::slug($data['title']);

        // Jika ada input 'volunteer'
        $data['capacity_volunteers'] = $data['volunteer'] ?? 0;

        // Proses tanggal dari input 'date'
        $dateRange = explode(' - ', $data['date']);
        $data['start'] = Carbon::createFromFormat('m/d/Y h:i A', trim($dateRange[0]));
        $data['end'] = Carbon::createFromFormat('m/d/Y h:i A', trim($dateRange[1]));

        // Update data event
        $event->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'description' => $data['content'],
            'category_id' => $data['category_id'],
            'status' => $data['status'] ?? $event->status, // Pertahankan status jika tidak ada
            'start' => $data['start'],
            'end' => $data['end'],
            'capacity_participants' => $data['participant'],
            'capacity_volunteers' => $data['capacity_volunteers'],
        ]);

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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
