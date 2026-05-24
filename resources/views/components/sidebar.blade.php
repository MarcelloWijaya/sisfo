@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

<aside id="sidebar"
    class="w-72 bg-white shadow-xl fixed top-0 left-0 h-screen overflow-visible z-40 transition-all duration-300">
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

    <nav class="p-4 space-y-1" x-data="{
        openMenus: {
            master: false,
            academic: false,
            attendance: false,
            finance: false,
            reports: false
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
        <a href="{{ url('/dashboard') }}"
            class="sidebar-link relative flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group {{ request()->is('dashboard') ? 'bg-[#90C74A] text-white' : '' }}">

            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>

            <span class="menu-text">{{ __('all.dashboard') }}</span>
            <span class="tooltip-text">{{ __('all.dashboard') }}</span>
        </a>

        {{-- MASTER DATA --}}
        <div>
            <button type="button" @click="toggleMenu('master')"
                class="collapse-parent-menu sidebar-button relative w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group">

                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4">
                        </path>
                    </svg>

                    <span class="menu-text main-menu-title">{{ __('all.master_data') }}</span>
                </div>

                <span class="tooltip-text">{{ __('all.master_data') }}</span>

                <svg class="menu-arrow w-4 h-4 transition-transform duration-200"
                    :class="{ 'rotate-180': openMenus.master }" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                    </path>
                </svg>
            </button>

            <div x-show="openMenus.master || isCollapsed()" x-cloak class="submenu-wrapper ml-6 mt-1 space-y-1">
                <a href="{{ url('/branches') }}"
                    class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition {{ request()->is('branches*') ? 'bg-[#90C74A] text-white' : '' }}">

                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>

                    <span class="menu-text">{{ __('all.branches') }}</span>
                    <span class="tooltip-text">{{ __('all.branches') }}</span>
                </a>

                <a href="{{ url('/students') }}"
                    class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition {{ request()->is('students*') ? 'bg-[#90C74A] text-white' : '' }}">

                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>

                    <span class="menu-text">{{ __('all.students') }}</span>
                    <span class="tooltip-text">{{ __('all.students') }}</span>
                </a>

                <a href="{{ url('/teachers') }}"
                    class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition {{ request()->is('teachers*') ? 'bg-[#90C74A] text-white' : '' }}">

                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                        </path>
                    </svg>

                    <span class="menu-text">{{ __('all.teachers') }}</span>
                    <span class="tooltip-text">{{ __('all.teachers') }}</span>
                </a>

                <a href="{{ url('/classrooms') }}"
                    class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition {{ request()->is('classrooms*') ? 'bg-[#90C74A] text-white' : '' }}">

                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4M8 14h8">
                        </path>
                    </svg>

                    <span class="menu-text">{{ __('all.classrooms') }}</span>
                    <span class="tooltip-text">{{ __('all.classrooms') }}</span>
                </a>
            </div>
        </div>

        {{-- FINANCE --}}
        <div>
            <button type="button" @click="toggleMenu('finance')"
                class="collapse-parent-menu sidebar-button relative w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group">

                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>

                    <span class="menu-text main-menu-title">{{ __('all.finance') }}</span>
                </div>

                <span class="tooltip-text">{{ __('all.finance') }}</span>

                <svg class="menu-arrow w-4 h-4 transition-transform duration-200"
                    :class="{ 'rotate-180': openMenus.finance }" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                    </path>
                </svg>
            </button>

            <div x-show="openMenus.finance || isCollapsed()" x-cloak class="submenu-wrapper ml-6 mt-1 space-y-1">
                <a href="{{ url('/branch-pricings') }}"
                    class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition {{ request()->is('branch-pricings*') ? 'bg-[#90C74A] text-white' : '' }}">

                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2m9-4a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>

                    <span class="menu-text">{{ __('all.pricing') }}</span>
                    <span class="tooltip-text">{{ __('all.pricing') }}</span>
                </a>

                <a href="{{ url('/invoices') }}"
                    class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition {{ request()->is('invoices*') ? 'bg-[#90C74A] text-white' : '' }}">

                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>

                    <span class="menu-text">{{ __('all.invoices') }}</span>
                    <span class="tooltip-text">{{ __('all.invoices') }}</span>
                </a>

                <a href="{{ url('/coupons') }}"
                    class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition {{ request()->is('coupons*') ? 'bg-[#90C74A] text-white' : '' }}">

                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 5v2m0 4v2m0 4v2M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z">
                        </path>
                    </svg>

                    <span class="menu-text">{{ __('all.coupons') }}</span>
                    <span class="tooltip-text">{{ __('all.coupons') }}</span>
                </a>
            </div>
        </div>

        {{-- REPORTS --}}
        <div>
            <button type="button" @click="toggleMenu('reports')"
                class="collapse-parent-menu sidebar-button relative w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition-all duration-300 group">

                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>

                    <span class="menu-text main-menu-title">{{ __('all.reports') }}</span>
                </div>

                <span class="tooltip-text">{{ __('all.reports') }}</span>

                <svg class="menu-arrow w-4 h-4 transition-transform duration-200"
                    :class="{ 'rotate-180': openMenus.reports }" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                    </path>
                </svg>
            </button>

            <div x-show="openMenus.reports || isCollapsed()" x-cloak class="submenu-wrapper ml-6 mt-1 space-y-1">
                <a href="{{ url('/reports/attendance') }}"
                    class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">

                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>

                    <span class="menu-text">{{ __('all.attendance_report') }}</span>
                    <span class="tooltip-text">{{ __('all.attendance_report') }}</span>
                </a>

                <a href="{{ url('/reports/financial') }}"
                    class="sidebar-link relative flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-[#90C74A] hover:text-white transition">

                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>

                    <span class="menu-text">{{ __('all.financial_report') }}</span>
                    <span class="tooltip-text">{{ __('all.financial_report') }}</span>
                </a>
            </div>
        </div>
    </nav>

    {{-- USER INFO --}}
    <div class="mt-auto p-4 border-t border-gray-100 user-box">
        <div class="flex items-center gap-3">
            <div
                class="w-10 h-10 bg-gradient-to-r from-[#90C74A] to-[#7db33e] rounded-xl flex items-center justify-center shadow-sm shrink-0">
                <span class="text-white font-bold text-lg">
                    {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                </span>
            </div>

            <div class="menu-text flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-800 truncate">
                    {{ auth()->user()->name ?? 'User' }}
                </p>

                <p class="text-xs text-gray-500">
                    @php $roleName = auth()->user()->getRoleNames()->first() ?? 'user'; @endphp
                    {{ __("all.$roleName") }}
                </p>
            </div>

            <a href="{{ route('profile.edit') }}" class="menu-text text-gray-400 hover:text-[#90C74A] transition">
                ⚙️
            </a>
        </div>

        {{-- COLLAPSE BUTTON --}}
        <button id="collapseSidebarBtn"
            class="sidebar-button mt-4 w-full flex items-center justify-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-[#90C74A] hover:text-white transition">

            <svg id="collapseIcon" class="w-5 h-5 shrink-0" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">

                <path id="collapseIconPath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 19l-7-7 7-7m8 14l-7-7 7-7">
                </path>
            </svg>

            <span class="menu-text">
                Collapse
            </span>
        </button>
    </div>

    {{-- VERSION --}}
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

    #sidebar.w-20 .collapse-parent-menu {
        display: none !important;
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
        line-height: 1;
        padding: 8px 10px;
        border-radius: 8px;
        white-space: nowrap;
        z-index: 9999;
        box-shadow: 0 10px 20px rgba(0, 0, 0, .12);
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

    #sidebar.w-20 .sidebar-link:hover .tooltip-text,
    #sidebar.w-20 .sidebar-button:hover .tooltip-text {
        display: block;
    }

    #sidebar.w-20 .user-box,
    #sidebar.w-20 .version-box {
        padding-left: 12px;
        padding-right: 12px;
    }
</style>
