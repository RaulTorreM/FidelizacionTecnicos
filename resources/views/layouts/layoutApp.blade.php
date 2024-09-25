<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="font-medium">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Estilos globales -->
    <link rel="stylesheet" href="{{ asset('css/appStyles.css') }}">
    
    @stack('styles')

    <script>
        // Aplicar configuración al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('darkMode') === 'true') {
                document.body.classList.add('dark-mode');
            }
            document.documentElement.classList.remove('font-small', 'font-medium', 'font-large');
            document.documentElement.classList.add(`font-${localStorage.getItem('fontSize') || 'medium'}`);
            const activeLink = document.querySelector('.sidebar a.active');
            if (activeLink) {
                activeLink.style.backgroundColor = localStorage.getItem('sidebarColor') || '#007bff';
            }
        });
    </script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>