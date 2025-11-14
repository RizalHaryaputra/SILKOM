<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Borrowing;
use App\Models\Damage;
use App\Models\ComputerUsage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan (MIS) utama.
     */
    public function index(Request $request)
    {
        // --- 1. Ambil Filter dari Request ---
        
        // Tetapkan jenis laporan default jika tidak ada
        $reportType = $request->input('report_type', 'asset_summary');
        
        // Tetapkan rentang tanggal default (1 bulan terakhir)
        $startDate = $request->input('start_date') 
            ? Carbon::parse($request->input('start_date')) 
            : Carbon::now()->subMonth();
            
        $endDate = $request->input('end_date') 
            ? Carbon::parse($request->input('end_date')) 
            : Carbon::now();

        // Variabel untuk menampung data dan judul
        $data = null;
        $title = "";

        // --- 2. Jalankan Kueri berdasarkan Jenis Laporan ---
        
        switch ($reportType) {
            case 'asset_summary':
                $title = "Laporan Ringkasan Aset (Sering Rusak/Pinjam)";
                $data = $this->getAssetSummaryReport($startDate, $endDate);
                break;
            
            case 'cost_analysis':
                $title = "Laporan Analisis Biaya Perbaikan";
                $data = $this->getCostAnalysisReport($startDate, $endDate);
                break;

            case 'user_activity':
                $title = "Laporan Pengguna Aktif";
                $data = $this->getUserActivityReport($startDate, $endDate);
                break;

            case 'usage_log':
                $title = "Laporan Utilisasi Lab (Harian)";
                $data = $this->getUsageLogReport($startDate, $endDate);
                break;
        }

        // --- 3. Kirim Data ke View ---
        return view('admin.reports.index', compact(
            'data',         // Data hasil kueri
            'title',        // Judul laporan
            'reportType',   // Untuk menandai filter yg aktif
            'startDate',    // Untuk mengisi value filter
            'endDate'       // Untuk mengisi value filter
        ));
    }

    /**
     * [cite_start]LAPORAN 1: Sering Rusak / Sering Dipinjam [cite: 27]
     */
    private function getAssetSummaryReport($start, $end)
    {
        return Asset::withCount([
            'borrowings' => fn($q) => $q->whereBetween('borrowed_at', [$start, $end]),
            'damages' => fn($q) => $q->whereBetween('reported_at', [$start, $end])
        ])
        ->orderBy('damages_count', 'desc')
        ->orderBy('borrowings_count', 'desc')
        ->get();
    }

    /**
     * LAPORAN 2: Rekap Pengguna Aktif
     */
    private function getUserActivityReport($start, $end)
    {
        return User::whereHas('roles', fn($q) => $q->whereIn('name', ['Student', 'Staff']))
            ->with(['studentProfile']) // Muat profil mahasiswa
            ->withCount([
                'borrowings' => fn($q) => $q->whereBetween('borrowed_at', [$start, $end]),
                'computerUsages' => fn($q) => $q->whereBetween('started_at', [$start, $end])
            ])
            ->having('borrowings_count', '>', 0)
            ->orHaving('computer_usages_count', '>', 0)
            ->orderBy('borrowings_count', 'desc')
            ->orderBy('computer_usages_count', 'desc')
            ->get();
    }

    /**
     * LAPORAN 3: Laporan Utilisasi Lab Harian
     */
    private function getUsageLogReport($start, $end)
    {
        return ComputerUsage::whereBetween('started_at', [$start, $end])
            ->select(
                DB::raw('DATE(started_at) as date'),
                DB::raw('COUNT(id) as total_sessions')
                // (Nanti bisa ditambahkan SUM(durasi) jika Anda menghitungnya)
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }

    /**
     * LAPORAN 4: Analisis Biaya Perbaikan (Tambahan dari saya)
     */
    private function getCostAnalysisReport($start, $end)
    {
        return Asset::withSum([
            // Hitung total 'repair_cost' dalam rentang tanggal
            'damages' => fn($q) => $q->whereBetween('reported_at', [$start, $end])
        ], 'repair_cost')
        ->orderBy('damages_sum_repair_cost', 'desc')
        ->get();
    }
}