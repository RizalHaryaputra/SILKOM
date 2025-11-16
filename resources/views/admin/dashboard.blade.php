<x-admin-layout title="Dashboard Admin">

    <section class="max-w-7xl mx-auto p-4 sm:p-6">

        {{-- 1. Header Halaman & Salam --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin Lab</h1>
            <p class="text-gray-500">Selamat datang kembali, {{ auth()->user()->name }}. Berikut adalah ringkasan tugas
                Anda hari ini.</p>
        </div>

        {{-- 2. Stats Row (KPI Tugas Mendesak) --}}
        <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">

            {{-- KPI 1: Peminjaman Pending (Paling Penting) --}}
            <a href="{{ route('admin.borrow.requests.index') }}" class="block">
                <div class="rounded-xl bg-white p-6 shadow-md transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center space-x-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Peminjaman Pending</div>
                            <div class="text-2xl font-bold text-gray-800">{{ $pendingBorrowingsCount }}</div>
                        </div>
                    </div>
                </div>
            </a>

            {{-- KPI 2: Aset Rusak --}}
            <a href="{{ route('admin.damages.index') }}" class="block">
                <div class="rounded-xl bg-white p-6 shadow-md transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center space-x-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Aset Rusak</div>
                            <div class="text-2xl font-bold text-gray-800">{{ $damagedAssetsCount }}</div>
                        </div>
                    </div>
                </div>
            </a>

            {{-- KPI 3: Pengajuan Alat Pending --}}
            <a href="{{ route('admin.asset-requests.index') }}" class="block">
                <div class="rounded-xl bg-white p-6 shadow-md transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center space-x-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-yellow-100">
                            <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Pengajuan Alat Pending</div>
                            <div class="text-2xl font-bold text-gray-800">{{ $pendingAssetRequestsCount }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- 3. Tabel Aksi Cepat: Peminjaman Pending --}}
        <div class="bg-white rounded-xl shadow-md p-6">

            {{-- Toolbar --}}
            <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between">
                <h2 class="font-semibold text-xl text-gray-800">Permintaan Peminjaman Mendesak (5 Terbaru)</h2>
                <a href="{{ route('admin.borrow.requests.index') }}"
                    class="text-sm text-blue-600 hover:underline font-medium">
                    Lihat Semua Peminjaman
                </a>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Peminjam</th>
                            <th class="px-4 py-3 text-left">Aset</th>
                            <th class="px-4 py-3 text-left">Tgl. Pinjam</th>
                            <th class="px-4 py-3 text-center">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($topPendingBorrowings as $borrowing)
                        <tr class="hover:bg-blue-50/50 transition duration-100">
                            {{-- Peminjam --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $borrowing->user->name }}</div>
                                <div class="text-xs text-gray-500">{{
                                    $borrowing->user->studentProfile?->student_id_number ?? $borrowing->user->email }}
                                </div>
                            </td>
                            {{-- Aset --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $borrowing->asset->name }}</div>
                                <div class="text-xs text-gray-500">{{ $borrowing->asset->category }}</div>
                            </td>
                            {{-- Tgl. Pinjam --}}
                            <td class="px-4 py-3">{{ $borrowing->borrowed_at->isoFormat('DD MMM YYYY') }}</td>
                            {{-- Aksi Cepat --}}
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- PERBAIKAN: Tambahkan onsubmit() --}}
                                    <form action="{{ route('admin.borrow.requests.approve', $borrowing) }}"
                                        method="POST"
                                        onsubmit="return openConfirmModal('Setujui peminjaman \'{{ $borrowing->asset->name }}\'?', this, 'approve');">
                                        @csrf @method('PUT')
                                        <button type="submit"
                                            class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-green-600 hover:bg-green-700 transition duration-150">
                                            Approve
                                        </button>
                                    </form>
                                    {{-- PERBAIKAN: Tambahkan onsubmit() --}}
                                    <form action="{{ route('admin.borrow.requests.reject', $borrowing) }}" method="POST"
                                        onsubmit="return openConfirmModal('Tolak peminjaman \'{{ $borrowing->asset->name }}\'?', this, 'reject');">
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
                                yang mendesak.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 mt-8">

            {{-- Toolbar --}}
            <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between">
                <h2 class="font-semibold text-xl text-gray-800">Pengajuan Alat Mendesak (5 Terbaru)</h2>
                <a href="{{ route('admin.asset-requests.index') }}"
                    class="text-sm text-blue-600 hover:underline font-medium">
                    Lihat Semua Pengajuan
                </a>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Pemohon</th>
                            <th class="px-4 py-3 text-left">Nama Alat</th>
                            <th class="px-4 py-3 text-left">Alasan</th>
                            <th class="px-4 py-3 text-center">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($topPendingAssetRequests as $request)
                        <tr class="hover:bg-blue-50/50 transition duration-100">
                            {{-- Pemohon --}}
                            <td class="px-4 py-3">
                                <div class_exists("font-medium text-gray-900")>{{ $request->requester_user->name }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $request->requester_user->getRoleNames()->first()
                                    }}</div>
                            </td>
                            {{-- Nama Alat --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $request->asset_name }}</div>
                                <div class="text-xs text-gray-500 truncate" title="{{ $request->specifications }}">{{
                                    $request->specifications ?? 'Tanpa spek' }}</div>
                            </td>
                            {{-- Alasan --}}
                            <td class="px-4 py-3">
                                <p class="truncate max-w-[30ch] text-gray-500" title="{{ $request->reason }}">{{
                                    $request->reason }}</p>
                            </td>
                            {{-- Aksi Cepat --}}
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- PERBAIKAN: Tambahkan onsubmit() --}}
                                    <form action="{{ route('admin.asset-requests.approve', $request) }}" method="POST"
                                        onsubmit="return openConfirmModal('Setujui pengajuan \'{{ $request->asset_name }}\'?', this, 'approve');">
                                        @csrf @method('PUT')
                                        <button type="submit"
                                            class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-green-600 hover:bg-green-700 transition duration-150">
                                            Approve
                                        </button>
                                    </form>
                                    {{-- PERBAIKAN: Tambahkan onsubmit() --}}
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
                            <td colspan="4" class="px-4 py-10 text-center text-gray-500">Tidak ada pengajuan alat baru
                                yang mendesak.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 4. Pintasan (Quick Links) --}}
        <div class="mt-8">
            <h2 class="font-semibold text-xl text-gray-800 mb-4">Pintasan Admin</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                {{-- Kelola Aset --}}
                <a href="{{ route('admin.assets.index') }}"
                    class="block p-6 bg-white rounded-xl shadow-md text-center transition-all duration-300 hover:shadow-lg hover:bg-gray-50">
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 mx-auto">
                        <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m1.5 0V5.625A2.25 2.25 0 0 1 7.5 3.375h9A2.25 2.25 0 0 1 18.75 5.625v1.875m-1.5 0h-12" />
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-800 mt-3">Kelola Aset</p>
                </a>
                {{-- Kelola Kerusakan --}}
                <a href="{{ route('admin.damages.index') }}"
                    class="block p-6 bg-white rounded-xl shadow-md text-center transition-all duration-300 hover:shadow-lg hover:bg-gray-50">
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mx-auto">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-800 mt-3">Kelola Kerusakan</p>
                </a>
                {{-- Kelola Pengguna --}}
                <a href="{{ route('admin.users.index') }}"
                    class="block p-6 bg-white rounded-xl shadow-md text-center transition-all duration-300 hover:shadow-lg hover:bg-gray-50">
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-purple-100 mx-auto">
                        <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.53-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-800 mt-3">Kelola Pengguna</p>
                </a>
                {{-- Lihat Laporan --}}
                <a href="{{ route('admin.reports.index') }}"
                    class="block p-6 bg-white rounded-xl shadow-md text-center transition-all duration-300 hover:shadow-lg hover:bg-gray-50">
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mx-auto">
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-800 mt-3">Lihat Laporan</p>
                </a>
            </div>
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

        {{-- Flash Message (jika ada error otorisasi dari tombol approve/reject) --}}
        @if(session('error'))
        <div class="mt-6 rounded-xl bg-red-50 px-4 py-3 text-red-700 border border-red-200 font-medium">{{
            session('error') }}</div>
        @endif

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
</x-admin-layout>