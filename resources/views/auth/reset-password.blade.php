<x-guest-layout title="Reset Password">
    <div class="max-w-lg mx-auto p-4 sm:p-6 lg:px-8 my-12">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8 sm:p-10">

                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Reset Password</h2>

                {{-- Tampilkan Error Validasi Global --}}
                @if($errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-red-700 border border-red-200">
                        <ul class="list-disc pl-5 text-sm mt-2">
                            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="space-y-2">
                        <label for="email" class="flex items-center text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required autofocus
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400"
                            value="{{ old('email', $request->email) }}">
                        @error('email') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="flex items-center text-sm font-semibold text-gray-700">Password Baru</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required autocomplete="new-password"
                                class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400 pr-10">
                            
                            {{-- Tombol Mata --}}
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
                        <label for="password_confirmation" class="flex items-center text-sm font-semibold text-gray-700">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                                class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400 pr-10">
                            
                            {{-- Tombol Mata --}}
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
                        @error('password_confirmation') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-col pt-4">
                        <button type="submit"
                            class="w-full bg-blue-600 text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
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
            setupPasswordToggle('password', 'password_toggle', 'eye_icon_password', 'eye_slash_icon_password');
            setupPasswordToggle('password_confirmation', 'password_confirmation_toggle', 'eye_icon_password_confirmation', 'eye_slash_icon_password_confirmation');
        });
    </script>
    @endpush
</x-guest-layout>