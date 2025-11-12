<x-admin-layout title="Detail Aset">

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8 space-y-8">
                {{-- Baris 1: Nama Aset & Kategori --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Nama Aset --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                            Nama Aset
                        </label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                            value="{{ $asset->name }}">
                    </div>

                    {{-- Kategori --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25A2.25 2.25 0 0 1 13.5 8.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                            </svg>
                            Kategori
                        </label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                            value="{{ $asset->category }}">
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="space-y-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        Deskripsi
                    </label>
                    <textarea readonly rows="5"
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700 resize-vertical">{{ $asset->description ?? '-' }}</textarea>
                </div>

                {{-- Baris 3: Status & Harga --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Status --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                            Status
                        </label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                            value="{{ $asset->status }}">
                    </div>

                    {{-- Harga --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Harga Beli
                        </label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                            value="{{ $asset->purchase_price ? 'Rp ' . number_format($asset->purchase_price, 0, ',', '.') : '-' }}">
                    </div>
                </div>

                {{-- Gambar Aset --}}
                <div class="space-y-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Gambar Aset
                    </label>

                    @if ($asset->asset_image_path)
                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        <img src="{{ asset('storage/' . $asset->asset_image_path) }}" alt="Foto aset"
                            class="w-56 h-56 object-cover rounded-lg">
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Gambar Aset</p>
                            <p class="text-xs text-gray-500">{{ $asset->name }}</p>
                        </div>
                    </div>
                    @else
                    <p class="text-sm text-gray-500 italic">Tidak ada gambar aset.</p>
                    @endif
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex flex-col sm:flex-row pt-6">
                    <a href="{{ route('admin.assets.index') }}"
                        class="flex-1 px-6 py-4 bg-gray-200 text-gray-800 font-medium rounded-xl hover:bg-gray-300 transition-all duration-200 text-center">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>

</x-admin-layout>