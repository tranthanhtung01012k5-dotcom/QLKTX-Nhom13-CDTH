@extends('layoutmaster.layoutSinhVien')

@section('title', 'Hóa đơn & thanh toán | Cổng sinh viên KTX')
@section('student-subtitle', 'Hóa đơn & thanh toán')

@section('content')
<header class="page-header ph">
    <div>
        <h1>Hóa đơn & thanh toán</h1>
        <p class="mu">Theo dõi các khoản phí và lịch sử thanh toán.</p>
    </div>
    @yield('page-actions')
</header>

{-- Khung nội dung: bổ sung truy vấn, biểu mẫu và component Blade tại đây. --}
<section class="student-placeholder">
    <div>
        <strong>Khu vực xây dựng chức năng: Hóa đơn & thanh toán</strong>
        <span>Thêm giao diện và dữ liệu của chức năng này tại đây.</span>
    </div>
</section>
@endsection