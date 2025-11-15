<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBorrowingRequest;
use App\Models\Asset;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewBorrowingRequestAdminMail;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myBorrowings = Borrowing::with('asset')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('student.borrow.index', compact('myBorrowings'));
    }

    public function create()
    {
        $availableAssets = Asset::where('status', 'Available')->where('category', '!=', 'Computer')
            ->orderBy('name')
            ->get();

        return view('student.borrow.create', compact('availableAssets'));
    }

    public function store(StoreBorrowingRequest $request)
    {
        $data = $request->validated(); // Ini sekarang akan menyertakan 'purpose'

        // Buat data peminjaman
        $borrowing = Borrowing::create([
            'user_id' => auth()->id(),
            'asset_id' => $data['asset_id'],
            'borrowed_at' => $data['borrowed_at'],
            'purpose' => $data['purpose'], // Ini sekarang aman
            'status' => 'Pending',
        ]);

        // === KIRIM NOTIFIKASI KE ADMIN (OAS) ===
        $admins = User::role('Admin')->get();

        if ($admins->isNotEmpty()) {
            Mail::to($admins)->send(new NewBorrowingRequestAdminMail($borrowing));
        }

        return redirect()->route('student.borrow.index')
            ->with('success', 'Permintaan peminjaman berhasil diajukan. Mohon tunggu persetujuan Admin.');
    }
    //

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrowing $borrow) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrow)
    {
        // 1. Otorisasi: Pastikan mahasiswa ini yang punya request
        if (auth()->id() !== $borrow->user_id) {
            abort(403, 'Anda tidak berhak membatalkan permintaan ini.');
        }

        // 2. Logika Bisnis: Hanya bisa dibatalkan jika statusnya masih 'Pending'
        if ($borrow->status !== 'Pending') {
            return redirect()->route('student.borrow.index')
                ->with('error', 'Permintaan ini sudah diproses dan tidak dapat dibatalkan.');
        }

        // 3. Hapus request (ini akan soft delete jika Anda setup di model,
        //    atau hard delete jika tidak. Keduanya valid untuk pembatalan.)
        $borrow->delete();

        // 4. Redirect kembali
        return redirect()->route('student.borrow.index')
            ->with('success', 'Permintaan peminjaman telah berhasil dibatalkan.');
    }
}
