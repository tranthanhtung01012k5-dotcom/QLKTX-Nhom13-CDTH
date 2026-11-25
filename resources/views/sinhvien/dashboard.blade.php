@extends('layoutmaster.layoutSinhVien')

@section('title', 'Tổng quan | Cổng sinh viên KTX')
@section('student-subtitle', 'Tổng quan')

@section('content')
<header class="page-header ph">
    <div>
        <h1>Tổng quan</h1>
        <p class="mu">Thông tin tổng quan và các nội dung cần sinh viên theo dõi.</p>
    </div>
    @yield('page-actions')
</header>

<section class="student-placeholder">
    <div>
        <h1> Chào {{ $sinhVien->ho_va_ten ?? 'Sinh viên' }}!</h1>
        <small> {{ $sinhVien->ma_sinh_vien ?? 'Chưa xác định' }} - {{ $sinhVien->lop ?? 'Chưa xác định' }} - {{ $sinhVien->phong?->ten_phong ?? 'Chưa xác định' }}</small>
    </div>
</section>
@endsection
@push('styles')
<style>
    .student-placeholder {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        text-align: left;

        min-height: 300px;
        padding: 40px 50px;
        box-sizing: border-box;

        background: linear-gradient(135deg, #42A5F5, #1976D2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 16px;

        color: #fff;
        box-shadow: 0 8px 24px rgba(33, 150, 243, 0.2);
    }

    .student-placeholder h1 {
        font-size: 36px;
        font-weight: 800;
        margin: 0 0 16px;
        color: #fff;
    }

    .student-placeholder small {
        display: block;
        font-size: 18px;
        line-height: 1.8;
        color: #EAF4FF;
        max-width: 600px;
    }

    @media (max-width: 768px) {
        .student-placeholder {
            padding: 30px 24px;
            min-height: 240px;
        }

        .student-placeholder h1 {
            font-size: 26px;
        }

        .student-placeholder small {
            font-size: 15px;
        }
    }
</style>
@endpush