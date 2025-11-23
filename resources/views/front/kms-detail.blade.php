@extends('layouts.front')
@section('title', 'Detail KMS')

@section('content')
<section class="bg-gray-50 py-20 px-4 sm:px-6 lg:px-8bg-gray-50">
    <div class="relative bg-gray-900">
        <div class="absolute inset-0">
            @if($kms->cover_image)
            <img class="w-full h-full object-cover opacity-40" src="{{ asset('storage/' . $kms->cover_image) }}"
                alt="{{ $kms->title }}">
            @else
            <div class="w-full h-full bg-gradient-to-r from-blue-900 to-indigo-900 opacity-90"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
            {{-- Badge Kategori --}}
            <span
                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-4 uppercase tracking-wider">
                {{ $kms->category }}
            </span>

            {{-- Judul Dokumen --}}
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-6 leading-tight">
                {{ $kms->title }}
            </h1>

            {{-- Meta Info (Penulis & Tanggal) --}}
            <div class="flex items-center justify-center space-x-4 text-gray-300 text-sm">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>{{ $kms->author ?? 'Admin Lab' }}</span>
                </div>
                <span>&bull;</span>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ $kms->created_at->isoFormat('D MMMM YYYY') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Konten Utama --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Tombol Kembali --}}
        <div class="mb-8">
            <a href="{{ route('front.kms') }}"
                class="inline-flex items-center text-sm text-gray-500 hover:text-blue-600 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Panduan
            </a>
        </div>

        {{-- Artikel --}}
        <article class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12">
            {{--
            Class 'prose' dan 'prose-lg' berasal dari plugin @tailwindcss/typography.
            Ini wajib ada agar HTML dari TinyMCE (h1, h2, ul, ol, bold) tampil dengan benar.
            --}}
            <div class="prose prose-lg prose-blue max-w-none text-gray-700">
                {!! $kms->content !!}
            </div>
        </article>

        {{-- Footer Artikel --}}
        <div class="mt-12 border-t border-gray-200 pt-8 flex justify-between items-center">
            <p class="text-sm text-gray-500">
                Terakhir diperbarui: {{ $kms->updated_at->diffForHumans() }}
            </p>

            {{-- Tombol Share (Opsional/Dummy) --}}
            <div class="flex space-x-3">
                <button
                    class="p-2 rounded-full bg-gray-100 text-gray-500 hover:bg-blue-50 hover:text-blue-600 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </button>
                <button
                    class="p-2 rounded-full bg-gray-100 text-gray-500 hover:bg-blue-400 hover:text-white transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>
@endsection