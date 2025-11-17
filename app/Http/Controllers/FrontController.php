<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // 1. TAMBAHKAN BARIS INI (PENTING)

class FrontController extends Controller
{
    /**
     * Menampilkan halaman Beranda (Landing Page).
     */
    public function index()
    {
        return view('front.index');
    }

    // 2. TAMBAHKAN 3 FUNGSI BARU DI BAWAH INI

    /**
     * Menampilkan halaman Fitur.
     */
    public function fitur(): View
    {
        return view('front.fitur'); // Nanti kita buat file 'fitur.blade.php'
    }

    /**
     * Menampilkan halaman Tentang.
     */
    public function tentang(): View
    {
        return view('front.tentang'); // Nanti kita buat file 'tentang.blade.php'
    }

    /**
     * Menampilkan halaman Kontak.
     */
    public function kontak(): View
    {
        return view('front.kontak'); // Nanti kita buat file 'kontak.blade.php'
    }
}