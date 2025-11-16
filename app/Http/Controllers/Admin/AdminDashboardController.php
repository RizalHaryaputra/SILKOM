<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\AssetRequest;
use App\Models\Asset;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // KPI: Tugas Mendesak
        $pendingBorrowingsCount = Borrowing::where('status', 'Pending')->count();
        $pendingAssetRequestsCount = AssetRequest::where('status', 'Pending')->count(); // <-- Anda sudah punya ini
        $damagedAssetsCount = Asset::where('status', 'Damaged')->count();

        // Tabel: 5 Peminjaman Pending Teratas
        $topPendingBorrowings = Borrowing::with(['user', 'asset'])
            ->where('status', 'Pending')
            ->latest()
            ->take(5)
            ->get();

        // Tabel: 5 Pengajuan Alat Pending Teratas
        $topPendingAssetRequests = AssetRequest::with('requester_user')
            ->where('status', 'Pending')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'pendingBorrowingsCount',
            'pendingAssetRequestsCount',
            'damagedAssetsCount',
            'topPendingBorrowings',
            'topPendingAssetRequests'
        ));
    }
}
