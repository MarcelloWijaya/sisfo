@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.add_branch'))
@section('header', __('all.add_new_branch'))

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ url('/branches') }}" method="POST">
                @csrf

                <div class="p-6 space-y-6">
                    <!-- Branch Code -->
                    <div>
                        <label for="code"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.branch_code') }}</label>
                        <input type="text" name="code" id="code" value="{{ old('code') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition @error('code') border-red-500 @enderror"
                            placeholder="e.g., JKT001">
                        @error('code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Branch Name -->
                    <div>
                        <label for="name"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.branch_name') }} <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition @error('name') border-red-500 @enderror"
                            placeholder="e.g., Anaku Educare Jakarta">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.address') }}</label>
                        <textarea name="address" id="address" rows="3"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition @error('address') border-red-500 @enderror"
                            placeholder="Jl. Contoh No. 123, Kota">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- City -->
                    <div>
                        <label for="city"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.city') }}</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition @error('city') border-red-500 @enderror"
                            placeholder="e.g., Jakarta">
                        @error('city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.phone_number') }}</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition @error('phone') border-red-500 @enderror"
                            placeholder="e.g., (021) 1234567">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.email') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition @error('email') border-red-500 @enderror"
                            placeholder="branch@anaku.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.status') }}</label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                            <option value="active">{{ __('all.active') }}</option>
                            <option value="inactive">{{ __('all.inactive') }}</option>
                        </select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ url('/branches') }}"
                        class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition">
                        {{ __('all.cancel') }}
                    </a>
                    <button type="submit"
                        class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-6 py-2.5 rounded-xl transition shadow-sm hover:shadow-md">
                        {{ __('all.create_branch') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
