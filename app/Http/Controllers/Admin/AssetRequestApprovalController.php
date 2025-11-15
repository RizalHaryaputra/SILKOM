<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\AssetRequestStatusUpdatedStaffMail;
use Illuminate\Http\Request;

class AssetRequestApprovalController extends Controller
{
    /**
     * Menampilkan dashboard persetujuan pengajuan alat.
     */
    public function index()
    {
        // Permintaan Masuk (Pending)
        $pendingRequests = AssetRequest::with('requester_user') 
            ->where('status', 'Pending')
            ->latest()
            ->get();

        // Riwayat (Selesai atau Ditolak)
        $historyRequests = AssetRequest::with('requester_user')
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

        $assetRequest->update([
            'status' => 'Approved',
        ]);

        Mail::to($assetRequest->requester_user)->send(new AssetRequestStatusUpdatedStaffMail($assetRequest));

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

        $assetRequest->update([
            'status' => 'Rejected',
        ]);

        Mail::to($assetRequest->requester_user)->send(new AssetRequestStatusUpdatedStaffMail($assetRequest));

        return redirect()->route('admin.asset-requests.index')
            ->with('success', "Pengajuan untuk {$assetRequest->asset_name} telah ditolak.");
    }

    public function show(AssetRequest $assetRequest)
    {
        return view('admin.asset-requests.show', compact('assetRequest'));
    }
}