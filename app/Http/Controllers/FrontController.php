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
    public function assets()
    {
        // Ambil semua aset
        $assets = Asset::all();

        return view('front.assets', compact('assets'));
    }

    // ===============================
    // Halaman Panduan KMS (READ-ONLY)
    // ===============================
    public function kms()
    {
        // Ambil semua panduan KMS
        $guides = KmsDocument::all();

        return view('front.kms', compact('guides'));
    }

    public function showAsset(Asset $asset) {
        return view('front.asset-detail', compact('asset'));
    }

    public function showKms(KmsDocument $kms) {
        return view('front.kms-detail', compact('kms'));
    }
}
