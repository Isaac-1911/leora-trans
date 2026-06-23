<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leora Trans</title>

    {{-- Tailwind --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
</head>
<body class="bg-black text-white">

    @yield('content')

</body>
</html>
