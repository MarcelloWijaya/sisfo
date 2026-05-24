<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Anaku Educare - @yield('title', 'Information System')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        @include('components.sidebar')
        <div id="mainWrapper" class="flex-1 flex flex-col transition-all duration-300">
            @include('components.navbar')
            <main class="flex-1 p-6">@yield('content')</main>
            @include('components.footer')
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainWrapper = document.getElementById('mainWrapper');
        const collapseBtn = document.getElementById('collapseSidebarBtn');
        const collapseIcon = document.getElementById('collapseIcon');
        const mobileBtn = document.getElementById('mobileMenuButton');

        const savedState = localStorage.getItem('sidebarCollapsed') === 'true';

        function setSidebar(collapsed) {
            if (collapsed) {
                sidebar.classList.remove('w-72');
                sidebar.classList.add('w-20');
                mainWrapper.classList.remove('ml-72');
                mainWrapper.classList.add('ml-20');
                document.querySelectorAll('.menu-text, .logo-text').forEach(el => el.style.display = 'none');
                if (collapseIcon) collapseIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>';
            } else {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-72');
                mainWrapper.classList.remove('ml-20');
                mainWrapper.classList.add('ml-72');
                document.querySelectorAll('.menu-text, .logo-text').forEach(el => el.style.display = '');
                if (collapseIcon) collapseIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>';
            }
        }

        setSidebar(savedState);

        collapseBtn?.addEventListener('click', () => {
            const isCollapsed = sidebar.classList.contains('w-20');
            setSidebar(!isCollapsed);
            localStorage.setItem('sidebarCollapsed', !isCollapsed);
        });

        mobileBtn?.addEventListener('click', () => sidebar.classList.toggle('-translate-x-full'));

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) sidebar.classList.remove('-translate-x-full');
        });
    </script>

    @stack('scripts')
</body>

</html>
