<x-admin-layout title="Input Log Penggunaan Komputer">

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8">
                
                <h2 class="text-xl font-bold text-gray-800 mb-6">Formulir Log Penggunaan Komputer</h2>

                {{-- Tampilkan Error Validasi Global --}}
                @if($errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-red-700 border border-red-200">
                        <h3 class="font-semibold text-sm">Harap perbaiki kesalahan berikut:</h3>
                        <ul class="list-disc pl-5 text-sm mt-2">
                            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('admin.computer-usage.store') }}" class="space-y-8">
                    @csrf

                    {{-- Baris 1: Pilih Mahasiswa & Komputer (Grid) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Pilih Mahasiswa (User) --}}
                        <div class="space-y-2">
                            <label for="user_id" class="flex items-center text-sm font-semibold text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                                Pilih Mahasiswa
                            </label>
                            <select id="user_id" name="user_id" required
                                class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900">
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="flex items-center mt-2 text-red-600 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Pilih Komputer (Aset) --}}
                        <div class="space-y-2">
                            <label for="asset_id" class="flex items-center text-sm font-semibold text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" /></svg>
                                Pilih Komputer
                            </label>
                            <select id="asset_id" name="asset_id" required
                                class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900">
                                <option value="">-- Pilih Komputer --</option>
                                @foreach($computers as $computer)
                                    <option value="{{ $computer->id }}" @if(old('asset_id') == $computer->id) selected @endif>
                                        {{ $computer->name }}
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
                    </div>

                    {{-- Baris 2: Waktu Mulai & Selesai (Grid) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Waktu Mulai --}}
                        <div class="space-y-2">
                            <label for="started_at" class="flex items-center text-sm font-semibold text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                                Waktu Mulai
                            </label>
                            <input type="datetime-local" id="started_at" name="started_at" required
                                class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400"
                                value="{{ old('started_at', now()->format('Y-m-d\TH:i')) }}">
                            @error('started_at')
                            <div class="flex items-center mt-2 text-red-600 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Waktu Selesai (Opsional) --}}
                        <div class="space-y-2">
                            <label for="finished_at" class="flex items-center text-sm font-semibold text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                                Waktu Selesai (Opsional)
                            </label>
                            <input type="datetime-local" id="finished_at" name="finished_at"
                                class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400"
                                value="{{ old('finished_at') }}">
                            @error('finished_at')
                            <div class="flex items-center mt-2 text-red-600 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>


                    {{-- Tombol Aksi --}}
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <a href="{{ route('admin.computer-usage.index') }}"
                            class="flex-1 px-6 py-4 bg-gray-200 text-gray-800 font-medium rounded-xl hover:bg-gray-300 transition-all duration-200 text-center">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 bg-blue-600 text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Simpan Log
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>