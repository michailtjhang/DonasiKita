<?php

namespace App\Http\Controllers\Backend;

use App\Models\Event;
use Illuminate\Support\Str;
use App\Models\Category;
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
            $events = Event::get();
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
                    } 
                    else {
                        return '<span class="badge badge-Secondary">Upcoming</span>';
                    }
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
        dd($request->all());
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'cover' => 'required',
            'participant' => 'required',
            'volunteer' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $data = $request->all();

        // Generate blog_id unik
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
        $data['user_id'] = auth()->user()->id;

        // Simpan data ke tabel Blog
        $event = Event::create($data);

        // Tambahkan data thumbnail 
        $dataThumbnail['file_path'] = $filename;
        $dataThumbnail['type'] = 'Image';
        $dataThumbnail['event_id'] = $event->event_id;

        // Simpan data ke tabel Thumbnail
        // Thumbnail::create($dataThumbnail);

        return redirect()->route('event.index')->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
