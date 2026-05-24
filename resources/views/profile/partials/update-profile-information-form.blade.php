<form method="post" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('patch')

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.name') }}</label>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-[#90C74A] focus:border-[#90C74A] @error('name') border-red-500 @enderror">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.email') }}</label>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-[#90C74A] focus:border-[#90C74A] @error('email') border-red-500 @enderror">
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-6 py-2.5 rounded-xl transition">
            {{ __('all.save') }}
        </button>
    </div>

    @if (session('status') === 'profile-updated')
        <p class="text-sm text-green-600 mt-2">{{ __('all.saved') }}</p>
    @endif
</form>
