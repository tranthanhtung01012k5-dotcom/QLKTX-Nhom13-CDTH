<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\QuanLy\BaoCaoController;
use App\Http\Controllers\QuanLy\DienNuocController;
use App\Http\Controllers\QuanLy\DonDangKyController;
use App\Http\Controllers\QuanLy\DotDangKyController;
use App\Http\Controllers\QuanLy\HoaDonController;
use App\Http\Controllers\QuanLy\PhongController;
use App\Http\Controllers\QuanLy\QuanLyController;
use App\Http\Controllers\QuanLy\QuanLySinhVienController as QuanLySinhVienController;
use App\Http\Controllers\QuanLy\SuCoController;
use App\Http\Controllers\QuanLy\TaiKhoanController;
use App\Http\Controllers\QuanLy\TangController;
use App\Http\Controllers\QuanLy\ThongBaoController;
use App\Http\Controllers\QuanLy\ToaController;
use App\Http\Controllers\QuanLy\ViPhamKiLuatController;
use App\Http\Controllers\Student\DisciplineController;
use App\Http\Controllers\Student\FileController;
use App\Http\Controllers\Student\IncidentController;
use App\Http\Controllers\Student\InvoiceController;
use App\Http\Controllers\Student\NotificationController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\RoomController;
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

// PHẦN 2: SINH VIÊN (chỉ tài khoản vai trò Sinh viên)
Route::middleware(['auth:tai_khoan', 'tai_khoan.active', 'role.sinhvien'])
    ->prefix('sinh-vien')
    ->name('sinhvien.')
    ->group(function () {

        // Tổng quan
        Route::get('/', [SinhVienController::class, 'dashboard'])->name('dashboard');

        // Phòng ở & đăng ký: phòng hiện tại, hợp đồng, đăng ký ở KTX, rời KTX
        Route::controller(RoomController::class)->prefix('phong-o')->name('rooms.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/dang-ky', 'register')->middleware('throttle:sv-ghi')->name('register');
            Route::post('/dang-ky/{id}/huy', 'cancelRegistration')->whereNumber('id')->name('register.cancel');
            Route::post('/roi-ktx', 'leave')->middleware('throttle:sv-ghi')->name('leave');
            Route::post('/roi-ktx/{id}/huy', 'cancelLeave')->whereNumber('id')->name('leave.cancel');
        });

        // Hóa đơn & thanh toán
        Route::controller(InvoiceController::class)->prefix('hoa-don')->name('invoices.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->whereNumber('id')->name('show');
            Route::post('/{id}/thanh-toan', 'pay')->whereNumber('id')->middleware('throttle:sv-ghi')->name('pay');
        });

        // Sự cố
        Route::controller(IncidentController::class)->prefix('su-co')->name('incidents.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->middleware('throttle:sv-ghi')->name('store');
            Route::get('/{id}', 'show')->whereNumber('id')->name('show');
            Route::put('/{id}', 'update')->whereNumber('id')->name('update');
            Route::delete('/{id}', 'destroy')->whereNumber('id')->name('destroy');
        });

        // Thông báo
        Route::get('/thong-bao', [NotificationController::class, 'index'])->name('notifications.index');

        // Kỷ luật
        Route::get('/ky-luat', [DisciplineController::class, 'index'])->name('discipline.index');

        // Hồ sơ cá nhân
        Route::controller(ProfileController::class)->prefix('ho-so')->name('profile.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/', 'update')->name('update');
            Route::put('/mat-khau', 'updatePassword')->middleware('throttle:sv-matkhau')->name('password');
        });

        // Tệp đính kèm của chính sinh viên (ảnh sự cố, chứng từ, minh chứng kỷ luật)
        Route::get('/tep/{loai}/{id}', [FileController::class, 'show'])
            ->whereIn('loai', ['su-co', 'hoa-don', 'ky-luat'])
            ->whereNumber('id')
            ->name('files.show');
    });

// PHẦN 3: QUẢN LÝ
Route::middleware(['auth:tai_khoan', 'tai_khoan.active'])
    ->prefix('quan-ly')
    ->name('quanly.')
    ->group(function () {
        Route::get('/', [QuanLyController::class, 'dashboard'])->name('dashboard');
        Route::get('/tep/{loai}/{id}', [FileController::class, 'show'])
            ->whereIn('loai', ['su-co', 'hoa-don', 'ky-luat'])
            ->whereNumber('id')
            ->name('files.show');
        Route::get('/bao-cao', [BaoCaoController::class, 'index'])->name('reports.index');

        Route::resource('toa', ToaController::class)
            ->names('buildings')->parameters(['toa' => 'toa']);
        Route::resource('tang', TangController::class)
            ->names('floors')->parameters(['tang' => 'tang']);
        Route::resource('phong', PhongController::class)
            ->names('rooms')->parameters(['phong' => 'phong']);
        Route::resource('sinh-vien', QuanLySinhVienController::class)
            ->names('students')->parameters(['sinh-vien' => 'sinh_vien']);
        Route::resource('dot-dang-ky', DotDangKyController::class)
            ->names('registration-periods')->parameters(['dot-dang-ky' => 'dot_dang_ky']);
        Route::resource('don-dang-ky', DonDangKyController::class)
            ->names('registrations')->parameters(['don-dang-ky' => 'don_dang_ky']);
        Route::resource('dien-nuoc', DienNuocController::class)
            ->names('meters')->parameters(['dien-nuoc' => 'dien_nuoc']);
        Route::resource('hoa-don', HoaDonController::class)
            ->names('invoices')->parameters(['hoa-don' => 'hoa_don']);
        Route::resource('su-co', SuCoController::class)
            ->names('incidents')->parameters(['su-co' => 'su_co']);
        Route::resource('vi-pham-ki-luat', ViPhamKiLuatController::class)
            ->names('violations')->parameters(['vi-pham-ki-luat' => 'vi_pham_ki_luat']);
        Route::resource('thong-bao', ThongBaoController::class)
            ->names('notices')->parameters(['thong-bao' => 'thong_bao']);
        Route::resource('tai-khoan', TaiKhoanController::class)
            ->names('accounts')->parameters(['tai-khoan' => 'tai_khoan']);
    });
