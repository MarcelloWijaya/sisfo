<form method="post" action="{{ route('profile.destroy') }}" class="space-y-4"
    onsubmit="return confirm('{{ __('all.delete_account_confirm') }}')">
    @csrf
    @method('delete')

    <div class="bg-red-50 rounded-xl p-4 border border-red-200">
        <p class="text-sm text-red-600 mb-4">{{ __('all.delete_account_warning') }}</p>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('all.password') }} <span
                    class="text-red-500">*</span></label>
            <input type="password" name="password" id="password" required
                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-[#90C74A] focus:border-[#90C74A] @error('password') border-red-500 @enderror"
                placeholder="{{ __('all.enter_password_to_confirm') }}">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2.5 rounded-xl transition">
                {{ __('all.delete_account') }}
            </button>
        </div>
    </div>
</form>
