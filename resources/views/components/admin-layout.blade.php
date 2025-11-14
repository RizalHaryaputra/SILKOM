@props(['title' => 'Admin Dashboard'])

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} — SILKOM</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-100 antialiased">
    <div x-data="{ sidebarOpen: false, sidebarCollapsed: false }" x-cloak>
        <div class="flex">

            {{-- Overlay mobile --}}
            <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
                :class="sidebarOpen ? 'pointer-events-auto' : 'pointer-events-none'"
                class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity lg:hidden">
            </div>

            {{-- Sidebar --}}
            <aside
                class="fixed inset-y-0 left-0 z-30 flex flex-col transform bg-blue-900 text-gray-300 transition-all duration-300 ease-in-out"
                :class="{
                'w-64': !sidebarCollapsed,
                'w-20': sidebarCollapsed,
                'translate-x-0': sidebarOpen,
                '-translate-x-full lg:translate-x-0': !sidebarOpen
            }">

                {{-- Header Sidebar --}}
                <div class="flex items-center px-5 py-6 shrink-0"
                    :class="sidebarCollapsed ? 'justify-center' : 'justify-between'">
                    <span class="font-bold text-lg text-white" x-show="!sidebarCollapsed" x-transition.opacity>
                        SILKOM <span class="block text-xs font-normal">Admin</span>
                    </span>
                    <button @click="sidebarCollapsed = !sidebarCollapsed"
                        class="hidden lg:block text-gray-400 hover:text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>

                {{-- Navigasi --}}
                <nav class="flex-1 px-4 space-y-2 overflow-y-auto">
                    {{-- Dashboard --}}
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-3 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white' }}"
                        :class="sidebarCollapsed && 'justify-center'">
                        <svg class="h-5 w-5 shrink-0" :class="!sidebarCollapsed && 'mr-3'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M8.557 2.75H4.682A1.93 1.93 0 0 0 2.75 4.682v3.875a1.94 1.94 0 0 0 1.932 1.942h3.875a1.94 1.94 0 0 0 1.942-1.942V4.682A1.94 1.94 0 0 0 8.557 2.75m10.761 0h-3.875a1.94 1.94 0 0 0-1.942 1.932v3.875a1.943 1.943 0 0 0 1.942 1.942h3.875a1.94 1.94 0 0 0 1.932-1.942V4.682a1.93 1.93 0 0 0-1.932-1.932M8.557 13.5H4.682a1.943 1.943 0 0 0-1.932 1.943v3.875a1.93 1.93 0 0 0 1.932 1.932h3.875a1.94 1.94 0 0 0 1.942-1.932v-3.875a1.94 1.94 0 0 0-1.942-1.942m8.818-.001a3.875 3.875 0 1 0 0 7.75a3.875 3.875 0 0 0 0-7.75" />
                        </svg>
                        <span class="whitespace-nowrap" x-show="!sidebarCollapsed" x-transition.fade>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center px-3 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white' }}"
                        :class="sidebarCollapsed && 'justify-center'">
                        <svg class="h-5 w-5 shrink-0" :class="!sidebarCollapsed && 'mr-3'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                        <span class="whitespace-nowrap" x-show="!sidebarCollapsed" x-transition.fade>Pengguna</span>
                    </a>

                    <a href="{{ route('admin.assets.index') }}"
                        class="flex items-center px-3 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.assets.*') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white' }}"
                        :class="sidebarCollapsed && 'justify-center'">
                        <svg class="h-5 w-5 shrink-0" :class="!sidebarCollapsed && 'mr-3'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M5.25 14.25h13.5m-13.5 0a3 3 0 0 1-3-3m3 3a3 3 0 1 0 0 6h13.5a3 3 0 1 0 0-6m-16.5-3a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3m-19.5 0a4.5 4.5 0 0 1 .9-2.7L5.737 5.1a3.375 3.375 0 0 1 2.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 0 1 .9 2.7m0 0a3 3 0 0 1-3 3m0 3h.008v.008h-.008v-.008Zm0-6h.008v.008h-.008v-.008Zm-3 6h.008v.008h-.008v-.008Zm0-6h.008v.008h-.008v-.008Z" />
                        </svg>
                        <span class="whitespace-nowrap" x-show="!sidebarCollapsed" x-transition.fade>Aset</span>
                    </a>

                    <a href="{{ route('admin.borrow.requests.index') }}"
                        class="flex items-center px-3 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.borrow.requests.*') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white' }}"
                        :class="sidebarCollapsed && 'justify-center'">
                        <svg class="h-5 w-5 shrink-0" :class="!sidebarCollapsed && 'mr-3'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>
                        <span class="whitespace-nowrap" x-show="!sidebarCollapsed" x-transition.fade>Peminjaman</span>
                    </a>

                    <a href="{{ route('admin.asset-requests.index') }}"
                        class="flex items-center px-3 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.asset-requests.*') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white' }}"
                        :class="sidebarCollapsed && 'justify-center'">
                        <svg class="h-5 w-5 shrink-0" :class="!sidebarCollapsed && 'mr-3'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg>
                        <span class="whitespace-nowrap" x-show="!sidebarCollapsed" x-transition.fade>Pengajuan</span>
                    </a>

                    <a href="{{ route('admin.damages.index') }}"
                        class="flex items-center px-3 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.damages.*') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white' }}"
                        :class="sidebarCollapsed && 'justify-center'">
                        <svg class="h-5 w-5 shrink-0" :class="!sidebarCollapsed && 'mr-3'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg>
                        <span class="whitespace-nowrap" x-show="!sidebarCollapsed" x-transition.fade>Kerusakan</span>
                    </a>

                    {{-- Computer Usage --}}
                    <a href="{{ route('admin.computer-usage.index') }}"
                        class="flex items-center px-3 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.computer-usage.*') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white' }}"
                        :class="sidebarCollapsed && 'justify-center'">
                        <svg class="h-5 w-5 shrink-0" :class="!sidebarCollapsed && 'mr-3'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                        </svg>
                        <span class="whitespace-nowrap" x-show="!sidebarCollapsed" x-transition.fade>Log Komputer</span>
                    </a>           

                    
                </nav>
            </aside>

            {{-- Main wrapper --}}
            <div class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 ease-in-out"
                :class="sidebarCollapsed ? 'lg:ml-20' : 'lg:ml-64'">

                {{-- Header --}}
                <header class="sticky top-0 z-10 bg-white shadow-md">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                        {{-- Hamburger mobile --}}
                        <div class="flex items-center lg:hidden">
                            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>

                        {{-- Title --}}
                        <h1 class="text-xl font-semibold text-gray-800 flex-1 text-center lg:text-left">
                            @yield('page-title', $title)
                        </h1>

                        {{-- User Menu --}}
                        <div class="flex items-center">
                            <x-user-menu />
                        </div>
                    </div>
                </header>

                {{-- Content --}}
                <main class="flex-1 p-4 sm:p-6 lg:p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    @stack('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
</body>

</html>