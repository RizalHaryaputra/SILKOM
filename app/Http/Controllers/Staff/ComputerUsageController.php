<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ComputerUsage;
use App\Models\User;
use App\Models\Asset;
use App\Http\Requests\StoreComputerUsageRequest;
use Illuminate\Support\Facades\DB; // <-- 1. TAMBAHKAN DB FACADE

class ComputerUsageController extends Controller
{
    // ... method index() tidak berubah ...
    public function index()
    {
        $usages = ComputerUsage::with(['user', 'asset'])
            ->latest()
            ->paginate(15);

        return view('staff.computer-usage.index', compact('usages'));
    }

    // ... method create() tidak berubah ...
    public function create()
    {
        $users = User::role('Student')->orderBy('name')->get();
        // 2. UBAH KUERI INI agar hanya menampilkan komputer yang tersedia
        $computers = Asset::where('category', 'Computer')
            ->where('status', 'Available') // <-- Tambahkan filter ini
            ->orderBy('name')
            ->get();

        return view('staff.computer-usage.create', compact('users', 'computers'));
    }

    /**
     * Menyimpan log penggunaan komputer baru.
     * LOGIKA DIPERBARUI
     */
    public function store(StoreComputerUsageRequest $request)
    {
        $data = $request->validated();

        try {
            // 3. GUNAKAN DB TRANSACTION
            DB::transaction(function () use ($data) {
                // Langkah A: Buat log penggunaan
                ComputerUsage::create($data);

                // Langkah B: Ubah status aset menjadi 'Borrowed'
                $asset = Asset::find($data['asset_id']);
                $asset->update(['status' => 'Borrowed']);
            });
        } catch (\Exception $e) {
            return redirect()->route('staff.computer-usage.create')
                ->with('error', 'Gagal menyimpan log. Terjadi kesalahan server.');
        }

        return redirect()->route('staff.computer-usage.index')
            ->with('success', 'Log penggunaan komputer berhasil ditambahkan.');
    }

    /**
     * 4. METODE BARU: Menyelesaikan sesi penggunaan komputer.
     */
    public function finish(ComputerUsage $computerUsage)
    {
        // Validasi 1: Pastikan belum diselesaikan
        if ($computerUsage->finished_at) {
            return redirect()->route('staff.computer-usage.index')
                ->with('error', 'Sesi ini sudah selesai.');
        }

        // Validasi 2: Pastikan status aset memang 'Borrowed'
        if ($computerUsage->asset->status !== 'Borrowed') {
            return redirect()->route('staff.computer-usage.index')
                ->with('error', 'Status aset tidak sesuai. Aksi dibatalkan.');
        }

        try {
            DB::transaction(function () use ($computerUsage) {
                // Langkah A: Isi waktu selesai
                $computerUsage->update([
                    'finished_at' => now()
                ]);

                // Langkah B: Kembalikan status aset ke 'Available'
                $computerUsage->asset->update([
                    'status' => 'Available'
                ]);
            });
        } catch (\Exception $e) {
            return redirect()->route('staff.computer-usage.index')
                ->with('error', 'Gagal menyelesaikan sesi. Terjadi kesalahan server.');
        }

        return redirect()->route('staff.computer-usage.index')
            ->with('success', "Sesi untuk {$computerUsage->asset->name} berhasil diselesaikan.");
    }

    public function destroy(ComputerUsage $computerUsage)
    {
        try {
            DB::transaction(function () use ($computerUsage) {
                // Logika Pengaman: Jika log yang dihapus sedang aktif
                // (belum selesai), kembalikan status aset.
                if (is_null($computerUsage->finished_at) && $computerUsage->asset->status === 'Borrowed') {
                    $computerUsage->asset->update(['status' => 'Available']);
                }

                // Hapus log-nya (ini hard delete karena kita tidak pakai softDeletes di migrasi ini)
                $computerUsage->delete();
            });
        } catch (\Exception $e) {
            return redirect()->route('staff.computer-usage.index')
                ->with('error', 'Gagal menghapus log. Terjadi kesalahan server.');
        }

        return redirect()->route('staff.computer-usage.index')
            ->with('success', 'Log penggunaan komputer berhasil dihapus.');
    }
}
