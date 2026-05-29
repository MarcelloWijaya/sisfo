@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.teacher_attendance'))
@section('header', __('all.teacher_attendance'))

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">{{ __('all.attendance_list') }}</h3>
                <p class="text-sm text-gray-500">{{ __('all.manage_teacher_attendance') }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('attendance.teacher.bulk.create') }}?branch_id={{ request('branch_id') }}&attendance_date={{ request('date', date('Y-m-d')) }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2.5 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    {{ __('all.bulk_attendance') }}
                </a>
                <a href="{{ route('attendance.teacher.create') }}"
                    class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-5 py-2.5 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('all.add_attendance') }}
                </a>
            </div>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <form method="GET" class="flex flex-col md:flex-row gap-3">
                @if (auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('director'))
                    <select name="branch_id" class="px-4 py-2.5 border border-gray-300 rounded-xl">
                        <option value="">{{ __('all.all_branches') }}</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}"
                                {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                @endif

                <select name="teacher_id" class="px-4 py-2.5 border border-gray-300 rounded-xl">
                    <option value="">{{ __('all.all_teachers') }}</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->full_name }}
                        </option>
                    @endforeach
                </select>

                <input type="date" name="date" value="{{ request('date') }}"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl">

                <select name="status" class="px-4 py-2.5 border border-gray-300 rounded-xl">
                    <option value="">{{ __('all.all_status') }}</option>
                    <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>{{ __('all.present') }}
                    </option>
                    <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>{{ __('all.absent') }}
                    </option>
                    <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>{{ __('all.late') }}
                    </option>
                    <option value="excused" {{ request('status') == 'excused' ? 'selected' : '' }}>{{ __('all.excused') }}
                    </option>
                    <option value="sick" {{ request('status') == 'sick' ? 'selected' : '' }}>{{ __('all.sick') }}
                    </option>
                    <option value="leave" {{ request('status') == 'leave' ? 'selected' : '' }}>{{ __('all.leave') }}
                    </option>
                </select>

                <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2.5 rounded-xl">
                    {{ __('all.filter') }}
                </button>

                @if (request()->anyFilled(['branch_id', 'teacher_id', 'date', 'status']))
                    <a href="{{ route('attendance.teacher.index') }}"
                        class="text-gray-500 hover:text-gray-700 px-4 py-2.5">
                        {{ __('all.clear') }}
                    </a>
                @endif
            </form>
        </div>

        <!-- Teacher Attendance Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">{{ __('all.date') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">{{ __('all.teacher_name') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">{{ __('all.teacher_id') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">{{ __('all.status') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">{{ __('all.check_in') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">{{ __('all.check_out') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">{{ __('all.recorded_by') }}
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">{{ __('all.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($attendances as $attendance)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm">
                                    {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 font-medium">{{ $attendance->teacher->full_name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm">{{ $attendance->teacher->teacher_id ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-medium {{ $attendance->status_badge }}">
                                        {{ __("all.{$attendance->status}") }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">{{ $attendance->check_in_time ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm">{{ $attendance->check_out_time ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm">{{ $attendance->recorder->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('attendance.teacher.show', $attendance) }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('attendance.teacher.edit', $attendance) }}"
                                        class="text-[#90C74A] hover:text-[#7db33e]">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <button onclick="confirmDelete({{ $attendance->id }})"
                                        class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                    <form id="delete-form-{{ $attendance->id }}"
                                        action="{{ route('attendance.teacher.destroy', $attendance) }}" method="POST"
                                        class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500">{{ __('all.no_attendance_found') }}</p>
                                    <a href="{{ route('attendance.teacher.create') }}"
                                        class="mt-2 inline-block text-[#90C74A] hover:underline">
                                        {{ __('all.record_first_attendance') }}
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t">
                {{ $attendances->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete(id) {
                if (confirm('{{ __('all.delete_confirm_permanent') }}')) {
                    document.getElementById('delete-form-' + id).submit();
                }
            }
        </script>
    @endpush
@endsection
