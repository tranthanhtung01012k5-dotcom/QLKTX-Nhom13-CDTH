<footer class="ft student-footer">

    <div class="fc">
        <b>🏠 KTX Xây dựng</b>
        <small>Ký túc xá Trường Đại học Xây dựng Hà Nội</small>
    </div>

    <div class="fc">
        <b>Liên hệ</b>
        <small>
            Phòng Quản lý KTX<br>
            Số 55 Giải Phóng, Phường Phương Liệt, Quận Thanh Xuân, Hà Nội<br>
            ktx@huce.edu.vn<br>
            0363 636 363<br>
        </small>
    </div>

    <div class="fc">
        <b>Truy cập nhanh</b>

        <a href="{{ route('sinhvien.rooms.index') }}">
            Phòng ở
        </a>

        <a href="{{ route('sinhvien.invoices.index') }}">
            Hóa đơn
        </a>

        <a href="{{ route('sinhvien.incidents.index') }}">
            Báo sự cố
        </a>
    </div>

    <p class="fn">
        © {{ date('Y') }} Hệ thống Quản lý KTX
    </p>

</footer>

<style>
    .student-footer {
        margin-left: 232px;
        padding: 26px clamp(16px, 4vw, 44px);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 18px;
        background: linear-gradient(90deg,
                var(--pri2),
                color-mix(in srgb, #14B8A6 22%, var(--card)));
        border-top: 4px solid #14B8A6;
    }

    .student-footer .fc {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .student-footer .fc a {
        color: var(--pri);
        text-decoration: none;
        font-weight: 600;
    }

    .student-footer .fc small {
        line-height: 1.7;
    }

    .student-footer .fn {
        grid-column: 1 / -1;
        font-size: 12.5px;
        color: var(--mut);
    }

    @media (max-width: 820px) {
        .student-footer {
            margin-left: 0;
            margin-bottom: 68px;
        }
    }
</style>