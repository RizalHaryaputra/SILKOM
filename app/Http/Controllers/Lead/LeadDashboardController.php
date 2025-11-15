<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Damage;
use App\Models\Borrowing;
use App\Models\ComputerUsage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeadDashboardController extends Controller
{
    public function index()
    {
        // 1. KPI FINANSIAL UTAMA
        $totalAssetValue = Asset::sum('purchase_price');
        $totalRepairCost = Damage::sum('repair_cost');

        // 2. DATA GRAFIK DONAT (KESEHATAN ASET)
        $assetStatusCounts = Asset::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $donutChartData = [
            'labels' => $assetStatusCounts->keys(),
            'data' => $assetStatusCounts->values(),
        ];

        // 3. DATA GRAFIK BATANG (TOP 5 ASET SERING RUSAK)
        $topDamagedAssets = Asset::withCount('damages')
            ->whereHas('damages') // <-- PERBAIKAN: Gunakan whereHas
            ->orderBy('damages_count', 'desc')
            ->take(5)
            ->get();

        $barChartDamagedData = [
            'labels' => $topDamagedAssets->pluck('name'),
            'data' => $topDamagedAssets->pluck('damages_count'),
        ];

        // 4. DATA GRAFIK BATANG (TOP 5 ASET SERING DIPINJAM)
        $topBorrowedAssets = Asset::withCount('borrowings')
            ->whereHas('borrowings')
            ->orderBy('borrowings_count', 'desc')
            ->take(5)
            ->get();

        $barChartBorrowedData = [
            'labels' => $topBorrowedAssets->pluck('name'),
            'data' => $topBorrowedAssets->pluck('borrowings_count'),
        ];

        // 5. DATA GRAFIK GARIS (TREN BIAYA vs UTILISASI - 6 BULAN TERAKHIR)
        $lineChartLabels = [];
        $costData = [];
        $utilizationData = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthName = $month->isoFormat('MMM YYYY');
            $lineChartLabels[] = $monthName;

            // Query Biaya Perbaikan per bulan
            $costData[] = Damage::whereMonth('reported_at', $month->month)
                ->whereYear('reported_at', $month->year)
                ->sum('repair_cost');

            // Query Utilisasi per bulan (Total peminjaman + total log komputer)
            $borrowUsage = Borrowing::whereMonth('borrowed_at', $month->month)
                ->whereYear('borrowed_at', $month->year)
                ->count();
            $computerUsage = ComputerUsage::whereMonth('started_at', $month->month)
                ->whereYear('started_at', $month->year)
                ->count();
            $utilizationData[] = $borrowUsage + $computerUsage;
        }

        $lineChartData = [
            'labels' => $lineChartLabels,
            'costData' => $costData,
            'utilizationData' => $utilizationData,
        ];

        // Kirim semua data ke view
        return view('lead.dashboard', compact(
            'totalAssetValue',
            'totalRepairCost',
            'donutChartData',
            'barChartDamagedData', 
            'barChartBorrowedData',
            'lineChartData'
        ));
    }
}
