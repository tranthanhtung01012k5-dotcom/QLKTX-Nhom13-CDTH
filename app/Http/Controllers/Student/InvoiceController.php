<?php

namespace App\Http\Controllers\Student;

use App\Http\Requests\Student\ThanhToanRequest;
use App\Models\DienNuoc;
use App\Models\GiaTien;
use App\Models\HoaDon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Hóa đơn & thanh toán của sinh viên.
 * Sinh viên gửi thông tin thanh toán -> hóa đơn chuyển sang "Chờ xác nhận"
 * -> Ban quản lý xác nhận thành "Đã thanh toán".
 */
class InvoiceController extends StudentController
{
    private const BO_LOC = [
        'tat-ca'  => 'Tất cả',
        'can-nop' => 'Cần thanh toán',
        'qua-han' => 'Quá hạn',
        'cho'     => 'Chờ xác nhận',
        'da-nop'  => 'Đã thanh toán',
    ];

    public function index(Request $request): View
    {
        $sinhVien = $this->sinhVien();
        $boLoc    = array_key_exists($request->query('loc'), self::BO_LOC) ? $request->query('loc') : 'tat-ca';
        $tuKhoa   = trim((string) $request->query('q', ''));

        $query = $sinhVien->hoaDons();

        match ($boLoc) {
            'can-nop' => $query->whereIn('trang_thai', HoaDon::TRANG_THAI_CAN_THANH_TOAN),
            'qua-han' => $query->whereIn('trang_thai', HoaDon::TRANG_THAI_CAN_THANH_TOAN)
                ->whereDate('han_thanh_toan', '<', now()->toDateString()),
            'cho'     => $query->where('trang_thai', 'Cho xac nhan'),
            'da-nop'  => $query->where('trang_thai', 'Da thanh toan'),
            default   => null,
        };

        if ($tuKhoa !== '') {
            $like = '%' . str_replace(['%', '_'], ['\%', '\_'], $tuKhoa) . '%';
            $query->where(fn ($q) => $q->where('ma_hoa_don', 'like', $like)->orWhere('ky_thanh_toan', 'like', $like));
        }

        $hoaDons = $query->orderByDesc('ngay_phat_hanh')->orderByDesc('id')->paginate(8)->withQueryString();

        // Số liệu tổng quan (toàn bộ hóa đơn của sinh viên)
        $tatCa      = $sinhVien->hoaDons()->get();
        $canNop     = $tatCa->filter(fn (HoaDon $h) => $h->canThanhToan());
        $tongCanNop = $canNop->sum(fn (HoaDon $h) => $h->soTienPhaiNop());
        $soQuaHan   = $canNop->filter(fn (HoaDon $h) => $h->quaHan())->count();
        $soCho      = $tatCa->filter(fn (HoaDon $h) => $h->choXacNhan())->count();
        $tongDaNop  = $tatCa->filter(fn (HoaDon $h) => $h->daThanhToan())->sum(fn (HoaDon $h) => $h->soTienPhaiNop());
        $demBoLoc = [
            'tat-ca'  => $tatCa->count(),
            'can-nop' => $canNop->count(),
            'qua-han' => $soQuaHan,
            'cho'     => $soCho,
            'da-nop'  => $tatCa->filter(fn (HoaDon $h) => $h->daThanhToan())->count(),
        ];

        // Chỉ số điện nước gần đây của phòng
        $chiSo = $sinhVien->phong_id
            ? DienNuoc::where('phong_id', $sinhVien->phong_id)->orderByDesc('ngay_ghi')->orderByDesc('id')->limit(6)->get()
            : collect();
        $donGia = GiaTien::whereIn('ma_loai_tien', ['GT_DIEN', 'GT_NUOC'])->get()->keyBy('ma_loai_tien');

        $boLocNhan = self::BO_LOC;

        return view('sinhvien.invoices.index', compact(
            'sinhVien', 'hoaDons', 'boLoc', 'boLocNhan', 'tuKhoa', 'tongCanNop', 'soQuaHan', 'soCho', 'tongDaNop',
            'demBoLoc', 'chiSo', 'donGia'
        ));
    }

    public function show(int $id): View
    {
        $sinhVien = $this->sinhVien();
        $hoaDon   = $sinhVien->hoaDons()->with('phong.tang.toaNha')->findOrFail($id);
        $phuongThuc = ThanhToanRequest::PHUONG_THUC;

        return view('sinhvien.invoices.show', compact('sinhVien', 'hoaDon', 'phuongThuc'));
    }

    public function pay(ThanhToanRequest $request, int $id): RedirectResponse
    {
        $sinhVien = $this->sinhVien();
        $data     = $request->validated();

        $duongDan = null;
        if ($request->hasFile('anh_chung_tu')) {
            $duongDan = $request->file('anh_chung_tu')->store('chung-tu', 'local');
        }

        $loi = DB::transaction(function () use ($sinhVien, $id, $data, $duongDan) {
            $hoaDon = $sinhVien->hoaDons()->lockForUpdate()->findOrFail($id);

            if (! $hoaDon->canThanhToan()) {
                return 'Hóa đơn này không ở trạng thái có thể thanh toán.';
            }

            $anhCu = $hoaDon->anh_chung_tu;

            $hoaDon->update([
                'trang_thai'      => 'Cho xac nhan',
                'phuong_thuc'     => $data['phuong_thuc'],
                'ma_giao_dich'    => $data['phuong_thuc'] === 'Tien mat' ? null : ($data['ma_giao_dich'] ?? null),
                'so_tien'         => $hoaDon->soTienPhaiNop(),
                'ngay_thanh_toan' => now(),
                'anh_chung_tu'    => $duongDan ?? $hoaDon->anh_chung_tu,
            ]);

            if ($duongDan && $anhCu && $anhCu !== $duongDan) {
                Storage::disk('local')->delete($anhCu);
            }

            return null;
        });

        if ($loi) {
            if ($duongDan) {
                Storage::disk('local')->delete($duongDan);
            }

            return redirect()->route('sinhvien.invoices.show', $id)->with('error', $loi);
        }

        return redirect()->route('sinhvien.invoices.show', $id)
            ->with('success', 'Đã gửi thông tin thanh toán. Hóa đơn đang chờ Ban quản lý xác nhận.');
    }
}
