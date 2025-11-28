@extends('layouts.admin')

@section('title', 'Edit Invitation')

@section('content')

<h1 class="text-3xl font-bold text-gray-700 mb-6">Edit Invitation</h1>

{{-- Tombol kembali --}}
<a href="{{ route('admin.invitation.index') }}" 
   class="inline-block mb-6 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
    ← Kembali
</a>

{{-- Card Form --}}
<div class="bg-white p-8 rounded-2xl shadow-md border max-w-xl">

<form action="{{ route('admin.invitation.update', $inv) }}" method="POST">


          
        @csrf
        @method('PUT')

        {{-- NAMA --}}
        <div class="mb-5">
            <label class="block font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" 
                   name="nama" 
                   value="{{ old('nama', $inv->nama) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-brown-700"
                   required>
        </div>

        {{-- EMAIL --}}
        <div class="mb-5">
            <label class="block font-medium text-gray-700 mb-1">Email</label>
            <input type="email" 
                   name="email" 
                   value="{{ old('email', $inv->email) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-brown-700"
                   required>
        </div>

        {{-- JUMLAH HADIR --}}
        <div class="mb-5">
            <label class="block font-medium text-gray-700 mb-1">Jumlah Hadir</label>
            <input type="number" 
                   name="jml_hadir"
                   min="0"
                   value="{{ old('jml_hadir', $inv->jml_hadir) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-brown-700"
                   required>
        </div>

        {{-- PESAN / NOTE --}}
        <div class="mb-5">
            <label class="block font-medium text-gray-700 mb-1">Pesan</label>
            <textarea name="message"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 h-24 resize-none focus:outline-none focus:border-brown-700"
                      placeholder="Pesan tambahan (opsional)">{{ old('message', $inv->message) }}</textarea>
        </div>

        {{-- STATUS --}}
        <div class="mb-6">
            <label class="block font-medium text-gray-700 mb-1">Status Kehadiran</label>

            <select name="status"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-brown-700"
                    required>

                <option value="belum" {{ $inv->status == 'belum' ? 'selected' : '' }}>Belum Hadir</option>
                <option value="hadir" {{ $inv->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="batal" {{ $inv->status == 'batal' ? 'selected' : '' }}>Batal</option>

            </select>
        </div>

        {{-- SUBMIT --}}
        <button type="submit"
            class="w-full py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">
            Update Invitation
        </button>

    </form>

</div>

@endsection
