<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // 1. KPI: Permintaan Pending
        $pendingCount = Borrowing::where('user_id', $userId)
            ->where('status', 'Pending')->count();

        // 2. KPI: Aset Sedang Dipinjam
        $activeCount = Borrowing::where('user_id', $userId)
            ->where('status', 'Approved')->count();

        // 3. Tabel: 5 Peminjaman Terkini (Pending/Approved)
        $recentBorrowings = Borrowing::with('asset')
            ->where('user_id', $userId)
            ->whereIn('status', ['Pending', 'Approved'])
            ->latest()
            ->take(5)
            ->get();

        return view('student.dashboard', compact(
            'pendingCount',
            'activeCount',
            'recentBorrowings'
        ));
    }
}
