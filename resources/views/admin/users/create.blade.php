<x-admin-layout title="Tambah Pengguna Baru">

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8">

                <h2 class="text-xl font-bold text-gray-800 mb-6">Formulir Pengguna Baru</h2>

                {{-- Tampilkan Error Validasi Global --}}
                @if($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-red-700 border border-red-200">
                    <h3 class="font-semibold text-sm">Harap perbaiki kesalahan berikut:</h3>
                    <ul class="list-disc pl-5 text-sm mt-2">
                        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-8">
                    @csrf

                    {{-- Data Login Utama --}}
                    <div class="space-y-6 p-6 rounded-xl border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">1. Informasi Akun</h3>
                        {{-- Nama Lengkap --}}
                        <div class="space-y-2">
                            <label for="name" class="flex items-center text-sm font-semibold text-gray-700">Nama
                                Lengkap</label>
                            <input type="text" id="name" name="name" placeholder="Mis: Budi Setiawan" required
                                class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400"
                                value="{{ old('name') }}">
                        </div>

                        {{-- Email --}}
                        <div class="space-y-2">
                            <label for="email"
                                class="flex items-center text-sm font-semibold text-gray-700">Email</label>
                            <input type="email" id="email" name="email" placeholder="Mis: budi@lab.com" required
                                class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400"
                                value="{{ old('email') }}">
                        </div>

                        {{-- Password Grid --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="password"
                                    class="flex items-center text-sm font-semibold text-gray-700">Password</label>
                                {{-- 1. Tambahkan div relative --}}
                                <div class="relative">
                                    <input type="password" id="password" name="password" required
                                        class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400 pr-10">
                                    {{-- 2. Tambahkan tombol ikon --}}
                                    <button type="button" id="password_toggle"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                                        {{-- Ikon Mata (Default) --}}
                                        <svg id="eye_icon_password" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                        {{-- Ikon Mata Coret (Hidden) --}}
                                        <svg id="eye_slash_icon_password"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 hidden">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- BARU: Field Konfirmasi Password dengan Ikon Mata --}}
                            <div class="space-y-2">
                                <label for="password_confirmation"
                                    class="flex items-center text-sm font-semibold text-gray-700">Konfirmasi
                                    Password</label>
                                {{-- 1. Tambahkan div relative --}}
                                <div class="relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        required
                                        class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400 pr-10">
                                    {{-- 2. Tambahkan tombol ikon --}}
                                    <button type="button" id="password_confirmation_toggle"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                                        {{-- Ikon Mata (Default) --}}
                                        <svg id="eye_icon_password_confirmation" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                        {{-- Ikon Mata Coret (Hidden) --}}
                                        <svg id="eye_slash_icon_password_confirmation"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 hidden">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Data Role & Profil --}}
                    <div class="space-y-6 p-6 rounded-xl border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">2. Role & Profil</h3>
                        {{-- Role --}}
                        <div class="space-y-2">
                            <label for="role" class="flex items-center text-sm font-semibold text-gray-700">Role
                                Pengguna</label>
                            <select id="role_select" name="role" required
                                class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900">
                                <option value="">-- Pilih Role --</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->name }}" @if(old('role')==$role->name) selected @endif>
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- FIELD MAHASISWA (KONDISIONAL) --}}
                        <div id="student_profile_fields" class="hidden space-y-6 pt-4 border-t border-gray-200">
                            <h4 class="font-semibold text-gray-700">Profil Mahasiswa</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="student_id_number"
                                        class="flex items-center text-sm font-semibold text-gray-700">NIM</label>
                                    <input type="text" id="student_id_number" name="student_id_number"
                                        placeholder="Mis: 23051130013"
                                        class="w-full px-4 py-4 border border-gray-200 rounded-xl ... bg-gray-50"
                                        value="{{ old('student_id_number') }}">
                                </div>
                                <div class="space-y-2">
                                    <label for="major"
                                        class="flex items-center text-sm font-semibold text-gray-700">Jurusan</label>
                                    <input type="text" id="major" name="major" placeholder="Mis: Teknologi Informasi"
                                        class="w-full px-4 py-4 border border-gray-200 rounded-xl ... bg-gray-50"
                                        value="{{ old('major') }}">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="faculty"
                                    class="flex items-center text-sm font-semibold text-gray-700">Fakultas</label>
                                <input type="text" id="faculty" name="faculty" placeholder="Mis: Fakultas Teknik"
                                    class="w-full px-4 py-4 border border-gray-200 rounded-xl ... bg-gray-50"
                                    value="{{ old('faculty') }}">
                            </div>
                        </div>
                    </div>


                    {{-- Tombol Aksi --}}
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <a href="{{ route('admin.users.index') }}"
                            class="flex-1 px-6 py-4 bg-gray-200 text-gray-800 font-medium rounded-xl hover:bg-gray-300 transition-all duration-200 text-center">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 bg-blue-600 text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Simpan Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role_select');
            const studentFields = document.getElementById('student_profile_fields');
            const nimInput = document.getElementById('student_id_number');
            const majorInput = document.getElementById('major');
            const facultyInput = document.getElementById('faculty');

            function toggleStudentFields() {
                if (roleSelect.value === 'Student') {
                    studentFields.classList.remove('hidden');
                    nimInput.required = true;
                    majorInput.required = true;
                    facultyInput.required = true;
                } else {
                    studentFields.classList.add('hidden');
                    nimInput.required = false;
                    majorInput.required = false;
                    facultyInput.required = false;
                }
            }

            // Panggil saat role diganti
            roleSelect.addEventListener('change', toggleStudentFields);
            
            // Panggil saat halaman dimuat (jika ada data 'old')
            toggleStudentFields();

            // Fungsi helper untuk toggle
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

            // Terapkan ke field 'password'
            setupPasswordToggle(
                'password', 
                'password_toggle', 
                'eye_icon_password', 
                'eye_slash_icon_password'
            );

            // Terapkan ke field 'password_confirmation'
            setupPasswordToggle(
                'password_confirmation', 
                'password_confirmation_toggle', 
                'eye_icon_password_confirmation', 
                'eye_slash_icon_password_confirmation'
            );
        });
    </script>
    @endpush
</x-admin-layout>