<x-admin-layout title="Detail Dokumen KMS">

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8">

                <h2 class="text-xl font-bold text-gray-800 mb-6">
                    Detail Dokumen KMS
                </h2>

                {{-- Baris 1: Judul --}}
                <div class="space-y-2 mb-6">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        Judul Dokumen</label>
                    <input type="text" readonly
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-100 cursor-not-allowed"
                        value="{{ $kmsDocument->title }}">
                </div>

                {{-- Baris 2: Grid Kategori & Cover --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            Penulis</label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-100 cursor-not-allowed"
                            value="{{ $kmsDocument->author }}">
                    </div>

                    {{-- Kategori --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25A2.25 2.25 0 0 1 13.5 8.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                            </svg>
                            Kategori</label>
                        <input type="text" readonly
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl bg-gray-100 cursor-not-allowed"
                            value="{{ $kmsDocument->category }}">
                    </div>
                </div>

                {{-- Cover Image --}}
                <div class="space-y-2 mb-8">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Cover Dokumen</label>
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        @if ($kmsDocument->cover_image)
                        <img src="{{ asset('storage/' . $kmsDocument->cover_image) }}"
                            class="h-32 w-auto object-cover rounded-lg" alt="Cover Dokumen">
                        @else
                        <p class="text-sm text-gray-500">Tidak ada cover.</p>
                        @endif
                    </div>
                </div>

                {{-- Konten --}}
                <div class="space-y-2 mb-10">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"></path>
                        </svg>
                        Konten Dokumen</label>

                    {{-- Menampilkan konten KMS (HTML) --}}
                    <div class="prose prose-blue max-w-none border border-gray-200 rounded-xl p-6 bg-gray-50">
                        {!! $kmsDocument->content !!}
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <a href="{{ route('admin.kms-documents.index') }}" class="flex-1 px-6 py-4 bg-gray-200 text-gray-800 font-medium rounded-xl 
                               hover:bg-gray-300 transition-all duration-200 text-center">
                        Kembali
                    </a>

                    {{-- <a href="{{ route('admin.kms-documents.edit', $kmsDocument->id) }}" class="flex-1 bg-blue-600 text-white font-bold py-4 px-6 rounded-xl 
                               hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl text-center">
                        Edit Dokumen
                    </a> --}}
                </div>

            </div>
        </div>
    </div>

</x-admin-layout>