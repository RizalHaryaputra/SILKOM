<x-student-layout title="Formulir Peminjaman Aset"> {{-- Asumsi Anda menggunakan x-app-layout untuk student --}}

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:px-8">
        
        {{-- Statistik Aset Tersedia (adaptasi dari template Stats Row) --}}
        <div class="mb-8 grid grid-cols-1">
            <div class="rounded-xl bg-white p-6 shadow-md transition-all duration-300">
                <div class="flex items-center space-x-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m1.5 0V5.625A2.25 2.25 0 0 1 7.5 3.375h9A2.25 2.25 0 0 1 18.75 5.625v1.875m-1.5 0h-12" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Total Aset Tersedia</div>
                        <div class="text-2xl font-bold text-gray-800">{{ $availableAssets->count() }} Unit</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Peminjaman --}}
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Formulir Peminjaman Aset</h2>
                
                {{-- Error Validasi Global --}}
                @if($errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-red-700 border border-red-200">
                        <h3 class="font-semibold text-sm">Harap perbaiki kesalahan berikut:</h3>
                        <ul class="list-disc pl-5 text-sm mt-2">
                            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('student.borrow.store') }}" class="space-y-8">
                    @csrf

                    {{-- Pilih Aset --}}
                    <div class="space-y-2">
                        <label for="asset_id" class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10.5 11.25h3M12 15h.008m-7.008 4.5h12.016a1.125 1.125 0 0 0 1.125-1.125V9.75M18.75 9.75h.375c.621 0 1.125.504 1.125 1.125v.375m-1.5-1.5V5.625c0-.621-.504-1.125-1.125-1.125H6.75c-.621 0-1.125.504-1.125 1.125v3.375c0 .621.504 1.125 1.125 1.125h.375m1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v.375m-1.5-1.5V5.625" />
                            </svg>
                            Pilih Aset yang Tersedia
                        </label>
                        <select id="asset_id" name="asset_id" required
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900">
                            <option value="">-- Pilih Aset --</option>
                            @foreach($availableAssets as $asset)
                                <option value="{{ $asset->id }}" @if(old('asset_id') == $asset->id) selected @endif>
                                    {{ $asset->name }} (Kategori: {{ $asset->category }})
                                </option>
                            @endforeach
                        </select>
                        @error('asset_id')
                        <div class="flex items-center mt-2 text-red-600 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Tujuan --}}
                    <div class="space-y-2">
                        <label for="purpose" class="flex items-center text-sm font-semibold text-gray-700">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                            Tujuan Peminjaman
                        </label>
                        <textarea id="purpose" name="purpose" rows="5" required
                            placeholder="Jelaskan tujuan Anda ingin meminjam aset ini..."
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400 resize-vertical">{{ old('purpose') }}</textarea>
                        @error('purpose')
                        <div class="flex items-center mt-2 text-red-600 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Tanggal Rencana Pinjam --}}
                    <div class="space-y-2">
                        <label for="borrowed_at" class="flex items-center text-sm font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            Tanggal Rencana Pinjam
                        </label>
                        <input type="date" id="borrowed_at" name="borrowed_at" required
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400"
                            value="{{ old('borrowed_at', now()->format('Y-m-d')) }}"
                            min="{{ now()->format('Y-m-d') }}">
                        @error('borrowed_at')
                        <div class="flex items-center mt-2 text-red-600 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <a href="{{ route('student.borrow.index') }}"
                            class="flex-1 px-6 py-4 bg-gray-200 text-gray-800 font-medium rounded-xl hover:bg-gray-300 transition-all duration-200 text-center">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 bg-blue-600 text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Ajukan Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-student-layout>