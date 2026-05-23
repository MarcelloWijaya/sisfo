<x-app-layout>
    <div class="p-6 bg-gray-50 min-h-screen">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                Super Admin Dashboard
            </h1>
            <p class="text-gray-500">
                Welcome to Anaku Educare Information System
            </p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Students Card -->
            <div
                class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border-l-4 border-[#90C74A]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Students</p>
                        <p class="text-3xl font-bold text-gray-800">900</p>
                        <p class="text-xs text-green-600 mt-2">
                            <span class="inline-flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                +12% from last month
                            </span>
                        </p>
                    </div>
                    <div class="bg-[#90C74A]/10 rounded-full p-3">
                        <svg class="w-8 h-8 text-[#90C74A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Teachers Card -->
            <div
                class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border-l-4 border-[#90C74A]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Teachers</p>
                        <p class="text-3xl font-bold text-gray-800">90</p>
                        <p class="text-xs text-green-600 mt-2">
                            <span class="inline-flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                +5 new this month
                            </span>
                        </p>
                    </div>
                    <div class="bg-[#90C74A]/10 rounded-full p-3">
                        <svg class="w-8 h-8 text-[#90C74A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Branches Card -->
            <div
                class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border-l-4 border-[#90C74A]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Branches</p>
                        <p class="text-3xl font-bold text-gray-800">9</p>
                        <p class="text-xs text-gray-500 mt-2">Active branches</p>
                    </div>
                    <div class="bg-[#90C74A]/10 rounded-full p-3">
                        <svg class="w-8 h-8 text-[#90C74A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue Card -->
            <div
                class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border-l-4 border-[#90C74A]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Monthly Revenue</p>
                        <p class="text-3xl font-bold text-gray-800">Rp 150.000.000</p>
                        <p class="text-xs text-green-600 mt-2">
                            <span class="inline-flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                +8.2% from last month
                            </span>
                        </p>
                    </div>
                    <div class="bg-[#90C74A]/10 rounded-full p-3">
                        <svg class="w-8 h-8 text-[#90C74A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <button
                    class="bg-[#90C74A] hover:bg-[#7db33e] text-white font-semibold py-3 px-4 rounded-xl transition-colors duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add New Student
                </button>
                <button
                    class="bg-[#90C74A] hover:bg-[#7db33e] text-white font-semibold py-3 px-4 rounded-xl transition-colors duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                        </path>
                    </svg>
                    Register Teacher
                </button>
                <button
                    class="bg-[#90C74A] hover:bg-[#7db33e] text-white font-semibold py-3 px-4 rounded-xl transition-colors duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Generate Report
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
