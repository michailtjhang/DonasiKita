<?php

namespace App\Http\Controllers\Backend;

use App\Models\Event;
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
                        <a href="#" onclick="deleteData(this)" data-id="' . $events->id . '" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></a>
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
        //
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
