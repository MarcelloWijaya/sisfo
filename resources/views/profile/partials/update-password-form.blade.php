<form method="post" action="{{ route('password.update') }}" class="space-y-4">
    @csrf
    @method('put')

    <div>
        <label for="current_password"
            class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.current_password') }}</label>
        <input type="password" name="current_password" id="current_password" required
            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-[#90C74A] focus:border-[#90C74A] @error('current_password') border-red-500 @enderror">
        @error('current_password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.new_password') }}</label>
        <input type="password" name="password" id="password" required
            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-[#90C74A] focus:border-[#90C74A] @error('password') border-red-500 @enderror">
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password_confirmation"
            class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.confirm_password') }}</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required
            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-[#90C74A] focus:border-[#90C74A]">
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-6 py-2.5 rounded-xl transition">
            {{ __('all.update_password') }}
        </button>
    </div>

    @if (session('status') === 'password-updated')
        <p class="text-sm text-green-600 mt-2">{{ __('all.saved') }}</p>
    @endif
</form>
