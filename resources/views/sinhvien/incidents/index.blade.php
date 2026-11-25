@extends('layoutmaster.layoutSinhVien')

@section('title', 'Sự cố | Cổng sinh viên KTX')
@section('student-subtitle', 'Sự cố')

@section('content')
<header class="page-header ph">
    <div>
        <h1>Sự cố</h1>
        <p class="mu">Gửi báo cáo và theo dõi tiến độ xử lý sự cố.</p>
    </div>
    @yield('page-actions')
</header>

{-- Khung nội dung: bổ sung truy vấn, biểu mẫu và component Blade tại đây. --}
<section class="student-placeholder">
    <div>
        <strong>Khu vực xây dựng chức năng: Sự cố</strong>
        <span>Thêm giao diện và dữ liệu của chức năng này tại đây.</span>
    </div>
</section>
@endsection