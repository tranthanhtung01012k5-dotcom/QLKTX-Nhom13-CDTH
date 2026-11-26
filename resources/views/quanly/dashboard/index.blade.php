@extends('layoutmaster.layoutQuanLy')

@section('title', 'Bảng điều khiển')

@section('content')
<div class="page-header">
    <div>
        <h1>Bảng điều khiển</h1>
        <p class="page-description">Tổng quan hoạt động quản lý ký túc xá.</p>
    </div>
</div>

<div class="card-grid">
    @foreach ([
    ['Sinh viên đang ở', $soluongSinhVien],
    ['Tỷ lệ lấp đầy', $tile_hienthi],
    ['Sự cố chưa xử lý', $sucochuasuly],
    ['Đơn chờ xét duyệt', $donchuasuly],
    ['Hóa đơn chờ xác nhận', $hoadonchoxacnhan],
    ] as [$label, $key])
    <section class="card st">
        <span class="ico">{{ $loop->iteration }}</span>
        <div>
            <div class="mu">{{ $label }}</div>
            <div class="big">{{ $key }}</div>
        </div>
    </section>
    @endforeach
</div>

<div class="card-grid card-grid-two">
    <section class="card">
        <h3>Tỷ lệ lấp đầy theo tòa</h3>

        @foreach ($bangtile as $toa)
        <div class="br">
            <span>{{ $toa['ten_toa'] }}</span>
            <div class="bar"><i style="width: {{ $toa['tile'] }}%"></i></div>
            <b>{{ $toa['dang_o'] }}/{{ $toa['tong_suc_chua'] }}</b>
        </div>
        @endforeach
    </section>
    <section class="card">
        <h3>Sự cố theo trạng thái</h3>

        @php
        $ten_trang_thai = [
        'Chua xu ly' => 'Chưa xử lý',
        'Dang xu ly' => 'Đang xử lý',
        'Da tiep nhan' => 'Đã tiếp nhận',
        'Da hoan thanh' => 'Đã hoàn thành',
        ];
        $tong = collect($bangsucotheotrangthai)->sum('so_luong');
        @endphp

        @foreach ($bangsucotheotrangthai as $trangthai)
        <div class="br">
            <span>{{ $ten_trang_thai[$trangthai['trang_thai']] ?? $trangthai['trang_thai'] }}</span>
            <div class="bar">
                <i style="width: {{ $tong > 0 ? $trangthai['so_luong'] / $tong * 100 : 0 }}%"></i>
            </div>
            <b>{{ $trangthai['so_luong'] }}</b>
        </div>
        @endforeach
    </section>
</div>
@endsection