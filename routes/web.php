<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('admin.main');
});




// Admin Routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/otp-verify', [AdminController::class, 'otpVerify'])->name('admin.otp-verify');
Route::get('/admin/main', [AdminController::class, 'main'])->name('admin.main');
Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
Route::get('/admin/industry', [AdminController::class, 'manageIndustry'])->name('admin.manage-inudstry');
Route::get('/admin/business-report', [AdminController::class, 'manageBusiness'])->name('admin.manage-business');
Route::get('/admin/invoice', [AdminController::class, 'invoice'])->name('admin.invoice');
Route::get('admin/account-history', [AdminController::class, 'accountHistory'])->name('admin.account');
Route::get('/admin/upload', [AdminController::class, 'uploadDocument'])->name('admin.upload');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

