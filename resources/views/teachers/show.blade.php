@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.teacher_details'))
@section('header', __('all.teacher_details'))

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header with Actions -->
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">{{ __('all.teacher_information') }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ url('/teachers/' . $teacher->id . '/edit') }}"
                        class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        {{ __('all.edit') }}
                    </a>
                    <button onclick="confirmDelete({{ $teacher->id }})"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        {{ __('all.delete') }}
                    </button>
                    <form id="delete-form-{{ $teacher->id }}" action="{{ url('/teachers/' . $teacher->id) }}"
                        method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>

            <!-- Teacher Details -->
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div>
                            <label
                                class="text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('all.teacher_id') }}</label>
                            <p class="mt-1 text-gray-900 font-mono text-lg">{{ $teacher->teacher_id }}</p>
                        </div>

                        <div>
                            <label
                                class="text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('all.teacher_name') }}</label>
                            <p class="mt-1 text-gray-900 font-semibold text-lg">{{ $teacher->name }}</p>
                        </div>

                        <div>
                            <label
                                class="text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('all.subject') }}</label>
                            <p class="mt-1">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    {{ $teacher->subject }}
                                </span>
                            </p>
                        </div>

                        <div>
                            <label
                                class="text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('all.gender') }}</label>
                            <p class="mt-1 text-gray-900">
                                {{ $teacher->gender == 'male' ? __('all.male') : __('all.female') }}
                            </p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div>
                            <label
                                class="text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('all.phone_number') }}</label>
                            <p class="mt-1 text-gray-900">{{ $teacher->phone ?? '-' }}</p>
                            @if ($teacher->phone)
                                <a href="tel:{{ $teacher->phone }}"
                                    class="text-sm text-[#90C74A] hover:underline">{{ __('all.call_now') }}</a>
                            @endif
                        </div>

                        <div>
                            <label
                                class="text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('all.email') }}</label>
                            <p class="mt-1 text-gray-900">{{ $teacher->email ?? '-' }}</p>
                            @if ($teacher->email)
                                <a href="mailto:{{ $teacher->email }}"
                                    class="text-sm text-[#90C74A] hover:underline">{{ __('all.send_email') }}</a>
                            @endif
                        </div>

                        <div>
                            <label
                                class="text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('all.qualification') }}</label>
                            <p class="mt-1 text-gray-900">{{ $teacher->qualification ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label
                        class="text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('all.address') }}</label>
                    <div class="mt-2 p-4 bg-gray-50 rounded-xl">
                        <p class="text-gray-700">{{ $teacher->address ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                <a href="{{ url('/teachers') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-800 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('all.back_to_teachers') }}
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
