@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.attendance_details'))
@section('header', __('all.attendance_details'))

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">{{ __('all.attendance_information') }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('attendance.teacher.edit', $teacherAttendance) }}"
                        class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        {{ __('all.edit') }}
                    </a>
                    <button onclick="confirmDelete({{ $teacherAttendance->id }})"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        {{ __('all.delete') }}
                    </button>
                    <form id="delete-form-{{ $teacherAttendance->id }}"
                        action="{{ route('attendance.teacher.destroy', $teacherAttendance) }}" method="POST"
                        class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">{{ __('all.teacher_name') }}</label>
                            <p class="mt-1 text-gray-900 font-semibold text-lg">
                                {{ $teacherAttendance->teacher->full_name ?? '-' }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">{{ __('all.teacher_id') }}</label>
                            <p class="mt-1 text-gray-900 font-mono">{{ $teacherAttendance->teacher->teacher_id ?? '-' }}
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">{{ __('all.branch') }}</label>
                            <p class="mt-1 text-gray-900">{{ $teacherAttendance->branch->name ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label
                                class="text-xs font-medium text-gray-500 uppercase">{{ __('all.attendance_date') }}</label>
                            <p class="mt-1 text-gray-900">
                                {{ \Carbon\Carbon::parse($teacherAttendance->attendance_date)->format('d F Y') }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">{{ __('all.status') }}</label>
                            <div class="mt-1">
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-medium {{ $teacherAttendance->status_badge }}">
                                    {{ __("all.{$teacherAttendance->status}") }}
                                </span>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">{{ __('all.recorded_by') }}</label>
                            <p class="mt-1 text-gray-900">{{ $teacherAttendance->recorder->name ?? '-' }}</p>
                            <p class="text-xs text-gray-500">{{ $teacherAttendance->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                        <label class="text-xs font-medium text-green-600 uppercase">{{ __('all.check_in_time') }}</label>
                        <p class="mt-1 text-2xl font-bold text-green-700">
                            {{ $teacherAttendance->check_in_time ?? '-- : --' }}</p>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                        <label class="text-xs font-medium text-blue-600 uppercase">{{ __('all.check_out_time') }}</label>
                        <p class="mt-1 text-2xl font-bold text-blue-700">
                            {{ $teacherAttendance->check_out_time ?? '-- : --' }}</p>
                    </div>
                </div>

                @if ($teacherAttendance->notes)
                    <div class="mt-4">
                        <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                            <label class="text-xs font-medium text-yellow-700 uppercase">{{ __('all.notes') }}</label>
                            <p class="mt-1 text-gray-700">{{ $teacherAttendance->notes }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                <a href="{{ route('attendance.teacher.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-800">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('all.back_to_attendance') }}
                </a>
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
