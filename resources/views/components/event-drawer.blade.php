<!-- Drawer Overlay -->
<div x-show="open" 
     x-cloak
     @click="open = false; $dispatch('drawer-closed')" 
     class="fixed inset-0 bg-gray-900/50 z-40 transition-opacity">
</div>

<!-- Drawer Panel -->
<div x-show="open"
     x-cloak
     x-transition:enter="transform transition ease-out duration-300"
     x-transition:enter-start="translate-x-full"
     x-transition:enter-end="translate-x-0"
     x-transition:leave="transform transition ease-in duration-200"
     x-transition:leave-start="translate-x-0"
     x-transition:leave-end="translate-x-full"
     class="fixed right-0 top-0 h-full w-[600px] bg-white shadow-xl z-50 overflow-y-auto">
    
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">
                {{ $mode === 'create' ? 'Create New Event' : 'Edit Event' }}
            </h2>
            <button @click="open = false; $dispatch('drawer-closed')" 
                    type="button"
                    class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form method="POST" 
              x-bind:action="editEventId ? '{{ route('events.index') }}/' + editEventId : '{{ route('events.store') }}'"
              class="space-y-6">
            @csrf
            <input type="hidden" name="_method" x-bind:value="editEventId ? 'PUT' : 'POST'">

            <div>
                <label for="event_code" class="block text-sm font-medium text-gray-700 mb-2">Event Code</label>
                <input type="text" 
                       name="event_code" 
                       id="event_code" 
                       value="{{ $mode === 'create' ? $eventCode : $event?->event_code }}"
                       readonly
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Event Title *</label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title', $event?->title) }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" 
                          id="description" 
                          rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $event?->description) }}</textarea>
            </div>

            <div>
                <label for="venue" class="block text-sm font-medium text-gray-700 mb-2">Venue</label>
                <input type="text" 
                       name="venue" 
                       id="venue" 
                       value="{{ old('venue', $event?->venue) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="start_datetime" class="block text-sm font-medium text-gray-700 mb-2">Start Date & Time</label>
                    <input type="datetime-local" 
                           name="start_datetime" 
                           id="start_datetime" 
                           value="{{ old('start_datetime', $event?->start_datetime?->format('Y-m-d\TH:i')) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="end_datetime" class="block text-sm font-medium text-gray-700 mb-2">End Date & Time</label>
                    <input type="datetime-local" 
                           name="end_datetime" 
                           id="end_datetime" 
                           value="{{ old('end_datetime', $event?->end_datetime?->format('Y-m-d\TH:i')) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="total_capacity" class="block text-sm font-medium text-gray-700 mb-2">Total Capacity</label>
                    <input type="number" 
                           name="total_capacity" 
                           id="total_capacity" 
                           value="{{ old('total_capacity', $event?->total_capacity) }}"
                           min="1"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" 
                            id="status" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="upcoming" {{ old('status', $event?->status) === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="ongoing" {{ old('status', $event?->status) === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ old('status', $event?->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status', $event?->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <button @click="open = false; $dispatch('drawer-closed')" 
                        type="button"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    {{ $mode === 'create' ? 'Create Event' : 'Update Event' }}
                </button>
            </div>
        </form>
    </div>
</div>
