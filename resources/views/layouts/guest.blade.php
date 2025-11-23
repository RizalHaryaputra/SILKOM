<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Title akan diambil dari halaman (login atau register) --}}
    <title>{{ $title ?? 'SILKOM' }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100 antialiased min-h-screen flex flex-col">
    <nav class="sticky top-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span
                        class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">SILKOM</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="/#beranda" class="text-gray-700 hover:text-blue-600 transition">Beranda</a>
                    <a href="/#fitur" class="text-gray-700 hover:text-blue-600 transition">Fitur</a>
                    <a href="/#aset" class="text-gray-700 hover:text-blue-600 transition">Aset</a>
                    <a href="/#kms" class="text-gray-700 hover:text-blue-600 transition">KMS</a>
                </div>
                <div class="flex space-x-3">
                    {{-- Navigasi ini hanya untuk Tamu (Guest) --}}
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-blue-600 {{ request()->routeIs('login') ? 'bg-blue-50 font-semibold' : 'hover:bg-blue-50' }} rounded-lg transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 {{ request()->routeIs('register') ? 'bg-gradient-to-r from-blue-700 to-indigo-700' : 'bg-gradient-to-r from-blue-600 to-indigo-600' }} text-white rounded-lg hover:shadow-lg transition transform hover:scale-105">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- INI ADALAH KONTEN HALAMAN (SLOT) --}}
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-gray-900 text-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8 mb-8">

                {{-- 1. Brand & Deskripsi --}}
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center space-x-2 mb-4">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold tracking-wide">SILKOM</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Sistem Informasi Manajemen Laboratorium Komputer yang terintegrasi untuk mendukung kegiatan
                        praktikum dan akademik di Fakultas Teknik.
                    </p>
                </div>

                {{-- 2. Layanan --}}
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-white">Layanan Lab</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>
                            <a href="{{ route('front.assets') }}"
                                class="hover:text-blue-400 transition duration-200 flex items-center gap-2">
                                <span>&rsaquo;</span> Katalog Aset
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.kms') }}"
                                class="hover:text-blue-400 transition duration-200 flex items-center gap-2">
                                <span>&rsaquo;</span> Panduan & SOP
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}"
                                class="hover:text-blue-400 transition duration-200 flex items-center gap-2">
                                <span>&rsaquo;</span> Peminjaman Alat
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}"
                                class="hover:text-blue-400 transition duration-200 flex items-center gap-2">
                                <span>&rsaquo;</span> Cek Ketersediaan
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- 3. Tautan Cepat --}}
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-white">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>
                            <a href="/"
                                class="hover:text-blue-400 transition duration-200">Beranda</a>
                        </li>
                        <li>
                            <a href="https://www.uny.ac.id/" target="_blank"
                                class="hover:text-blue-400 transition duration-200">Universitas Negeri Yogyakarta</a>
                        </li>
                        <li>
                            <a href="https://ft.uny.ac.id/" target="_blank"
                                class="hover:text-blue-400 transition duration-200">Fakultas Teknik</a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class="hover:text-blue-400 transition duration-200">Login
                                Staff/Admin</a>
                        </li>
                    </ul>
                </div>

                {{-- 4. Kontak --}}
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-white">Hubungi Kami</h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Gedung KPLT Lt. 2, Fakultas Teknik, Karangmalang, Yogyakarta</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>lab.komputer@uny.ac.id</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>(0274) 586168</span>
                        </li>
                    </ul>
                </div>

            </div>

            {{-- Copyright --}}
            <div
                class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} SILKOM - Universitas Negeri Yogyakarta.</p>
                <p class="mt-2 md:mt-0">Developed by <span class="text-gray-300">Hrya</span> & Tim.</p>
            </div>
        </div>
    </footer>

    {{-- PERBAIKAN: Pindahkan script ke sini --}}
    @stack('scripts')
</body>

</html>