<x-admin-layout title="Persetujuan Pengajuan Alat">

    <section class="max-w-7xl mx-auto p-4 sm:p-6">
        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-50 px-4 py-3 text-green-700 border border-green-200 font-medium">{{
            session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-red-700 border border-red-200 font-medium">{{
            session('error') }}</div>
        @endif

        {{-- 1. Header Halaman --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Pengajuan Alat</h1>
            <p class="text-gray-500">Tinjau dan setujui pengajuan alat baru dari Staff atau Mahasiswa.</p>
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
                            <th class="px-4 py-3 text-left">Pemohon</th>
                            <th class="px-4 py-3 text-left">Nama Alat</th>
                            <th class="px-4 py-3 text-left">Alasan</th>
                            <th class="px-4 py-3 text-left">Tgl. Pengajuan</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pendingRequests as $request)
                        <tr class="hover:bg-blue-50/50 transition duration-100">
                            {{-- Kolom Pemohon --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $request->requester->name }}</div>
                                {{-- Menampilkan role atau NIM --}}
                                <div class="text-xs text-gray-500">
                                    {{ $request->requester->studentProfile->student_id_number ??
                                    $request->requester->getRoleNames()->first() }}
                                </div>
                            </td>
                            {{-- Kolom Nama Alat --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $request->asset_name }}</div>
                                <div class="text-xs text-gray-500 truncate max-w-[25ch]"
                                    title="{{ $request->specifications }}">{{ $request->specifications ?? 'Tanpa
                                    spesifikasi' }}</div>
                            </td>
                            {{-- Kolom Alasan --}}
                            <td class="px-4 py-3">
                                <p class="truncate max-w-[30ch] text-gray-500" title="{{ $request->reason }}">{{
                                    $request->reason }}</p>
                            </td>
                            {{-- Kolom Tgl. Pengajuan --}}
                            <td class="px-4 py-3">{{ $request->created_at->isoFormat('DD MMM YYYY') }}</td>
                            {{-- Kolom Aksi --}}
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.asset-requests.show', $request) }}"
                                        class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-yellow-500 hover:bg-yellow-600 transition duration-150">Detail</a>
                                    {{-- Tombol Approve --}}
                                    <form action="{{ route('admin.asset-requests.approve', $request) }}" method="POST"
                                        onsubmit="return openConfirmModal('Setujui pengajuan \'{{ $request->asset_name }}\'?', this, 'approve');">
                                        @csrf @method('PUT')
                                        <button type="submit"
                                            class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-green-600 hover:bg-green-700 transition duration-150">
                                            Approve
                                        </button>
                                    </form>
                                    {{-- Tombol Reject --}}
                                    <form action="{{ route('admin.asset-requests.reject', $request) }}" method="POST"
                                        onsubmit="return openConfirmModal('Tolak pengajuan \'{{ $request->asset_name }}\'?', this, 'reject');">
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
                            <td colspan="5" class="px-4 py-10 text-center text-gray-500">Tidak ada pengajuan alat baru
                                yang masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- =============================================== --}}
        {{-- TABEL 2: RIWAYAT PENGAJUAN --}}
        {{-- =============================================== --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            {{-- Toolbar --}}
            <div class="mb-4">
                <h2 class="font-semibold text-xl text-gray-800">Riwayat Pengajuan (Disetujui / Ditolak)</h2>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Pemohon</th>
                            <th class="px-4 py-3 text-left">Nama Alat</th>
                            <th class="px-4 py-3 text-left">Tgl. Pengajuan</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($historyRequests as $request)
                        <tr class="hover:bg-blue-50/50 transition duration-100">
                            {{-- Kolom Pemohon --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $request->requester->name ?? 'User Dihapus' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $request->requester->studentProfile->student_id_number ??
                                    ($request->requester->getRoleNames()->first() ?? '-') }}
                                </div>
                            </td>
                            {{-- Kolom Nama Alat --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $request->asset_name }}</div>
                            </td>
                            {{-- Kolom Tgl. Pengajuan --}}
                            <td class="px-4 py-3">{{ $request->created_at->isoFormat('DD MMM YYYY') }}</td>
                            {{-- Kolom Status --}}
                            <td class="px-4 py-3 text-center">
                                @if($request->status == 'Approved')
                                <span
                                    class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">Disetujui</span>
                                @elseif($request->status == 'Rejected')
                                <span
                                    class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('admin.asset-requests.show', $request) }}"
                                    class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-yellow-500 hover:bg-yellow-600 transition duration-150">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-gray-500">Tidak ada riwayat pengajuan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            @if($historyRequests->hasPages())
            <div class="border-t px-4 py-3 mt-0">
                {{ $historyRequests->links() }}
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