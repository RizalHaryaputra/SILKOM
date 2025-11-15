<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Http\Requests\ApproveBorrowingRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\BorrowingStatusUpdatedStudentMail;
use Illuminate\Http\Request;

class BorrowingApprovalController extends Controller
{
    public function index()
    {
        // Permintaan Masuk (Pending)
        $pendingBorrowings = Borrowing::with(['asset', 'user.studentProfile'])
            ->where('status', 'Pending')
            ->latest()->get();

        // Aset yang Sedang Dipinjam (Approved)
        $activeBorrowings = Borrowing::with(['asset', 'user.studentProfile'])
            ->where('status', 'Approved')
            ->latest()->get();

        // Riwayat (Selesai atau Ditolak)
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
        if ($borrowing->status !== 'Pending') {
            return redirect()->route('admin.borrow.requests.index')
                ->with('error', 'Aksi Gagal! Permintaan ini sudah diproses.');
        }

        if ($borrowing->asset->status !== 'Available') {
            return redirect()->route('admin.borrow.requests.index')
                ->with('error', 'Aksi Gagal! Aset ini sudah tidak tersedia (mungkin baru saja rusak atau disetujui untuk orang lain).');
        }

        try {
            DB::transaction(function () use ($borrowing) {
                // Setujui permintaan ini
                $borrowing->update([
                    'status' => 'Approved',
                    'approver_admin_id' => auth()->id()
                ]);

                // Update status aset
                $borrowing->asset()->update(['status' => 'Borrowed']);

                // Kirim notifikasi 'Approved' ke mahasiswa
                Mail::to($borrowing->user)->send(new BorrowingStatusUpdatedStudentMail($borrowing));

                // Tolak otomatis semua permintaan pending LAINNYA untuk aset ini
                $otherPendingRequests = Borrowing::where('asset_id', $borrowing->asset_id)
                    ->where('status', 'Pending')
                    ->where('id', '!=', $borrowing->id)
                    ->get();

                foreach ($otherPendingRequests as $reqToReject) {
                    $reqToReject->update([
                        'status' => 'Rejected',
                        'approver_admin_id' => auth()->id()
                    ]);
                    Mail::to($reqToReject->user)->send(new BorrowingStatusUpdatedStudentMail($reqToReject));
                }
            });
        } catch (\Exception $e) {
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
        Mail::to($borrowing->user)->send(new BorrowingStatusUpdatedStudentMail($borrowing));

        return redirect()->route('admin.borrow.requests.index')
            ->with('success', "Peminjaman untuk {$borrowing->asset->name} telah ditolak.");
    }

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

    public function show(Borrowing $borrowing)
    {
        return view('admin.borrow.show', compact('borrowing'));
    }
}
