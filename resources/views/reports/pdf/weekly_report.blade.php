<!DOCTYPE html>
<html>
<head>
    <title>Laporan Mingguan Lab</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        h1 { text-align: center; font-size: 18px; margin-bottom: 20px; color: #2d3748; }
        h2 { font-size: 14px; border-bottom: 2px solid #e2e8f0; padding-bottom: 5px; margin-top: 20px; color: #4a5568; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #cbd5e0; padding: 8px; text-align: left; }
        th { background-color: #f7fafc; font-weight: bold; }
        .summary-box { background: #ebf8ff; padding: 10px; border: 1px solid #bee3f8; margin-bottom: 20px; border-radius: 4px; }
        .summary-item { display: inline-block; width: 30%; text-align: center; }
        .summary-value { font-size: 16px; font-weight: bold; display: block; }
        .summary-label { font-size: 10px; color: #718096; }
        .footer { text-align: center; margin-top: 30px; font-size: 10px; color: #a0aec0; }
    </style>
</head>
<body>

    <h1>LAPORAN MINGGUAN LABORATORIUM KOMPUTER</h1>
    <p style="text-align: center;">Periode: {{ $startDate }} - {{ $endDate }}</p>

    {{-- Ringkasan KPI --}}
    <div class="summary-box">
        <div class="summary-item">
            <span class="summary-value">{{ $totalBorrowings }}</span>
            <span class="summary-label">Peminjaman Baru</span>
        </div>
        <div class="summary-item">
            <span class="summary-value">{{ $totalDamages }}</span>
            <span class="summary-label">Laporan Kerusakan</span>
        </div>
        <div class="summary-item">
            <span class="summary-value">Rp {{ number_format($totalCost, 0, ',', '.') }}</span>
            <span class="summary-label">Biaya Perbaikan</span>
        </div>
    </div>

    {{-- Tabel 1: Aset Rusak Minggu Ini --}}
    <h2>Laporan Kerusakan Baru</h2>
    @if($damages->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Aset</th>
                    <th>Pelapor</th>
                    <th>Biaya (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($damages as $damage)
                <tr>
                    <td>{{ $damage->reported_at->format('d/m/Y') }}</td>
                    <td>{{ $damage->asset->name }}</td>
                    <td>{{ $damage->reporterAdmin->name ?? '-' }}</td>
                    <td>{{ number_format($damage->repair_cost, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p><i>Tidak ada kerusakan yang dilaporkan minggu ini.</i></p>
    @endif

    {{-- Tabel 2: Peminjaman Minggu Ini --}}
    <h2>Aktivitas Peminjaman</h2>
    @if($borrowings->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Peminjam</th>
                    <th>Aset</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowings as $borrowing)
                <tr>
                    <td>{{ $borrowing->borrowed_at->format('d/m/Y') }}</td>
                    <td>{{ $borrowing->user->name }}</td>
                    <td>{{ $borrowing->asset->name }}</td>
                    <td>{{ $borrowing->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p><i>Tidak ada aktivitas peminjaman minggu ini.</i></p>
    @endif

    <div class="footer">
        Laporan ini digenerate otomatis oleh sistem SILKOM pada {{ now()->format('d M Y H:i') }}
    </div>
</body>
</html>