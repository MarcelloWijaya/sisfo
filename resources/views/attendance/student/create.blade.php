@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.add_attendance'))
@section('header', __('all.add_new_attendance'))

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('attendance.student.store') }}" method="POST">
                @csrf

                <div class="p-6 space-y-5">
                    @if (auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('director'))
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.branch') }} <span
                                    class="text-red-500">*</span></label>
                            <select name="branch_id" id="branch_id"
                                class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]" required>
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

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.student') }} <span
                                class="text-red-500">*</span></label>
                        <select name="student_id" id="student_id"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]" required>
                            <option value="">{{ __('all.select_student') }}</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }} ({{ $student->nis }})
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.schedule') }} <span
                                class="text-red-500">*</span></label>
                        <select name="schedule_id" id="schedule_id"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]" required>
                            <option value="">{{ __('all.select_schedule') }}</option>
                            @foreach ($schedules as $schedule)
                                <option value="{{ $schedule->id }}"
                                    {{ old('schedule_id') == $schedule->id ? 'selected' : '' }}>
                                    {{ $schedule->activity }} - {{ $schedule->day }} ({{ $schedule->start_time }} -
                                    {{ $schedule->end_time }})
                                </option>
                            @endforeach
                        </select>
                        @error('schedule_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.attendance_date') }} <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="attendance_date" value="{{ old('attendance_date', date('Y-m-d')) }}"
                            required class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]">
                        @error('attendance_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.status') }} <span
                                    class="text-red-500">*</span></label>
                            <select name="status" class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]" required>
                                @foreach ($statuses as $key => $status)
                                    <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
                                        {{ __("all.$key") }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.check_in_time') }}</label>
                            <input type="time" name="check_in_time" value="{{ old('check_in_time') }}"
                                class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.check_out_time') }}</label>
                        <input type="time" name="check_out_time" value="{{ old('check_out_time') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.notes') }}</label>
                        <textarea name="notes" rows="3" class="w-full px-3 py-2 border rounded-lg focus:ring-[#90C74A]"
                            placeholder="{{ __('all.notes_placeholder') }}">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t flex justify-end gap-3">
                    <a href="{{ route('attendance.student.index') }}"
                        class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                        {{ __('all.cancel') }}
                    </a>
                    <button type="submit" class="bg-[#90C74A] text-white px-6 py-2 rounded-lg hover:bg-[#7db33e]">
                        {{ __('all.save_attendance') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
