<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Damage;
use App\Models\Asset;
use App\Http\Requests\StoreDamageRequest;
use App\Http\Requests\UpdateDamageRequest;
use Illuminate\Support\Facades\Storage;

class DamageController extends Controller
{
    // Menampilkan daftar riwayat kerusakan
    public function index()
    {
        // Tampilkan dengan relasi 'asset' agar bisa menampilkan nama aset
        $damages = Damage::with('asset')->latest()->paginate(10);

        return view('admin.damages.index', compact('damages'));
    }

    // Menampilkan form lapor kerusakan baru
    public function create()
    {
        // Ambil semua aset untuk ditampilkan di dropdown
        $assets = Asset::orderBy('name')->get();

        return view('admin.damages.create', compact('assets'));
    }

    // Menyimpan laporan kerusakan baru
    public function store(StoreDamageRequest $request)
    {
        $data = $request->validated();

        // Logika Upload Gambar Kerusakan
        if ($request->hasFile('damage_image')) {
            $path = $request->file('damage_image')->store('damages', 'public');
            $data['damage_image_path'] = $path;
        }

        // Set status awal
        $data['repair_status'] = 'Reported';
        // Set admin pelapor
        $data['reporter_admin_id'] = auth()->id();

        $damage = Damage::create($data);

        // Otomatis ubah status aset menjadi 'Damaged'
        $damage->asset()->update(['status' => 'Damaged']);

        return redirect()->route('admin.damages.index')
            ->with('success', 'Laporan kerusakan berhasil ditambahkan.');
    }

    // Menampilkan form edit laporan kerusakan
    public function edit(Damage $damage)
    {
        // Ambil semua aset untuk dropdown
        $assets = Asset::orderBy('name')->get();

        return view('admin.damages.edit', compact('damage', 'assets'));
    }

    // Memperbarui laporan kerusakan
    public function update(UpdateDamageRequest $request, Damage $damage)
    {
        $data = $request->validated();

        // Logika Update Gambar
        if ($request->hasFile('damage_image')) {
            // Hapus gambar lama jika ada
            if ($damage->damage_image_path) {
                Storage::disk('public')->delete($damage->damage_image_path);
            }
            // Upload gambar baru
            $path = $request->file('damage_image')->store('damages', 'public');
            $data['damage_image_path'] = $path;
        }

        $damage->update($data);

        // Jika status perbaikan 'Completed', kembalikan status aset ke 'Available'
        if ($data['repair_status'] === 'Completed') {
            $damage->asset()->update(['status' => 'Available']);
        } else {
            // Jika status masih 'In Progress' atau 'Reported', pastikan status aset tetap 'Damaged'
            $damage->asset()->update(['status' => 'Damaged']);
        }

        return redirect()->route('admin.damages.index')
            ->with('success', 'Laporan kerusakan berhasil diperbarui.');
    }

    public function show(Damage $damage)
    {
        return view('admin.damages.show', compact('damage'));
    }

    // Menghapus laporan kerusakan (Soft Delete)
    public function destroy(Damage $damage)
    {
        // Saat laporan dihapus (soft delete), kita tidak mengubah status aset
        // karena mungkin asetnya memang masih rusak.
        $damage->delete();

        return redirect()->route('admin.damages.index')
            ->with('success', 'Laporan kerusakan berhasil dihapus.');
    }
}
