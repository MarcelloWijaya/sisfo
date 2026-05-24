@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }

    $user = auth()->user();
    $isDirector = $user->hasRole('director');
    $routePrefix = $isDirector ? 'director.students' : 'students';
@endphp

@section('title', __('all.add_student'))
@section('header', __('all.add_new_student'))

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route($routePrefix . '.store') }}" method="POST">
                @csrf

                <div class="p-6 space-y-6">
                    <!-- NIS -->
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.nis') }} <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nis" id="nis" value="{{ old('nis') }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition @error('nis') border-red-500 @enderror"
                            placeholder="e.g., 2024001">
                        @error('nis')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Student Name -->
                    <div>
                        <label for="name"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.student_name') }} <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition @error('name') border-red-500 @enderror"
                            placeholder="e.g., Ahmad Fauzi">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Class -->
                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.class') }}
                            <span class="text-red-500">*</span></label>
                        <select name="class" id="class" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                            <option value="">{{ __('all.select_class') }}</option>
                            <option value="10" {{ old('class') == '10' ? 'selected' : '' }}>10</option>
                            <option value="11" {{ old('class') == '11' ? 'selected' : '' }}>11</option>
                            <option value="12" {{ old('class') == '12' ? 'selected' : '' }}>12</option>
                        </select>
                        @error('class')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.gender') }}
                            <span class="text-red-500">*</span></label>
                        <select name="gender" id="gender" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                            <option value="">{{ __('all.select_gender') }}</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('all.male') }}
                            </option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                {{ __('all.female') }}</option>
                        </select>
                        @error('gender')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.phone_number') }}</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition @error('phone') border-red-500 @enderror"
                            placeholder="e.g., 08123456789">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.address') }}</label>
                        <textarea name="address" id="address" rows="3"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition @error('address') border-red-500 @enderror"
                            placeholder="{{ __('all.address_placeholder') }}">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Parent Name -->
                    <div>
                        <label for="parent_name"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.parent_name') }}</label>
                        <input type="text" name="parent_name" id="parent_name" value="{{ old('parent_name') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition"
                            placeholder="{{ __('all.parent_name_placeholder') }}">
                    </div>

                    <!-- Parent Phone -->
                    <div>
                        <label for="parent_phone"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.parent_phone') }}</label>
                        <input type="tel" name="parent_phone" id="parent_phone" value="{{ old('parent_phone') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition"
                            placeholder="e.g., 08123456789">
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ url('/students') }}"
                        class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition">
                        {{ __('all.cancel') }}
                    </a>
                    <button type="submit"
                        class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-6 py-2.5 rounded-xl transition shadow-sm hover:shadow-md">
                        {{ __('all.create_student') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
