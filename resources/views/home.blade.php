@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Welcome, {{ Auth::user()->name }}</h1>
        <p class="text-gray-600 mt-1">Here's what's happening with your events.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Ongoing Events -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 bg-blue-50 border-b border-blue-100">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-blue-900">Ongoing Events</h2>
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                        {{ $ongoingEvents->count() }}
                    </span>
                </div>
            </div>
            <div class="p-6">
                @if($ongoingEvents->isEmpty())
                    <div class="text-center py-6">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No ongoing events</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new event.</p>
                        <div class="mt-6">
                            <a href="{{ route('events.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Create Event
                            </a>
                        </div>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($ongoingEvents as $event)
                            <div class="border rounded-lg p-4 hover:border-blue-200 transition-colors">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-medium text-gray-900">{{ $event->title }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <span class="inline-flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                {{ $event->venue }}
                                            </span>
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        Ongoing
                                    </span>
                                </div>
                                <div class="mt-3 text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($event->end_datetime)->format('M j, Y g:i A') }}</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('events.show', $event) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition">
                                        View Details ?
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @if($ongoingEvents->count() >= 5)
                            <a href="{{ route('events.index', ['status' => 'ongoing']) }}" class="block text-center text-sm text-blue-600 hover:text-blue-800 transition mt-4">
                                View All Ongoing Events
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 bg-purple-50 border-b border-purple-100">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-purple-900">Upcoming Events</h2>
                    <span class="bg-purple-100 text-purple-800 text-sm font-medium px-3 py-1 rounded-full">
                        {{ $upcomingEvents->count() }}
                    </span>
                </div>
            </div>
            <div class="p-6">
                @if($upcomingEvents->isEmpty())
                    <div class="text-center py-6">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No upcoming events</h3>
                        <p class="mt-1 text-sm text-gray-500">Schedule your next event.</p>
                        <div class="mt-6">
                            <a href="{{ route('events.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                                Schedule Event
                            </a>
                        </div>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($upcomingEvents as $event)
                            <div class="border rounded-lg p-4 hover:border-purple-200 transition-colors">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-medium text-gray-900">{{ $event->title }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <span class="inline-flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                {{ $event->venue }}
                                            </span>
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        Upcoming
                                    </span>
                                </div>
                                <div class="mt-3 text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($event->start_datetime)->format('M j, Y g:i A') }}</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('events.show', $event) }}" class="text-sm font-medium text-purple-600 hover:text-purple-800 transition">
                                        View Details ?
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @if($upcomingEvents->count() >= 5)
                            <a href="{{ route('events.index', ['status' => 'upcoming']) }}" class="block text-center text-sm text-purple-600 hover:text-purple-800 transition mt-4">
                                View All Upcoming Events
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('events.create') }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <div>
                        <h3 class="font-medium text-gray-900">Create Event</h3>
                        <p class="text-sm text-gray-500">Add a new event to your calendar</p>
                    </div>
                </a>
                <a href="{{ route('events.index') }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    <div>
                        <h3 class="font-medium text-gray-900">View All Events</h3>
                        <p class="text-sm text-gray-500">See your complete event list</p>
                    </div>
                </a>
                <a href="{{ route('events.index', ['status' => 'completed']) }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <div>
                        <h3 class="font-medium text-gray-900">Past Events</h3>
                        <p class="text-sm text-gray-500">Review completed events</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
