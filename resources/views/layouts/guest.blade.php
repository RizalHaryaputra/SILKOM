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
                    <a href="#beranda" class="text-gray-700 hover:text-blue-600 transition">Beranda</a>
                    <a href="#fitur" class="text-gray-700 hover:text-blue-600 transition">Fitur</a>
                    <a href="#tentang" class="text-gray-700 hover:text-blue-600 transition">Tentang</a>
                    <a href="#kontak" class="text-gray-700 hover:text-blue-600 transition">Kontak</a>
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
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold">SILKOM</span>
                    </div>
                    <p class="text-gray-400 text-sm">Sistem Informasi Laboratorium Komputer untuk manajemen yang lebih
                        baik.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Produk</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Fitur</a></li>
                        <li><a href="#" class="hover:text-white transition">Harga</a></li>
                        <li><a href="#" class="hover:text-white transition">Demo</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Karir</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Dukungan</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Dokumentasi</a></li>
                        <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2025 SILKOM. Developed by Hrya.</p>
            </div>
        </div>
    </footer>

    {{-- PERBAIKAN: Pindahkan script ke sini --}}
    @stack('scripts')
</body>

</html>