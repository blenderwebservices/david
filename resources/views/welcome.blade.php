<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts (opcional, como en el original) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @viteReactRefresh
    @vite(['src/main.jsx', 'resources/css/app.css'])
</head>
<body class="antialiased">
    @auth
        <div style="position: fixed; top: 1rem; right: 1rem; z-index: 50;">
            <a href="/admin" style="background: rgba(0,0,0,0.8); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; text-decoration: none; backdrop-filter: blur(4px); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                Dashboard Admin
            </a>
        </div>
    @endauth
    <div id="root"></div>
</body>
</html>
