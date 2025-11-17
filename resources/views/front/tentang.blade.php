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
                    <a href="{{ route('front.index') }}" class="text-gray-700 hover:text-blue-600 transition">Beranda</a>
                    <a href="{{ route('fitur') }}" class="text-gray-700 hover:text-blue-600 transition">Fitur</a>
                    <a href="{{ route('tentang') }}" class="text-gray-700 hover:text-blue-600 transition">Tentang</a>
                    <a href="{{ route('kontak') }}" class="text-gray-700 hover:text-blue-600 transition">Kontak</a>
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

    <!-- Tentang Kami -->
    <section id="tentang-kami" class="py-20 px-4 sm:px-6 lg:px-8 pt-32"> <div class="max-w-7xl mx-auto">

        <div class="text-center mb-16 fade-in-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Tentang SILKOM</h2>
            <p class="text-xl text-gray-600">Sistem Informasi Laboratorium Komputer UNY</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 fade-in-up" style="animation-delay: 0.2s;">
            <p class="text-gray-700 text-lg leading-relaxed mb-6">
                Selamat datang di SILKOM, platform terintegrasi yang dirancang untuk merevolusi cara
                laboratorium komputer di Universitas Negeri Yogyakarta dikelola. Proyek ini merupakan
                bagian dari Project-Based Learning (PBL) Mata Kuliah Praktikum Manajemen Sistem Informasi.
            </p>
            <p class="text-gray-700 text-lg leading-relaxed mb-6">
                Tujuan kami adalah menciptakan sistem yang efisien, otomatis, dan cerdas, dengan
                mengintegrasikan lima tingkatan sistem informasi (TPS, MIS, OAS, KMS, dan EIS) ke dalam
                satu platform yang kohesif.
            </p>
            <h3 class="text-2xl font-bold text-gray-900 mb-4 mt-8">Tim Pengembang</h3>
            <ul class="list-disc list-inside text-gray-700 text-lg space-y-2">
                <li>Rizal Haryaputra (23051130013)</li>
                <li>Nabila Putri Aulaya Syifa (23051130020)</li>
                <li>Rigel Nadimaisy A. (23051130024)</li>
                <li>Rajendriya D. (23051130010)</li>
            </ul>
        </div>

    </div>
</section>

    <!-- Footer -->
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