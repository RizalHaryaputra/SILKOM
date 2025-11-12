<x-admin-layout title="Manajemen Peminjaman">

    <section class="max-w-7xl mx-auto p-4 sm:p-6">
        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-50 px-4 py-3 text-green-700 border border-green-200 font-medium">{{
            session('success') }}</div>
        @endif
        {{-- Menambahkan session 'error' untuk kegagalan otorisasi --}}
        @if(session('error'))
        <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-red-700 border border-red-200 font-medium">{{
            session('error') }}</div>
        @endif

        {{-- 1. Header Halaman --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Peminjaman</h1>
            <p class="text-gray-500">Setujui, tolak, atau selesaikan peminjaman aset laboratorium.</p>
        </div>

        {{-- =============================================== --}}
        {{-- TABEL 1: PERMINTAAN MASUK (PENDING) --}}
        {{-- =============================================== --}}
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            {{-- Toolbar --}}
            <div class="mb-4">
                <h2 class="font-semibold text-xl text-gray-800">Permintaan Masuk (Pending)</h2>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Peminjam</th>
                            <th class="px-4 py-3 text-left">Aset</th>
                            <th class="px-4 py-3 text-left">Tgl. Pinjam</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pendingBorrowings as $borrowing)
                        <tr class="hover:bg-blue-50/50 transition duration-100">
                            {{-- Kolom Peminjam --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $borrowing->user->name }}</div>
                                <div class="text-xs text-gray-500">{{
                                    $borrowing->user->studentProfile->student_id_number ?? $borrowing->user->email }}
                                </div>
                            </td>
                            {{-- Kolom Aset --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $borrowing->asset->name }}</div>
                                <div class="text-xs text-gray-500">{{ $borrowing->asset->category }}</div>
                            </td>
                            {{-- Kolom Tgl. Pinjam --}}
                            <td class="px-4 py-3">{{ $borrowing->borrowed_at->isoFormat('DD MMM YYYY') }}</td>
                            {{-- Kolom Aksi --}}
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.borrow.requests.show', $borrowing) }}"
                                        class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-yellow-500 hover:bg-yellow-600 transition duration-150">Detail</a>
                                    {{-- Tombol Approve --}}
                                    <form action="{{ route('admin.borrow.requests.approve', $borrowing) }}"
                                        method="POST"
                                        onsubmit="return openConfirmModal('Setujui peminjaman \'{{ $borrowing->asset->name }}\' oleh \'{{ $borrowing->user->name }}\'?', this, 'approve');">
                                        @csrf @method('PUT')
                                        <button type="submit"
                                            class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-green-600 hover:bg-green-700 transition duration-150">
                                            Approve
                                        </button>
                                    </form>
                                    {{-- Tombol Reject --}}
                                    <form action="{{ route('admin.borrow.requests.reject', $borrowing) }}" method="POST"
                                        onsubmit="return openConfirmModal('Tolak peminjaman \'{{ $borrowing->asset->name }}\' oleh \'{{ $borrowing->user->name }}\'?', this, 'reject');">
                                        @csrf @method('PUT')
                                        <button type="submit"
                                            class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 transition duration-150">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-gray-500">Tidak ada permintaan peminjaman
                                yang masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- =============================================== --}}
        {{-- TABEL 2: ASET SEDANG DIPINJAM (AKTIF) --}}
        {{-- =============================================== --}}
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            {{-- Toolbar --}}
            <div class="mb-4">
                <h2 class="font-semibold text-xl text-gray-800">Aset Sedang Dipinjam (Disetujui)</h2>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Peminjam</th>
                            <th class="px-4 py-3 text-left">Aset</th>
                            <th class="px-4 py-3 text-left">Tgl. Pinjam</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($activeBorrowings as $borrowing)
                        <tr class="hover:bg-blue-50/50 transition duration-100">
                            {{-- Kolom Peminjam --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $borrowing->user->name }}</div>
                                <div class="text-xs text-gray-500">{{
                                    $borrowing->user->studentProfile->student_id_number ?? $borrowing->user->email }}
                                </div>
                            </td>
                            {{-- Kolom Aset --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $borrowing->asset->name }}</div>
                                <div class="text-xs text-gray-500">{{ $borrowing->asset->category }}</div>
                            </td>
                            {{-- Kolom Tgl. Pinjam --}}
                            <td class="px-4 py-3">{{ $borrowing->borrowed_at->isoFormat('DD MMM YYYY') }}</td>
                            {{-- Kolom Aksi --}}
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.borrow.requests.show', $borrowing) }}"
                                        class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-yellow-500 hover:bg-yellow-600 transition duration-150">Detail</a>
                                    {{-- Tombol Selesaikan --}}
                                    <form action="{{ route('admin.borrow.requests.complete', $borrowing) }}"
                                        method="POST"
                                        onsubmit="return openConfirmModal('Tandai \'{{ $borrowing->asset->name }}\' telah dikembalikan?', this, 'complete');">
                                        @csrf @method('PUT')
                                        <button type="submit"
                                            class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 transition duration-150">
                                            Tandai Selesai
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-gray-500">Tidak ada aset yang sedang
                                dipinjam.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- =============================================== --}}
        {{-- TABEL 3: RIWAYAT PEMINJAMAN --}}
        {{-- =============================================== --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            {{-- Toolbar --}}
            <div class="mb-4">
                <h2 class="font-semibold text-xl text-gray-800">Riwayat Peminjaman (Selesai / Ditolak)</h2>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Peminjam</th>
                            <th class="px-4 py-3 text-left">Aset</th>
                            <th class="px-4 py-3 text-left">Tgl. Pinjam</th>
                            <th class="px-4 py-3 text-left">Tgl. Kembali</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($historyBorrowings as $borrowing)
                        <tr class="hover:bg-blue-50/50 transition duration-100">
                            {{-- Kolom Peminjam --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $borrowing->user->name ?? 'User Dihapus' }}
                                </div>
                                <div class="text-xs text-gray-500">{{
                                    $borrowing->user->studentProfile->student_id_number ?? ($borrowing->user->email ??
                                    '-') }}</div>
                            </td>
                            {{-- Kolom Aset --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $borrowing->asset->name ?? 'Aset Dihapus' }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $borrowing->asset->category ?? '-' }}</div>
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
                            {{-- Kolom Status --}}
                            <td class="px-4 py-3 text-center">
                                @if($borrowing->status == 'Completed')
                                <span
                                    class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Selesai</span>
                                @elseif($borrowing->status == 'Rejected')
                                <span
                                    class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">Ditolak</span>
                                @endif
                            </td>
                            {{-- Kolom Aksi --}}
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('admin.borrow.requests.show', $borrowing) }}"
                                    class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-yellow-500 hover:bg-yellow-600 transition duration-150">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-gray-500">Tidak ada riwayat peminjaman.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            @if($historyBorrowings->hasPages())
            <div class="border-t px-4 py-3 mt-0">
                {{ $historyBorrowings->links() }}
            </div>
            @endif
        </div>

        {{-- ===== Modal Konfirmasi Aksi ===== --}}
        <div id="confirmModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Konfirmasi Tindakan</h3>
                <p id="confirmMessage" class="text-sm text-gray-700 mb-6"></p>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeConfirmModal()"
                        class="rounded-lg px-3 py-2 text-sm text-gray-600 hover:bg-gray-50">Batal</button>
                    {{-- Tombol ini akan diubah oleh JS --}}
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

    /**
     * @param {string} message Pesan konfirmasi
     * @param {HTMLFormElement} formEl Form yang akan di-submit
     * @param {'approve' | 'reject' | 'complete'} type Tipe aksi
     */
    function openConfirmModal(message, formEl, type = 'approve') {
        _pendingForm = formEl;
        document.getElementById('confirmMessage').textContent = message;

        // Reset kelas tombol
        confirmBtn.className = 'rounded-lg px-3 py-2 text-sm font-semibold text-white';
        confirmBtn.disabled = false;

        // Sesuaikan tombol berdasarkan tipe aksi
        switch (type) {
            case 'approve':
                confirmBtn.classList.add('bg-green-600', 'hover:bg-green-700');
                confirmBtn.textContent = 'Ya, Setujui';
                break;
            case 'reject':
                confirmBtn.classList.add('bg-red-600', 'hover:bg-red-700');
                confirmBtn.textContent = 'Ya, Tolak';
                break;
            case 'complete':
                confirmBtn.classList.add('bg-blue-600', 'hover:bg-blue-700');
                confirmBtn.textContent = 'Ya, Selesaikan';
                break;
        }

        document.getElementById('confirmModal').classList.remove('hidden');
        document.getElementById('confirmModal').classList.add('flex');
        return false; // Mencegah form submit langsung
    }

    function closeConfirmModal() {
        document.getElementById('confirmModal').classList.add('hidden');
        document.getElementById('confirmModal').classList.remove('flex');
        _pendingForm = null;
    }

    document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
        if (_pendingForm) {
            confirmBtn.textContent = 'Memproses...'; 
            confirmBtn.disabled = true;
            _pendingForm.submit();
        }
    });
    </script>
    @endpush
</x-admin-layout>