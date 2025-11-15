<?php

namespace App\Http\Controllers\Staff;

use App\Models\AssetRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetRequestRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAssetRequestAdminMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AssetRequestController extends Controller
{
    /**
     * Menampilkan riwayat pengajuan alat oleh user yang login.
     */
    public function index()
    {
        $myRequests = AssetRequest::where('requester_user_id', auth()->id())
            ->latest()
            ->paginate(10);
        $view = auth()->user()->hasRole('Staff') ? 'staff.asset-requests.index' : 'student.asset-requests.index';
        return view($view, compact('myRequests'));
    }

    /**
     * Menampilkan form untuk membuat pengajuan alat baru.
     */
    public function create()
    {
        $view = auth()->user()->hasRole('Staff') ? 'staff.asset-requests.create' : 'student.asset-requests.create';
        return view($view);
    }

    /**
     * Menyimpan pengajuan alat baru.
     */
    public function store(StoreAssetRequestRequest $request)
    {
        $data = $request->validated();
        $data['requester_user_id'] = auth()->id();
        $data['status'] = 'Pending';

        $assetRequest = AssetRequest::create($data); 

        $admins = User::role('Admin')->get();
        if ($admins->isNotEmpty()) {
            Mail::to($admins)->send(new NewAssetRequestAdminMail($assetRequest));
        }

        $route = auth()->user()->hasRole('Staff') ? 'staff.asset-requests.index' : 'student.asset-requests.index';
        return redirect()->route($route)
            ->with('success', 'Pengajuan alat baru berhasil dikirim.');
    }


    /**
     * Menampilkan form untuk mengedit pengajuan.
     */
    public function edit(AssetRequest $assetRequest)
    {
        if (auth()->id() !== $assetRequest->requester_user_id) {
            abort(403, 'Anda tidak berhak mengakses halaman ini.');
        }
        if ($assetRequest->status !== 'Pending') {
            return redirect()->back()->with('error', 'Pengajuan yang sudah diproses tidak dapat diedit.');
        }

        $view = auth()->user()->hasRole('Staff') ? 'staff.asset-requests.edit' : 'student.asset-requests.edit';
        return view($view, ['assetRequest' => $assetRequest]);
    }

    /**
     * Memperbarui pengajuan di database.
     * Kita akan menggunakan validasi dari StoreAssetRequestRequest lagi.
     */
    public function update(StoreAssetRequestRequest $request, AssetRequest $assetRequest)
    {
        // Otorisasi: Pastikan user hanya mengupdate request miliknya
        if (auth()->id() !== $assetRequest->requester_user_id) {
            abort(403);
        }
        // Otorisasi: Hanya bisa update jika status 'Pending'
        if ($assetRequest->status !== 'Pending') {
            return redirect()->back()->with('error', 'Pengajuan yang sudah diproses tidak dapat diperbarui.');
        }

        $data = $request->validated();
        $assetRequest->update($data);

        $route = auth()->user()->hasRole('Staff') ? 'staff.asset-requests.index' : 'student.asset-requests.index';
        return redirect()->route($route)
            ->with('success', 'Pengajuan alat berhasil diperbarui.');
    }

    /**
     * Menghapus pengajuan alat.
     */
    public function destroy(AssetRequest $assetRequest)
    {
        // Otorisasi: Pastikan user hanya menghapus request miliknya
        if (auth()->id() !== $assetRequest->requester_user_id) {
            abort(403);
        }
        // Otorisasi: Hanya bisa hapus jika status 'Pending'
        if ($assetRequest->status !== 'Pending') {
            return redirect()->back()->with('error', 'Pengajuan yang sudah diproses tidak dapat dihapus.');
        }

        $assetRequest->delete(); // Ini akan soft delete

        $route = auth()->user()->hasRole('Staff') ? 'staff.asset-requests.index' : 'student.asset-requests.index';
        return redirect()->route($route)
            ->with('success', 'Pengajuan alat berhasil dihapus.');
    }

    public function show(AssetRequest $assetRequest)
    {
        return view('staff.asset-requests.show', compact('assetRequest'));
    }
}
