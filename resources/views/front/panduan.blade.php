@extends('layouts.front')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="container mx-auto py-10">

    <h1 class="text-3xl font-bold mb-6">Panduan Penggunaan Laboratorium (KMS)</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($guides as $guide)
        <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition">

            @if ($guide->cover_image)
                <img src="{{ asset('storage/' . $guide->cover_image) }}"
                     class="w-full h-40 object-cover rounded mb-4">
            @endif

            <h2 class="text-xl font-semibold mb-2">{{ $guide->title }}</h2>

            <p class="text-sm text-gray-600 mb-3">
                <strong>Kategori:</strong> {{ $guide->category }}
            </p>

            <p class="text-gray-800 mb-4">
                {{ Str::limit($guide->content, 120) }}
            </p>

            <a href="#"
               class="text-blue-600 font-semibold hover:underline">
               Lihat Detail
            </a>
        </div>
        @endforeach

    </div>

</div>
@endsection
