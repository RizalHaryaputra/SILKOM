<x-staff-layout title="Detail Pengajuan Alat">

    <section class="max-w-4xl mx-auto p-4 sm:p-6">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8 space-y-8">

                {{-- Header --}}
                <h2 class="text-2xl font-bold text-gray-800 border-b pb-4">
                    Detail Pengajuan Alat
                </h2>

                {{-- Informasi Alat --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Nama Alat --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                            Nama Alat Diajukan
                        </label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                            value="{{ $assetRequest->asset_name }}">
                    </div>

                    {{-- Tanggal Pengajuan --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"  
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            Tanggal Pengajuan
                        </label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                            value="{{ $assetRequest->created_at->format('d M Y') }}">
                    </div>
                </div>

                {{-- Alasan Pengajuan --}}
                <div class="space-y-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        Alasan Pengajuan
                    </label>
                    <textarea readonly rows="5"
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700 resize-vertical">{{ $assetRequest->reason }}</textarea>
                </div>

                {{-- Status & Catatan Admin --}}
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    {{-- Status --}}
                    <div class="space-y-2">
                        <label for="specifications" class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6v-.75c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5" />
                            </svg>
                            Spesifikasi (Opsional)
                        </label>
                        <textarea id="specifications" name="specifications" rows="3" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400 resize-vertical">{{ old('specifications', $assetRequest->specifications ?? '-') }}</textarea>
                    </div>

                </div>

                {{-- Tombol Aksi --}}
                {{-- Tombol Kembali --}}
                <div class="flex flex-col sm:flex-row pt-6">
                    <a href="{{ route('staff.asset-requests.index') }}"
                        class="flex-1 px-6 py-4 bg-gray-200 text-gray-800 font-medium rounded-xl hover:bg-gray-300 transition-all duration-200 text-center">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </section>

</x-staff-layout>