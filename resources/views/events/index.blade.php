@extends('layouts.app')
@section('content')
<div x-data="{ 
    createDrawerOpen: false, 
    editDrawerOpen: false, 
    editEventId: null,
    openEditDrawer(eventId) {
        this.editEventId = eventId;
        this.editDrawerOpen = true;
    }
}" class="container mx-auto px-6 py-6">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Events Management</h2>
            <button @click="createDrawerOpen = true" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create Event
            </button>
        </div>

        <!-- Success Message -->
        @if (session('status'))
            <div class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md text-sm" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('status') }}
                </div>
            </div>
        @endif

        <!-- Search and Filter -->
        <div class="px-6 py-4 border-b border-gray-200">
            <form method="GET" action="{{ route('events.index') }}" class="flex flex-wrap gap-3 items-end">
                <!-- Search Input -->
                <div class="flex-1 min-w-[250px]">
                    <label for="search" class="block text-xs font-medium text-gray-700 mb-1">Search</label>
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               id="search" 
                               value="{{ request('search') }}"
                               placeholder="Search by title, venue, or code..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="w-48">
                    <label for="status" class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" 
                            id="status" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">All Status</option>
                        <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition duration-150">
                        Filter
                    </button>
                    @if(request('search') || request('status'))
                        <a href="{{ route('events.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-md transition duration-150">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table -->
        @if($events->isEmpty())
            <div class="px-6 py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No events found</h3>
                <p class="mt-1 text-sm text-gray-500">
                    @if(request('search') || request('status'))
                        No events match your search criteria. Try adjusting your filters.
                    @else
                        Get started by creating a new event.
                    @endif
                </p>
                <div class="mt-6">
                    @if(request('search') || request('status'))
                        <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-md transition duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear Filters
                        </a>
                    @else
                        <button @click="createDrawerOpen = true" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Create Event
                        </button>
                    @endif
                </div>
            </div>
        @else
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[30%]">Event</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Venue</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[18%]">Schedule</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[10%]">Capacity</th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Status</th>
                        <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-[12%]">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($events as $event)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-4 py-3">
                                <div class="text-sm font-medium text-gray-900 truncate">{{ $event->title }}</div>
                                <div class="text-xs text-gray-500 truncate">{{ Str::limit($event->description, 40) }}</div>
                            </td>
                            <td class="px-3 py-3">
                                <div class="text-sm text-gray-900 truncate">{{ Str::limit($event->venue ?? 'TBD', 20) }}</div>
                            </td>
                            <td class="px-3 py-3">
                                <div class="text-sm text-gray-900 whitespace-nowrap">{{ \Carbon\Carbon::parse($event->start_datetime)->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($event->start_datetime)->format('h:i A') }}</div>
                            </td>
                            <td class="px-3 py-3">
                                <div class="text-sm text-gray-900">{{ $event->total_capacity ?? 'N/A' }}</div>
                            </td>
                            <td class="px-3 py-3">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $event->status === 'upcoming' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $event->status === 'ongoing' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $event->status === 'completed' ? 'bg-gray-100 text-gray-800' : '' }}
                                    {{ $event->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex justify-end gap-2">
                                    <button @click="openEditDrawer({{ $event->id }})" class="text-blue-600 hover:text-blue-900 transition duration-150" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition duration-150" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            @if($events->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing <span class="font-medium">{{ $events->firstItem() }}</span> to <span class="font-medium">{{ $events->lastItem() }}</span> of <span class="font-medium">{{ $events->total() }}</span> results
                        </div>
                        <div>
                            {{ $events->links() }}
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>

    <!-- Create Event Drawer -->
    <template x-if="createDrawerOpen">
        <div x-data="{ open: true }" @open-drawer.window="open = true">
            <x-event-drawer :event-code="$eventCode" mode="create" />
        </div>
    </template>

    <!-- Edit Event Drawers -->
    @foreach($events as $event)
        <template x-if="editDrawerOpen && editEventId === {{ $event->id }}">
            <div x-data="{ open: true }">
                <x-event-drawer :event="$event" mode="edit" />
            </div>
        </template>
    @endforeach
</div>
@endsection
