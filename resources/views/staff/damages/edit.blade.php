<x-staff-layout title="Edit Laporan Kerusakan">

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8">
                
                {{-- Error Validasi Global --}}
                @if($errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-red-700 border border-red-200">
                        <h3 class="font-semibold text-sm">Harap perbaiki kesalahan berikut:</h3>
                        <ul class="list-disc pl-5 text-sm mt-2">
                            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('staff.damages.update', $damage->id) }}" enctype="multipart/form-data"
                    class="space-y-8">
                    @csrf
                    @method('PUT')

                    {{-- Baris 1: Pilih Aset & Tanggal Lapor (Grid) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Pilih Aset --}}
                        <div class="space-y-2">
                            <label for="asset_id" class="flex items-center text-sm font-semibold text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                </svg>
                                Aset yang Rusak
                            </label>
                            <select id="asset_id" name="asset_id" required
                                class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900">
                                <option value="">-- Pilih Aset --</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}" @if(old('asset_id', $damage->asset_id) == $asset->id) selected @endif>
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

                        {{-- Tanggal Lapor --}}
                        <div class="space-y-2">
                            <label for="reported_at" class="flex items-center text-sm font-semibold text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                                Tanggal Laporan
                            </label>
                            <input type="date" id="reported_at" name="reported_at" required
                                class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400"
                                value="{{ old('reported_at', $damage->reported_at->format('Y-m-d')) }}">
                            @error('reported_at')
                            <div class="flex items-center mt-2 text-red-600 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Deskripsi Kerusakan --}}
                    <div class="space-y-2">
                        <label for="description" class="flex items-center text-sm font-semibold text-gray-700">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                            Deskripsi Kerusakan
                        </label>
                        <textarea id="description" name="description" rows="5"
                            placeholder="Jelaskan detail kerusakan..." required
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400 resize-vertical">{{ old('description', $damage->description) }}</textarea>
                        @error('description')
                        <div class="flex items-center mt-2 text-red-600 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    {{-- Baris 3: Status Perbaikan & Biaya (Grid) - PENTING UNTUK EDIT --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Status Perbaikan --}}
                        <div class="space-y-2">
                            <label for="repair_status" class="flex items-center text-sm font-semibold text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                </svg>
                                Status Perbaikan
                            </label>
                            <select id="repair_status" name="repair_status" required disabled
                                class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900">
                                <option value="Reported" @if(old('repair_status', $damage->repair_status) == 'Reported') selected @endif>Dilaporkan</option>
                                <option value="In Progress" @if(old('repair_status', $damage->repair_status) == 'In Progress') selected @endif>Dikerjakan</option>
                                <option value="Completed" @if(old('repair_status', $damage->repair_status) == 'Completed') selected @endif>Selesai</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-2">Admin yang akan menggantinya</p>
                            @error('repair_status')
                            <div class="flex items-center mt-2 text-red-600 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <input type="hidden" name="repair_status" value="{{ $damage->repair_status }}">

                        {{-- Biaya Perbaikan (untuk EIS) --}}
                        <div class="space-y-2">
                            <label for="repair_cost" class="flex items-center text-sm font-semibold text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                Biaya Perbaikan
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">Rp</span>
                                <input type="number" id="repair_cost" name="repair_cost" readonly="true" disabled
                                    placeholder="150000"
                                    class="w-full pl-10 pr-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400"
                                    value="{{ old('repair_cost', $damage->repair_cost) }}">
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Admin yang akan menggantinya</p>
                            @error('repair_cost')
                            <div class="flex items-center mt-2 text-red-600 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Ganti Gambar Kerusakan --}}
                    <div class="space-y-2">
                        <label for="damage_image" class="flex items-center text-sm font-semibold text-gray-700">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Ganti Foto Kerusakan
                        </label>

                        {{-- Preview Gambar Saat Ini --}}
                        @if ($damage->damage_image_path)
                        <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-xl mb-4">
                            <img src="{{ asset('storage/' . $damage->damage_image_path) }}" alt="Foto saat ini"
                                class="w-16 h-16 object-cover rounded-lg">
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-medium text-gray-900">Gambar saat ini</V>
                                <p class="text-xs text-gray-500">Upload gambar baru untuk menggantinya.</p>
                            </div>
                        </div>
                        @endif

                        <input type="file" id="damage_image" name="damage_image" accept="image/*"
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:transition-colors">
                        <p class="text-xs text-gray-500 mt-2">Kosongkan jika tidak ingin mengganti gambar.</p>
                        @error('damage_image')
                        <div class="flex items-center mt-2 text-red-600 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <a href="{{ route('staff.damages.index') }}"
                            class="flex-1 px-6 py-4 bg-gray-200 text-gray-800 font-medium rounded-xl hover:bg-gray-300 transition-all duration-200 text-center">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 bg-blue-600 text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Perbarui Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-staff-layout>