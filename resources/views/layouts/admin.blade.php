<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

    @include('partials.sidebar')

    <div class="main-wrapper">

        @include('partials.topbar')

        <main class="content">
            @yield('content')
        </main>

    </div>


    @include('partials.alert')
    @stack('scripts')
</body>

</html>
