<x-guest-layout>
    @php
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        }
    @endphp

    <div class="text-center mb-6">
        <div class="flex justify-center">
            <div class="w-16 h-16 bg-[#90C74A] rounded-2xl flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
            </div>
        </div>
        <h2 class="mt-4 text-2xl font-bold text-gray-800">Anaku Educare</h2>
        <p class="text-sm text-gray-500">{{ __('all.login_to_account') }}</p>
    </div>

    @if (session('status'))
        <div class="mb-4 text-sm text-green-600 bg-green-50 p-3 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('all.email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-[#90C74A] focus:border-[#90C74A]">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('all.password') }}</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-[#90C74A] focus:border-[#90C74A]">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-center justify-between mt-4">
            <label class="flex items-center">
                <input type="checkbox" name="remember"
                    class="rounded border-gray-300 text-[#90C74A] focus:ring-[#90C74A]">
                <span class="ml-2 text-sm text-gray-600">{{ __('all.remember_me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-[#90C74A] hover:text-[#7db33e]">
                    {{ __('all.forgot_password') }}
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit"
                class="w-full bg-[#90C74A] hover:bg-[#7db33e] text-white font-medium py-2 px-4 rounded-lg transition shadow-sm hover:shadow-md">
                {{ __('all.log_in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
