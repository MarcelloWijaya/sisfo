@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.edit_pricing'))
@section('header', __('all.edit_pricing'))

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">
                {{ __('all.edit_pricing') }}
            </h1>

            <div class="mb-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-lg">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-blue-700">{{ __('all.director_can_edit_fees') }}</span>
                </div>
            </div>

            <form method="POST" action="{{ route('director.pricing.update', $branchPricing->id) }}">
                @csrf
                @method('PUT')

                <!-- Read-only fields -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <label class="block text-sm font-medium text-gray-500 mb-1">{{ __('all.branch') }}</label>
                        <p class="text-gray-800 font-semibold">{{ $branchPricing->branch->name }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <label class="block text-sm font-medium text-gray-500 mb-1">{{ __('all.academic_year') }}</label>
                        <p class="text-gray-800 font-semibold">{{ $branchPricing->academic_year }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <label class="block text-sm font-medium text-gray-500 mb-1">{{ __('all.payment_type') }}</label>
                        <p class="text-gray-800 font-semibold">{{ __("all.{$branchPricing->payment_type}") }}</p>
                    </div>
                </div>

                <!-- Editable fields -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            {{ __('all.registration_fee') }}
                        </label>
                        <input type="number" name="registration_fee"
                            value="{{ old('registration_fee', $branchPricing->registration_fee) }}" min="0"
                            class="w-full rounded-xl border-gray-300 focus:ring-[#90C74A] focus:border-[#90C74A]">
                        @error('registration_fee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            {{ __('all.equipment_fee') }}
                        </label>
                        <input type="number" name="equipment_fee"
                            value="{{ old('equipment_fee', $branchPricing->equipment_fee) }}" min="0"
                            class="w-full rounded-xl border-gray-300 focus:ring-[#90C74A] focus:border-[#90C74A]">
                        @error('equipment_fee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            {{ __('all.course_fee') }}
                        </label>
                        <input type="number" name="course_fee" value="{{ old('course_fee', $branchPricing->course_fee) }}"
                            min="0"
                            class="w-full rounded-xl border-gray-300 focus:ring-[#90C74A] focus:border-[#90C74A]">
                        @error('course_fee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        {{ __('all.description') }}
                    </label>
                    <textarea name="description" rows="4"
                        class="w-full rounded-xl border-gray-300 focus:ring-[#90C74A] focus:border-[#90C74A]"
                        placeholder="{{ __('all.description_placeholder') }}">{{ old('description', $branchPricing->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('director.pricing.show', $branchPricing) }}"
                        class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                        {{ __('all.cancel') }}
                    </a>
                    <button type="submit"
                        class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-6 py-3 rounded-xl transition shadow-sm hover:shadow-md">
                        {{ __('all.update_pricing') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
