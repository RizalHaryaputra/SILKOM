<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\ComputerUsage;
use App\Models\Damage;

class StaffDashboardController extends Controller
{
    public function index()
    {
        // 1. KPI: Kesehatan Lab Komputer
        $availableAssets = Asset::where('status', 'Available')->count();
        $borrowedAssets = Asset::where('status', 'Borrowed')->count();
        $damagedAssets = Asset::where('status', 'Damaged')->count();

        // 2. PERBARUI: Ambil 5 log penggunaan komputer terbaru
        $recentUsages = ComputerUsage::with(['user.studentProfile', 'asset'])
            ->latest()
            ->take(5)
            ->get();

        return view('staff.dashboard', compact(
            'availableAssets',
            'borrowedAssets',
            'damagedAssets',
            'recentUsages'
        ));
    }
}
