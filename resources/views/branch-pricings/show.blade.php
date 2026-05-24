@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.pricing_details'))
@section('header', __('all.pricing_details'))

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Alert untuk Director (readonly) -->
        @if ($isDirector)
            <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-yellow-700">{{ __('all.readonly_mode') }} -
                        {{ __('all.director_cannot_edit') }}</span>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 bg-gradient-to-r from-[#90C74A]/10 to-transparent border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800">{{ $branchPricing->branch->name ?? '-' }}</h2>
                <p class="text-sm text-gray-500">{{ $branchPricing->academic_year }} |
                    {{ __("all.{$branchPricing->payment_type}") }}</p>
            </div>

            <!-- Pricing Items (Seperti gambar) -->
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Registration Fee -->
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium">{{ __('all.registration_fee') }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-xl font-bold text-gray-800">Rp
                                {{ number_format($branchPricing->registration_fee, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Equipment Fee -->
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium">{{ __('all.equipment_fee') }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-xl font-bold text-gray-800">Rp
                                {{ number_format($branchPricing->equipment_fee, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Course Fee / SPP -->
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium">{{ __('all.course_fee') }} ({{ __('all.spp') }})</span>
                        </div>
                        <div class="text-right">
                            <span class="text-xl font-bold text-gray-800">Rp
                                {{ number_format($branchPricing->course_fee, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="flex justify-between items-center py-4 mt-2 bg-gray-50 rounded-xl px-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#90C74A] rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-gray-900 font-bold text-lg">{{ __('all.total_payment') }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-[#90C74A]">
                                Rp
                                {{ number_format($branchPricing->registration_fee + $branchPricing->equipment_fee + $branchPricing->course_fee, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if ($branchPricing->description)
                    <div class="mt-6 p-4 bg-gray-50 rounded-xl">
                        <p class="text-sm text-gray-600">{{ $branchPricing->description }}</p>
                    </div>
                @endif
            </div>

            <!-- Footer Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                <a href="{{ route('branch-pricings.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-800">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('all.back') }}
                </a>

                @if (!$isDirector)
                    <div class="flex gap-3">
                        <a href="{{ route('branch-pricings.edit', $branchPricing) }}"
                            class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-4 py-2 rounded-lg transition">
                            {{ __('all.edit_pricing') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
