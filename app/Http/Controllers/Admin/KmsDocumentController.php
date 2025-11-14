<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KmsDocument;
use App\Http\Requests\StoreKmsDocumentRequest;
use App\Http\Requests\UpdateKmsDocumentRequest;
use Illuminate\Support\Facades\Storage;

class KmsDocumentController extends Controller
{
    /**
     * Menampilkan daftar dokumen KMS.
     */
    public function index()
    {
        $documents = KmsDocument::latest()->paginate(10);
        return view('admin.kms.index', compact('documents'));
    }

    /**
     * Menampilkan form untuk membuat dokumen baru.
     */
    public function create()
    {
        // Ambil kategori dari skema (untuk dropdown)
        $categories = [
            'Maintenance',
            'Network',
            'Software',
            'Hardware',
            'Guideline',
            'Troubleshooting',
            'Safety',
            'Other',
        ];
        return view('admin.kms.create', compact('categories'));
    }

    /**
     * Menyimpan dokumen baru.
     */
    public function store(StoreKmsDocumentRequest $request)
    {
        $data = $request->validated();

        // Handle upload gambar cover
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('kms_covers', 'public');
            $data['cover_image'] = $path;
        }

        KmsDocument::create($data);

        return redirect()->route('admin.kms-documents.index')
            ->with('success', 'Dokumen KMS berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail dokumen (bisa digunakan untuk 'show' page).
     */
    public function show(KmsDocument $kmsDocument)
    {
        // Tampilkan view 'show' dan kirim data dokumen
        return view('admin.kms.show', compact('kmsDocument'));
    }

    /**
     * Menampilkan form untuk mengedit dokumen.
     */
    public function edit(KmsDocument $kmsDocument)
    {
        $categories = [
            'Maintenance',
            'Network',
            'Software',
            'Hardware',
            'Guideline',
            'Troubleshooting',
            'Safety',
            'Other',
        ];
        return view('admin.kms.edit', compact('kmsDocument', 'categories'));
    }

    /**
     * Memperbarui dokumen.
     */
    public function update(UpdateKmsDocumentRequest $request, KmsDocument $kmsDocument)
    {
        $data = $request->validated();

        // Handle update gambar cover
        if ($request->hasFile('cover_image')) {
            // 1. Hapus gambar lama jika ada
            if ($kmsDocument->cover_image) {
                Storage::disk('public')->delete($kmsDocument->cover_image);
            }
            // 2. Upload gambar baru
            $path = $request->file('cover_image')->store('kms_covers', 'public');
            $data['cover_image'] = $path;
        }

        $kmsDocument->update($data);

        return redirect()->route('admin.kms-documents.index')
            ->with('success', 'Dokumen KMS berhasil diperbarui.');
    }

    /**
     * Menghapus dokumen (Soft Delete).
     */
    public function destroy(KmsDocument $kmsDocument)
    {
        // Kita tidak menghapus gambar saat soft delete,
        // agar bisa di-restore.

        // Jika Anda ingin HAPUS PERMANEN gambar saat soft delete, 
        // Anda harus setup 'deleting' event di Model Observer.
        // Untuk saat ini, kita biarkan filenya.

        $kmsDocument->delete(); // Ini akan soft delete

        return redirect()->route('admin.kms-documents.index')
            ->with('success', 'Dokumen KMS berhasil dipindahkan ke arsip (soft delete).');
    }
}
