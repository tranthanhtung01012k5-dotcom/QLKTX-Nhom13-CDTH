@extends('layoutmaster.layoutSinhVien')

@section('title', 'Kỷ luật cá nhân | Cổng sinh viên KTX')
@section('student-subtitle', 'Kỷ luật cá nhân')

@section('content')
<header class="page-header ph">
    <div>
        <h1>Kỷ luật cá nhân</h1>
        <p class="mu">Theo dõi các ghi nhận và phản hồi liên quan.</p>
    </div>
    @yield('page-actions')
</header>

{-- Khung nội dung: bổ sung truy vấn, biểu mẫu và component Blade tại đây. --}
<section class="student-placeholder">
    <div>
        <strong>Khu vực xây dựng chức năng: Kỷ luật cá nhân</strong>
        <span>Thêm giao diện và dữ liệu của chức năng này tại đây.</span>
    </div>
</section>
@endsection