<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Http\Requests\ApproveBorrowingRequest;
use App\Notifications\BorrowingStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- 1. TAMBAHKAN DB FACADE

class BorrowingApprovalController extends Controller
{
    // ... method index() tidak berubah ...
    public function index()
    {
        // 1. Permintaan Masuk (Pending)
        $pendingBorrowings = Borrowing::with(['asset', 'user.studentProfile'])
            ->where('status', 'Pending')
            ->latest()->get();

        // 2. Aset yang Sedang Dipinjam (Approved)
        $activeBorrowings = Borrowing::with(['asset', 'user.studentProfile'])
            ->where('status', 'Approved')
            ->latest()->get();

        // 3. Riwayat (Selesai atau Ditolak)
        $historyBorrowings = Borrowing::with(['asset', 'user.studentProfile'])
            ->whereIn('status', ['Completed', 'Rejected'])
            ->latest()
            ->paginate(10);

        return view('admin.borrow.index', compact(
            'pendingBorrowings',
            'activeBorrowings',
            'historyBorrowings'
        ));
    }


    /**
     * Menyetujui permintaan peminjaman.
     */
    public function approve(ApproveBorrowingRequest $request, Borrowing $borrowing)
    {
        // 2. Validasi manual (yang kita hapus dari FormRequest)
        if ($borrowing->status !== 'Pending') {
            return redirect()->route('admin.borrow.requests.index')
                ->with('error', 'Aksi Gagal! Permintaan ini sudah diproses.');
        }

        if ($borrowing->asset->status !== 'Available') {
            return redirect()->route('admin.borrow.requests.index')
                ->with('error', 'Aksi Gagal! Aset ini sudah tidak tersedia (mungkin baru saja rusak atau disetujui untuk orang lain).');
        }

        // 3. Gunakan Transaksi Database
        try {
            DB::transaction(function () use ($borrowing) {
                // Langkah A: Setujui permintaan ini
                $borrowing->update([
                    'status' => 'Approved',
                    'approver_admin_id' => auth()->id()
                ]);

                // Langkah B: Update status aset
                $borrowing->asset()->update(['status' => 'Borrowed']);

                // Langkah C: Kirim notifikasi 'Approved' ke mahasiswa
                // $borrowing->user->notify(new BorrowingStatusUpdated($borrowing));

                // Langkah D (SOLUSI): Tolak otomatis semua permintaan pending LAINNYA untuk aset ini
                $otherPendingRequests = Borrowing::where('asset_id', $borrowing->asset_id)
                    ->where('status', 'Pending')
                    ->where('id', '!=', $borrowing->id)
                    ->get();

                foreach ($otherPendingRequests as $reqToReject) {
                    $reqToReject->update([
                        'status' => 'Rejected',
                        'approver_admin_id' => auth()->id()
                    ]);

                    // Kirim notifikasi 'Rejected' ke mahasiswa lain
                    // $reqToReject->user->notify(new BorrowingStatusUpdated($reqToReject));
                }
            });
        } catch (\Exception $e) {
            // Jika terjadi error saat transaksi
            return redirect()->route('admin.borrow.requests.index')
                ->with('error', 'Terjadi kesalahan server saat memproses permintaan. Silakan coba lagi.');
        }

        return redirect()->route('admin.borrow.requests.index')
            ->with('success', "Peminjaman disetujui. Permintaan lain untuk aset ini telah otomatis ditolak.");
    }

    /**
     * Menolak permintaan peminjaman.
     */
    public function reject(Request $request, Borrowing $borrowing)
    {
        // Validasi manual
        if ($borrowing->status !== 'Pending') {
            return redirect()->route('admin.borrow.requests.index')
                ->with('error', 'Aksi Gagal! Permintaan ini sudah diproses.');
        }

        $borrowing->update([
            'status' => 'Rejected',
            'approver_admin_id' => auth()->id()
        ]);

        // Kirim notifikasi ke mahasiswa
        // $borrowing->user->notify(new BorrowingStatusUpdated($borrowing));

        return redirect()->route('admin.borrow.requests.index')
            ->with('success', "Peminjaman untuk {$borrowing->asset->name} telah ditolak.");
    }

    // ... method complete() tidak berubah ...
    public function complete(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->status !== 'Approved') {
            return redirect()->route('admin.borrow.requests.index')
                ->with('error', 'Aksi tidak valid.');
        }

        $borrowing->update([
            'status' => 'Completed',
            'returned_at' => now()
        ]);

        $borrowing->asset()->update(['status' => 'Available']);

        return redirect()->route('admin.borrow.requests.index')
            ->with('success', "Aset {$borrowing->asset->name} telah ditandai sebagai dikembalikan.");
    }
}
