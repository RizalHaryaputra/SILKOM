@props(['title' => 'Staff Dashboard'])

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
                        SILKOM <span class="block text-xs font-normal">Staff Lab</span>
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
                    <a href="{{ route('staff.dashboard') }}"
                        class="flex items-center px-3 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('staff.dashboard') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white' }}"
                        :class="sidebarCollapsed && 'justify-center'">
                        <svg class="h-5 w-5 shrink-0" :class="!sidebarCollapsed && 'mr-3'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M8.557 2.75H4.682A1.93 1.93 0 0 0 2.75 4.682v3.875a1.94 1.94 0 0 0 1.932 1.942h3.875a1.94 1.94 0 0 0 1.942-1.942V4.682A1.94 1.94 0 0 0 8.557 2.75m10.761 0h-3.875a1.94 1.94 0 0 0-1.942 1.932v3.875a1.943 1.943 0 0 0 1.942 1.942h3.875a1.94 1.94 0 0 0 1.932-1.942V4.682a1.93 1.93 0 0 0-1.932-1.932M8.557 13.5H4.682a1.943 1.943 0 0 0-1.932 1.943v3.875a1.93 1.93 0 0 0 1.932 1.932h3.875a1.94 1.94 0 0 0 1.942-1.932v-3.875a1.94 1.94 0 0 0-1.942-1.942m8.818-.001a3.875 3.875 0 1 0 0 7.75a3.875 3.875 0 0 0 0-7.75" />
                        </svg>
                        <span class="whitespace-nowrap" x-show="!sidebarCollapsed" x-transition.fade>Dashboard</span>
                    </a>

                    {{-- Computer Usage --}}
                    <a href="{{ route('staff.computer-usage.index') }}"
                        class="flex items-center px-3 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('staff.computer-usage.*') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white' }}"
                        :class="sidebarCollapsed && 'justify-center'">
                        <svg class="h-5 w-5 shrink-0" :class="!sidebarCollapsed && 'mr-3'"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                        </svg>
                        <span class="whitespace-nowrap" x-show="!sidebarCollapsed" x-transition.fade>Log Komputer</span>
                    </a>

                    <a href="{{ route('staff.damages.index') }}"
                        class="flex items-center px-3 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('staff.damages.*') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white' }}"
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

                    <a href="{{ route('staff.asset-requests.index') }}"
                        class="flex items-center px-3 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('staff.asset-requests.*') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white' }}"
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