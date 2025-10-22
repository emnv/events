@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">{{ __('Events') }}</h2>
            </div>
            <div class="p-6">
                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <a href="{{ route('events.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded mb-4 transition duration-150">
                    {{ __('Create Event') }}
                </a>

                @if($events->isEmpty())
                    <p class="text-gray-600">{{ __('No events found.') }}</p>
                @else
                    <ul class="space-y-4">
                        @foreach($events as $event)
                            <li class="border border-gray-200 rounded-lg p-4 flex justify-between items-start hover:bg-gray-50 transition duration-150">
                                <div class="flex-1">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">{{ $event->title }}</h5>
                                    <p class="text-gray-600 mb-2">{{ $event->description }}</p>
                                    <div class="text-sm text-gray-600 space-y-1">
                                        <div><span class="font-medium">Venue:</span> {{ $event->venue ?? 'TBD' }}</div>
                                        <div><span class="font-medium">Start Date:</span> {{ $event->start_datetime ?? 'TBD' }}</div>
                                        <div><span class="font-medium">End Date:</span> {{ $event->end_datetime ?? 'TBD' }}</div>
                                        <div><span class="font-medium">Total Capacity:</span> {{ $event->total_capacity ?? 'TBD' }}</div>
                                        <div><span class="font-medium">Status:</span> <span class="inline-block px-2 py-1 text-xs font-semibold rounded {{ $event->status === 'upcoming' ? 'bg-blue-100 text-blue-800' : ($event->status === 'ongoing' ? 'bg-green-100 text-green-800' : ($event->status === 'completed' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800')) }}">{{ ucfirst($event->status) }}</span></div>
                                    </div>
                                </div>
                                <div class="flex gap-2 ml-4">
                                    <a href="{{ route('events.edit', $event->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white text-sm font-semibold px-3 py-1.5 rounded transition duration-150">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-3 py-1.5 rounded transition duration-150" onclick="return confirm('Are you sure you want to delete this event?')">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection