@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.add_schedule'))
@section('header', __('all.add_new_schedule'))

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('classrooms.store') }}" method="POST">
                @csrf

                <div class="p-6 space-y-5">
                    @if (auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('director'))
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.branch') }} <span
                                    class="text-red-500">*</span></label>
                            <select name="branch_id" class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]" required>
                                <option value="">{{ __('all.select_branch') }}</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ old('branch_id', $branchId) == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('branch_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <input type="hidden" name="branch_id" value="{{ $branchId }}">
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.day') }} <span
                                    class="text-red-500">*</span></label>
                            <select name="day" class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]" required>
                                <option value="">{{ __('all.select_day') }}</option>
                                @foreach ($days as $key => $day)
                                    <option value="{{ $key }}" {{ old('day') == $key ? 'selected' : '' }}>
                                        {{ __("all.$key") }}</option>
                                @endforeach
                            </select>
                            @error('day')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.room') }} <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="room" value="{{ old('room') }}" required
                                class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]" placeholder="e.g., A-101">
                            @error('room')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.start_time') }} <span
                                    class="text-red-500">*</span></label>
                            <input type="time" name="start_time" value="{{ old('start_time') }}" required
                                class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]">
                            @error('start_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.end_time') }} <span
                                    class="text-red-500">*</span></label>
                            <input type="time" name="end_time" value="{{ old('end_time') }}" required
                                class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]">
                            @error('end_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.level') }} <span
                                    class="text-red-500">*</span></label>
                            <select name="level" class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]" required>
                                <option value="">{{ __('all.select_level') }}</option>
                                @foreach ($levels as $key => $level)
                                    <option value="{{ $key }}" {{ old('level') == $key ? 'selected' : '' }}>
                                        {{ __("all.$key") }}</option>
                                @endforeach
                            </select>
                            @error('level')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.teacher') }} <span
                                    class="text-red-500">*</span></label>
                            <select name="teacher_id" class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]"
                                required>
                                <option value="">{{ __('all.select_teacher') }}</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.activity') }} <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="activity" value="{{ old('activity') }}" required
                            class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]"
                            placeholder="e.g., English Class, Math Tutoring">
                        @error('activity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.quota') }}</label>
                        <input type="number" name="quota" value="{{ old('quota', 20) }}" min="1"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]">
                        @error('quota')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t flex justify-end gap-3">
                    <a href="{{ route('classrooms.index') }}"
                        class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                        {{ __('all.cancel') }}
                    </a>
                    <button type="submit" class="bg-[#90C74A] text-white px-6 py-2 rounded-lg hover:bg-[#7db33e]">
                        {{ __('all.create_schedule') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
