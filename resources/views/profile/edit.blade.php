@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.profile'))
@section('header', __('all.profile'))

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="space-y-6">
            <!-- Update Profile Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('all.profile_information') }}</h3>
                    <p class="text-sm text-gray-500 mb-6">{{ __('all.update_profile_description') }}</p>

                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('all.update_password') }}</h3>
                    <p class="text-sm text-gray-500 mb-6">{{ __('all.update_password_description') }}</p>

                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account (hanya untuk role tertentu) -->
            @if (auth()->user()->hasRole('student') || auth()->user()->hasRole('parent'))
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('all.delete_account') }}</h3>
                        <p class="text-sm text-gray-500 mb-6">{{ __('all.delete_account_description') }}</p>

                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
