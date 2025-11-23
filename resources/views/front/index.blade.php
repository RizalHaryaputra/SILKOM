<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILKOM - Sistem Informasi Laboratorium Komputer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/80 backdrop-blur-md shadow-sm z-50 border-b border-gray-200">
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
                    <a href="#aset" class="text-gray-700 hover:text-blue-600 transition">Aset</a>
                    <a href="#kms" class="text-gray-700 hover:text-blue-600 transition">KMS</a>
                </div>
                <div class="flex space-x-3">
                    @guest
                    <button class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                        <a href="{{ route('login') }}">
                            Masuk
                        </a>
                    </button>
                    <button
                        class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition transform hover:scale-105">
                        <a href="{{ route('register') }}">
                            Daftar
                        </a>
                    </button>
                    @endguest
                    @auth
                    {{-- Dropdown Profile (menggunakan Alpine.js) --}}
                    <div x-data="{ profileDropdownOpen: false }" @click.outside="profileDropdownOpen = false"
                        class="relative">
                        <button @click="profileDropdownOpen = !profileDropdownOpen"
                            class="flex items-center space-x-2 px-4 py-2 bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-md font-semibold hover:bg-gray-200 transition-colors text-sm">
                            <img class="h-6 w-6 rounded-full object-cover"
                                src="{{'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=random' }}"
                                alt="Avatar">
                            <span class="truncate max-w-[100px]">{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 transform transition-transform"
                                :class="{'rotate-180': profileDropdownOpen}" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="profileDropdownOpen" x-transition
                            class="z-50 absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1">
                            @role('Admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                            @endrole
                            @role('Lead')
                            <a href="{{ route('lead.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                            @endrole
                            @role('Student')
                            <a href="{{ route('student.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                            @endrole
                            @role('Staff')
                            <a href="{{ route('staff.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                            @endrole
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="pt-24 pb-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto mt-12">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="fade-in-up">
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Sistem Informasi &
                        <span
                            class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Manajemen
                            Laboratorium Komputer</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8">
                        Platform terintegrasi untuk mempermudah peminjaman aset, pemantauan inventaris, dan pelaporan
                        teknis di lingkungan Kampus. Transparan, Efisien, dan Akurat.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('login') }}">
                            <button
                                class="px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-2xl transition transform hover:scale-105 font-semibold">
                                Login Sekarang
                            </button>
                        </a>
                        <a href="{{ route('front.assets') }}">
                            <button
                                class="px-8 py-4 border-2 border-blue-600 text-blue-600 rounded-xl hover:bg-blue-50 transition font-semibold">
                                Lihat Aset
                            </button>
                        </a>
                    </div>
                </div>
                <div class="relative float-animation">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-3xl blur-3xl opacity-20">
                    </div>
                    <div class="relative bg-white rounded-3xl shadow-2xl p-8">
                        <div class="space-y-4">
                            <div
                                class="flex items-center space-x-3 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl">
                                <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Manajemen Aset</p>
                                    <p class="text-sm text-gray-600">Kelola inventaris lab</p>
                                </div>
                            </div>
                            <div
                                class="flex items-center space-x-3 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl">
                                <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Laporan Otomatis</p>
                                    <p class="text-sm text-gray-600">PDF & Notifikasi</p>
                                </div>
                            </div>
                            <div
                                class="flex items-center space-x-3 p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl">
                                <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Dashboard EIS</p>
                                    <p class="text-sm text-gray-600">Visualisasi & KPI</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
                <div>
                    <div class="text-4xl font-bold mb-2">5+</div>
                    <div class="text-blue-100">Modul Sistem</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">100%</div>
                    <div class="text-blue-100">Otomatis</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">24/7</div>
                    <div class="text-blue-100">Akses</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">∞</div>
                    <div class="text-blue-100">Skalabilitas</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600">Lima sistem terintegrasi dalam satu platform</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- TPS -->
                <div
                    class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">TPS</h3>
                    <p class="text-gray-600 mb-4">Transaction Processing System untuk peminjaman alat, pencatatan
                        kerusakan, dan penggunaan komputer.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Peminjaman Alat</li>
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Laporan Kerusakan</li>
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Tracking Penggunaan
                        </li>
                    </ul>
                </div>

                <!-- MIS -->
                <div
                    class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">MIS</h3>
                    <p class="text-gray-600 mb-4">Management Information System untuk laporan operasional lengkap dan
                        komprehensif.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Laporan Penggunaan</li>
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Analisis Kerusakan</li>
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Rekap Pengguna</li>
                    </ul>
                </div>

                <!-- OAS -->
                <div
                    class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">OAS</h3>
                    <p class="text-gray-600 mb-4">Office Automation System untuk otomatisasi komunikasi dan administrasi
                        laboratorium.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Notifikasi Otomatis
                        </li>
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Pengajuan Alat</li>
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Laporan PDF Auto</li>
                    </ul>
                </div>

                <!-- KMS -->
                <div
                    class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">KMS</h3>
                    <p class="text-gray-600 mb-4">Knowledge Management System untuk dokumentasi dan prosedur teknis
                        laboratorium.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Dokumentasi SOP</li>
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Panduan Teknis</li>
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Arsip Digital</li>
                    </ul>
                </div>

                <!-- EIS -->
                <div
                    class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2 md:col-span-2 lg:col-span-1">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">EIS</h3>
                    <p class="text-gray-600 mb-4">Executive Information System dengan dashboard visual dan KPI strategis
                        untuk pimpinan.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Dashboard Visual</li>
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> KPI Real-time</li>
                        <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Analitik Strategis</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= --}}
    {{-- SECTION: KATALOG ASET --}}
    {{-- ========================= --}}
    <section id="aset" class="py-20 px-4 sm:px-6 lg:px-8bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-2">Katalog Aset</h2>
                <p class="text-gray-600 mb-10">
                    Daftar aset laboratorium yang tersedia untuk digunakan dan dikelola.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($latestAssets as $asset)
                <div
                    class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">

                    {{-- Gambar --}}
                    @if ($asset->asset_image_path)
                    <img src="{{ asset('storage/' . $asset->asset_image_path) }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gray-200 text-gray-400 flex flex-col items-center justify-center">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="mt-4 text-md font-medium">Tidak ada gambar</span>
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

            {{-- BUTTON LIHAT SEMUA --}}
            <div class="text-center mt-10">
                <a href="{{ route('front.assets') }}"
                    class="px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition transform hover:scale-105">
                    Lihat Semua Aset
                </a>
            </div>
        </div>
    </section>


    {{-- ========================= --}}
    {{-- SECTION: PANDUAN KMS --}}
    {{-- ========================= --}}
    <section id="kms" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-2">Panduan Penggunaan Lab (KMS)</h2>
                <p class="text-gray-600 mb-10">
                    Dokumen panduan penggunaan laboratorium untuk membantu operasional kegiatan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($latestGuides as $kms)
                <div
                    class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">

                    {{-- Gambar --}}
                    @if ($kms->cover_image)
                    <img src="{{ asset('storage/' . $kms->cover_image) }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gray-200 text-gray-400 flex flex-col items-center justify-center">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="mt-4 text-md font-medium">Tidak ada gambar</span>
                    </div>
                    @endif

                    <div class="p-5 text-left">
                        <h3 class="font-semibold text-xl">{{ $kms->title }}</h3>
                        <p class="text-sm text-gray-600 mt-2">
                            Kategori: {{ $kms->category }}
                        </p>

                        <a href="{{ route('front.kms-detail', $kms) }}"
                            class="block text-center mt-5 border rounded-lg py-2 hover:bg-gray-100">
                            Lihat Detail
                        </a>
                    </div>

                </div>
                @endforeach
            </div>

            {{-- BUTTON LIHAT SEMUA --}}
            <div class="text-center mt-10">
                <a href="{{ route('front.kms') }}"
                    class="px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition transform hover:scale-105">
                    Lihat Semua Panduan
                </a>
            </div>
        </div>
    </section>



    <!-- Tech Stack Section -->
    <section class="py-20 bg-gray-50 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Teknologi Terkini</h2>
                <p class="text-xl text-gray-600">Dibangun dengan teknologi modern dan terpercaya</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div
                    class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="text-4xl mb-3">🚀</div>
                    <h4 class="font-semibold text-gray-900">Laravel 12</h4>
                    <p class="text-sm text-gray-600">Framework Backend</p>
                </div>
                <div
                    class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="text-4xl mb-3">🎨</div>
                    <h4 class="font-semibold text-gray-900">Tailwind CSS</h4>
                    <p class="text-sm text-gray-600">Modern UI</p>
                </div>
                <div
                    class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="text-4xl mb-3">🗄️</div>
                    <h4 class="font-semibold text-gray-900">MySQL</h4>
                    <p class="text-sm text-gray-600">Database</p>
                </div>
                <div
                    class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="text-4xl mb-3">📊</div>
                    <h4 class="font-semibold text-gray-900">Chart.js</h4>
                    <p class="text-sm text-gray-600">Visualisasi Data</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl p-12 shadow-2xl">
                <h2 class="text-4xl font-bold text-white mb-4">Siap Menggunakan Fasilitas Lab?</h2>
                <p class="text-xl text-blue-100 mb-8">Bergabunglah sekarang untuk meminjam aset, cek ketersediaan
                    komputer, dan akses panduan teknis dalam satu pintu.
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('register') }}">
                        <button
                            class="px-8 py-4 bg-white text-blue-600 rounded-xl hover:shadow-2xl transition transform hover:scale-105 font-semibold w-full sm:w-auto">
                            Daftar Sekarang
                        </button>
                    </a>
                    <a href="{{ route('front.assets') }}">
                        <button
                            class="px-8 py-4 border-2 border-white text-white rounded-xl hover:bg-white hover:text-blue-600 transition font-semibold w-full sm:w-auto">
                            Lihat Katalog Aset
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
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

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Add fade-in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                }
            });
        }, observerOptions);

        document.querySelectorAll('section > div').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>

</html>