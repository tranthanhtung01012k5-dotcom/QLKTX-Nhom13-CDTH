<?php

namespace App\Http\Controllers\QuanLy;

use App\Models\QuanLy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\SinhVien;
use App\Models\SuCo;
use App\Models\Phong;
use App\Models\HoaDon;
use App\Models\ToaNha;

class QuanLyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $soluongSinhVien = SinhVien::count();
        $sucochuasuly = SuCo::where('trang_thai', 'Chua xu ly')->count();
        $tongsonguoidango = Phong::sum('so_nguoi_hien_tai');
        $tongsucchua = Phong::sum('suc_chua');
        $tile = $tongsucchua > 0 ? $tongsonguoidango / $tongsucchua * 100 : 0;
        $tile_hienthi = number_format($tile, 2) . '%';
        $hoadonchoxacnhan = HoaDon::where('trang_thai', 'Chua thanh toan')->count();
        $donchuasuly = SuCo::where('trang_thai', 'Dang xu ly')->count();
        $bangtile = $this->bangtile();
        $bangsucotheotrangthai = $this->sucotheotrangthai();
        return view(
            'quanly.dashboard.index',
            compact(
                'soluongSinhVien',
                'sucochuasuly',
                'tile',
                'tile_hienthi',
                'donchuasuly',
                'hoadonchoxacnhan',
                'bangtile',
                'bangsucotheotrangthai'
            )
        );
    }
    private function bangtile()
    {
        return ToaNha::query()
            ->leftJoin('tang', 'tang.toa_nha_id', '=', 'toa_nha.id')
            ->leftJoin('phong', 'phong.tang_id', '=', 'tang.id')
            ->selectRaw('toa_nha.ten_toa, SUM(phong.suc_chua) as tong_suc_chua, SUM(phong.so_nguoi_hien_tai) as dang_o')
            ->groupBy('toa_nha.id', 'toa_nha.ten_toa')
            ->orderBy('toa_nha.id')
            ->get()
            ->map(fn($t) => [
                'ten_toa'       => $t->ten_toa,
                'tong_suc_chua' => (int) $t->tong_suc_chua,
                'dang_o'        => (int) $t->dang_o,
                'tile'          => $t->tong_suc_chua > 0 ? number_format(($t->dang_o / $t->tong_suc_chua) * 100, 2) : 0,
            ])
            ->all();
    }
    private function sucotheotrangthai()
    {
        $tongsuco = SuCo::count();
        return SuCo::query()
            ->selectRaw('trang_thai, COUNT(*) as so_luong')
            ->groupBy('trang_thai')
            ->get()
            ->map(fn($t) => [
                'trang_thai' => $t->trang_thai,
                'so_luong'   => (int) $t->so_luong,
                'tile'       => $tongsuco > 0 ? number_format(($t->so_luong / $tongsuco) * 100, 2) : 0,
            ])
            ->all();
    }
}
