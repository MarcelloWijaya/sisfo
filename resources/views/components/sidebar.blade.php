@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

<aside id="sidebar"
    class="w-72 bg-white shadow-xl fixed top-0 left-0 h-screen overflow-visible z-40 transition-all duration-300 flex flex-col">

    {{-- LOGO --}}
    <div class="p-6 border-b border-gray-100">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-[#90C74A] rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
            </div>
            <div class="logo-text">
                <h1 class="text-xl font-bold text-gray-800">Anaku Educare</h1>
                <p class="text-xs text-gray-500">{{ __('all.information_system') }}</p>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto overflow-x-visible">
        <nav class="p-4 space-y-1" x-data="{
            openMenus: {
                branches: false,
                pricing: false,
                teachers: false,
                students: false,
                payments: false,
                classes: false
            },
            toggleMenu(menu) {
                if (!document.getElementById('sidebar')?.classList.contains('w-20')) {
                    this.openMenus[menu] = !this.openMenus[menu];
                }
            },
            isCollapsed() {
                return document.getElementById('sidebar')?.classList.contains('w-20');
            }
        }">

            {{-- DASHBOARD --}}
            <a href="{{ route('director.dashboard') }}"
                class="sidebar-link relative flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group {{ request()->is('director/dashboard') ? 'bg-[#90C74A] text-white' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span class="menu-text">{{ __('all.dashboard') }}</span>
                <span class="tooltip-text">{{ __('all.dashboard') }}</span>
            </a>

            {{-- ==================== CABANG ==================== --}}
            <div>
                <button type="button" @click="toggleMenu('branches')"
                    class="sidebar-button relative w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.branches') }}</span>
                    </div>
                    <span class="tooltip-text">{{ __('all.branches') }}</span>
                    <svg class="menu-arrow w-4 h-4 transition-transform duration-200"
                        :class="{ 'rotate-180': openMenus.branches }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="openMenus.branches || isCollapsed()" x-cloak class="submenu-wrapper ml-6 mt-1 space-y-1">
                    <a href="{{ route('director.branches.index') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.branch_data') }}</span>
                        <span class="tooltip-text">{{ __('all.branch_data') }}</span>
                    </a>
                </div>
            </div>

            {{-- ==================== BIAYA ==================== --}}
            <div>
                <button type="button" @click="toggleMenu('pricing')"
                    class="sidebar-button relative w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.pricing') }}</span>
                    </div>
                    <span class="tooltip-text">{{ __('all.pricing') }}</span>
                    <svg class="menu-arrow w-4 h-4 transition-transform duration-200"
                        :class="{ 'rotate-180': openMenus.pricing }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="openMenus.pricing || isCollapsed()" x-cloak class="submenu-wrapper ml-6 mt-1 space-y-1">
                    <a href="{{ route('director.pricing.index') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5h6">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.view_branch_pricing') }}</span>
                        <span class="tooltip-text">{{ __('all.view_branch_pricing') }}</span>
                    </a>
                </div>
            </div>

            {{-- ==================== GURU ==================== --}}
            <div>
                <button type="button" @click="toggleMenu('teachers')"
                    class="sidebar-button relative w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.teachers') }}</span>
                    </div>
                    <span class="tooltip-text">{{ __('all.teachers') }}</span>
                    <svg class="menu-arrow w-4 h-4 transition-transform duration-200"
                        :class="{ 'rotate-180': openMenus.teachers }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>
                <div x-show="openMenus.teachers || isCollapsed()" x-cloak class="submenu-wrapper ml-6 mt-1 space-y-1">
                    <a href="{{ route('director.teachers.index') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.teacher_data') }}</span>
                        <span class="tooltip-text">{{ __('all.teacher_data') }}</span>
                    </a>
                    <a href="{{ route('director.teachers.create') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="menu-text">{{ __('all.add_teacher') }}</span>
                        <span class="tooltip-text">{{ __('all.add_teacher') }}</span>
                    </a>
                    {{-- <a href="{{ route('director.teachers.schedule') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.teacher_schedule') }}</span>
                        <span class="tooltip-text">{{ __('all.teacher_schedule') }}</span>
                    </a> --}}
                    <a href="{{ route('attendance.teacher.index') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="menu-text">{{ __('all.teacher_attendance') }}</span>
                        <span class="tooltip-text">{{ __('all.teacher_attendance') }}</span>
                    </a>
                    {{-- <a href="{{ route('director.teacher-training.create') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.request_training') }}</span>
                        <span class="tooltip-text">{{ __('all.request_training') }}</span>
                    </a> --}}
                </div>
            </div>

            {{-- ==================== MURID ==================== --}}
            <div>
                <button type="button" @click="toggleMenu('students')"
                    class="sidebar-button relative w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.students') }}</span>
                    </div>
                    <span class="tooltip-text">{{ __('all.students') }}</span>
                    <svg class="menu-arrow w-4 h-4 transition-transform duration-200"
                        :class="{ 'rotate-180': openMenus.students }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>
                <div x-show="openMenus.students || isCollapsed()" x-cloak class="submenu-wrapper ml-6 mt-1 space-y-1">
                    <a href="{{ route('director.students.index') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.student_data') }}</span>
                        <span class="tooltip-text">{{ __('all.student_data') }}</span>
                    </a>
                    <a href="{{ route('director.students.create') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="menu-text">{{ __('all.add_student') }}</span>
                        <span class="tooltip-text">{{ __('all.add_student') }}</span>
                    </a>
                    {{-- <a href="{{ route('director.students.grades') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5h6">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.student_grades') }}</span>
                        <span class="tooltip-text">{{ __('all.student_grades') }}</span>
                    </a> --}}
                    <a href="{{ route('attendance.student.index') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="menu-text">{{ __('all.student_attendance') }}</span>
                        <span class="tooltip-text">{{ __('all.student_attendance') }}</span>
                    </a>
                </div>
            </div>

            {{-- ==================== PEMBAYARAN ==================== --}}
            <div>
                <button type="button" @click="toggleMenu('payments')"
                    class="sidebar-button relative w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.payments') }}</span>
                    </div>
                    <span class="tooltip-text">{{ __('all.payments') }}</span>
                    <svg class="menu-arrow w-4 h-4 transition-transform duration-200"
                        :class="{ 'rotate-180': openMenus.payments }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>
                <div x-show="openMenus.payments || isCollapsed()" x-cloak class="submenu-wrapper ml-6 mt-1 space-y-1">
                    <a href="{{ route('director.payments.monthly') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.monthly_fee') }}</span>
                        <span class="tooltip-text">{{ __('all.monthly_fee') }}</span>
                    </a>
                    <a href="{{ route('director.payments.book') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.book_fee') }}</span>
                        <span class="tooltip-text">{{ __('all.book_fee') }}</span>
                    </a>
                </div>
            </div>

            {{-- ==================== KELAS ==================== --}}
            <div>
                <button type="button" @click="toggleMenu('classes')"
                    class="sidebar-button relative w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4M8 14h8">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.classes') }}</span>
                    </div>
                    <span class="tooltip-text">{{ __('all.classes') }}</span>
                    <svg class="menu-arrow w-4 h-4 transition-transform duration-200"
                        :class="{ 'rotate-180': openMenus.classes }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>
                <div x-show="openMenus.classes || isCollapsed()" x-cloak class="submenu-wrapper ml-6 mt-1 space-y-1">
                    <a href="{{ route('director.classes.index') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.class_data') }}</span>
                        <span class="tooltip-text">{{ __('all.class_data') }}</span>
                    </a>
                    <a href="{{ route('director.classes.manage') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                        </svg>
                        <span class="menu-text">{{ __('all.manage_class') }}</span>
                        <span class="tooltip-text">{{ __('all.manage_class') }}</span>
                    </a>
                    <a href="{{ route('director.classes.today-attendance') }}"
                        class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="menu-text">{{ __('all.today_attendance') }}</span>
                        <span class="tooltip-text">{{ __('all.today_attendance') }}</span>
                    </a>
                </div>
            </div>

        </nav>
    </div>

    {{-- USER INFO --}}
    <div class="mt-auto p-4 border-t border-gray-100 user-box">
        <div class="flex items-center gap-3">
            <div
                class="w-10 h-10 bg-gradient-to-r from-[#90C74A] to-[#7db33e] rounded-xl flex items-center justify-center shadow-sm shrink-0">
                <span class="text-white font-bold text-lg">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
            </div>
            <div class="menu-text flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-800 truncate">{{ auth()->user()->name ?? 'User' }}</p>
                <p class="text-xs text-gray-500">
                    @php $roleName = auth()->user()->getRoleNames()->first() ?? 'user'; @endphp
                    {{ __("all.$roleName") }}
                </p>
            </div>
            <a href="{{ route('profile.edit') }}"
                class="menu-text text-gray-400 hover:text-[#90C74A] transition">⚙️</a>
        </div>

        <button id="collapseSidebarBtn"
            class="sidebar-button mt-4 w-full flex items-center justify-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-[#90C74A] hover:text-white transition">
            <svg id="collapseIcon" class="w-5 h-5 shrink-0" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path id="collapseIconPath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
            </svg>
            <span class="menu-text">Collapse</span>
        </button>
    </div>

    <div class="p-4 border-t border-gray-100 version-box">
        <div class="bg-gradient-to-r from-[#90C74A]/10 to-transparent rounded-xl p-3">
            <p class="text-xs text-gray-600 menu-text">{{ __('all.system_version') }}</p>
            <p class="text-sm font-semibold text-gray-800 menu-text">v2.0.0</p>
        </div>
    </div>
