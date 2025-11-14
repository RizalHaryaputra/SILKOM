<x-student-layout title="Peminjaman Saya"> {{-- Asumsi Anda menggunakan x-app-layout untuk student --}}

    <section class="max-w-7xl mx-auto p-4 sm:p-6">
        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-50 px-4 py-3 text-green-700 border border-green-200 font-medium">{{
            session('success') }}</div>
        @endif

        {{-- 1. Header Halaman --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Peminjaman Saya</h1>
            <p class="text-gray-500">Riwayat dan status peminjaman aset Anda.</p>
        </div>

        {{-- 3. Table Container --}}
        <div class="bg-white rounded-xl shadow-md p-6">

            {{-- Toolbar --}}
            <div class="mb-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <h2 class="font-semibold text-xl text-gray-800">Riwayat Peminjaman</h2>

                <div class="flex items-center gap-2">
                    {{-- Search Form --}}
                    <form method="GET" action="{{ route('student.borrow.index') }}"
                        class="flex items-center w-full md:w-80">
                        <div class="relative w-full">
                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="Cari aset (nama, kategori)..."
                                class="w-full rounded-l-xl border border-gray-200 py-2.5 pl-10 pr-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30"
                                aria-label="Cari aset" />
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
                    <a href="{{ route('student.borrow.create') }}">
                        <div
                            class="flex items-center gap-2 bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p>Pinjam Aset Baru</p>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Aset Dipinjam</th>
                            <th class="px-4 py-3 text-left">Tgl. Pinjam</th>
                            <th class="px-4 py-3 text-left">Tgl. Kembali</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($myBorrowings as $borrowing)
                        <tr class="hover:bg-blue-50/50 transition duration-100">

                            {{-- Kolom Nama Aset & Gambar --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    {{-- Thumbnail --}}
                                    <div
                                        class="h-10 w-10 overflow-hidden rounded-lg bg-gray-100 ring-1 ring-gray-200 flex-shrink-0">
                                        @if($borrowing->asset->asset_image_path)
                                        <img src="{{ asset('storage/'.$borrowing->asset->asset_image_path) }}"
                                            alt="Foto Aset" class="h-full w-full object-cover">
                                        @else
                                        {{-- Ikon fallback --}}
                                        <div class="flex h-full w-full items-center justify-center text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
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
                                        <div class="text-xs text-gray-500">{{ $borrowing->asset->category ?? '' }}</div>
                                    </div>
                                </div>
                            </td>

                            {{-- Kolom Tgl. Pinjam --}}
                            <td class="px-4 py-3">{{ $borrowing->borrowed_at->isoFormat('DD MMM YYYY') }}</td>

                            {{-- Kolom Tgl. Kembali --}}
                            <td class="px-4 py-3">
                                @if($borrowing->returned_at)
                                {{ $borrowing->returned_at->isoFormat('DD MMM YYYY') }}
                                @else
                                <span class="text-gray-500">-</span>
                                @endif
                            </td>

                            {{-- Kolom Status (dengan badge) --}}
                            <td class="px-4 py-3 text-center">
                                @if($borrowing->status == 'Pending')
                                <span
                                    class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">Menunggu</span>
                                @elseif($borrowing->status == 'Approved')
                                <span
                                    class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">Disetujui</span>
                                @elseif($borrowing->status == 'Rejected')
                                <span
                                    class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">Ditolak</span>
                                @elseif($borrowing->status == 'Completed')
                                <span
                                    class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Selesai</span>
                                @else
                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">{{
                                    $borrowing->status }}</span>
                                @endif
                            </td>

                            {{-- Kolom aksi --}}
                            <td class="px-4 py-3 text-center">
                                @if($borrowing->status == 'Pending')
                                <form action="{{ route('student.borrow.destroy', $borrowing->id) }}" method="POST"
                                    onsubmit="return openConfirmModal('Anda yakin ingin membatalkan permintaan ini?', this, 'reject');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 transition duration-150">
                                        Batal
                                    </button>
                                </form>
                                @else
                                <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-gray-500">Anda belum memiliki riwayat
                                peminjaman.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            @if($myBorrowings->hasPages())
            <div class="border-t px-4 py-3 mt-0">
                {{ $myBorrowings->links() }}
            </div>
            @endif
        </div>

        <div id="confirmModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Konfirmasi Batalkan</h3>
                <p id="confirmMessage" class="text-sm text-gray-700 mb-6"></p>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeConfirmModal()"
                        class="rounded-lg px-3 py-2 text-sm text-gray-600 hover:bg-gray-50">Batal</button>
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

    function openConfirmModal(message, formEl) {
        _pendingForm = formEl;
        document.getElementById('confirmMessage').textContent = message;
        document.getElementById('confirmModal').classList.remove('hidden');
        document.getElementById('confirmModal').classList.add('flex');
        return false;
    }

    function closeConfirmModal() {
        document.getElementById('confirmModal').classList.add('hidden');
        document.getElementById('confirmModal').classList.remove('flex');
        _pendingForm = null;
    }

    document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
        if (_pendingForm) {
            const btn = document.getElementById('confirmSubmitBtn');
            btn.textContent = 'Membatalkan...'; 
            btn.disabled = true;
            _pendingForm.submit();
        }
    });
    </script>
    @endpush
</x-student-layout>