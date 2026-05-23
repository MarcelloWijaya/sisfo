@extends('layouts.app')

@php
    if(session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.add_teacher'))
@section('header', __('all.add_new_teacher'))

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ url('/teachers') }}" method="POST">
                @csrf

                <div class="p-6 space-y-6">
                    <!-- Teacher ID -->
                    <div>
                        <label for="teacher_id" class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.teacher_id') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="teacher_id" id="teacher_id" value="{{ old('teacher_id') }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition @error('teacher_id') border-red-500 @enderror"
                            placeholder="e.g., TCH2024001">
                        @error('teacher_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Teacher Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.teacher_name') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition @error('name') border-red-500 @enderror"
                            placeholder="e.g., Dr. Budi Santoso">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.subject') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition"
                            placeholder="e.g., Mathematics, Physics, English">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.gender') }} <span class="text-red-500">*</span></label>
                        <select name="gender" id="gender" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                            <option value="">{{ __('all.select_gender') }}</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('all.male') }}</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('all.female') }}</option>
                        </select>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.phone_number') }}</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition"
                            placeholder="e.g., 08123456789">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.email') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition"
                            placeholder="teacher@anaku.com">
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.address') }}</label>
                        <textarea name="address" id="address" rows="3"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition"
                            placeholder="{{ __('all.address_placeholder') }}">{{ old('address') }}</textarea>
                    </div>

                    <!-- Qualification -->
                    <div>
                        <label for="qualification" class="block text-sm font-medium text-gray-700 mb-2">{{ __('all.qualification') }}</label>
                        <input type="text" name="qualification" id="qualification" value="{{ old('qualification') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition"
                            placeholder="e.g., S.Pd, M.Pd, Ph.D">
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ url('/teachers') }}"
                        class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition">
                        {{ __('all.cancel') }}
                    </a>
                    <button type="submit"
                        class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-6 py-2.5 rounded-xl transition shadow-sm hover:shadow-md">
                        {{ __('all.create_teacher') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
