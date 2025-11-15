<x-staff-layout title="Dashboard Staff">

    <section class="max-w-7xl mx-auto p-4 sm:p-6">

        {{-- 1. Header Halaman & Salam --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Staff</h1>
            <p class="text-gray-500">Selamat datang, {{ auth()->user()->name }}. Berikut adalah ringkasan kondisi
                laboratorium saat ini.</p>
        </div>

        {{-- 2. Stats Row (KPI Kondisi Lab) --}}
        <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">

            {{-- KPI 1: Aset Tersedia --}}
            <div class="rounded-xl bg-white p-6 shadow-md">
                <div class="flex items-center space-x-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Aset Tersedia</div>
                        <div class="text-2xl font-bold text-gray-800">{{ $availableAssets }}</div>
                    </div>
                </div>
            </div>

            {{-- KPI 2: Aset Sedang Dipinjam --}}
            <div class="rounded-xl bg-white p-6 shadow-md">
                <div class="flex items-center space-x-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-yellow-100">
                        <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Aset Dipinjam</div>
                        <div class="text-2xl font-bold text-gray-800">{{ $borrowedAssets }}</div>
                    </div>
                </div>
            </div>

            {{-- KPI 3: Aset Rusak --}}
            <div class="rounded-xl bg-white p-6 shadow-md">
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
                        <div class="text-2xl font-bold text-gray-800">{{ $damagedAssets }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 mt-8">

            {{-- Toolbar --}}
            <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between">
                <h2 class="font-semibold text-xl text-gray-800">Log Penggunaan Komputer (5 Terbaru)</h2>
                <a href="{{ route('staff.computer-usage.index') }}"
                    class="text-sm text-blue-600 hover:underline font-medium">
                    Lihat Semua Riwayat Log
                </a>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Mahasiswa</th>
                            <th class="px-4 py-3 text-left">Komputer</th>
                            <th class="px-4 py-3 text-left">Waktu Mulai</th>
                            <th class="px-4 py-3 text-left">Status Sesi</th>
                            <th class="px-4 py-3 text-center">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentUsages as $usage)
                        <tr class="hover:bg-blue-50/50 transition duration-100">

                            {{-- Kolom Mahasiswa --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $usage->user->name ?? 'User Dihapus' }}</div>
                                <div class="text-xs text-gray-500">{{ $usage->user->studentProfile->student_id_number ??
                                    $usage->user->email ?? '-' }}</div>
                            </td>

                            {{-- Kolom Komputer --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $usage->asset->name ?? 'Aset Dihapus' }}</div>
                                <div class="text-xs text-gray-500">Status Aset: {{ $usage->asset->status ?? 'N/A' }}
                                </div>
                            </td>

                            {{-- Kolom Waktu Mulai --}}
                            <td class="px-4 py-3">{{ $usage->started_at->isoFormat('DD MMM, HH:mm') }}</td>

                            {{-- Kolom Status Sesi --}}
                            <td class="px-4 py-3">
                                @if($usage->finished_at)
                                <span
                                    class="rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-700">Selesai</span>
                                @else
                                <span
                                    class="rounded-full bg-yellow-100 px-2 py-1 text-xs font-semibold text-yellow-700">Sedang
                                    Digunakan</span>
                                @endif
                            </td>

                            {{-- Kolom Aksi Cepat --}}
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
                            <td colspan="5" class="px-4 py-10 text-center text-gray-500">Belum ada log penggunaan
                                komputer.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pintasan (Quick Links) --}}
        <div class="mt-8">
            <h2 class="font-semibold text-xl text-gray-800 mb-4">Pintasan Staff</h2>
            <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                {{-- Input Log Komputer --}}
                <a href="{{ route('staff.computer-usage.create') }}"
                    class="block p-6 bg-white rounded-xl shadow-md text-center transition-all duration-300 hover:shadow-lg hover:bg-gray-50">
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 mx-auto">
                        <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-800 mt-3">Input Log Komputer</p>
                </a>
                {{-- Pengajuan Alat Baru --}}
                <a href="{{ route('staff.asset-requests.create') }}"
                    class="block p-6 bg-white rounded-xl shadow-md text-center transition-all duration-300 hover:shadow-lg hover:bg-gray-50">
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 mx-auto">
                        <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-800 mt-3">Pengajuan Alat Baru</p>
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

        @push('scripts')
        <script>
            let _pendingForm = null;
    const confirmBtn = document.getElementById('confirmSubmitBtn');

    function openConfirmModal(message, formEl, type = 'complete') {
        _pendingForm = formEl;
        document.getElementById('confirmMessage').textContent = message;

        confirmBtn.className = 'rounded-lg px-3 py-2 text-sm font-semibold text-white';
        confirmBtn.disabled = false;

        switch (type) {
            case 'complete':
                confirmBtn.classList.add('bg-blue-600', 'hover:bg-blue-700');
                confirmBtn.textContent = 'Ya, Selesaikan';
                break;
            case 'reject':
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
    </section>
</x-staff-layout>