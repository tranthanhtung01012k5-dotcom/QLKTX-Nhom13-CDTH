<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Student\SinhVienController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $user = Auth::guard('tai_khoan')->user();

    if (!$user) {
        return redirect()->route('login');
    }

    return match ($user->vai_tro) {
        1 => redirect()->route('quanly.dashboard'),
        2 => redirect()->route('sinhvien.dashboard'),
        default => abort(403),
    };
});

// PHẦN 1: ĐĂNG NHẬP
Route::middleware('guest:tai_khoan')->group(function () {
    Route::get('/dang-nhap', [LoginController::class, 'show'])->name('login');
    Route::post('/dang-nhap', [LoginController::class, 'authenticate'])
        ->middleware('throttle:10,1') // Giới hạn 10 lần thử/phút chống brute-force
        ->name('login.authenticate');
});

Route::post('/dang-xuat', [LoginController::class, 'logout'])
    ->middleware('auth:tai_khoan')
    ->name('logout');

// PHẦN 2: SINH VIÊN
Route::middleware(['auth:tai_khoan', 'tai_khoan.active'])
    ->prefix('sinh-vien')
    ->name('sinhvien.')
    ->controller(SinhVienController::class)
    ->group(function () {
        Route::get('/', 'dashboard')->name('dashboard');
        Route::get('/phong-o', 'rooms')->name('rooms.index');
        Route::get('/hoa-don', 'invoices')->name('invoices.index');
        Route::get('/su-co', 'incidents')->name('incidents.index');
        Route::get('/thong-bao', 'notifications')->name('notifications.index');
        Route::get('/ky-luat', 'discipline')->name('discipline.index');
        Route::get('/ho-so', 'profile')->name('profile.index');
    });
