<x-admin-layout title="Kelola Pengguna">

    <section class="max-w-7xl mx-auto p-4 sm:p-6">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 rounded-xl bg-green-50 px-4 py-3 text-green-700 border border-green-200 font-medium">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-red-700 border border-red-200 font-medium">{{ session('error') }}</div>
        @endif

        {{-- 1. Header Halaman --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h1>
            <p class="text-gray-500">Kelola akun pengguna.</p>
        </div>
        
        {{-- 3. Toolbar & Table Container --}}
        <div class="bg-white rounded-xl shadow-md p-6">

            {{-- Toolbar: search + add --}}
            <div class="mb-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">

                <h2 class="font-semibold text-xl text-gray-800">Daftar Pengguna</h2>
                
                <div class="flex items-center gap-2">
                    {{-- Search Form --}}
                    <form method="GET" action="{{ route('admin.users.index') }}"
                        class="flex items-center w-full md:w-80">
                        <div class="relative w-full">
                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="Cari nama, email, atau NIM..."
                                class="w-full rounded-l-xl border border-gray-200 py-2.5 pl-10 pr-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30"
                                aria-label="Cari pengguna" />
                            <svg class="pointer-events-none absolute left-3 top-2.5 h-5 w-5 text-gray-400"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-3.5-3.5" />
                            </svg>
                        </div>
                        <button type="submit"
                            class="rounded-r-xl bg-gray-100 px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200 border border-l-0 border-gray-200 transition duration-150">
                            Cari
                        </button>
                    </form>

                    {{-- Tombol Tambah --}}
                    <a href="{{ route('admin.users.create') }}">
                        <div
                            class="flex items-center gap-2 bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p>Tambah Pengguna</p>
                        </div>
                    </a>
                </div>
                
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Pengguna</th>
                            <th class="px-4 py-3 text-left">NIM</th>
                            <th class="px-4 py-3 text-left">Jurusan</th>
                            <th class="px-4 py-3 text-center">Role</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                        <tr class="hover:bg-blue-50/50 transition duration-100">
                            
                            {{-- Kolom Pengguna --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    {{-- Avatar (nanti bisa diganti foto profil) --}}
                                    <div class="h-10 w-10 overflow-hidden rounded-full bg-gray-100 ring-1 ring-gray-200 flex-shrink-0 flex items-center justify-center">
                                        @if($user->profile_photo_path)
                                            <img src="{{ asset('storage/'.$user->profile_photo_path) }}" alt="Foto" class="h-full w-full object-cover">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A1.875 1.875 0 0 1 18 22.5H6a1.875 1.875 0 0 1-1.499-2.382Z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="truncate max-w-[30ch] font-medium text-gray-900"
                                            title="{{ $user->name }}">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            {{-- Kolom NIM --}}
                            <td class="px-4 py-3">{{ $user->studentProfile->student_id_number ?? '-' }}</td>

                            {{-- Kolom Jurusan/Fakultas --}}
                            <td class="px-4 py-3">
                                @if($user->studentProfile)
                                    <div class="font-medium text-gray-900">{{ $user->studentProfile->major }}</div>
                                    <div class="text-xs text-gray-500">{{ $user->studentProfile->faculty }}</div>
                                @else
                                    -
                                @endif
                            </td>

                            {{-- Kolom Role (dengan badge) --}}
                            <td class="px-4 py-3 text-center">
                                @php $role = $user->getRoleNames()->first(); @endphp
                                @if($role == 'Student')
                                    <span class="rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-700">Student</span>
                                @elseif($role == 'Staff')
                                    <span class="rounded-full bg-purple-100 px-2 py-1 text-xs font-semibold text-purple-700">Staff</span>
                                @else
                                    <span class="rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-700">{{ $role }}</span>
                                @endif
                            </td>

                            {{-- Kolom Aksi --}}
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 transition duration-150">Edit</a>
                                    
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                        onsubmit="return openConfirmModal('Hapus pengguna \'{{ $user->name }}\'?', this, 'reject');">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 transition duration-150">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-gray-500">Belum ada pengguna (Staff/Student).</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Links --}}
            @if($users->hasPages())
            <div class="border-t px-4 py-3 mt-0">
                {{ $users->appends(request()->query())->links() }}
            </div>
            @endif
        </div>

    {{-- ===== Modal Konfirmasi Hapus ===== --}}
    <div id="confirmModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Konfirmasi Hapus</h3>
            <p id="confirmMessage" class="text-sm text-gray-700 mb-6"></p>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeConfirmModal()"
                    class="rounded-lg px-3 py-2 text-sm text-gray-600 hover:bg-gray-50">Batal</button>
                <button id="confirmSubmitBtn" type="button"
                    class="rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-700">Ya, Hapus</button>
            </div>
        </div>
    </div>
    </section>

    @push('scripts')
    <script>
    let _pendingForm = null;
    const confirmBtn = document.getElementById('confirmSubmitBtn');

    function openConfirmModal(message, formEl, type = 'reject') {
        _pendingForm = formEl;
        document.getElementById('confirmMessage').textContent = message;

        confirmBtn.className = 'rounded-lg px-3 py-2 text-sm font-semibold text-white';
        confirmBtn.disabled = false;

        if (type === 'reject') {
            confirmBtn.classList.add('bg-red-600', 'hover:bg-red-700');
            confirmBtn.textContent = 'Ya, Hapus';
        }

        document.getElementById('confirmModal').classList.remove('hidden');
        document.getElementById('confirmModal').classList.add('flex');
        return false;
    }

    function closeConfirmModal() {
        document.getElementById('confirmModal').classList.add('hidden');
        document.getElementById('confirmModal').classList.remove('flex');
        _pendingForm = null;
    }

    if(confirmBtn) {
        confirmBtn.addEventListener('click', function () {
            if (_pendingForm) {
                confirmBtn.textContent = 'Menghapus...'; 
                confirmBtn.disabled = true;
                _pendingForm.submit();
            }
        });
    }
    </script>
    @endpush
</x-admin-layout>