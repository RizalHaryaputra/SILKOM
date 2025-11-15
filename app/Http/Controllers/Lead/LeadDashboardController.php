<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Damage;
use Illuminate\Support\Facades\DB;

class LeadDashboardController extends Controller
{
    public function index()
    {
        // 1. KPI Finansial
        $totalAssetValue = Asset::sum('purchase_price');
        $totalRepairCost = Damage::sum('repair_cost');

        // 2. Data untuk Grafik Donat (Kesehatan Aset)
        $assetStatusCounts = Asset::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status'); // Hasil: ['Available' => 50, 'Damaged' => 5]

        // 3. Data untuk Grafik Batang (Top 5 Aset Rusak)
        $topDamagedAssets = Asset::withCount('damages')
            ->orderBy('damages_count', 'desc')
            ->take(5)
            ->get();

        return view('pimpinan.dashboard', compact(
            'totalAssetValue',
            'totalRepairCost',
            'assetStatusCounts',
            'topDamagedAssets'
        ));
    }
}
