<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\AssetRequestApprovalController;
use App\Http\Controllers\Admin\BorrowingApprovalController;
use App\Http\Controllers\Admin\DamageController;
use App\Http\Controllers\Admin\KmsDocumentController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Staff\AssetRequestController;
use App\Http\Controllers\Lead\LeadDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\ComputerUsageController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Student\BorrowingController;
use App\Http\Controllers\Student\StudentDashboardController;
use Illuminate\Support\Facades\Route;

// Front page route
Route::get('/', [FrontController::class, 'index'])->name('front.index');

// Route for Admin
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('assets', AssetController::class);
    Route::resource('damages', DamageController::class);
    Route::resource('users', UserManagementController::class);
    Route::resource('kms-documents', KmsDocumentController::class);
    Route::get('borrow-requests', [BorrowingApprovalController::class, 'index'])->name('borrow.requests.index');
    Route::get('borrow-requests/{borrowing}', [BorrowingApprovalController::class, 'show'])->name('borrow.requests.show');
    Route::put('borrow-requests/{borrowing}/approve', [BorrowingApprovalController::class, 'approve'])->name('borrow.requests.approve');
    Route::put('borrow-requests/{borrowing}/reject', [BorrowingApprovalController::class, 'reject'])->name('borrow.requests.reject');
    Route::put('borrow-requests/{borrowing}/complete', [BorrowingApprovalController::class, 'complete'])->name('borrow.requests.complete');
    Route::get('computer-usage/log', [ComputerUsageController::class, 'create'])->name('computer-usage.create');
    Route::post('computer-usage/log', [ComputerUsageController::class, 'store'])->name('computer-usage.store');
    Route::get('computer-usage/history', [ComputerUsageController::class, 'index'])->name('computer-usage.index');
    Route::patch('computer-usage/{computerUsage}/finish', [ComputerUsageController::class, 'finish'])->name('computer-usage.finish');
    Route::delete('computer-usage/{computerUsage}', [ComputerUsageController::class, 'destroy'])->name('computer-usage.destroy');
    Route::get('computer-usage/{computerUsage}', [ComputerUsageController::class, 'show'])->name('computer-usage.show');
    Route::get('asset-requests', [AssetRequestApprovalController::class, 'index'])->name('asset-requests.index');
    Route::put('asset-requests/{assetRequest}/approve', [AssetRequestApprovalController::class, 'approve'])->name('asset-requests.approve');
    Route::put('asset-requests/{assetRequest}/reject', [AssetRequestApprovalController::class, 'reject'])->name('asset-requests.reject');
    Route::get('asset-requests/{assetRequest}', [AssetRequestApprovalController::class, 'show'])->name('asset-requests.show');
    Route::get('reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
});

// Route for Lead
Route::middleware(['auth', 'role:Lead'])->prefix('lead')->name('lead.')->group(function () {
    Route::get('/dashboard', [LeadDashboardController::class, 'index'])->name('dashboard');
    Route::get('reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
});

// Route for Staff
Route::middleware(['auth', 'role:Staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
    Route::get('computer-usage/log', [ComputerUsageController::class, 'create'])->name('computer-usage.create');
    Route::post('computer-usage/log', [ComputerUsageController::class, 'store'])->name('computer-usage.store');
    Route::get('computer-usage/history', [ComputerUsageController::class, 'index'])->name('computer-usage.index');
    Route::patch('computer-usage/{computerUsage}/finish', [ComputerUsageController::class, 'finish'])->name('computer-usage.finish');
    Route::delete('computer-usage/{computerUsage}', [ComputerUsageController::class, 'destroy'])->name('computer-usage.destroy');
    Route::get('computer-usage/{computerUsage}', [ComputerUsageController::class, 'show'])->name('computer-usage.show');
    Route::resource('damages', DamageController::class);
    Route::resource('asset-requests', AssetRequestController::class);
});

// Route for Student
Route::middleware(['auth', 'role:Student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::resource('borrow', BorrowingController::class);
    Route::get('computer-usage-history', [App\Http\Controllers\Student\ComputerUsageController::class, 'index'])->name('computer-usage.index');
    Route::get('profile', [App\Http\Controllers\Student\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/details', [App\Http\Controllers\Student\ProfileController::class, 'updateDetails'])->name('profile.updateDetails');
    Route::patch('profile/password', [App\Http\Controllers\Student\ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

require __DIR__ . '/auth.php';
