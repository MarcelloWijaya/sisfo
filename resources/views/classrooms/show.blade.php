@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.schedule_details'))
@section('header', __('all.schedule_details'))

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header with Actions -->
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">{{ __('all.schedule_information') }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('classrooms.edit', $classroom) }}"
                        class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        {{ __('all.edit') }}
                    </a>
                    <button onclick="confirmDelete({{ $classroom->id }})"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        {{ __('all.delete') }}
                    </button>
                    <form id="delete-form-{{ $classroom->id }}" action="{{ route('classrooms.destroy', $classroom) }}"
                        method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>

            <!-- Schedule Details -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">{{ __('all.day') }}</label>
                            <p class="mt-1 text-gray-900 font-semibold text-lg">{{ __("all.{$classroom->day}") }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">{{ __('all.time') }}</label>
                            <p class="mt-1 text-gray-900 text-lg">{{ $classroom->start_time }} -
                                {{ $classroom->end_time }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">{{ __('all.room') }}</label>
                            <p class="mt-1 text-gray-900 font-mono text-lg">{{ $classroom->room }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">{{ __('all.level') }}</label>
                            <p class="mt-1">
                                <span class="px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ __("all.{$classroom->level}") }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">{{ __('all.activity') }}</label>
                            <p class="mt-1 text-gray-900 font-semibold text-lg">{{ $classroom->activity }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">{{ __('all.teacher') }}</label>
                            <p class="mt-1 text-gray-900">{{ $classroom->teacher->full_name ?? '-' }}</p>
                            @if ($classroom->teacher)
                                <p class="text-sm text-gray-500">{{ $classroom->teacher->qualification ?? '' }}</p>
                            @endif
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">{{ __('all.branch') }}</label>
                            <p class="mt-1 text-gray-900">{{ $classroom->branch->name ?? '-' }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-xs font-medium text-gray-500 uppercase">{{ __('all.quota') }}</label>
                            <p class="mt-1">
                                <span class="text-2xl font-bold text-[#90C74A]">{{ $classroom->quota }}</span>
                                <span class="text-sm text-gray-500"> {{ __('all.students') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                <a href="{{ route('classrooms.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-800">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('all.back_to_schedules') }}
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
