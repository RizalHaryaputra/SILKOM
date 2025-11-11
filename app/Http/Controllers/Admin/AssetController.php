<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest; 
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::latest()->paginate(10);
        return view('admin.assets.index', compact('assets'));
    }

    public function create()
    {
        return view('admin.assets.create');
    }

    public function store(StoreAssetRequest $request)
    {
        $data = $request->validated();

        // Logika Upload Gambar Aset
        if ($request->hasFile('asset_image')) {
            $path = $request->file('asset_image')->store('assets', 'public');
            $data['asset_image_path'] = $path;
        }

        Asset::create($data);

        return redirect()->route('admin.assets.index')
            ->with('success', 'Aset berhasil ditambahkan.');
    }


    public function show(Asset $asset)
    {
        return view('admin.assets.show', compact('asset'));
    }

    public function edit(Asset $asset){
        return view('admin.assets.edit', compact('asset'));
    }

    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $data = $request->validated();

        // Logika Update Gambar (Hapus yang lama jika ada yang baru)
        if ($request->hasFile('asset_image')) {
            // 1. Hapus gambar lama jika ada
            if ($asset->asset_image_path) {
                Storage::disk('public')->delete($asset->asset_image_path);
            }

            // 2. Upload gambar baru
            $path = $request->file('asset_image')->store('assets', 'public');
            $data['asset_image_path'] = $path;
        }

        $asset->update($data);

        return redirect()->route('admin.assets.index')
            ->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy(Asset $asset)
    {
        // PENTING: Kita tidak menghapus gambar saat soft delete.
        // Jika Anda ingin menghapus gambar, hapus komentar di bawah
        // ATAU buat logika Observer untuk 'deleting'

        // if ($asset->asset_image_path) {
        //     Storage::disk('public')->delete($asset->asset_image_path);
        // }

        $asset->delete(); // Ini akan melakukan Soft Delete

        return redirect()->route('admin.assets.index')
            ->with('success', 'Aset berhasil dihapus.');
    }
}
