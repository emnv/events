<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = now();
        
        $ongoingEvents = Event::query()
            ->where('start_datetime', '<=', $now)
            ->where('end_datetime', '>=', $now)
            ->where('status', 'ongoing')
            ->orderBy('end_datetime')
            ->limit(5)
            ->get();

        $upcomingEvents = Event::query()
            ->where('start_datetime', '>', $now)
            ->where('status', 'upcoming')
            ->orderBy('start_datetime')
            ->limit(5)
            ->get();

        return view('home', compact('ongoingEvents', 'upcomingEvents'));
    }
}
