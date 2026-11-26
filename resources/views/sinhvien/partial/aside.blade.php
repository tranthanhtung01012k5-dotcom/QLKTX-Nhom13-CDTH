<nav class="student-aside" aria-label="Menu sinh viên">

    <div class="brand">
        <i>🏠</i>
        KTX Xây dựng
    </div>

    <a href="{{ route('sinhvien.dashboard') }}"
        class="{{ request()->routeIs('sinhvien.dashboard') ? 'cur' : '' }}"
        title="Tổng quan">
        🏠 <span>Tổng quan</span>
    </a>

    <a href="{{ route('sinhvien.rooms.index') }}"
        class="{{ request()->routeIs('sinhvien.rooms.*') ? 'cur' : '' }}"
        title="Phòng ở">
        🛏️ <span>Phòng ở</span>
    </a>

    <a href="{{ route('sinhvien.invoices.index') }}"
        class="{{ request()->routeIs('sinhvien.invoices.*') ? 'cur' : '' }}"
        title="Hóa đơn">
        💳 <span>Hóa đơn</span>
    </a>

    <a href="{{ route('sinhvien.incidents.index') }}"
        class="{{ request()->routeIs('sinhvien.incidents.*') ? 'cur' : '' }}"
        title="Sự cố">
        🔧 <span>Sự cố</span>
    </a>

    <a href="{{ route('sinhvien.notifications.index') }}"
        class="{{ request()->routeIs('sinhvien.notifications.*') ? 'cur' : '' }}"
        title="Thông báo">
        📣 <span>Thông báo</span>
    </a>

    <a href="{{ route('sinhvien.discipline.index') }}"
        class="{{ request()->routeIs('sinhvien.discipline.*') ? 'cur' : '' }}"
        title="Kỷ luật">
        ⚖️ <span>Kỷ luật</span>
    </a>

    <a href="{{ route('sinhvien.profile.index') }}"
        class="{{ request()->routeIs('sinhvien.profile.*') ? 'cur' : '' }}"
        title="Hồ sơ">
        👤 <span>Hồ sơ</span>
    </a>

</nav>

<style>
    .student-aside {
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        width: 232px;
        padding: calc(env(safe-area-inset-top, 0px) + 22px) 14px 18px;
        background: linear-gradient(180deg, #1E47E0, #1597D9 70%, #14B8B0);
        color: #fff;
        display: flex;
        flex-direction: column;
        gap: 4px;
        z-index: 5;
    }

    .student-aside .brand {
        font-weight: 800;
        font-size: 19px;
        padding: 0 10px 18px;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .student-aside .brand i {
        font-style: normal;
        background: var(--acc);
        border-radius: 12px;
        width: 38px;
        height: 38px;
        display: grid;
        place-items: center;
    }

    .student-aside a {
        color: #e6f1ff;
        text-decoration: none;
        padding: 11px 12px;
        border-radius: 12px;
        display: flex;
        gap: 12px;
        align-items: center;
        position: relative;
        transition: background .2s;
    }

    .student-aside a:hover {
        background: rgba(255, 255, 255, .1);
    }

    .student-aside a.cur {
        background: #fff;
        color: #1E47E0;
        font-weight: 700;
        box-shadow: inset 4px 0 0 var(--acc);
    }

    .student-aside .bd {
        margin-left: auto;
        background: var(--acc);
        color: #18214D;
        border-radius: 99px;
        font-size: 12px;
        padding: 0 8px;
        font-weight: 800;
    }

    @media (max-width: 820px) {
        .student-aside {
            top: auto;
            width: 100%;
            height: auto;
            flex-direction: row;
            justify-content: space-around;
            padding: 6px 4px calc(6px + env(safe-area-inset-bottom, 0px));
            gap: 0;
        }

        .student-aside .brand,
        .student-aside a span {
            display: none;
        }

        .student-aside a {
            padding: 10px;
            font-size: 20px;
        }
    }
</style>