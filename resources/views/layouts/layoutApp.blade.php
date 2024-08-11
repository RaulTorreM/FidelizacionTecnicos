<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Club de Técnicos | @yield('title')</title>
    <link rel="icon" href="{{ asset('images/mainIcon.ico') }}" type="image/ico">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@300;400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/appStyles.css') }}">
    @stack('styles')
</head>
<body>
    <header>
        @yield('header')
    </header>

    <main>
		@yield('content')
    </main>

    <footer>
        @yield('footer')
    </footer>

    @stack('scripts')
</body>
</html>