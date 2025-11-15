<x-student-layout title="Dashboard">

    <section class="max-w-7xl mx-auto p-4 sm:p-6">

        {{-- 1. Header Halaman & Salam --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-gray-500">Selamat datang kembali, {{ auth()->user()->name }}.</p>
        </div>

        {{-- 2. Stats Row (KPI Peminjaman) --}}
        <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2">

            {{-- KPI 1: Permintaan Pending --}}
            <a href="{{ route('student.borrow.index') }}" class="block">
                <div class="rounded-xl bg-white p-6 shadow-md transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center space-x-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-yellow-100">
                            <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Permintaan Pending</div>
                            <div class="text-2xl font-bold text-gray-800">{{ $pendingCount }}</div>
                        </div>
                    </div>
                </div>
            </a>

            {{-- KPI 2: Aset Sedang Dipinjam --}}
            <a href="{{ route('student.borrow.index') }}" class="block">
                <div class="rounded-xl bg-white p-6 shadow-md transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center space-x-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Aset Sedang Dipinjam</div>
                            <div class="text-2xl font-bold text-gray-800">{{ $activeCount }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>



        {{-- 4. Tabel "Peminjaman Aktif & Pending" --}}
        <div class="bg-white rounded-xl shadow-md p-6 mt-8">

            {{-- Toolbar --}}
            <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between">
                <h2 class="font-semibold text-xl text-gray-800">Peminjaman Aktif & Pending (5 Terbaru)</h2>
                <a href="{{ route('student.borrow.index') }}" class="text-sm text-blue-600 hover:underline font-medium">
                    Lihat Semua Peminjaman
                </a>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Aset Dipinjam</th>
                            <th class="px-4 py-3 text-left">Tgl. Pinjam</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentBorrowings as $borrowing)
                        <tr class="hover:bg-blue-50/50 transition duration-100">

                            {{-- Kolom Nama Aset & Gambar --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-10 w-10 overflow-hidden rounded-lg bg-gray-100 ring-1 ring-gray-200 flex-shrink-0">
                                        @if($borrowing->asset->asset_image_path)
                                        <img src="{{ asset('storage/'.$borrowing->asset->asset_image_path) }}"
                                            alt="Foto Aset" class="h-full w-full object-cover">
                                        @else
                                        <div class="flex h-full w-full items-center justify-center text-gray-400">
                                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                            </svg>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="truncate max-w-[30ch] font-medium text-gray-900"
                                            title="{{ $borrowing->asset->name ?? 'Aset tidak ada' }}">{{
                                            $borrowing->asset->name ?? 'Aset tidak ada' }}</div>
                                    </div>
                                </div>
                            </td>

                            {{-- Kolom Tgl. Pinjam --}}
                            <td class="px-4 py-3">{{ $borrowing->borrowed_at->isoFormat('DD MMM YYYY') }}</td>

                            {{-- Kolom Status (dengan badge) --}}
                            <td class="px-4 py-3 text-center">
                                @if($borrowing->status == 'Pending')
                                <span
                                    class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">Menunggu</span>
                                @elseif($borrowing->status == 'Approved')
                                <span
                                    class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">Disetujui</span>
                                @endif
                            </td>

                            {{-- Kolom aksi --}}
                            <td class="px-4 py-3 text-center">
                                @if($borrowing->status == 'Pending')
                                <form action="{{ route('student.borrow.destroy', $borrowing) }}" method="POST"
                                    onsubmit="return openConfirmModal('Anda yakin ingin membatalkan permintaan ini?', this, 'reject');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 transition duration-150">
                                        Batalkan
                                    </button>
                                </form>
                                @else
                                <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-gray-500">Anda tidak memiliki
                                peminjaman yang sedang aktif atau pending.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 3. Pintasan (Quick Links) --}}
        <div class="mt-8">
            <h2 class="font-semibold text-xl text-gray-800 mb-4">Aksi Cepat</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Pinjam Aset Baru --}}
                <a href="{{ route('student.borrow.create') }}"
                    class="block p-6 bg-white rounded-xl shadow-md text-center transition-all duration-300 hover:shadow-lg hover:bg-gray-50">
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mx-auto">
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-800 mt-3">Pinjam Aset Baru</p>
                </a>

                {{-- Riwayat Penggunaan Komputer --}}
                <a href="{{ route('student.computer-usage.index') }}"
                    class="block p-6 bg-white rounded-xl shadow-md text-center transition-all duration-300 hover:shadow-lg hover:bg-gray-50">
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 mx-auto">
                        <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-800 mt-3">Riwayat Log Komputer</p>
                </a>
            </div>
        </div>

        {{-- Modal JS (untuk tombol 'Batalkan') --}}
        <div id="confirmModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Konfirmasi Batalkan</h3>
                <p id="confirmMessage" class="text-sm text-gray-700 mb-6"></p>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeConfirmModal()"
                        class="rounded-lg px-3 py-2 text-sm text-gray-600 hover:bg-gray-50">Tutup</button>
                    <button id="confirmSubmitBtn" type="button"
                        class="rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-700">Ya,
                        Batalkan</button>
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
            confirmBtn.textContent = 'Ya, Batalkan';
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

    if (confirmBtn) {
        confirmBtn.addEventListener('click', function () {
            if (_pendingForm) {
                confirmBtn.textContent = 'Memproses...'; 
                confirmBtn.disabled = true;
                _pendingForm.submit();
            }
        });
    }
    </script>
    @endpush
</x-student-layout>