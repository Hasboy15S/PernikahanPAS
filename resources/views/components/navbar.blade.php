<!-- Dummy Navbar -->

<nav class="fixed top-0 left-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50">
    <div class="max-w-6xl mx-auto px-6 py-3 flex justify-between items-center">

        {{-- LOGO / TITLE --}}
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-[#C19A6B] rounded-full"></div>
            <span class="text-lg font-semibold">Pernikahan</span>
        </div>

        {{-- MENU --}}
        <ul class="flex space-x-6 text-sm">
            <li>
                <a href="{{ url('/') }}" class="hover:text-[#C19A6B]">Beranda</a>
            </li>
            <li>
                <a href="{{ url('/rsvp') }}" class="hover:text-[#C19A6B]">RSVP</a>
            </li>
            <li>
                <a href="{{ url('/thankyou') }}" class="hover:text-[#C19A6B]">Ucapan</a>
            </li>
        </ul>

    </div>
</nav>
