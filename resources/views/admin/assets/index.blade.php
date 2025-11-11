<x-admin-layout title="Kelola Aset">

    <section class="max-w-7xl mx-auto p-4 sm:p-6">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 rounded-xl bg-green-50 px-4 py-3 text-green-700 border border-green-200 font-medium">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-red-700 border border-red-200">
                <ul class="list-disc pl-5 text-sm">
                    @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul>
            </div>
        @endif

        {{-- 1. Header Halaman --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Aset</h1>
            <p class="text-gray-500">Daftar dan kelola aset dan inventaris laboratorium.</p>
        </div>
        
        {{-- Tambahkan Stats Row di sini jika Anda mau (lihat catatan di bawah) --}}

        {{-- 3. Toolbar & Table Container --}}
        <div class="bg-white rounded-xl shadow-md p-6">

            {{-- Toolbar: search + add --}}
            <div class="mb-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">

                <h2 class="font-semibold text-xl text-gray-800">Daftar Aset Laboratorium</h2>
                
                <div class="flex items-center gap-2">
                    {{-- Search Form --}}
                    <form method="GET" action="{{ route('admin.assets.index') }}"
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
                    <a href="{{ route('admin.assets.create') }}">
                        <div
                            class="flex items-center gap-2 bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p>Tambah</p>
                        </div>
                    </a>
                </div>
                
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Nama Aset</th>
                            <th class="px-4 py-3 text-left">Kategori</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-center">Jumlah</th>
                            <th class="px-4 py-3 text-left">Harga Beli</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($assets as $asset)
                        <tr class="hover:bg-blue-50/50 transition duration-100">
                            
                            {{-- Kolom Nama Aset & Gambar --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    {{-- Thumbnail --}}
                                    <div
                                        class="h-10 w-10 overflow-hidden rounded-lg bg-gray-100 ring-1 ring-gray-200 flex-shrink-0">
                                        @if($asset->asset_image_path)
                                        <img src="{{ asset('storage/'.$asset->asset_image_path) }}" alt="Foto Aset"
                                            class="h-full w-full object-cover">
                                        @else
                                        {{-- Ikon fallback jika tidak ada gambar --}}
                                        <div class="flex h-full w-full items-center justify-center text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10.5 11.25h3M12 15h.008m-7.008 4.5h12.016a1.125 1.125 0 0 0 1.125-1.125V9.75M18.75 9.75h.375c.621 0 1.125.504 1.125 1.125v.375m-1.5-1.5V5.625c0-.621-.504-1.125-1.125-1.125H6.75c-.621 0-1.125.504-1.125 1.125v3.375c0 .621.504 1.125 1.125 1.125h.375m1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v.375m-1.5-1.5V5.625" />
                                            </svg>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="truncate max-w-[30ch] font-medium text-gray-900"
                                            title="{{ $asset->name }}">{{ $asset->name }}</div>
                                    </div>
                                </div>
                            </td>

                            {{-- Kolom Kategori --}}
                            <td class="px-4 py-3">
                                <span class="rounded-full bg-gray-100 px-2 py-1 text-xs font-medium text-gray-700">{{ $asset->category }}</span>
                            </td>

                            {{-- Kolom Status (dengan badge) --}}
                            <td class="px-4 py-3">
                                @if($asset->status == 'Available')
                                    <span class="rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">Tersedia</span>
                                @elseif($asset->status == 'Borrowed')
                                    <span class="rounded-full bg-yellow-100 px-2 py-1 text-xs font-semibold text-yellow-700">Dipinjam</span>
                                @elseif($asset->status == 'Damaged')
                                    <span class="rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-700">Rusak</span>
                                @else
                                    <span class="rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-700">{{ $asset->status }}</span>
                                @endif
                            </td>

                            {{-- Kolom Jumlah --}}
                            <td class="px-4 py-3 text-center">{{ $asset->total_quantity }}</td>
                            
                            {{-- Kolom Harga Beli --}}
                            <td class="px-4 py-3">
                                @if($asset->purchase_price)
                                    Rp {{ number_format($asset->purchase_price, 0, ',', '.') }}
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>

                            {{-- Kolom Aksi --}}
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.assets.edit', $asset) }}"
                                        class="rounded-lg px-2.5 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 transition duration-150">Edit</a>
                                    
                                    {{-- Form Hapus (dengan modal konfirmasi) --}}
                                    <form action="{{ route('admin.assets.destroy', $asset) }}" method="POST"
                                        onsubmit="return openConfirmModal('Hapus aset \'{{ $asset->name }}\'?', this);">
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
                            <td colspan="6" class="px-4 py-10 text-center text-gray-500">Belum ada aset.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Links --}}
            @if($assets->hasPages())
            <div class="border-t px-4 py-3 mt-0">
                {{ $assets->appends(request()->query())->links() }}
            </div>
            @endif
        </div>

    {{-- ===== Modal Konfirmasi Hapus ===== --}}
    {{-- (Struktur modal sama persis seperti contoh Anda) --}}
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
    // ===== Skrip Modal Konfirmasi Hapus =====
    // (Skrip sama persis seperti contoh Anda, hanya mengganti teks tombol)
    let _pendingForm = null;

    function openConfirmModal(message, formEl) {
        _pendingForm = formEl;
        document.getElementById('confirmMessage').textContent = message;
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
            const btn = document.getElementById('confirmSubmitBtn');
            btn.textContent = 'Menghapus...'; 
            btn.disabled = true;
            _pendingForm.submit();
            // Tidak perlu closeConfirmModal() di sini karena halaman akan reload
        }
    });
    </script>
    @endpush
</x-admin-layout>