@extends('layouts.main')

@section('title', 'Beranda')

@section('content')

{{-- Sambutan --}}
<div class="max-w-3xl mx-auto text-center py-20">
    <p class="text-[#6D4C41] leading-relaxed text-lg mb-4">
        Dengan penuh rasa syukur, kami mengundang Bapak/Ibu/Saudara/i
        untuk hadir pada acara pernikahan kami.
    </p>

    <h1 class="text-4xl font-bold text-[#8B4513] mb-2">
        Fhataayy & Chelsya
    </h1>
</div>

{{-- Form RSVP (dummy) --}}
<div class="max-w-md mx-auto py-10 px-6 border-t border-gray-300">

    <h1 class="text-5xl font-[cursive] text-center mb-4">rsvp</h1>

    <p class="text-center text-gray-600 mb-10">Batas paling lambat 30 November 2025</p>

    {{-- NAMA --}}
    <label class="block text-sm text-gray-700 font-medium mb-1">Nama *</label>
    <input 
        type="text" 
        class="w-full border-b border-gray-400 focus:outline-none focus:border-black py-2 mb-6"
        placeholder="Nama Lengkap"
    >

    {{-- PILIHAN HADIR (RADIO) --}}
    <p class="text-gray-700 font-medium mb-2">Kehadiran *</p>

    <div class="space-y-3 mb-6">
        <label class="flex items-center gap-3 text-gray-700">
            <input 
                type="radio" 
                name="kehadiran" 
                value="hadir" 
                id="radio-hadir"
                class="w-4 h-4"
            >
            Hadir
        </label>

        <label class="flex items-center gap-3 text-gray-700">
            <input 
                type="radio" 
                name="kehadiran" 
                value="tidakhadir" 
                id="radio-tidak-hadir"
                class="w-4 h-4"
            >
            Tidak Hadir
        </label>
    </div>

    {{-- JUMLAH YANG HADIR (AUTO SHOW) --}}
    <div id="jumlah-wrapper" class="hidden transition-all duration-300">
        <label class="block text-sm text-gray-700 font-medium mb-1">Jumlah yang hadir</label>
        <input 
            type="number"
            min="1"
            class="w-full border-b border-gray-400 focus:outline-none focus:border-black py-2 mb-8"
            placeholder="Contoh: 2 orang"
        />
    </div>

    {{-- EMAIL --}}
    <label class="block text-sm text-gray-700 font-medium mb-1">Email</label>
    <input 
        type="email" 
        class="w-full border-b border-gray-400 focus:outline-none focus:border-black py-2 mb-8"
        placeholder="XIPPLG6@kece.com"
    >

    {{-- FOOD CHOICE --}}
    <p class="text-gray-700 font-medium mb-4">
        Pilih Hidangan Pembuka:
    </p>

    <div class="space-y-3 mb-10">
        <label class="flex items-center gap-3 text-gray-700">
            <input type="checkbox" class="w-4 h-4 border-gray-500">
            Gudeg
        </label>

        <label class="flex items-center gap-3 text-gray-700">
            <input type="checkbox" class="w-4 h-4 border-gray-500">
            Rawon
        </label>
    </div>

    {{-- BUTTON --}}
    <button class="w-full bg-black text-white py-3 rounded-full tracking-wide hover:bg-gray-800 transition">
        Kirim
    </button>

</div>

<script>
    // Radio button kehadiran logic
    const radioHadir = document.getElementById('radio-hadir');
    const radioTidakHadir = document.getElementById('radio-tidak-hadir');
    const jumlahWrapper = document.getElementById('jumlah-wrapper');

    radioHadir.addEventListener('change', () => {
        jumlahWrapper.classList.remove('hidden');
    });

    radioTidakHadir.addEventListener('change', () => {
        jumlahWrapper.classList.add('hidden');
    });
</script>

@endsection
