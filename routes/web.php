<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\BorrowingApprovalController;
use App\Http\Controllers\Admin\DamageController;
use App\Http\Controllers\Lead\LeadDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Student\BorrowingController;
use App\Http\Controllers\Student\StudentDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route for Admin
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('assets', AssetController::class);
    Route::resource('damages', DamageController::class);

    // --- RUTE PERSETUJUAN PEMINJAMAN ---
    Route::get('borrow-requests', [BorrowingApprovalController::class, 'index'])->name('borrow.requests.index');
    Route::get('borrow-requests/{borrowing}', [BorrowingApprovalController::class, 'show'])->name('borrow.requests.show');
    Route::put('borrow-requests/{borrowing}/approve', [BorrowingApprovalController::class, 'approve'])->name('borrow.requests.approve');
    Route::put('borrow-requests/{borrowing}/reject', [BorrowingApprovalController::class, 'reject'])->name('borrow.requests.reject');
    Route::put('borrow-requests/{borrowing}/complete', [BorrowingApprovalController::class, 'complete'])->name('borrow.requests.complete');
});

// Route for Lead
Route::middleware(['auth', 'role:Lead'])->prefix('lead')->name('lead.')->group(function () {
    Route::get('/dashboard', [LeadDashboardController::class, 'index'])->name('dashboard');
});

// Route for Staff
Route::middleware(['auth', 'role:Staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
});

// Route for Student
Route::middleware(['auth', 'role:Student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::resource('borrow', BorrowingController::class);
});

require __DIR__ . '/auth.php';
