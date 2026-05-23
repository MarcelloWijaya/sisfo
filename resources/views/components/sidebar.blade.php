@php
    // FORCE SET LOCALE DARI SESSION
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

<aside class="w-72 bg-white shadow-xl hidden md:block fixed h-full overflow-y-auto z-30">
    <div class="p-6 border-b border-gray-100">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-[#90C74A] rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">Anaku Educare</h1>
                <p class="text-xs text-gray-500">{{ __('all.information_system') }}</p>
            </div>
        </div>
    </div>

    <nav class="p-4 space-y-1">
        <a href="{{ url('/dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group {{ request()->is('dashboard') ? 'bg-[#90C74A] text-white' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            <span>{{ __('all.dashboard') }}</span>
        </a>

        <a href="{{ url('/branches') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group {{ request()->is('branches*') ? 'bg-[#90C74A] text-white' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                </path>
            </svg>
            <span>{{ __('all.branches') }}</span>
        </a>

        <a href="{{ url('/students') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group {{ request()->is('students*') ? 'bg-[#90C74A] text-white' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
            <span>{{ __('all.students') }}</span>
        </a>

        <a href="{{ url('/teachers') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group {{ request()->is('teachers*') ? 'bg-[#90C74A] text-white' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span>{{ __('all.teachers') }}</span>
        </a>

        <a href="{{ url('/classrooms') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group {{ request()->is('classrooms*') ? 'bg-[#90C74A] text-white' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4M8 14h8">
                </path>
            </svg>
            <span>{{ __('all.classrooms') }}</span>
        </a>

        <!-- Attendance Section -->
        <div class="px-4 py-2">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('all.attendance') }}</p>
        </div>

        <a href="{{ route('attendance.student.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group {{ request()->is('attendance/student*') ? 'bg-[#90C74A] text-white' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                </path>
            </svg>
            <span>{{ __('all.student_attendance') }}</span>
        </a>

        <a href="{{ route('attendance.teacher.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group {{ request()->is('attendance/teacher*') ? 'bg-[#90C74A] text-white' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span>{{ __('all.teacher_attendance') }}</span>
        </a>

        <a href="{{ url('/invoices') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group {{ request()->is('invoices*') ? 'bg-[#90C74A] text-white' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            <span>{{ __('all.invoices') }}</span>
        </a>

        <a href="{{ url('/reports') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group {{ request()->is('reports*') ? 'bg-[#90C74A] text-white' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                </path>
            </svg>
            <span>{{ __('all.reports') }}</span>
        </a>
    </nav>

    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-100">
        <div class="bg-gradient-to-r from-[#90C74A]/10 to-transparent rounded-xl p-3">
            <p class="text-xs text-gray-600">{{ __('all.system_version') }}</p>
            <p class="text-sm font-semibold text-gray-800">v2.0.0</p>
        </div>
    </div>
</aside>
