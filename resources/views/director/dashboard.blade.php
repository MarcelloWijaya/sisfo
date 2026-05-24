@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

@section('title', __('all.director_dashboard'))
@section('header', __('all.director_dashboard'))

@section('content')
    <div class="space-y-6">
        <!-- Quick Menu Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Absensi Murid -->
            <a href="{{ route('attendance.student.index') }}"
                class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-[#90C74A] group">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-[#90C74A] transition">
                        <svg class="w-6 h-6 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ __('all.student_attendance') }}</h3>
                        <p class="text-sm text-gray-500">{{ __('all.attendance_today') }}: {{ $todayAttendance }} |
                            {{ __('all.present') }}: {{ $todayPresent }}</p>
                    </div>
                </div>
            </a>

            <!-- Pendaftaran Murid Baru -->
            <a href="{{ route('director.students.create') }}"
                class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-[#90C74A] group">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center group-hover:bg-[#90C74A] transition">
                        <svg class="w-6 h-6 text-green-600 group-hover:text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ __('all.new_student_registration') }}</h3>
                        <p class="text-sm text-gray-500">{{ __('all.register_new_student') }}</p>
                    </div>
                </div>
            </a>

            <!-- Atur Kelas -->
            <a href="{{ route('director.classes.manage') }}"
                class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-[#90C74A] group">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center group-hover:bg-[#90C74A] transition">
                        <svg class="w-6 h-6 text-purple-600 group-hover:text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ __('all.manage_classes') }}</h3>
                        <p class="text-sm text-gray-500">{{ __('all.total_classes') }}: {{ $totalClasses }}</p>
                    </div>
                </div>
            </a>

            <!-- Lihat Murid -->
            <a href="{{ route('director.students.index') }}"
                class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-[#90C74A] group">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center group-hover:bg-[#90C74A] transition">
                        <svg class="w-6 h-6 text-yellow-600 group-hover:text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ __('all.view_students') }}</h3>
                        <p class="text-sm text-gray-500">{{ __('all.total_students') }}: {{ $totalStudents }}</p>
                    </div>
                </div>
            </a>

            <!-- Lihat Guru -->
            <a href="{{ route('director.teachers.index') }}"
                class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-[#90C74A] group">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center group-hover:bg-[#90C74A] transition">
                        <svg class="w-6 h-6 text-pink-600 group-hover:text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ __('all.view_teachers') }}</h3>
                        <p class="text-sm text-gray-500">{{ __('all.total_teachers') }}: {{ $totalTeachers }}</p>
                    </div>
                </div>
            </a>

            <!-- Pembayaran -->
            <a href="{{ route('director.payments.monthly') }}"
                class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-[#90C74A] group">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center group-hover:bg-[#90C74A] transition">
                        <svg class="w-6 h-6 text-red-600 group-hover:text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ __('all.payments') }}</h3>
                        <p class="text-sm text-gray-500">{{ __('all.pending_payments') }}: {{ $pendingInvoices }}</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-[#90C74A]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">{{ __('all.total_branches') }}</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalBranches }}</p>
                    </div>
                    <div class="w-10 h-10 bg-[#90C74A]/10 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#90C74A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">{{ __('all.total_students') }}</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalStudents }}</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">{{ __('all.total_teachers') }}</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalTeachers }}</p>
                    </div>
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">{{ __('all.total_revenue') }}</p>
                        <p class="text-2xl font-bold text-[#90C74A]">Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Data -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Students -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-800">{{ __('all.recent_students') }}</h3>
                    <a href="{{ route('director.students.index') }}"
                        class="text-sm text-[#90C74A] hover:underline">{{ __('all.view_all') }}</a>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach ($recentStudents as $student)
                        <div class="px-6 py-3 flex justify-between items-center">
                            <div>
                                <p class="font-medium text-gray-800">{{ $student->name }}</p>
                                <p class="text-xs text-gray-500">{{ $student->nis }} |
                                    {{ $student->branch->name ?? '-' }}</p>
                            </div>
                            <span class="text-xs text-gray-400">{{ $student->created_at->diffForHumans() }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Today's Classes -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-800">{{ __('all.todays_classes') }}</h3>
                    <a href="{{ route('director.classes.today-attendance') }}"
                        class="text-sm text-[#90C74A] hover:underline">{{ __('all.take_attendance') }}</a>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach ($todayClasses as $class)
                        <div class="px-6 py-3 flex justify-between items-center">
                            <div>
                                <p class="font-medium text-gray-800">{{ $class->activity }}</p>
                                <p class="text-xs text-gray-500">{{ $class->start_time }} - {{ $class->end_time }} |
                                    {{ $class->room }} | {{ $class->teacher->full_name ?? '-' }}</p>
                            </div>
                            <a href="{{ route('director.classes.today-attendance') }}?class_id={{ $class->id }}"
                                class="text-[#90C74A] hover:underline text-sm">{{ __('all.attendance') }}</a>
                        </div>
                    @endforeach
                    @if ($todayClasses->isEmpty())
                        <div class="px-6 py-8 text-center text-gray-500">{{ __('all.no_classes_today') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
