@extends('layouts.front')

@section('title', 'Daftar KMS')
@php use Illuminate\Support\Str; @endphp

@section('content')
<section class="py-20 px-4 sm:px-6 lg:px-8bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mt-16">
            <h2 class="text-3xl font-bold mb-2">Panduan Penggunaan Lab (KMS)</h2>
            <p class="text-gray-600 mb-10">
                Dokumen panduan penggunaan laboratorium untuk membantu operasional kegiatan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($guides as $kms)
            <div class="bg-white shadow rounded-xl overflow-hidden">

                {{-- Gambar --}}
                @if ($kms->cover_image)
                <img src="{{ asset('storage/' . $kms->cover_image) }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-600">
                    Tidak Ada Gambar
                </div>
                @endif

                <div class="p-5 text-left">
                    <h3 class="font-semibold text-xl">{{ $kms->title }}</h3>
                    <p class="text-sm text-gray-600 mt-2">
                        Kategori: {{ $kms->category }}
                    </p>

                    <a href="{{ route('front.kms-detail', $kms) }}" class="block text-center mt-5 border rounded-lg py-2 hover:bg-gray-100">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection