@php
$u = Auth::user();
@endphp

<div x-data="{ open: false }" @click.outside="open = false" class="relative">
    {{-- Tombol Pemicu Dropdown --}}
    <button @click="open = !open"
        class="flex items-center space-x-2 rounded-full p-1 text-sm transition hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">

        <img class="h-9 w-9 rounded-full object-cover"
            src="{{ $u->photo ? asset('storage/'.$u->photo) : 'https://ui-avatars.com/api/?name='.urlencode($u->name).'&background=random' }}"
            alt="{{ $u->name }}">

        <span class=" fhidden font-medium text-gray-700 sm:block">{{ $u->name }}</span>

        <svg class="h-5 w-5 text-gray-500 hidden sm:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd"
                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                clip-rule="evenodd" />
        </svg>
    </button>

    {{-- Panel Dropdown --}}
    <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 mt-2 w-64 origin-top-right rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

        <div class="py-1" role="none">
            {{-- Informasi User di Header Dropdown --}}
            <div class="border-b border-gray-200 px-4 py-3">
                <p class="text-sm font-semibold text-gray-900" role="none">
                    {{ $u->name }}
                </p>
                <p class="truncate text-sm text-gray-500" role="none">
                    {{ $u->email }}
                </p>
            </div>

            {{-- Menu Item --}}
            <div class="py-1">
                <a href="{{ url('/') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100"
                    role="menuitem" tabindex="-1">
                    {{-- Icon Home (Heroicons) --}}
                    <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    <span>Home</span>
                </a>
                {{-- Anda bisa menambahkan link menu lain di sini --}}
            </div>

            {{-- Menu Logout --}}
            <div class="border-t border-gray-100 py-1">
                <form method="POST" action="{{ route('logout') }}" role="none">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center px-4 py-2 text-left text-sm text-gray-700 transition-colors hover:bg-gray-100"
                        role="menuitem" tabindex="-1">
                        {{-- Icon Logout (Heroicons) --}}
                        <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>