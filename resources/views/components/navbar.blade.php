@php
    // FORCE SET LOCALE - PASTIKAN SESSION DAN APP SINKRON
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp


<header
    class="bg-white shadow-sm sticky top-0 z-20 px-6 py-4 flex justify-between items-center border-b border-gray-100">
    <!-- Mobile menu button -->
    <button class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100" id="mobileMenuButton">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <div class="flex-1 md:flex-none">
        <h2 class="text-xl font-semibold text-gray-800">
            @yield('header', 'Dashboard')
        </h2>
        <p class="text-sm text-gray-500 flex items-center gap-2 mt-1">
            <svg class="w-4 h-4 text-[#90C74A]" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ __('all.welcome') }}, {{ auth()->user()->name ?? 'User' }}
        </p>
    </div>

    <div class="flex items-center gap-4">
        <!-- Notifications -->
        <button class="relative p-2 text-gray-500 hover:bg-gray-100 rounded-xl transition-colors"
            id="notificationButton">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
            </svg>
            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <!-- Language Switcher -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                    </path>
                </svg>
                <span class="text-sm font-medium">{{ strtoupper(app()->getLocale()) }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-2 w-36 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-30">
                <a href="{{ route('lang.switch', 'en') }}"
                    class="flex items-center gap-2 px-4 py-2 text-sm {{ app()->getLocale() == 'en' ? 'bg-[#90C74A]/10 text-[#90C74A]' : 'text-gray-700' }} hover:bg-gray-100 transition">
                    <span class="text-lg">🇬🇧</span>
                    <span>English</span>
                    @if (app()->getLocale() == 'en')
                        <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    @endif
                </a>
                <a href="{{ route('lang.switch', 'id') }}"
                    class="flex items-center gap-2 px-4 py-2 text-sm {{ app()->getLocale() == 'id' ? 'bg-[#90C74A]/10 text-[#90C74A]' : 'text-gray-700' }} hover:bg-gray-100 transition">
                    <span class="text-lg">🇮🇩</span>
                    <span>Indonesia</span>
                    @if (app()->getLocale() == 'id')
                        <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    @endif
                </a>
            </div>
        </div>

        <!-- User Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 transition-colors">
                <div class="w-8 h-8 bg-[#90C74A] rounded-full flex items-center justify-center">
                    <span class="text-white text-sm font-semibold">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </span>
                </div>
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-30">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    {{ __('all.profile_settings') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                        {{ __('all.logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

@push('scripts')
    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuButton')?.addEventListener('click', function() {
            const sidebar = document.querySelector('aside');
            sidebar?.classList.toggle('hidden');
        });
    </script>
@endpush
