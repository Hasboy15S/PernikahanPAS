<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Pernikahan')</title>

    {{-- Tailwind --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])


    {{-- Favicon (dummy) --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
</head>

<body class="bg-[#f7f5f0] text-[#4E342E] font-[Poppins]">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- PAGE CONTENT --}}
    <main class="pt-20">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('components.footer')

    {{-- JS --}}
    @vite('resources/js/app.js')

</body>
</html>
