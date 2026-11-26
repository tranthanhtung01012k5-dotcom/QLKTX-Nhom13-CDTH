@extends('layoutmaster.layoutSinhVien')

@section('title', 'Phòng ở & đăng ký | Cổng sinh viên KTX')
@section('student-subtitle', 'Phòng ở & đăng ký')

@section('content')
<header class="page-header ph">
    <div>
        <h1>Phòng ở & đăng ký</h1>
        <p class="mu">Thông tin phòng ở, hợp đồng và các yêu cầu lưu trú.</p>
    </div>
    @yield('page-actions')
</header>

{-- Khung nội dung: bổ sung truy vấn, biểu mẫu và component Blade tại đây. --}
<section class="student-placeholder">
    <div>
        <strong>Khu vực xây dựng chức năng: Phòng ở & đăng ký</strong>
        <span>Thêm giao diện và dữ liệu của chức năng này tại đây.</span>
    </div>
</section>
@endsection