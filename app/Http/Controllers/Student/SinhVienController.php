<?php

namespace App\Http\Controllers\Student;

use App\Models\SinhVien;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class SinhVienController extends Controller
{
    /**
     * Lấy thông tin sinh viên đang đăng nhập.
     */
    private function getSinhVien(): SinhVien
    {
        // Lấy tài khoản đang đăng nhập
        $taiKhoan = Auth::guard('tai_khoan')->user();

        if (!$taiKhoan) {
            abort(401, 'Bạn chưa đăng nhập.');
        }

        // Lấy sinh viên và toàn bộ thông tin phòng, tầng, tòa nhà
        $sinhVien = SinhVien::with([
            'phong.tang.toaNha'
        ])->find($taiKhoan->nguoi_dung_id);

        if (!$sinhVien) {
            abort(403, 'Tài khoản này không thuộc sinh viên.');
        }

        return $sinhVien;
    }

    /**
     * Trang tổng quan sinh viên.
     */
    public function dashboard(): View
    {
        $sinhVien = $this->getSinhVien();

        return view('sinhvien.dashboard', compact('sinhVien'));
    }

    /**
     * Quản lý phòng ở.
     */
    public function rooms(): View
    {
        $sinhVien = $this->getSinhVien();

        return view('sinhvien.rooms.index', compact('sinhVien'));
    }

    /**
     * Quản lý hóa đơn.
     */
    public function invoices(): View
    {
        $sinhVien = $this->getSinhVien();

        return view('sinhvien.invoices.index', compact('sinhVien'));
    }

    /**
     * Quản lý sự cố.
     */
    public function incidents(): View
    {
        $sinhVien = $this->getSinhVien();

        return view('sinhvien.incidents.index', compact('sinhVien'));
    }

    /**
     * Danh sách thông báo.
     */
    public function notifications(): View
    {
        $sinhVien = $this->getSinhVien();

        return view('sinhvien.notifications.index', compact('sinhVien'));
    }

    /**
     * Thông tin kỷ luật.
     */
    public function discipline(): View
    {
        $sinhVien = $this->getSinhVien();

        return view('sinhvien.discipline.index', compact('sinhVien'));
    }

    /**
     * Hồ sơ sinh viên.
     */
    public function profile(): View
    {
        $sinhVien = $this->getSinhVien();

        return view('sinhvien.profile.index', compact('sinhVien'));
    }
}
