<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('venue', 'like', "%{$search}%")
                    ->orWhere('event_code', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $events = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Generate event code for create drawer
        $lastEvent = Event::orderBy('id', 'desc')->first();
        $eventCode = 'EVT-'.str_pad($lastEvent ? $lastEvent->id + 1 : 1, 5, '0', STR_PAD_LEFT);

        return view('events.index', compact('events', 'eventCode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastEvent = Event::orderBy('id', 'desc')->first();
        $eventCode = 'EVT-'.str_pad($lastEvent ? $lastEvent->id + 1 : 1, 5, '0', STR_PAD_LEFT);

        return view('events.create', compact('eventCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_code' => 'required|string|max:255',
            'title' => 'required',
            'description' => '',
            'venue' => '',
            'start_datetime' => '',
            'end_datetime' => '',
            'total_capacity' => '',
            'status' => 'in:upcoming,ongoing,completed,cancelled',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('status', __('Event created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'event_code' => 'required|string|max:255',
            'title' => 'required',
            'description' => '',
            'venue' => '',
            'start_datetime' => '',
            'end_datetime' => '',
            'total_capacity' => '',
            'status' => 'in:upcoming,ongoing,completed,cancelled',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('status', __('Event updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('status', __('Event deleted successfully.'));
    }
}
