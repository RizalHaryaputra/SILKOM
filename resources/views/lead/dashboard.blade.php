<x-lead-layout title="Dashboard Pimpinan (EIS)">
    {{-- 1. SERTAKAN SCRIPT CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <section class="max-w-7xl mx-auto p-4 sm:p-6">

        {{-- 1. Header Halaman & Salam --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Pimpinan (EIS)</h1>
            <p class="text-gray-500">Ringkasan strategis kondisi laboratorium, finansial, dan utilisasi.</p>
        </div>

        {{-- 2. Stats Row (KPI Finansial Utama) --}}
        <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2">

            {{-- KPI 1: Total Nilai Aset --}}
            <div class="rounded-xl bg-white p-6 shadow-md">
                <div class="flex items-center space-x-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />

                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Total Nilai Aset</div>
                        <div class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalAssetValue, 0, ',', '.')
                            }}</div>
                    </div>
                </div>
            </div>

            {{-- KPI 2: Total Biaya Perbaikan --}}
            <div class="rounded-xl bg-white p-6 shadow-md">
                <div class="flex items-center space-x-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Total Biaya Perbaikan</div>
                        <div class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalRepairCost, 0, ',', '.')
                            }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Grafik Garis (Tren Biaya vs Utilisasi) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 lg:col-span-2">
                <h2 class="font-semibold text-xl text-gray-800 mb-4">Tren Biaya vs. Utilisasi (6 Bulan Terakhir)</h2>
                <div class="h-80"> {{-- Beri tinggi agar canvas bisa render --}}
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 lg:col-span-1 mb-8">
                <h2 class="font-semibold text-xl text-gray-800 mb-4">Ringkasan Kesehatan Aset</h2>
                <div class="h-80 flex justify-center items-center">
                    <canvas id="donutChart"></canvas>
                </div>
            </div>
        </div>

        {{-- 4. Layout 3 Kolom untuk Grafik Donat & Batang --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Grafik 1: Kesehatan Aset --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="font-semibold text-xl text-gray-800 mb-4">Top 5 Aset Sering Dipinjam</h2>
                <div class="h-64">
                    <canvas id="barChartBorrowed"></canvas>
                </div>
            </div>

            {{-- Grafik 2: Aset Sering Rusak --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="font-semibold text-xl text-gray-800 mb-4">Top 5 Aset Sering Rusak</h2>
                <div class="h-64">
                    <canvas id="barChartDamaged"></canvas>
                </div>
            </div>
        </div>

    </section>

    {{-- =============================================== --}}
    {{-- SKRIP JAVASCRIPT UNTUK CHART.JS --}}
    {{-- =============================================== --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // 1. Data Grafik Garis (Line Chart)
            const lineCtx = document.getElementById('lineChart');
            if (lineCtx) {
                new Chart(lineCtx, {
                    type: 'line',
                    data: {
                        labels: @json($lineChartData['labels']),
                        datasets: [
                            {
                                label: 'Total Biaya Perbaikan (Rp)',
                                data: @json($lineChartData['costData']),
                                borderColor: 'rgb(239, 68, 68)', // red-500
                                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                                tension: 0.1,
                                yAxisID: 'yCost', // Tautkan ke sumbu Y kiri
                            },
                            {
                                label: 'Total Utilisasi (Sesi)',
                                data: @json($lineChartData['utilizationData']),
                                borderColor: 'rgb(59, 130, 246)', // blue-500
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                tension: 0.1,
                                yAxisID: 'yUtilization', // Tautkan ke sumbu Y kanan
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            yCost: { // Sumbu Y Kiri (Biaya)
                                type: 'linear',
                                position: 'left',
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value;
                                    }
                                }
                            },
                            yUtilization: { // Sumbu Y Kanan (Utilisasi)
                                type: 'linear',
                                position: 'right',
                                grid: {
                                    drawOnChartArea: false, // Hanya tampilkan grid untuk sumbu Y kiri
                                },
                                ticks: {
                                    callback: function(value) {
                                        return value + ' Sesi';
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // 2. Data Grafik Donat (Donut Chart)
            const donutCtx = document.getElementById('donutChart');
            if (donutCtx) {
                new Chart(donutCtx, {
                    type: 'doughnut',
                    data: {
                        labels: @json($donutChartData['labels']),
                        datasets: [{
                            label: 'Jumlah Aset',
                            data: @json($donutChartData['data']),
                            backgroundColor: [
                                'rgb(34, 197, 94)',  // Hijau (Available)
                                'rgb(234, 179, 8)',  // Kuning (Borrowed)
                                'rgb(239, 68, 68)',  // Merah (Damaged)
                                'rgb(156, 163, 175)' // Abu-abu (Lainnya)
                            ],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                });
            }

            // 3. Data Grafik Batang (Bar Chart)
            // 3. Data Grafik Batang (Aset Sering Rusak)
            const barCtxDamaged = document.getElementById('barChartDamaged'); // <-- ID Diperbarui
            if (barCtxDamaged) {
                new Chart(barCtxDamaged, {
                    type: 'bar',
                    data: {
                        labels: @json($barChartDamagedData['labels']), // <-- Variabel Diperbarui
                        datasets: [{
                            label: 'Jumlah Kerusakan',
                            data: @json($barChartDamagedData['data']), // <-- Variabel Diperbarui
                            backgroundColor: 'rgba(239, 68, 68, 0.6)', // Merah
                            borderColor: 'rgb(239, 68, 68)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'y', // <-- Buat jadi horizontal agar label muat
                        scales: {
                            x: { // 'x' karena indexAxis 'y'
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1 
                                }
                            }
                        }
                    }
                });
            }

            // 4. (BARU) Data Grafik Batang (Aset Sering Dipinjam)
            const barCtxBorrowed = document.getElementById('barChartBorrowed');
            if (barCtxBorrowed) {
                new Chart(barCtxBorrowed, {
                    type: 'bar',
                    data: {
                        labels: @json($barChartBorrowedData['labels']),
                        datasets: [{
                            label: 'Jumlah Peminjaman',
                            data: @json($barChartBorrowedData['data']),
                            backgroundColor: 'rgba(59, 130, 246, 0.6)', // Biru
                            borderColor: 'rgb(59, 130, 246)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'y', // <-- Buat jadi horizontal
                        scales: {
                            x: { // 'x' karena indexAxis 'y'
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1 
                                }
                            }
                        }
                    }
                });
            }

        });
    </script>
    @endpush
</x-lead-layout>