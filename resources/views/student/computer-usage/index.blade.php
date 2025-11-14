<x-student-layout title="Riwayat Penggunaan Komputer">

    <section class="max-w-7xl mx-auto p-4 sm:p-6">
        
        {{-- 1. Header Halaman --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Penggunaan Komputer</h1>
            <p class="text-gray-500">Riwayat penggunaan komputer Anda yang tercatat di laboratorium.</p>
        </div>
        
        {{-- 3. Table Container --}}
        <div class="bg-white rounded-xl shadow-md p-6">

            {{-- Toolbar --}}
            <div class="mb-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <h2 class="font-semibold text-xl text-gray-800">Riwayat Log</h2>
                
                <div class="flex items-center gap-2">
                    {{-- Search Form --}}
                    <form method="GET" action="{{ route('student.computer-usage.index') }}"
                        class="flex items-center w-full md:w-80">
                        <div class="relative w-full">
                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="Cari komputer..."
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
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            {{-- Kolom Mahasiswa tidak perlu, karena ini sudah pasti data miliknya --}}
                            <th class="px-4 py-3 text-left">Komputer</th>
                            <th class="px-4 py-3 text-left">Waktu Mulai</th>
                            <th class="px-4 py-3 text-left">Waktu Selesai</th>
                            <th class="px-4 py-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($myUsages as $usage)
                        <tr class="hover:bg-blue-50/50 transition duration-100">
                            
                            {{-- Kolom Komputer --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $usage->asset->name ?? 'Aset Dihapus' }}</div>
                                <div class="text-xs text-gray-500">{{ $usage->asset->category ?? '-' }}</div>
                            </td>

                            {{-- Kolom Waktu Mulai --}}
                            <td class="px-4 py-3">{{ $usage->started_at->isoFormat('DD MMM YYYY, HH:mm') }}</td>
                            
                            {{-- Kolom Waktu Selesai --}}
                            <td class="px-4 py-3">
                                @if($usage->finished_at)
                                    {{ $usage->finished_at->isoFormat('DD MMM YYYY, HH:mm') }}
                                @else
                                    <span class="text-gray-500 italic">-</span>
                                @endif
                            </td>

                            {{-- Kolom Status Sesi --}}
                            <td class="px-4 py-3 text-center">
                                @if(!$usage->finished_at)
                                    <span class="rounded-full bg-yellow-100 px-2 py-1 text-xs font-semibold text-yellow-700">Sedang Digunakan</span>
                                @else
                                    <span class="rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-700">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-gray-500">Anda belum memiliki riwayat penggunaan komputer.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Links --}}
            @if($myUsages->hasPages())
            <div class="border-t px-4 py-3 mt-0">
                {{ $myUsages->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </section>
</x-student-layout>