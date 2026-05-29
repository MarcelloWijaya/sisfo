@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.student_details'))
@section('header', __('all.student_details'))

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header with Avatar -->
            <div class="px-6 py-4 bg-gradient-to-r from-[#90C74A]/10 to-transparent border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-16 h-16 bg-[#90C74A] rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-md">
                            {{ substr($student->name, 0, 1) }}
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">{{ $student->name }}</h2>
                            <p class="text-sm text-gray-500">{{ __('all.student') }} | {{ $student->class ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('students.edit', $student) }}"
                            class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            {{ __('all.edit') }}
                        </a>
                        <button onclick="confirmDelete({{ $student->id }})"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            {{ __('all.delete') }}
                        </button>
                        <form id="delete-form-{{ $student->id }}" action="{{ route('students.destroy', $student) }}"
                            method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    {{-- CARD 1: BASIC INFO --}}
                    <div class="bg-gray-50 rounded-xl p-4">
                        <h3 class="text-md font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <span>📋</span> {{ __('all.basic_info') }}
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs text-gray-500">{{ __('all.nis') }}</label>
                                <p class="font-medium text-gray-800">{{ $student->nis }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">{{ __('all.class') }}</label>
                                <p class="font-medium text-gray-800">{{ $student->class }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">{{ __('all.gender') }}</label>
                                <p class="font-medium text-gray-800">
                                    {{ $student->gender == 'male' ? __('all.male') : __('all.female') }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">{{ __('all.phone') }}</label>
                                <p class="font-medium text-gray-800">{{ $student->phone ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">{{ __('all.branch') }}</label>
                                <p class="font-medium text-gray-800">{{ $student->branch->name ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">{{ __('all.status') }}</label>
                                <p>
                                    <span
                                        class="px-2 py-1 rounded-full text-xs {{ $student->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $student->status == 'active' ? __('all.active') : __('all.inactive') }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- CARD 2: PAYMENT --}}
                    <div class="bg-gray-50 rounded-xl p-4">
                        <h3 class="text-md font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <span>💰</span> {{ __('all.payment') }}
                        </h3>
                        <div class="space-y-2">
                            <a href="{{ route('invoices.index', ['student_id' => $student->id]) }}"
                                class="flex items-center justify-between p-2 rounded-lg hover:bg-white transition">
                                <span class="text-sm">{{ __('all.invoices') }}</span>
                                <span class="text-[#90C74A]">→</span>
                            </a>
                            <a href="#"
                                class="flex items-center justify-between p-2 rounded-lg hover:bg-white transition">
                                <span class="text-sm">{{ __('all.first_registration') }}</span>
                                <span class="text-[#90C74A]">→</span>
                            </a>
                            <a href="#"
                                class="flex items-center justify-between p-2 rounded-lg hover:bg-white transition">
                                <span class="text-sm">{{ __('all.buy_replacement_book') }}</span>
                                <span class="text-[#90C74A]">→</span>
                            </a>
                        </div>
                        <div class="mt-4 pt-3 border-t border-gray-200">
                            <a href="{{ route('invoices.index', ['student_id' => $student->id]) }}"
                                class="text-sm text-[#90C74A] hover:underline flex items-center gap-1">
                                {{ __('all.view_invoice') }} →
                            </a>
                        </div>
                    </div>

                    {{-- CARD 3: CLASS --}}
                    <div class="bg-gray-50 rounded-xl p-4">
                        <h3 class="text-md font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <span>📚</span> {{ __('all.class') }}
                        </h3>
                        <div class="space-y-2">
                            <a href="{{ route('attendance.student.index', ['student_id' => $student->id]) }}"
                                class="flex items-center justify-between p-2 rounded-lg hover:bg-white transition">
                                <span class="text-sm">{{ __('all.view_attendance') }}</span>
                                <span class="text-[#90C74A]">→</span>
                            </a>
                            <a href="{{ route('attendance.student.create', ['student_id' => $student->id]) }}"
                                class="flex items-center justify-between p-2 rounded-lg hover:bg-white transition">
                                <span class="text-sm">{{ __('all.student_attendance') }}</span>
                                <span class="text-[#90C74A]">→</span>
                            </a>
                        </div>
                        <div class="mt-4 pt-3 border-t border-gray-200 flex justify-between">
                            <a href="{{ route('students.index', ['student_id' => $student->id]) }}"
                                class="text-sm text-[#90C74A] hover:underline">
                                {{ __('all.view_class') }} →
                            </a>
                            <a href="#" class="text-sm text-[#90C74A] hover:underline">
                                {{ __('all.move_class') }} →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                <a href="{{ route('students.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-800 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('all.back_to_students') }}
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