</aside>

<style>
    [x-cloak] {
        display: none !important;
    }

    #sidebar {
        transition: width 0.3s ease;
    }

    .sidebar-link,
    .sidebar-button {
        position: relative !important;
    }

    .tooltip-text {
        display: none;
        position: absolute;
        left: 100%;
        margin-left: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: #1f2937;
        color: white;
        font-size: 12px;
        padding: 8px 10px;
        border-radius: 8px;
        white-space: nowrap;
        z-index: 9999;
        box-shadow: 0 10px 20px rgba(0, 0, 0, .12);
        pointer-events: none;
    }

    #sidebar.w-20 .sidebar-link:hover .tooltip-text,
    #sidebar.w-20 .sidebar-button:hover .tooltip-text {
        display: block !important;
    }

    #sidebar.w-20 .menu-text,
    #sidebar.w-20 .logo-text,
    #sidebar.w-20 .menu-arrow {
        display: none !important;
    }

    #sidebar.w-20 .submenu-wrapper {
        display: block !important;
        margin-left: 0 !important;
    }

    #sidebar.w-20 .sidebar-link,
    #sidebar.w-20 .sidebar-button {
        justify-content: center;
        padding-left: 12px;
        padding-right: 12px;
    }

    #sidebar.w-20 .sidebar-link .menu-text,
    #sidebar.w-20 .sidebar-button .menu-text {
        display: none;
    }

    #sidebar.w-20 .user-box,
    #sidebar.w-20 .version-box {
        padding-left: 12px;
        padding-right: 12px;
    }

    #sidebar.w-20 .sidebar-link .tooltip-text,
    #sidebar.w-20 .sidebar-button .tooltip-text {
        position: fixed !important;
        left: 70px !important;
        top: auto !important;
        transform: translateY(0) !important;
        background: #1e293b !important;
        z-index: 99999 !important;
    }

    #sidebar.w-20 .menu-arrow {
        display: none !important;
    }

    #sidebar.w-20 .collapse-parent-menu {
        display: none !important;
    }
</style>
