@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.bulk_attendance'))
@section('header', __('all.bulk_attendance'))

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('attendance.student.bulk.store') }}" method="POST">
                @csrf
                <input type="hidden" name="schedule_id" value="{{ $schedule->id ?? '' }}">
                <input type="hidden" name="attendance_date" value="{{ $date ?? date('Y-m-d') }}">

                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <label class="text-xs text-gray-500">{{ __('all.schedule') }}</label>
                            <p class="font-semibold">{{ $schedule->activity ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <label class="text-xs text-gray-500">{{ __('all.date') }}</label>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($date ?? date('Y-m-d'))->format('d F Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">
                                        {{ __('all.student_name') }}</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">{{ __('all.nis') }}
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">{{ __('all.status') }}
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">{{ __('all.notes') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse ($students as $index => $student)
                                    <tr>
                                        <td class="px-4 py-3 font-medium">{{ $student->name }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $student->nis }}</td>
                                        <td class="px-4 py-3">
                                            <select name="attendances[{{ $index }}][status]"
                                                class="px-2 py-1 border rounded-lg text-sm focus:ring-[#90C74A]">
                                                <option value="present">{{ __('all.present') }}</option>
                                                <option value="absent">{{ __('all.absent') }}</option>
                                                <option value="late">{{ __('all.late') }}</option>
                                                <option value="excused">{{ __('all.excused') }}</option>
                                            </select>
                                            <input type="hidden" name="attendances[{{ $index }}][student_id]"
                                                value="{{ $student->id }}">
                                            <input type="hidden" name="attendances[{{ $index }}][schedule_id]"
                                                value="{{ $schedule->id }}">
                                        </td>
                                        <td class="px-4 py-3">
                                            <input type="text" name="attendances[{{ $index }}][notes]"
                                                class="w-full px-2 py-1 border rounded-lg text-sm"
                                                placeholder="{{ __('all.notes_placeholder') }}">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                            {{ __('all.no_students_found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t flex justify-end gap-3">
                    <a href="{{ route('attendance.student.index') }}"
                        class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                        {{ __('all.cancel') }}
                    </a>
                    <button type="submit" class="bg-[#90C74A] text-white px-6 py-2 rounded-lg hover:bg-[#7db33e]">
                        {{ __('all.save_all') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
