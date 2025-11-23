<x-guest-layout title="Lupa Password">
    <div class="max-w-lg mx-auto p-4 sm:p-6 lg:px-8 my-12">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-8 sm:p-10">

                <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Lupa Password?</h2>
                
                <div class="mb-8 text-sm text-gray-500 text-center leading-relaxed">
                    {{ __('Jangan khawatir. Masukkan alamat email Anda di bawah ini dan kami akan mengirimkan link untuk mereset password Anda.') }}
                </div>

                <x-auth-session-status class="mb-6" :status="session('status')" />

                {{-- Tampilkan Error Validasi Global (jika ada) --}}
                @if($errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-red-700 border border-red-200">
                        <ul class="list-disc pl-5 text-sm mt-2">
                            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label for="email" class="flex items-center text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan email terdaftar" required autofocus
                            class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900 placeholder:text-gray-400"
                            value="{{ old('email') }}">
                        @error('email') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-col space-y-4 pt-2">
                        <button type="submit"
                            class="w-full bg-blue-600 text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            {{ __('Kirim Link Reset Password') }}
                        </button>

                        <a href="{{ route('login') }}" class="text-center text-sm text-blue-600 hover:underline font-medium">
                            Kembali ke halaman Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>