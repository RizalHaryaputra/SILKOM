<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\KmsDocument;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    // ===============================
    // Halaman Landing Page
    // ===============================
    public function index()
    {
        // Ambil 3 aset terbaru
        $latestAssets = Asset::latest()->take(3)->get();

        // Ambil 3 panduan KMS terbaru
        $latestGuides = KmsDocument::latest()->take(3)->get();

        return view('front.index', compact('latestAssets', 'latestGuides'));
    }

    // ===============================
    // Halaman Katalog Aset (READ-ONLY)
    // ===============================
    public function katalog()
    {
        // Ambil semua aset
        $assets = Asset::all();

        return view('front.katalog', compact('assets'));
    }

    // ===============================
    // Halaman Panduan KMS (READ-ONLY)
    // ===============================
    public function panduan()
    {
        // Ambil semua panduan KMS
        $guides = KmsDocument::all();

        return view('front.panduan', compact('guides'));
    }
}
