<x-staff-layout title="Detail Log Penggunaan Komputer">

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8">

                <h2 class="text-xl font-bold text-gray-800 mb-6">Detail Log Penggunaan Komputer</h2>

                <div class="space-y-8">

                    {{-- User --}}
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                <path
                                    d="M4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            Mahasiswa
                        </label>
                        <div class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-gray-800">
                            {{ $computerUsage->user->name }}
                        </div>
                    </div>

                    {{-- Komputer --}}
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-500"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12" />
                            </svg>
                            Komputer
                        </label>
                        <div class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-gray-800">
                            {{ $computerUsage->asset->name }}
                        </div>
                    </div>

                    {{-- Waktu Mulai --}}
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            Waktu Mulai
                        </label>
                        <div class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-gray-800">
                            {{ $computerUsage->started_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                    {{-- Waktu Selesai --}}
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            Waktu Selesai
                        </label>
                        <div class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-gray-800">
                            {{ $computerUsage->finished_at ? $computerUsage->finished_at->format('d M Y, H:i') : '-' }}
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex flex-col sm:flex-row pt-6">
                        <a href="{{ route('staff.computer-usage.index') }}"
                            class="flex-1 px-6 py-4 bg-gray-200 text-gray-800 font-medium rounded-xl hover:bg-gray-300 transition-all duration-200 text-center">
                            Kembali
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

</x-staff-layout>