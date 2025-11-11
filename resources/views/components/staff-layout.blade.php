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