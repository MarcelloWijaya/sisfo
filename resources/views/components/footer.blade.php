@php
    // FORCE SET LOCALE DARI SESSION
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }
@endphp

<footer class="bg-white border-t border-gray-100 px-6 py-4">
    <div class="flex flex-col md:flex-row justify-between items-center gap-3">
        <p class="text-sm text-gray-500">
            © {{ date('Y') }} Anaku Educare. {{ __('all.all_rights_reserved') }}
        </p>

        <div class="flex items-center gap-4">
            <a href="#" class="text-xs text-gray-400 hover:text-[#90C74A] transition-colors">
                {{ __('all.privacy_policy') }}
            </a>
            <span class="text-gray-300">|</span>
            <a href="#" class="text-xs text-gray-400 hover:text-[#90C74A] transition-colors">
                {{ __('all.terms_of_service') }}
            </a>
            <span class="text-gray-300">|</span>
            <a href="#" class="text-xs text-gray-400 hover:text-[#90C74A] transition-colors">
                {{ __('all.help_center') }}
            </a>
        </div>
    </div>
</footer>
