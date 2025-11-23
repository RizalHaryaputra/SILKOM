@extends('layouts.front')
@section('title', 'Katalog Aset')

@section('content')
<section class="py-20 px-4 sm:px-6 lg:px-8bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mt-16">
            <h1 class="text-3xl font-bold text-center mb-2">Katalog Aset</h1>
            <p class="text-center text-gray-600 mb-10">
                Daftar aset laboratorium yang tersedia untuk digunakan dan dikelola.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($assets as $asset)
            <div class="bg-white shadow rounded-xl overflow-hidden">

                {{-- Gambar --}}
                @if ($asset->asset_image_path)
                <img src="{{ asset('storage/' . $asset->asset_image_path) }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-200 text-gray-400 flex flex-col items-center justify-center">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="mt-4 text-md    font-medium">Tidak ada gambar</span>
                </div>
                @endif

                <div class="p-5 text-left">
                    <h3 class="font-semibold text-xl">{{ $asset->name }}</h3>
                    <p class="text-green-700 font-bold mt-1">
                        {{ ucfirst($asset->status) }}
                    </p>
                    <p class="text-sm text-gray-600 mt-2">
                        Kategori: {{ $asset->category }}
                    </p>

                    <a href="{{ route('front.asset-detail', $asset) }}"
                        class="block text-center mt-5 border rounded-lg py-2 hover:bg-gray-100">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection