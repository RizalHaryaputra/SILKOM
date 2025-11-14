<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ComputerUsage;
use Illuminate\Http\Request;

class ComputerUsageController extends Controller
{
    public function index()
    {
        $myUsages = ComputerUsage::with('asset')
                            // Filter HANYA untuk user yang sedang login
                            ->where('user_id', auth()->id()) 
                            ->latest()
                            ->paginate(15);
        
        return view('student.computer-usage.index', compact('myUsages'));
    }
}
