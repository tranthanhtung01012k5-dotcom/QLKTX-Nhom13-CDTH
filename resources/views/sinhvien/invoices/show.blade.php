@extends('layoutmaster.layoutSinhVien')

@section('title', 'Hóa đơn ' . $hoaDon->ma_hoa_don . ' | Cổng sinh viên KTX')
@section('student-subtitle', 'Chi tiết hóa đơn')

@section('content')
<header class="page-header ph">
    <div>
        <h1>Hóa đơn kỳ {{ $hoaDon->ky_thanh_toan ?: '—' }}</h1>
        <p class="mu">Mã hóa đơn {{ $hoaDon->ma_hoa_don }}</p>
    </div>
    <div class="ac no-print">
        <a class="b q" href="{{ route('sinhvien.invoices.index') }}">← Danh sách</a>
        <button class="b q" type="button" onclick="window.print()">🖨️ In hóa đơn</button>
    </div>
</header>

@include('sinhvien.partial.common')

<div class="g2">
    <section class="c">
        <div class="sec-h">
            <h2>Chi tiết khoản thu</h2>
            @trangthai('hoadon', $hoaDon->trangThaiHienThi())
        </div>
        <dl class="kv">
            <div><dt>Sinh viên</dt><dd>{{ $sinhVien->ho_va_ten }} ({{ $sinhVien->ma_sinh_vien }})</dd></div>
            <div><dt>Phòng</dt><dd>{{ $hoaDon->phong?->ten_phong ?? '—' }}</dd></div>
            <div><dt>Loại hóa đơn</dt><dd>{{ $hoaDon->loai_hoa_don ?: '—' }}</dd></div>
            <div><dt>Ngày phát hành</dt><dd>@ngay($hoaDon->ngay_phat_hanh)</dd></div>
            <div><dt>Hạn thanh toán</dt><dd @if ($hoaDon->quaHan()) style="color:var(--bad)" @endif>@ngay($hoaDon->han_thanh_toan)</dd></div>
        </dl>

        <div class="ln"><span>🛏️ Tiền phòng</span><b>@vnd($hoaDon->tien_phong)</b></div>
        <div class="ln"><span>⚡ Tiền điện</span><b>@vnd($hoaDon->tien_dien)</b></div>
        <div class="ln"><span>💧 Tiền nước</span><b>@vnd($hoaDon->tien_nuoc)</b></div>
        <div class="ln tot"><span>Tổng cộng</span><span>@vnd($hoaDon->soTienPhaiNop())</span></div>

        @if ($hoaDon->quaHan())
            <div class="al bad" style="margin-top:14px"><span>🚨</span><div>Hóa đơn đã quá hạn nộp. Vui lòng thanh toán sớm.</div></div>
        @endif
    </section>

    <section class="c">
        <h2>Thông tin thanh toán</h2>
        @if ($hoaDon->phuong_thuc || $hoaDon->ngay_thanh_toan)
            <dl class="kv">
                <div><dt>Phương thức</dt><dd>{{ $phuongThuc[$hoaDon->phuong_thuc] ?? ($hoaDon->phuong_thuc ?: '—') }}</dd></div>
                <div><dt>Mã giao dịch</dt><dd>{{ $hoaDon->ma_giao_dich ?: '—' }}</dd></div>
                <div><dt>Số tiền</dt><dd>@vnd($hoaDon->so_tien ?? $hoaDon->soTienPhaiNop())</dd></div>
                <div><dt>Thời điểm gửi</dt><dd>@ngaygio($hoaDon->ngay_thanh_toan)</dd></div>
            </dl>
            @if ($hoaDon->anh_chung_tu)
                @if (\Illuminate\Support\Str::endsWith(strtolower($hoaDon->anh_chung_tu), '.pdf'))
                    <a class="b q s" href="{{ route('sinhvien.files.show', ['loai' => 'hoa-don', 'id' => $hoaDon->id]) }}" target="_blank" rel="noopener">📄 Xem chứng từ (PDF)</a>
                @else
                    <a href="{{ route('sinhvien.files.show', ['loai' => 'hoa-don', 'id' => $hoaDon->id]) }}" target="_blank" rel="noopener">
                        <img class="thumb" src="{{ route('sinhvien.files.show', ['loai' => 'hoa-don', 'id' => $hoaDon->id]) }}" alt="Chứng từ thanh toán">
                    </a>
                @endif
            @endif
            @if ($hoaDon->choXacNhan())
                <div class="al warn" style="margin-top:14px"><span>⏳</span><div>Thông tin thanh toán đã được gửi. Ban quản lý đang kiểm tra và sẽ xác nhận sớm.</div></div>
            @elseif ($hoaDon->daThanhToan())
                <div class="al ok" style="margin-top:14px"><span>✅</span><div>Hóa đơn đã được xác nhận thanh toán. Cảm ơn bạn!</div></div>
            @endif
        @else
            <p class="mu">Hóa đơn này chưa có giao dịch thanh toán.</p>
        @endif
    </section>
</div>

@if ($hoaDon->canThanhToan())
<section class="c no-print" id="thanh-toan">
    <h2>Thanh toán hóa đơn</h2>
    <div class="note">
        Chuyển khoản đúng số tiền <b>@vnd($hoaDon->soTienPhaiNop())</b> với nội dung:
        <b>{{ $hoaDon->ma_hoa_don }} {{ $sinhVien->ma_sinh_vien }}</b>, sau đó nhập mã giao dịch và tải lên ảnh biên lai.
        Thông tin tài khoản nhận tiền do Ban quản lý KTX cung cấp.
    </div>
    <form method="POST" action="{{ route('sinhvien.invoices.pay', $hoaDon->id) }}" enctype="multipart/form-data" data-once>
        @csrf
        <div class="fg">
            <label>
                <span class="req">Phương thức thanh toán</span>
                <select name="phuong_thuc" id="phuong_thuc" required>
                    @foreach ($phuongThuc as $value => $label)
                        <option value="{{ $value }}" @selected(old('phuong_thuc', 'Chuyen khoan') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('phuong_thuc')<div class="err">{{ $message }}</div>@enderror
            </label>
            <label>
                <span id="lbl-gd" class="req">Mã giao dịch</span>
                <input type="text" name="ma_giao_dich" id="ma_giao_dich" value="{{ old('ma_giao_dich') }}" maxlength="100" placeholder="Mã giao dịch trên biên lai">
                @error('ma_giao_dich')<div class="err">{{ $message }}</div>@enderror
            </label>
        </div>

        <div class="drop">
            <label><span id="lbl-ct">📎 Tải ảnh/biên lai chứng từ</span>
                <input type="file" name="anh_chung_tu" accept=".jpg,.jpeg,.png,.webp,.pdf" data-preview="pv-chungtu" style="display:none">
                <small>JPG, PNG, WEBP hoặc PDF, tối đa 4 MB — bấm để chọn tệp</small>
            </label>
            <div class="pv" id="pv-chungtu"></div>
        </div>
        @error('anh_chung_tu')<div class="err">{{ $message }}</div>@enderror

        <button class="b" type="submit">Gửi thông tin thanh toán</button>
    </form>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var pt = document.getElementById('phuong_thuc');
        var gd = document.getElementById('ma_giao_dich');
        var lg = document.getElementById('lbl-gd');
        var lc = document.getElementById('lbl-ct');
        function sync() {
            var cash = pt.value === 'Tien mat';
            gd.disabled = cash;
            lg.classList.toggle('req', !cash);
            lc.classList.toggle('req', !cash);
        }
        pt.addEventListener('change', sync); sync();
    });
</script>
@endpush
@endif
@endsection
