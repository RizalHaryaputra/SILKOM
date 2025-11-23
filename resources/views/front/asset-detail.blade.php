@extends('layouts.front')
@section('title', 'Detail Aset')

@section('content')
<section class="bg-gray-50 py-20 px-4 sm:px-6 lg:px-8bg-gray-50">
    <div class="min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb / Tombol Kembali --}}
            <div class="mb-6">
                <a href="{{ route('front.assets') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Katalog
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">

                    {{-- KOLOM KIRI: GAMBAR --}}
                    <div class="bg-gray-100 flex items-center justify-center p-8 lg:p-12 h-96 lg:h-auto relative">
                        @if($asset->asset_image_path)
                        <img src="{{ asset('storage/' . $asset->asset_image_path) }}" alt="{{ $asset->name }}"
                            class="max-w-full max-h-full object-contain shadow-lg rounded-lg">
                        @else
                        <div class="text-gray-300 flex flex-col items-center">
                            <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="mt-4 text-lg font-medium">Tidak ada gambar</span>
                        </div>
                        @endif

                        {{-- Badge Kategori (Floating) --}}
                        <span
                            class="absolute top-6 left-6 bg-white/90 backdrop-blur px-4 py-2 rounded-full text-sm font-bold text-gray-700 shadow-sm">
                            {{ $asset->category }}
                        </span>
                    </div>

                    {{-- KOLOM KANAN: DETAIL INFORMASI --}}
                    <div class="p-8 lg:p-12 flex flex-col justify-center">

                        {{-- Status Badge --}}
                        <div class="mb-4">
                            @if($asset->status === 'Available')
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <span class="w-2 h-2 mr-2 bg-green-500 rounded-full"></span>
                                Tersedia
                            </span>
                            @elseif($asset->status === 'Borrowed')
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <span class="w-2 h-2 mr-2 bg-yellow-500 rounded-full"></span>
                                Sedang Dipinjam
                            </span>
                            @elseif($asset->status === 'Damaged')
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>
                                Dalam Perbaikan
                            </span>
                            @endif
                        </div>

                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                            {{ $asset->name }}
                        </h1>

                        <div class="prose prose-blue text-gray-600 mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi & Spesifikasi</h3>
                            <p class="leading-relaxed">
                                {{ $asset->description ?? 'Tidak ada deskripsi detail untuk aset ini.' }}
                            </p>
                        </div>

                        <div class="border-t border-gray-100 pt-8">
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Informasi Tambahan
                            </h3>
                            <dl class="grid grid-cols-2 gap-x-4 gap-y-6">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Terakhir Diupdate</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{
                                        $asset->updated_at->diffForHumans() }}</dd>
                                </div>
                            </dl>
                        </div>

                        {{-- Call to Action --}}
                        <div class="mt-10">
                            @if($asset->status === 'Available')
                            @auth
                            {{-- Jika sudah login, arahkan ke dashboard student untuk meminjam --}}
                            <a href="{{ route('student.borrow.create', ['asset_id' => $asset->id]) }}"
                                class="w-full block text-center px-6 py-4 border border-transparent rounded-xl shadow-sm text-lg font-bold text-white bg-blue-600 hover:bg-blue-700 transition transform hover:-translate-y-0.5">
                                Ajukan Peminjaman Sekarang
                            </a>
                            @else
                            {{-- Jika belum login --}}
                            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 text-center">
                                <p class="text-blue-800 font-medium mb-3">Tertarik meminjam alat ini?</p>
                                <a href="{{ route('login') }}"
                                    class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow-md">
                                    Login untuk Meminjam
                                </a>
                            </div>
                            @endauth
                            @else
                            <button disabled
                                class="w-full block px-6 py-4 border border-gray-200 rounded-xl text-lg font-bold text-gray-400 bg-gray-100 cursor-not-allowed">
                                Aset Tidak Tersedia
                            </button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection