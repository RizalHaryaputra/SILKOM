<x-staff-layout title="Riwayat Penggunaan Komputer">

    <section class="max-w-7xl mx-auto p-4 sm:p-6">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 rounded-xl bg-green-50 px-4 py-3 text-green-700 border border-green-200 font-medium">{{ session('success') }}</div>
        @endif
        {{-- Menambahkan session 'error' untuk kegagalan --}}
        @if(session('error'))
            <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-red-700 border border-red-200 font-medium">{{ session('error') }}</div>
        @endif

        {{-- 1. Header Halaman --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Log Penggunaan Komputer</h1>
            <p class="text-gray-500">Riwayat penggunaan komputer yang tercatat oleh staff.</p>
        </div>
        
        {{-- 3. Toolbar & Table Container --}}
        <div class="bg-white rounded-xl shadow-md p-6">

            {{-- ... (Toolbar, Search, dan Tombol Tambah tidak berubah) ... --}}
            <div class="mb-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <h2 class="font-semibold text-xl text-gray-800">Riwayat Log</h2>
                <div class="flex items-center gap-2">
                    <form method="GET" action="{{ route('staff.computer-usage.index') }}"
                        class="flex items-center w-full md:w-80">
                        <div class="relative w-full">
                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="Cari mahasiswa atau komputer..."
                                class="w-full rounded-l-xl border border-gray-200 py-2.5 pl-10 pr-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30"
                                aria-label="Cari log" />
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
                    <a href="{{ route('staff.computer-usage.create') }}">
                        <div
                            class="flex items-center gap-2 bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p>Input Log Baru</p>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Mahasiswa</th>
                            <th class="px-4 py-3 text-left">Komputer</th>
                            <th class="px-4 py-3 text-left">Waktu Mulai</th>
                            <th class="px-4 py-3 text-left">Waktu Selesai</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($usages as $usage)
                        <tr class="hover:bg-blue-50/50 transition duration-100">
                            
                            {{-- Kolom Mahasiswa --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $usage->user->name ?? 'User Dihapus' }}</div>
                                <div class="text-xs text-gray-500">{{ $usage->user->studentProfile->student_id_number ?? $usage->user->email ?? '-' }}</div>
                            </td>

                            {{-- Kolom Komputer --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $usage->asset->name ?? 'Aset Dihapus' }}</div>
                                {{-- Tambahkan status aset untuk debugging --}}
                                <div class="text-xs text-gray-500">Status: {{ $usage->asset->status ?? 'N/A' }}</div>
                            </td>

                            {{-- Kolom Waktu Mulai --}}
                            <td class="px-4 py-3">{{ $usage->started_at->isoFormat('DD MMM YYYY, HH:mm') }}</td>
                            
                            {{-- Kolom Waktu Selesai --}}
                            <td class="px-4 py-3">
                                @if($usage->finished_at)
                                    {{ $usage->finished_at->isoFormat('DD MMM YYYY, HH:mm') }}
                                @else
                                    {{-- Beri indikator visual bahwa ini sedang berjalan --}}
                                    <span class="rounded-full bg-yellow-100 px-2 py-1 text-xs font-semibold text-yellow-700">Sedang Digunakan</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    @if(!$usage->finished_at)
                                        {{-- Tombol Selesaikan (Form 1) --}}
                                        <form action="{{ route('staff.computer-usage.finish', $usage) }}" method="POST"
                                            onsubmit="return openConfirmModal('Selesaikan sesi untuk {{ $usage->asset->name }}?', this, 'complete');">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 transition duration-150">
                                                Selesaikan
                                            </button>
                                        </form>
                                    @else
                                        {{-- Tombol Hapus (Form 2) --}}
                                        <form action="{{ route('staff.computer-usage.destroy', $usage) }}" method="POST"
                                            onsubmit="return openConfirmModal('Hapus log ini secara permanen?', this, 'reject');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 transition duration-150">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-gray-500">Belum ada log penggunaan komputer.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Links --}}
            @if($usages->hasPages())
            <div class="border-t px-4 py-3 mt-0">
                {{ $usages->appends(request()->query())->links() }}
            </div>
            @endif
        </div>

    <div id="confirmModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Konfirmasi Tindakan</h3>
            <p id="confirmMessage" class="text-sm text-gray-700 mb-6"></p>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeConfirmModal()"
                    class="rounded-lg px-3 py-2 text-sm text-gray-600 hover:bg-gray-50">Batal</button>
                <button id="confirmSubmitBtn" type="button"
                    class="rounded-lg px-3 py-2 text-sm font-semibold text-white">Ya</button>
            </div>
        </div>
    </div>
    </section>

    @push('scripts')
    <script>
    let _pendingForm = null;
    const confirmBtn = document.getElementById('confirmSubmitBtn');

    function openConfirmModal(message, formEl, type = 'complete') {
        _pendingForm = formEl;
        document.getElementById('confirmMessage').textContent = message;

        // Reset kelas tombol
        confirmBtn.className = 'rounded-lg px-3 py-2 text-sm font-semibold text-white';
        confirmBtn.disabled = false;

        // Sesuaikan tombol berdasarkan tipe aksi
        switch (type) {
            case 'complete':
                confirmBtn.classList.add('bg-blue-600', 'hover:bg-blue-700');
                confirmBtn.textContent = 'Ya, Selesaikan';
                break;
            case 'reject': // 'reject' akan kita gunakan untuk tombol 'Hapus' (merah)
                confirmBtn.classList.add('bg-red-600', 'hover:bg-red-700');
                confirmBtn.textContent = 'Ya, Hapus';
                break;
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

    if (document.getElementById('confirmSubmitBtn')) {
        document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
            if (_pendingForm) {
                confirmBtn.textContent = 'Memproses...'; 
                confirmBtn.disabled = true;
                _pendingForm.submit();
            }
        });
    }
    </script>
    @endpush
</x-staff-layout>