@php
$studentName = $sinhVien->ho_va_ten ?? 'Sinh viên';
$studentMSSV = $sinhVien->ma_sinh_vien ?? 'ABC';
$studenLop = $sinhVien->lop ?? 'Chưa xác định';
$studentPhong = $sinhVien->phong?->ten_phong ?? 'Chưa xác định';
$studentInitials = mb_substr($studentName, 0, 2);
@endphp

<header class="tb student-header">

    <span class="student-user-name">
        <i class="avatar">{{ $studentInitials }}</i>

        <span>
            {{ $studentName }}
            <small>
                {{ $studentMSSV }} - {{ $studenLop }} - {{ $studentPhong }}
            </small>
        </span>
    </span>

    <button type="button"
        class="b q s"
        data-theme-toggle
        aria-label="Đổi giao diện sáng hoặc tối">
        🌓
    </button>

    <form class="logout-form"
        method="POST"
        action="{{ route('logout') }}"
        data-confirm="Bạn có chắc chắn muốn đăng xuất?">

        @csrf

        <button type="submit" class="b q s">
            Đăng xuất
        </button>
    </form>

</header>

<style>
    .student-header {
        position: sticky;
        top: env(safe-area-inset-top, 0px);
        z-index: 6;
        margin-left: 232px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px clamp(16px, 4vw, 44px);
        background: linear-gradient(90deg, #2F6BFF, #1799E6 55%, #14B8A6);
        color: #fff;
        box-shadow: 0 6px 20px rgba(23, 153, 230, .28);
    }

    body:before {
        content: "";
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        height: env(safe-area-inset-top, 0px);
        background: #2F6BFF;
        z-index: 7;
    }

    .student-header small {
        color: #fff;
        opacity: .92;
        display: block;
        font-weight: 400;
        line-height: 1.3;
    }

    .student-user-name {
        display: flex;
        align-items: center;
        gap: 9px;
        font-weight: 600;
        margin-right: auto;
    }

    .student-user-name .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        color: #fff;
        background: linear-gradient(135deg, var(--pri), #FF8A4C);
        font-style: normal;
    }

    .student-header .b.q {
        background: rgba(255, 255, 255, .22);
        color: #fff;
    }

    .logout-form {
        margin: 0;
    }

    .logout-form button {
        font: inherit;
    }

    @media (max-width: 820px) {
        .student-header {
            margin-left: 0;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // Chức năng đổi giao diện sáng / tối
        const themeButton = document.querySelector('[data-theme-toggle]');
        const root = document.documentElement;

        themeButton?.addEventListener('click', () => {
            const currentTheme = root.dataset.theme || 'light';

            root.dataset.theme =
                currentTheme === 'dark' ? 'light' : 'dark';
        });

        // Xác nhận trước khi đăng xuất
        document.querySelectorAll('[data-confirm]').forEach((form) => {
            form.addEventListener('submit', (event) => {
                const message =
                    form.dataset.confirm ||
                    'Bạn có chắc chắn muốn tiếp tục?';

                if (!window.confirm(message)) {
                    event.preventDefault();
                }
            });
        });

    });
</script>