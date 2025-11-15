<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetRequest;
use App\Notifications\AssetRequestStatusUpdated;
use Illuminate\Http\Request;

class AssetRequestApprovalController extends Controller
{
    /**
     * Menampilkan dashboard persetujuan pengajuan alat.
     */
    public function index()
    {
        // Permintaan Masuk (Pending)
        $pendingRequests = AssetRequest::with('requester') 
            ->where('status', 'Pending')
            ->latest()
            ->get();

        // Riwayat (Selesai atau Ditolak)
        $historyRequests = AssetRequest::with('requester')
            ->whereIn('status', ['Approved', 'Rejected'])
            ->latest()
            ->paginate(10);

        return view('admin.asset-requests.index', compact(
            'pendingRequests',
            'historyRequests'
        ));
    }

    /**
     * Menyetujui permintaan pengajuan alat.
     */
    public function approve(Request $request, AssetRequest $assetRequest)
    {
        // Hanya bisa menyetujui jika status masih 'Pending'
        if ($assetRequest->status !== 'Pending') {
            return redirect()->route('admin.asset-requests.index')
                ->with('error', 'Aksi tidak valid. Permintaan ini sudah diproses.');
        }

        // 1. Update status
        $assetRequest->update([
            'status' => 'Approved',
        ]);

        // 2. Kirim notifikasi ke pembuat request (Staff)
        // Pastikan Anda mengaktifkan ini jika sudah siap
        // $assetRequest->requester_user->notify(new AssetRequestStatusUpdated($assetRequest));

        return redirect()->route('admin.asset-requests.index')
            ->with('success', "Pengajuan untuk {$assetRequest->asset_name} telah disetujui.");
    }

    /**
     * Menolak permintaan pengajuan alat.
     */
    public function reject(Request $request, AssetRequest $assetRequest)
    {
        // Hanya bisa menolak jika status masih 'Pending'
        if ($assetRequest->status !== 'Pending') {
            return redirect()->route('admin.asset-requests.index')
                ->with('error', 'Aksi tidak valid. Permintaan ini sudah diproses.');
        }

        // 1. Update status
        $assetRequest->update([
            'status' => 'Rejected',
        ]);

        // 2. Kirim notifikasi ke pembuat request (Staff)
        // $assetRequest->requester_user->notify(new AssetRequestStatusUpdated($assetRequest));

        return redirect()->route('admin.asset-requests.index')
            ->with('success', "Pengajuan untuk {$assetRequest->asset_name} telah ditolak.");
    }

    public function show(AssetRequest $assetRequest)
    {
        return view('admin.asset-requests.show', compact('assetRequest'));
    }
}