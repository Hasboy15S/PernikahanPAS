@extends('layouts.admin')

@section('title', 'Invitation')

@section('content')

<h1 class="text-3xl font-bold text-gray-700 mb-6">Invitation</h1>

{{-- BUTTON TAMBAH --}}
<div class="mb-6">
    <a href="{{ route('admin.invitation.create') }}"
       class="px-3 bg-gray-300 py-3 bg-brown-700 text-black rounded-md hover:bg-brown-800 transition">
        + Tambah Data
    </a>
</div>

{{-- TABLE WRAPPER --}}
<div class="bg-white p-6 rounded-2xl shadow-md border">

    <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Tamu RSVP</h2>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-left">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-3">Id</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Jumlah Hadir</th>
                    <th class="p-3">Status Scan</th>
                    <th class="p-3">Created_at</th>
                    <th class="p-3">Updated_at</th>
                    <th class="p-3">message</th>
                    <th class="p-3">kode_qr</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $item)
                <tr class="border-b hover:bg-gray-50 transition">

                    {{-- Id --}}
                    <td class="p-3 font-medium">{{ $item->id }}</td>

                    {{-- NAMA --}}
                    <td class="p-3 font-medium">{{ $item->nama }}</td>

                    {{-- EMAIL --}}
                    <td class="p-3">{{ $item->email ?? '-' }}</td>

                    {{-- JUMLAH --}}
                    <td class="p-3">{{ $item->jml_hadir ?? 0 }}</td>

                    {{-- STATUS SCAN --}}
                    <td class="p-3">
                        @if ($item->status === 'hadir')
                            <span class="px-3 py-1 rounded-full bg-green-700 text-white text-sm">Hadir</span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-gray-500 text-white text-sm">Belum</span>
                        @endif
                    </td>
                    {{-- CREATED_AT --}}
                    <td class="p-3">{{ $item->created_at->format('d M Y') }}</td>

                    {{-- UPDATED_AT --}}
                    <td class="p-3">{{ $item->updated_at->format('d M Y') }}</td>
                    <td class="p-3">{{ $item->message ?? '-' }}</td>
                    <td class="p-3">{{ $item->code_qr ?? '-' }}</td>
                    {{-- AKSI --}}
                    <td class="p-3 text-center flex items-center justify-center gap-2">

                        {{-- EDIT --}}
                        <a href="{{ route('admin.invitation.edit', $item->id_invitation) }}" 
                            class="px-3 py-1 rounded-full text-white bg-green-600 text-sm">
                                Edit
                            </a>

                        {{-- DELETE --}}
                        <form action="{{ route('admin.invitation.destroy', $item->id_invitation) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 rounded-full text-white bg-red-600 text-sm">Delete</button>
                        </form>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@if(session('qr_popup'))
<script>
    window.onload = function() {
        let qr = "{{ session('qr_popup') }}";

        alert("QR Berhasil Dibuat!");
        window.open(qr, "_blank", "width=400,height=400");
    };
</script>
@endif

@endsection
