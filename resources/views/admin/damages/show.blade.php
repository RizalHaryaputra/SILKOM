<x-admin-layout title="Detail Laporan Kerusakan">

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8 space-y-8">

                {{-- Baris 1: Aset & Tanggal Lapor --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Aset --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                            Aset yang Rusak
                        </label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                            value="{{ $damage->asset->name ?? '-' }} ({{ $damage->asset->category ?? '-' }})">
                    </div>

                    {{-- Tanggal Laporan --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            Tanggal Laporan
                        </label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                            value="{{ $damage->reported_at->format('d M Y') }}">
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="space-y-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        Deskripsi Kerusakan
                    </label>
                    <textarea readonly rows="5"
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700 resize-vertical">{{ $damage->description }}</textarea>
                </div>

                {{-- Baris 3: Status & Biaya --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Status --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                            Status Perbaikan
                        </label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                            value="{{ $damage->repair_status }}">
                    </div>

                    {{-- Biaya --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Biaya Perbaikan
                        </label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                            value="{{ $damage->repair_cost ? 'Rp ' . number_format($damage->repair_cost, 0, ',', '.') : '-' }}">
                    </div>
                </div>

                {{-- Gambar Kerusakan --}}
                <div class="space-y-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Foto Kerusakan
                    </label>

                    @if ($damage->damage_image_path)
                        <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-xl">
                            <img src="{{ asset('storage/' . $damage->damage_image_path) }}" alt="Foto kerusakan"
                                class="w-56 h-56 object-cover rounded-lg">
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Foto Kerusakan</p>
                                <p class="text-xs text-gray-500">{{ $damage->asset->name ?? 'Aset Tidak Ditemukan' }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 italic">Tidak ada foto yang diunggah.</p>
                    @endif
                </div>

                {{-- Tombol Kembali --}}
                <div class="flex flex-col sm:flex-row pt-6">
                    <a href="{{ route('admin.damages.index') }}"
                        class="flex-1 px-6 py-4 bg-gray-200 text-gray-800 font-medium rounded-xl hover:bg-gray-300 transition-all duration-200 text-center">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>

</x-admin-layout>
