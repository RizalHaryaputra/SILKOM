<x-staff-layout title="Riwayat Pengajuan Alat">

    <section class="max-w-7xl mx-auto p-4 sm:p-6">
        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-50 px-4 py-3 text-green-700 border border-green-200 font-medium">{{
            session('success') }}</div>
        @endif

        {{-- 1. Header Halaman --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Pengajuan Alat Saya</h1>
            <p class="text-gray-500">Riwayat dan status pengajuan alat baru Anda.</p>
        </div>

        {{-- 3. Toolbar & Table Container --}}
        <div class="bg-white rounded-xl shadow-md p-6">

            {{-- Toolbar: search + add --}}
            <div class="mb-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">

                <h2 class="font-semibold text-xl text-gray-800">Riwayat Pengajuan</h2>

                <div class="flex items-center gap-2">
                    {{-- Search Form --}}
                    <form method="GET" action="{{ route('staff.asset-requests.index') }}"
                        class="flex items-center w-full md:w-80">
                        <div class="relative w-full">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama aset..."
                                class="w-full rounded-l-xl border border-gray-200 py-2.5 pl-10 pr-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30"
                                aria-label="Cari kerusakan" />
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
                    <a href="{{ route('staff.asset-requests.create') }}">
                        <div
                            class="flex items-center gap-2 bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p>Buat Pengajuan</p>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Nama Alat Diajukan</th>
                            <th class="px-4 py-3 text-left">Alasan</th>
                            <th class="px-4 py-3 text-left">Tgl. Pengajuan</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($myRequests as $request)
                        <tr class="hover:bg-blue-50/50 transition duration-100">

                            {{-- Kolom Nama Alat --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $request->asset_name }}</div>
                                {{-- <div class="text-xs text-gray-500 truncate max-w-[25ch]"
                                    title="{{ $request->specifications }}">{{ $request->specifications ?? 'Tanpa
                                    spesifikasi' }}</div> --}}
                            </td>

                            {{-- Kolom Alasan --}}
                            <td class="px-4 py-3">
                                <p class="truncate max-w-[40ch] text-gray-500" title="{{ $request->reason }}">{{
                                    $request->reason }}</p>
                            </td>

                            {{-- Kolom Tgl. Pengajuan --}}
                            <td class="px-4 py-3">{{ $request->created_at->isoFormat('DD MMM YYYY') }}</td>

                            {{-- Kolom Status (dengan badge) --}}
                            <td class="px-4 py-3 text-center">
                                @if($request->status == 'Pending')
                                <span
                                    class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">Menunggu</span>
                                @elseif($request->status == 'Approved')
                                <span
                                    class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">Disetujui</span>
                                @elseif($request->status == 'Rejected')
                                <span
                                    class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">Ditolak</span>
                                @else
                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">{{
                                    $request->status }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('staff.asset-requests.show', $request->id) }}"
                                        class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-yellow-500 hover:bg-yellow-600 transition duration-150">Detail</a>
                                    {{-- Tampilkan tombol hanya jika status 'Pending' --}}
                                    @if($request->status == 'Pending')
                                    <a href="{{ route('staff.asset-requests.edit', $request->id) }}"
                                        class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 transition duration-150">Edit</a>

                                    <form action="{{ route('staff.asset-requests.destroy', $request->id) }}"
                                        method="POST"
                                        onsubmit="return openConfirmModal('Hapus pengajuan \'{{ $request->asset_name }}\'?', this, 'reject');">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 transition duration-150">
                                            Batal
                                        </button>
                                    </form>
                                    @else

                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-gray-500">Anda belum memiliki riwayat
                                pengajuan alat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            @if($myRequests->hasPages())
            <div class="border-t px-4 py-3 mt-0">
                {{ $myRequests->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </section>

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