@extends('layouts.front')

@section('content')
<div class="container mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold text-center mb-2">Katalog Aset</h1>
    <p class="text-center text-gray-600 mb-10">
        Daftar aset laboratorium yang tersedia untuk digunakan dan dikelola.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach ($assets as $item)
            <div class="bg-white shadow rounded-lg overflow-hidden">

                {{-- Gambar Aset --}}
                @if ($item->asset_image_path)
                    <img src="{{ asset('storage/' . $item->asset_image_path) }}"
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                        Tidak ada gambar
                    </div>
                @endif

                <div class="p-4">
                    <h2 class="text-lg font-semibold">{{ $item->name }}</h2>

                    {{-- STATUS --}}
                    <p class="text-green-600 font-medium">Available</p>

                    {{-- KATEGORI --}}
                    <p class="text-gray-600 text-sm mb-4">
                        Kategori: {{ $item->category }}
                    </p>

                    {{-- TOMBOL DETAIL --}}
                    <a href="#"
                       class="block w-full text-center border rounded-md py-2 hover:bg-gray-100 transition">
                        Lihat Detail
                    </a>
                </div>

            </div>
        @endforeach

    </div>

</div>
@endsection
