<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    {{-- SIDEBAR --}}
    <aside class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg z-50">
        <div class="p-6 border-b">
            <h1 class="text-xl font-bold text-gray-700">Admin Panel</h1>
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded-lg hover:bg-gray-200 {{ request()->is('admin/dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
               Dashboard
            </a>

            <a href="{{ route('admin.invitation.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-gray-200 {{ request()->is('admin/invitation*') ? 'bg-gray-200 font-semibold' : '' }}">
               Invitation
            </a>

            <a href="{{ route('admin.produk.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-gray-200 {{ request()->is('admin/produk*') ? 'bg-gray-200 font-semibold' : '' }}">
               Produk
            </a>
        </nav>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="ml-64 p-8">
        @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg border border-green-300">
    {{ session('success') }}
    </div>
    @endif
        @yield('content')
    </main>

</body>
</html>
