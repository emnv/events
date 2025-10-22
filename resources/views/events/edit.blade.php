@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">{{ __('Edit Event') }}</h2>
            </div>
            <form action="{{ route('events.update', $event->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label for="event_code" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Event Code') }}</label>
                        <input readonly type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-500 cursor-not-allowed" id="event_code" name="event_code" value="{{ old('event_code', $event->event_code) }}">
                        @error('event_code')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Title') }} <span class="text-red-500">*</span></label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="title" name="title" value="{{ old('title', $event->title) }}" required>
                        @error('title')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Description') }}</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="description" name="description" rows="3">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="venue" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Venue') }}</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="venue" name="venue" value="{{ old('venue', $event->venue) }}">
                        @error('venue')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="start_datetime" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Start Date and Time') }}</label>
                        <input type="datetime-local" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="start_datetime" name="start_datetime" value="{{ old('start_datetime', $event->start_datetime) }}">
                        @error('start_datetime')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="end_datetime" class="block text-sm font-medium text-gray-700 mb-1">{{ __('End Date and Time') }}</label>
                        <input type="datetime-local" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="end_datetime" name="end_datetime" value="{{ old('end_datetime', $event->end_datetime) }}">
                        @error('end_datetime')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="total_capacity" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Total Capacity') }}</label>
                        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="total_capacity" name="total_capacity" value="{{ old('total_capacity', $event->total_capacity) }}">
                        @error('total_capacity')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Status') }}</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" id="status" name="status">
                            <option value="upcoming" {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>{{ __('Upcoming') }}</option>
                            <option value="ongoing" {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>{{ __('Ongoing') }}</option>
                            <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                            <option value="cancelled" {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
                        </select>
                        @error('status')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end gap-2">
                    <a href="{{ route('events.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded transition duration-150">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded transition duration-150">
                        {{ __('Update Event') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection