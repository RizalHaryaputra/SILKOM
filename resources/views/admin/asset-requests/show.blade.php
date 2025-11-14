<x-admin-layout title="Detail Pengajuan Alat">

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:px-8">
        {{-- Informasi Peminjam --}}
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
                        value="{{ $assetRequest->requester->name ?? '-' }}">
                </div>
                <div class="space-y-2">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                        </svg>
                        Role
                    </label>
                    <input type="text" readonly
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-700"
                        value="{{ $assetRequest->requester->getRoleNames()->first() ?? '-' }}">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8 space-y-8">
                {{-- Header --}}
                <h2 class="text-xl font-bold text-gray-800 mb-6">Detail Pengajuan Alat</h2>
    
                {{-- Informasi Alat --}}
                <div class="space-y-6">
    
                    {{-- Nama Alat --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                            Nama Alat
                        </label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-800"
                            value="{{ $assetRequest->asset_name }}">
                    </div>
    
                    {{-- Alasan Pengajuan --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            Alasan Pengajuan
                        </label>
                        <textarea readonly rows="4"
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-800 resize-none">{{ $assetRequest->reason }}</textarea>
                    </div>
    
                    {{-- Spesifikasi (Opsional) --}}
                    @if($assetRequest->specifications)
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25" />
                            </svg>
                            Spesifikasi
                        </label>
                        <textarea readonly rows="3"
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-800 resize-none">{{ $assetRequest->specifications }}</textarea>
                    </div>
                    @endif
    
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
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-800"
                            value="{{ $assetRequest->created_at->format('d M Y') }}">
                    </div>
    
                    {{-- Status --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Status Pengajuan
                        </label>
                        <input type="text" readonly class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-800
                                    {{ $assetRequest->status }}" value="{{ ucfirst($assetRequest->status) }}">
                    </div>
    
                    {{-- Catatan Admin (Opsional) --}}
                    @if($assetRequest->admin_note)
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25v-16.5m0 0l-9 9m9-9l9 9" />
                            </svg>
                            Catatan Admin
                        </label>
                        <textarea readonly rows="3"
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-50 text-gray-800 resize-none">{{ $assetRequest->admin_note }}</textarea>
                    </div>
                    @endif
                </div>
    
                {{-- Tombol Kembali --}}
                <div class="flex flex-col sm:flex-row pt-6">
                    <a href="{{ route('admin.asset-requests.index') }}"
                        class="flex-1 px-6 py-4 bg-gray-200 text-gray-800 font-medium rounded-xl hover:bg-gray-300 transition-all duration-200 text-center">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>