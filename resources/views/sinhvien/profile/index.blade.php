@extends('layoutmaster.layoutSinhVien')

@section('title', 'Hồ sơ cá nhân | Cổng sinh viên KTX')
@section('student-subtitle', 'Hồ sơ cá nhân')

@section('content')
<header class="page-header ph">
    <div>
        <h1>Hồ sơ cá nhân</h1>
        <p class="mu">Thông tin sinh viên và thiết lập tài khoản.</p>
    </div>
    @yield('page-actions')
</header>

{-- Khung nội dung: bổ sung truy vấn, biểu mẫu và component Blade tại đây. --}
<section class="student-placeholder">
    <div>
        <strong>Khu vực xây dựng chức năng: Hồ sơ cá nhân</strong>
        <span>Thêm giao diện và dữ liệu của chức năng này tại đây.</span>
    </div>
</section>
@endsection