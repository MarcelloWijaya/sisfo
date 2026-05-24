@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.add_pricing'))
@section('header', __('all.add_new_pricing'))

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">
                {{ __('all.add_new_pricing') }}
            </h1>

            <form method="POST" action="{{ route('branch-pricings.store') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            {{ __('all.branch') }} <span class="text-red-500">*</span>
                        </label>
                        <select name="branch_id"
                            class="w-full rounded-xl border-gray-300 focus:ring-[#90C74A] focus:border-[#90C74A]" required>
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

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            {{ __('all.academic_year') }} <span class="text-red-500">*</span>
                        </label>
                        <select name="academic_year"
                            class="w-full rounded-xl border-gray-300 focus:ring-[#90C74A] focus:border-[#90C74A]" required>
                            <option value="">{{ __('all.select_academic_year') }}</option>
                            @foreach ($academicYears as $key => $year)
                                <option value="{{ $key }}" {{ old('academic_year') == $key ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                        @error('academic_year')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            {{ __('all.payment_type') }} <span class="text-red-500">*</span>
                        </label>
                        <select name="payment_type"
                            class="w-full rounded-xl border-gray-300 focus:ring-[#90C74A] focus:border-[#90C74A]" required>
                            <option value="">{{ __('all.select_payment_type') }}</option>
                            <option value="monthly" {{ old('payment_type') == 'monthly' ? 'selected' : '' }}>
                                {{ __('all.monthly') }}</option>
                            <option value="quarterly" {{ old('payment_type') == 'quarterly' ? 'selected' : '' }}>
                                {{ __('all.quarterly') }}</option>
                            <option value="semester" {{ old('payment_type') == 'semester' ? 'selected' : '' }}>
                                {{ __('all.semester') }}</option>
                            <option value="yearly" {{ old('payment_type') == 'yearly' ? 'selected' : '' }}>
                                {{ __('all.yearly') }}</option>
                        </select>
                        @error('payment_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            {{ __('all.registration_fee') }}
                        </label>
                        <input type="number" name="registration_fee" value="{{ old('registration_fee', 0) }}"
                            min="0"
                            class="w-full rounded-xl border-gray-300 focus:ring-[#90C74A] focus:border-[#90C74A]">
                        @error('registration_fee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            {{ __('all.equipment_fee') }}
                        </label>
                        <input type="number" name="equipment_fee" value="{{ old('equipment_fee', 0) }}" min="0"
                            class="w-full rounded-xl border-gray-300 focus:ring-[#90C74A] focus:border-[#90C74A]">
                        @error('equipment_fee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            {{ __('all.course_fee') }}
                        </label>
                        <input type="number" name="course_fee" value="{{ old('course_fee', 0) }}" min="0"
                            class="w-full rounded-xl border-gray-300 focus:ring-[#90C74A] focus:border-[#90C74A]">
                        @error('course_fee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            {{ __('all.description') }}
                        </label>
                        <textarea name="description" rows="4"
                            class="w-full rounded-xl border-gray-300 focus:ring-[#90C74A] focus:border-[#90C74A]"
                            placeholder="{{ __('all.description_placeholder') }}">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('branch-pricings.index') }}"
                        class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                        {{ __('all.cancel') }}
                    </a>
                    <button type="submit"
                        class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-6 py-3 rounded-xl transition shadow-sm hover:shadow-md">
                        {{ __('all.save_pricing') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
