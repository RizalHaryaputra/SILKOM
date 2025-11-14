<x-student-layout title="Pengaturan Akun">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header Halaman --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Pengaturan Akun</h1>
            <p class="text-gray-500">Kelola informasi profil dan keamanan akun Anda.</p>
        </div>

        {{-- Flash Message --}}
        @if (session('status'))
        <div class="rounded-md bg-green-50 p-4 mb-6 border border-green-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                </div>
            </div>
        </div>
        @endif
        
        {{-- Menampilkan Error Validasi (Global) --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-red-700 border border-red-200">
                <h3 class="font-semibold text-sm">Harap perbaiki kesalahan berikut:</h3>
                <ul class="list-disc pl-5 text-sm mt-2">
                    @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul>
            </div>
        @endif

        {{-- Layout 2 Kolom --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Kolom Kanan (Ringkasan Profil) --}}
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex flex-col items-center text-center w-full">
                        <img class="h-24 w-24 rounded-full object-cover mb-4" src="{{ $user->profile_photo_path 
    ? asset('storage/' . $user->profile_photo_path) 
    : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&size=128' }}"
                            alt="{{ $user->name }}">
                        <h2 class="truncate text-xl font-bold text-gray-800 w-full">{{ $user->name }}</h2>
                        <p class="truncate text-sm text-gray-500 w-full">{{ $user->email }}</p>
                    </div>
                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <dl class="space-y-4">
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">NIM</dt>
                                <dd class="text-sm font-medium text-gray-800">{{ $user->studentProfile?->student_id_number ?? '-' }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Jurusan</dt>
                                <dd class="text-sm font-medium text-gray-800 text-right">{{ $user->studentProfile?->major ?? '-' }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Fakultas</dt>
                                <dd class="text-sm font-medium text-gray-800 text-right">{{ $user->studentProfile?->faculty ?? '-' }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Role</dt>
                                <dd class="text-sm font-medium text-gray-800 text-right">{{ $user->getRoleNames()->first() }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </aside>

            {{-- Kolom Kiri (Konten Utama / Form) --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Form Update Data Kontak & Foto --}}
                <form method="POST" action="{{ route('student.profile.updateDetails') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="bg-white rounded-xl shadow-md">
                        <div class="p-8">
                            <h3 class="text-lg font-semibold text-gray-800">Profil & Data Akademik</h3>
                            <p class="mt-1 text-sm text-gray-500">Perbarui informasi profil dan data akademik Anda.</p>
                        </div>
                        <div class="px-8 py-6 space-y-6 bg-gray-50">
                            
                            {{-- Foto Profil --}}
                            <div class="space-y-2">
                                <label for="photo" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                                <div class="mt-2 flex items-center space-x-4">
                                    <img class="h-12 w-12 rounded-full object-cover"
                                        src="{{ $user->profile_photo_path ? asset('storage/'.$user->profile_photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=random' }}"
                                        alt="Current photo">
                                    {{-- PERBAIKAN: Style Input File --}}
                                    <input type="file" name="photo" id="photo" accept="image/*"
                                        class="w-full px-4 py-3.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:transition-colors" />
                                </div>
                                @error('photo') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>

                            {{-- PERBAIKAN: Style Input Field --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $user->name) }}"
                                        class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder:text-gray-400 @error('name') border-red-500 @enderror">
                                    @error('name') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                        class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder:text-gray-400 @error('email') border-red-500 @enderror">
                                    @error('email') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="student_id_number" class="block text-sm font-medium text-gray-700">NIM</label>
                                    <input type="text" name="student_id_number" id="student_id_number"
                                        value="{{ old('student_id_number', $user->studentProfile?->student_id_number) }}"
                                        class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder:text-gray-400 @error('student_id_number') border-red-500 @enderror">
                                    @error('student_id_number') <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="major" class="block text-sm font-medium text-gray-700">Jurusan</label>
                                    <input type="text" name="major" id="major"
                                        value="{{ old('major', $user->studentProfile?->major) }}"
                                        class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder:text-gray-400 @error('major') border-red-500 @enderror">
                                    @error('major') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="faculty" class="block text-sm font-medium text-gray-700">Fakultas</label>
                                <input type="text" name="faculty" id="faculty"
                                    value="{{ old('faculty', $user->studentProfile?->faculty) }}"
                                    class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder:text-gray-400 @error('faculty') border-red-500 @enderror">
                                @error('faculty') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        {{-- PERBAIKAN: Style Button Footer --}}
                        <div class="px-6 py-4 bg-gray-50 text-right rounded-b-xl flex justify-end gap-4">
                            <button type="submit"
                                class="bg-blue-600 text-white font-bold py-3 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Simpan Perubahan Profil
                            </button>
                        </div>
                    </div>
                </form>

                {{-- Form Ganti Password --}}
                <form method="POST" action="{{ route('student.profile.updatePassword') }}">
                    @csrf
                    @method('PATCH')
                    <div class="bg-white rounded-xl shadow-md">
                        <div class="p-8">
                            <h3 class="text-lg font-semibold text-gray-800">Ubah Password</h3>
                            <p class="mt-1 text-sm text-gray-500">Pastikan Anda menggunakan password yang kuat.</p>
                        </div>
                        <div class="px-8 py-6 space-y-6 bg-gray-50">
                            
                            {{-- PERBAIKAN: Style Input Field --}}
                            <div class="space-y-2">
                                <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
                                <div class="relative">
                                    <input type="password" name="current_password" id="current_password"
                                        class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder:text-gray-400 pr-10 @error('current_password') border-red-500 @enderror">
                                    <button type="button" id="current_password_toggle" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                                        <svg id="eye_icon_current" class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 10.224 7.29 6.3 12 6.3c4.71 0 8.577 3.924 9.964 5.382.074.086.12.193.12.319s-.046.233-.12.319C20.577 13.776 16.71 17.7 12 17.7c-4.71 0-8.577-3.924-9.964-5.382Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <svg id="eye_slash_icon_current" class="size-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 14.302 6.095 17.3 12 17.3c.976 0 1.914-.145 2.802-.408m.05-3.198.051.051a3 3 0 0 1-4.242 0l-.05-.05A3 3 0 0 1 12 9.75c.578 0 1.127.14 1.618.388m5.421 2.843a10.473 10.473 0 0 0-2.261-2.73m2.261 2.73a10.473 10.473 0 0 1-2.261 2.73m0 0A10.473 10.473 0 0 1 12 17.3c-2.13 0-4.137-.62-5.877-1.74M12 9.75v.003V9.75Zm0 3.75v.003V13.5Zm0 3.75v.003V17.25Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                                @error('current_password') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password"
                                            class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder:text-gray-400 pr-10 @error('password') border-red-500 @enderror">
                                        <button type="button" id="password_toggle" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                                            <svg id="eye_icon_password" class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 10.224 7.29 6.3 12 6.3c4.71 0 8.577 3.924 9.964 5.382.074.086.12.193.12.319s-.046.233-.12.319C20.577 13.776 16.71 17.7 12 17.7c-4.71 0-8.577-3.924-9.964-5.382Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <svg id="eye_slash_icon_password" class="size-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 14.302 6.095 17.3 12 17.3c.976 0 1.914-.145 2.802-.408m.05-3.198.051.051a3 3 0 0 1-4.242 0l-.05-.05A3 3 0 0 1 12 9.75c.578 0 1.127.14 1.618.388m5.421 2.843a10.473 10.473 0 0 0-2.261-2.73m2.261 2.73a10.473 10.473 0 0 1-2.261 2.73m0 0A10.473 10.473 0 0 1 12 17.3c-2.13 0-4.137-.62-5.877-1.74M12 9.75v.003V9.75Zm0 3.75v.003V13.5Zm0 3.75v.003V17.25Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                                    <div class="relative">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder:text-gray-400 pr-10">
                                        <button type="button" id="password_confirmation_toggle" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                                            <svg id="eye_icon_password_confirmation" class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 10.224 7.29 6.3 12 6.3c4.71 0 8.577 3.924 9.964 5.382.074.086.12.193.12.319s-.046.233-.12.319C20.577 13.776 16.71 17.7 12 17.7c-4.71 0-8.577-3.924-9.964-5.382Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <svg id="eye_slash_icon_password_confirmation" class="size-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 14.302 6.095 17.3 12 17.3c.976 0 1.914-.145 2.802-.408m.05-3.198.051.051a3 3 0 0 1-4.242 0l-.05-.05A3 3 0 0 1 12 9.75c.578 0 1.127.14 1.618.388m5.421 2.843a10.473 10.473 0 0 0-2.261-2.73m2.261 2.73a10.473 10.473 0 0 1-2.261 2.73m0 0A10.473 10.473 0 0 1 12 17.3c-2.13 0-4.137-.62-5.877-1.74M12 9.75v.003V9.75Zm0 3.75v.003V13.5Zm0 3.75v.003V17.25Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- PERBAIKAN: Style Button Footer --}}
                        <div class="px-6 py-4 bg-gray-50 text-right rounded-b-xl flex justify-end gap-4">
                            <button type="submit"
                                class="bg-blue-600 text-white font-bold py-3 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    {{-- Skrip untuk show/hide password (3 tombol) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function setupPasswordToggle(inputId, toggleButtonId, eyeIconId, eyeSlashIconId) {
                const input = document.getElementById(inputId);
                const toggle = document.getElementById(toggleButtonId);
                const eyeIcon = document.getElementById(eyeIconId);
                const eyeSlashIcon = document.getElementById(eyeSlashIconId);

                if (toggle) {
                    toggle.addEventListener('click', function() {
                        if (input.type === 'password') {
                            input.type = 'text';
                            eyeIcon.classList.add('hidden');
                            eyeSlashIcon.classList.remove('hidden');
                        } else {
                            input.type = 'password';
                            eyeIcon.classList.remove('hidden');
                            eyeSlashIcon.classList.add('hidden');
                        }
                    });
                }
            }
            setupPasswordToggle('current_password', 'current_password_toggle', 'eye_icon_current', 'eye_slash_icon_current');
            setupPasswordToggle('password', 'password_toggle', 'eye_icon_password', 'eye_slash_icon_password');
            setupPasswordToggle('password_confirmation', 'password_confirmation_toggle', 'eye_icon_password_confirmation', 'eye_slash_icon_password_confirmation');
        });
    </script>
    @endpush
</x-student-layout>