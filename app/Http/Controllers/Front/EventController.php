<?php

namespace App\Http\Controllers\Front;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category', 'thumbnail', 'detailEvent', 'location')->latest()->paginate(6);

        return view('front.event.index', [
            'title' => 'Event',
            'events' => $events
        ]);
    }

    public function show(string $slug)
    {
        $event = Event::with('category', 'thumbnail', 'detailEvent', 'location')->whereSlug($slug)->firstOrFail();

        return view('front.event.show', [
            'title' => $event->title,
            'event' => $event,
        ]);
    }
}
