@extends('layoutmaster.layoutSinhVien')

@section('title', 'Hóa đơn & thanh toán | Cổng sinh viên KTX')
@section('student-subtitle', 'Hóa đơn & thanh toán')

@section('content')
<header class="page-header ph">
    <div>
        <h1>Hóa đơn & thanh toán</h1>
        <p class="mu">Theo dõi các khoản phí và lịch sử thanh toán.</p>
    </div>
</header>

@include('sinhvien.partial.common')

<div class="g4">
    <div class="c">
        <span class="ico">💰</span>
        <div class="stat-sub">Cần thanh toán</div>
        <div class="big">@vnd($tongCanNop)</div>
        <div class="stat-sub">{{ $demBoLoc['can-nop'] }} hóa đơn</div>
    </div>
    <div class="c">
        <span class="ico">🚨</span>
        <div class="stat-sub">Quá hạn</div>
        <div class="big" @if ($soQuaHan > 0) style="color:var(--bad)" @endif>{{ $soQuaHan }}</div>
        <div class="stat-sub">{{ $soQuaHan > 0 ? 'Hãy thanh toán sớm để tránh bị xử lý' : 'Không có hóa đơn quá hạn' }}</div>
    </div>
    <div class="c">
        <span class="ico">⏳</span>
        <div class="stat-sub">Chờ xác nhận</div>
        <div class="big">{{ $soCho }}</div>
        <div class="stat-sub">Ban quản lý đang kiểm tra</div>
    </div>
    <div class="c">
        <span class="ico">✅</span>
        <div class="stat-sub">Đã thanh toán</div>
        <div class="big">@vnd($tongDaNop)</div>
        <div class="stat-sub">{{ $demBoLoc['da-nop'] }} hóa đơn</div>
    </div>
</div>

<section class="c">
    <form method="GET" action="{{ route('sinhvien.invoices.index') }}" class="fb">
        <input type="hidden" name="loc" value="{{ $boLoc }}">
        <input type="search" name="q" value="{{ $tuKhoa }}" placeholder="Tìm theo mã hóa đơn hoặc kỳ thanh toán (vd: 11/2026)" aria-label="Tìm hóa đơn">
        <button class="b" type="submit">Tìm</button>
        @if ($tuKhoa !== '')<a class="b q" href="{{ route('sinhvien.invoices.index', ['loc' => $boLoc]) }}">Xóa tìm</a>@endif
    </form>

    <div class="chips">
        @foreach ($boLocNhan as $key => $nhan)
            <a class="chip {{ $boLoc === $key ? 'on' : '' }}" href="{{ route('sinhvien.invoices.index', array_filter(['loc' => $key, 'q' => $tuKhoa])) }}">
                {{ $nhan }} <small>({{ $demBoLoc[$key] }})</small>
            </a>
        @endforeach
    </div>

    @forelse ($hoaDons as $hd)
        <div class="rw">
            <span class="ic">🧾</span>
            <span class="g1">
                <b>Hóa đơn kỳ {{ $hd->ky_thanh_toan ?: '—' }}</b>
                <small>{{ $hd->ma_hoa_don }} · phát hành @ngay($hd->ngay_phat_hanh) · hạn nộp @ngay($hd->han_thanh_toan)</small>
            </span>
            <span class="am">@vnd($hd->soTienPhaiNop())</span>
            @trangthai('hoadon', $hd->trangThaiHienThi())
            <a class="b q s" href="{{ route('sinhvien.invoices.show', $hd->id) }}">Chi tiết</a>
            @if ($hd->canThanhToan())
                <a class="b y s" href="{{ route('sinhvien.invoices.show', $hd->id) }}#thanh-toan">Thanh toán</a>
            @endif
        </div>
    @empty
        <div class="em"><span>🧾</span>Không có hóa đơn nào{{ $boLoc !== 'tat-ca' || $tuKhoa !== '' ? ' phù hợp với bộ lọc.' : '.' }}</div>
    @endforelse

    {{ $hoaDons->links('sinhvien.partial.pagination') }}
</section>

<section class="c">
    <h2>Chỉ số điện nước của phòng</h2>
    @if (! $sinhVien->phong_id)
        <div class="em" style="padding:18px"><span>ℹ️</span>Bạn chưa được xếp phòng nên chưa có chỉ số điện nước.</div>
    @else
        @if ($donGia->isNotEmpty())
            <small>
                Đơn giá hiện hành:
                @if ($donGia->has('GT_DIEN')) điện @vnd($donGia['GT_DIEN']->don_gia)/kWh @endif
                @if ($donGia->has('GT_DIEN') && $donGia->has('GT_NUOC')) · @endif
                @if ($donGia->has('GT_NUOC')) nước @vnd($donGia['GT_NUOC']->don_gia)/m³ @endif
            </small>
        @endif
        @forelse ($chiSo as $cs)
            <div class="rw" style="margin-top:10px">
                <span class="ic">📟</span>
                <span class="g1"><b>Ghi ngày @ngay($cs->ngay_ghi)</b><small>{{ $cs->ma_chi_so }}</small></span>
                <span class="g1"><small>⚡ Điện</small><b>{{ $cs->chi_so_dien_cu }} → {{ $cs->chi_so_dien_moi }} ({{ $cs->soDienTieuThu() }} kWh)</b></span>
                <span class="g1"><small>💧 Nước</small><b>{{ $cs->chi_so_nuoc_cu }} → {{ $cs->chi_so_nuoc_moi }} ({{ $cs->soNuocTieuThu() }} m³)</b></span>
            </div>
        @empty
            <div class="em" style="padding:18px"><span>📟</span>Chưa có chỉ số điện nước nào được ghi cho phòng của bạn.</div>
        @endforelse
    @endif
</section>
@endsection
