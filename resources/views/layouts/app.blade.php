<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Anaku Educare - @yield('title', 'Information System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100">

    <div class="min-h-screen flex">
        @include('components.sidebar')

        <div class="flex-1 flex flex-col md:ml-72">
            @include('components.navbar')

            <main class="flex-1 p-6">
                @yield('content')
            </main>

            @include('components.footer')
        </div>
    </div>

    @stack('scripts')
</body>

</html>
