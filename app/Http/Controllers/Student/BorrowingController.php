<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBorrowingRequest;
use App\Models\Asset;
use App\Models\Borrowing;
use App\Models\User;
use App\Notifications\NewBorrowingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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
        $availableAssets = Asset::where('status', 'Available')
            ->orderBy('name')
            ->get();

        return view('student.borrow.create', compact('availableAssets'));
    }

    public function store(StoreBorrowingRequest $request)
    {
        $data = $request->validated();

        // Buat data peminjaman
        $borrowing = Borrowing::create([
            'user_id' => auth()->id(),
            'asset_id' => $data['asset_id'],
            'borrowed_at' => $data['borrowed_at'],
            'status' => 'Pending', // <-- Status awal
        ]);

        // === KIRIM NOTIFIKASI KE ADMIN (OAS) ===
        $admins = User::role('Admin')->get();

        // Kirim notifikasi ke mereka (via email)
        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NewBorrowingRequest($borrowing));
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
    public function edit(string $id)
    {
        //
    }

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
    public function destroy(string $id)
    {
        //
    }
}
