<x-admin-layout title="Detail Peminjaman Aset">

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:px-8">

        {{-- Header Statistik --}}
        <div class="mb-8 bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8 space-y-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Identitas Peminjam</h2>
                <div class="space-y-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Nama Peminjam
                    </label>
                    <input type="text" readonly
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                        value="{{ $borrowing->user->name ?? '-' }}">
                </div>
                <div class="space-y-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                        </svg>
                        NIM
                    </label>
                    <input type="text" readonly
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                        value="{{ $borrowing->user->studentProfile->student_id_number ?? '-' }}">
                </div>
            </div>
        </div>

        {{-- Detail Peminjaman --}}
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8 space-y-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Detail Peminjaman Aset</h2>

                {{-- Aset yang Dipinjam --}}
                <div class="space-y-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                        Aset yang Dipinjam
                    </label>
                    <input type="text" readonly
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                        value="{{ $borrowing->asset->name ?? '-' }} (Kategori: {{ $borrowing->asset->category ?? '-' }})">
                </div>

                {{-- Tujuan Peminjaman --}}
                <div class="space-y-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        Tujuan Peminjaman
                    </label>
                    <textarea readonly rows="5"
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700 resize-vertical">{{ $borrowing->purpose ?? '-' }}</textarea>
                </div>

                {{-- Tanggal Pinjam & Kembali --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Tanggal Pinjam --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            Tanggal Pinjam
                        </label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                            value="{{ $borrowing->borrowed_at ? $borrowing->borrowed_at->format('d M Y') : '-' }}">
                    </div>

                    {{-- Tanggal Pengembalian --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            Tanggal Kembali (Jika Ada)
                        </label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                            value="{{ $borrowing->returned_at ? $borrowing->returned_at->format('d M Y') : '-' }}">
                    </div>
                </div>

                {{-- Status Peminjaman --}}
                <div class="space-y-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Status
                    </label>
                    <input type="text" readonly
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                        value="{{ ucfirst($borrowing->status) }}">
                </div>

                {{-- Tombol Kembali --}}
                <div class="flex flex-col sm:flex-row pt-6">
                    <a href="{{ route('admin.borrow.requests.index') }}"
                        class="flex-1 px-6 py-4 bg-gray-200 text-gray-800 font-medium rounded-xl hover:bg-gray-300 transition-all duration-200 text-center">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>