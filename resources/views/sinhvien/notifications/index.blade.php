@extends('layoutmaster.layoutSinhVien')

@section('title', 'Thông báo | Cổng sinh viên KTX')
@section('student-subtitle', 'Thông báo')

@section('content')
<header class="page-header ph">
    <div>
        <h1>Thông báo</h1>
        <p class="mu">Các thông báo được gửi từ Ban quản lý KTX.</p>
    </div>
    @yield('page-actions')
</header>

{-- Khung nội dung: bổ sung truy vấn, biểu mẫu và component Blade tại đây. --}
<section class="student-placeholder">
    <div>
        <strong>Khu vực xây dựng chức năng: Thông báo</strong>
        <span>Thêm giao diện và dữ liệu của chức năng này tại đây.</span>
    </div>
</section>
@endsection