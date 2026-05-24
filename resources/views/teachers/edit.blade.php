@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.edit_teacher'))
@section('header', __('all.edit_teacher'))

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route($routePrefix . '.update', $teacher) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="p-6 space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.name') }} <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $teacher->name) }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition @error('name') border-red-500 @enderror"
                            placeholder="e.g., Budi Santoso">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nickname -->
                    <div>
                        <label for="nickname"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.nickname') }}</label>
                        <input type="text" name="nickname" id="nickname"
                            value="{{ old('nickname', $teacher->nickname) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                        @error('nickname')
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
                            <option value="male" {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}>
                                {{ __('all.male') }}</option>
                            <option value="female" {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>
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
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $teacher->phone) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.email') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $teacher->email) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.address') }}</label>
                        <textarea name="address" id="address" rows="3"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition"
                            placeholder="{{ __('all.address_placeholder') }}">{{ old('address', $teacher->address) }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Place of Birth -->
                    <div>
                        <label for="place_of_birth"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.place_of_birth') }}</label>
                        <input type="text" name="place_of_birth" id="place_of_birth"
                            value="{{ old('place_of_birth', $teacher->place_of_birth) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                        @error('place_of_birth')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.date_of_birth') }}</label>
                        <input type="date" name="date_of_birth" id="date_of_birth"
                            value="{{ old('date_of_birth', $teacher->date_of_birth) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                        @error('date_of_birth')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Education -->
                    <div>
                        <label for="last_education"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.last_education') }}</label>
                        <input type="text" name="last_education" id="last_education"
                            value="{{ old('last_education', $teacher->last_education) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                        @error('last_education')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Qualification -->
                    <div>
                        <label for="qualification"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.qualification') }}</label>
                        <input type="text" name="qualification" id="qualification"
                            value="{{ old('qualification', $teacher->qualification) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                        @error('qualification')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status"
                            class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.status') }}</label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                            <option value="active" {{ old('status', $teacher->status) == 'active' ? 'selected' : '' }}>
                                {{ __('all.active') }}</option>
                            <option value="inactive" {{ old('status', $teacher->status) == 'inactive' ? 'selected' : '' }}>
                                {{ __('all.inactive') }}</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route($routePrefix . '.index') }}"
                        class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition">
                        {{ __('all.cancel') }}
                    </a>
                    <button type="submit"
                        class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-6 py-2.5 rounded-xl transition shadow-sm hover:shadow-md">
                        {{ __('all.update_teacher') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
