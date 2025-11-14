<x-admin-layout title="Halaman Laporan (MIS)">

    <section class="max-w-7xl mx-auto p-4 sm:p-6">
        {{-- 1. Header Halaman --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Laporan (MIS)</h1>
            <p class="text-gray-500">Analisis data transaksional untuk pengambilan keputusan manajerial.</p>
        </div>

        {{-- 2. Form Filter Laporan --}}
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <form method="GET" action="{{ route(request()->route()->getName()) }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    {{-- Filter Jenis Laporan --}}
                    <div>
                        <label for="report_type" class="block text-sm font-medium text-gray-700">Jenis Laporan</label>
                        <select id="report_type" name="report_type"
                            class="mt-1 block w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900">
                            <option value="asset_summary" @if($reportType=='asset_summary' ) selected @endif>
                                Ringkasan Aset (Rusak/Pinjam)
                            </option>
                            <option value="cost_analysis" @if($reportType=='cost_analysis' ) selected @endif>
                                Analisis Biaya Perbaikan
                            </option>
                            <option value="user_activity" @if($reportType=='user_activity' ) selected @endif>
                                Laporan Pengguna Aktif
                            </option>
                            <option value="usage_log" @if($reportType=='usage_log' ) selected @endif>
                                Laporan Utilisasi Lab (Harian)
                            </option>
                        </select>
                    </div>

                    {{-- Filter Tanggal Mulai --}}
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" value="{{ $startDate->format('Y-m-d') }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900">
                    </div>

                    {{-- Filter Tanggal Selesai --}}
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" value="{{ $endDate->format('Y-m-d') }}"
                            class="mt-1 block w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 text-gray-900">
                    </div>

                    {{-- Tombol Tampilkan --}}
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            Tampilkan Laporan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- 3. Kontainer Hasil Laporan --}}
        <div class="bg-white rounded-xl shadow-md p-6">

            {{-- Header Hasil Laporan --}}
            <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800">{{ $title }}</h2>
                    <p class="text-sm text-gray-500">
                        Menampilkan data dari {{ $startDate->isoFormat('DD MMM YYYY') }} sampai {{
                        $endDate->isoFormat('DD MMM YYYY') }}.
                    </p>
                </div>
                {{-- Tombol Cetak (JS Sederhana) --}}
                <button onclick="window.print()"
                    class="mt-3 md:mt-0 flex items-center gap-2 bg-gray-200 text-gray-800 px-4 py-3 rounded-lg hover:bg-gray-300 text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                    </svg>
                    Cetak Laporan
                </button>
            </div>

            {{-- ====================================================== --}}
            {{-- BAGIAN TABEL DINAMIS --}}
            {{-- ====================================================== --}}

            <div class="overflow-x-auto rounded-lg border border-gray-100">

                {{-- LAPORAN 1: RINGKASAN ASET --}}
                @if($reportType == 'asset_summary')
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Aset</th>
                            <th class="px-4 py-3 text-left">Kategori</th>
                            <th class="px-4 py-3 text-center">Total Dipinjam</th>
                            <th class="px-4 py-3 text-center">Total Rusak</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($data as $asset)
                        <tr class="hover:bg-blue-50/50">
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $asset->name }}</td>
                            <td class="px-4 py-3">{{ $asset->category }}</td>
                            <td class="px-4 py-3 text-center">{{ $asset->borrowings_count }} kali</td>
                            <td class="px-4 py-3 text-center">{{ $asset->damages_count }} kali</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-gray-500">Tidak ada data untuk rentang
                                tanggal ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- LAPORAN 2: ANALISIS BIAYA --}}
                @elseif($reportType == 'cost_analysis')
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Aset</th>
                            <th class="px-4 py-3 text-left">Kategori</th>
                            <th class="px-4 py-3 text-right">Total Biaya Perbaikan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($data as $asset)
                        <tr class="hover:bg-blue-50/50">
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $asset->name }}</td>
                            <td class="px-4 py-3">{{ $asset->category }}</td>
                            <td class="px-4 py-3 text-right">Rp {{ number_format($asset->damages_sum_repair_cost ?? 0,
                                0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-4 py-10 text-center text-gray-500">Tidak ada data untuk rentang
                                tanggal ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- LAPORAN 3: PENGGUNA AKTIF --}}
                @elseif($reportType == 'user_activity')
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Nama Pengguna</th>
                            <th class="px-4 py-3 text-left">NIM / Role</th>
                            <th class="px-4 py-3 text-center">Total Peminjaman Aset</th>
                            <th class="px-4 py-3 text-center">Total Sesi Komputer</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($data as $user)
                        <tr class="hover:bg-blue-50/50">
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->studentProfile?->student_id_number ??
                                $user->getRoleNames()->first() }}</td>
                            <td class="px-4 py-3 text-center">{{ $user->borrowings_count }} kali</td>
                            <td class="px-4 py-3 text-center">{{ $user->computer_usages_count }} kali</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-gray-500">Tidak ada data untuk rentang
                                tanggal ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- LAPORAN 4: UTILISASI LAB --}}
                @elseif($reportType == 'usage_log')
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-center">Total Sesi Penggunaan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($data as $log)
                        <tr class="hover:bg-blue-50/50">
                            <td class="px-4 py-3 font-medium text-gray-900">{{
                                \Carbon\Carbon::parse($log->date)->isoFormat('dddd, DD MMM YYYY') }}</td>
                            <td class="px-4 py-3 text-center">{{ $log->total_sessions }} sesi</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-4 py-10 text-center text-gray-500">Tidak ada data untuk rentang
                                tanggal ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @endif
            </div>

        </div>
    </section>

</x-admin-layout>