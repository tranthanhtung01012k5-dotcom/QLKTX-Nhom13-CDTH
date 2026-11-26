@extends('layoutmaster.layoutDangNhap')

@section('title', 'Đăng nhập | Cổng sinh viên KTX')

@section('content')
<section class="login-page">
    <div class="lp">
        <h1>Chào mừng về nhà 🏠</h1>
        <p>Đăng ký phòng, thanh toán hóa đơn và báo sự cố ngay trên cổng sinh viên.</p>

        <div id="lb" aria-hidden="true">
            <div class="lb-tooltip" data-lb-tooltip>Ký túc xá sinh viên</div>
            <svg viewBox="0 0 600 500" class="sc" aria-hidden="true">
                <defs>
                    <!-- Bầu trời & ánh sáng -->
                    <linearGradient id="skyGrad" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#4B93FF" stop-opacity="0.35" />
                        <stop offset="65%" stop-color="#9BE7F8" stop-opacity="0.25" />
                        <stop offset="100%" stop-color="#FFE699" stop-opacity="0.35" />
                    </linearGradient>

                    <!-- Tòa KTX chính -->
                    <linearGradient id="mainDormGrad" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#3B5BFF" />
                        <stop offset="100%" stop-color="#2339B8" />
                    </linearGradient>

                    <!-- Tòa phụ trái & phải -->
                    <linearGradient id="leftBlockGrad" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0%" stop-color="#7C9BFF" />
                        <stop offset="100%" stop-color="#5676E8" />
                    </linearGradient>
                    <linearGradient id="rightBlockGrad" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0%" stop-color="#9B7EFF" />
                        <stop offset="100%" stop-color="#7052DC" />
                    </linearGradient>

                    <!-- Cửa sổ sáng đèn -->
                    <linearGradient id="winLit" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#FFF4B8" />
                        <stop offset="100%" stop-color="#FFD15C" />
                    </linearGradient>

                    <!-- Cửa sổ tối / phản chiếu xanh -->
                    <linearGradient id="winDark" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#1A2C7A" />
                        <stop offset="100%" stop-color="#121E59" />
                    </linearGradient>

                    <!-- Thảm cỏ & lối đi -->
                    <linearGradient id="grassGrad" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#67D494" />
                        <stop offset="100%" stop-color="#3FB372" />
                    </linearGradient>

                    <!-- Bóng mềm -->
                    <filter id="softShadow" x="-15%" y="-15%" width="130%" height="130%">
                        <feDropShadow dx="0" dy="6" stdDeviation="6" flood-color="#12235E" flood-opacity="0.16" />
                    </filter>
                </defs>

                <!-- Lớp nền nhẹ -->
                <rect width="600" height="500" fill="url(#skyGrad)" />

                <!-- Mặt trời & tia sáng -->
                <g class="rays" stroke="#FFE27A" stroke-width="4.5" stroke-linecap="round">
                    <line x1="534" y1="70" x2="550" y2="70" />
                    <line x1="529.44" y1="87" x2="543.30" y2="95" />
                    <line x1="517" y1="99.44" x2="525" y2="113.30" />
                    <line x1="500" y1="104" x2="500" y2="120" />
                    <line x1="483" y1="99.44" x2="475" y2="113.30" />
                    <line x1="470.56" y1="87" x2="456.70" y2="95" />
                    <line x1="466" y1="70" x2="450" y2="70" />
                    <line x1="470.56" y1="53" x2="456.70" y2="45" />
                    <line x1="483" y1="40.56" x2="475" y2="26.70" />
                    <line x1="500" y1="36" x2="500" y2="20" />
                    <line x1="517" y1="40.56" x2="525" y2="26.70" />
                    <line x1="529.44" y1="53" x2="543.30" y2="45" />
                </g>
                <circle cx="500" cy="70" r="28" fill="#FFD84D" />
                <circle cx="494" cy="64" r="8" fill="#FFF3A8" opacity="0.7" />

                <!-- Mây trôi -->
                <g class="cl">
                    <g transform="translate(0 40) scale(1.2)">
                        <ellipse cx="40" cy="20" rx="40" ry="16" fill="#fff" opacity=".92" />
                        <ellipse cx="24" cy="10" rx="20" ry="14" fill="#fff" opacity=".92" />
                        <ellipse cx="58" cy="8" rx="22" ry="16" fill="#fff" opacity=".92" />
                    </g>
                </g>
                <g class="cl b2">
                    <g transform="translate(0 118) scale(0.82)">
                        <ellipse cx="40" cy="20" rx="40" ry="16" fill="#fff" opacity=".88" />
                        <ellipse cx="24" cy="10" rx="20" ry="14" fill="#fff" opacity=".88" />
                        <ellipse cx="58" cy="8" rx="22" ry="16" fill="#fff" opacity=".88" />
                    </g>
                </g>

                <!-- Đàn chim -->
                <g class="bi" style="animation-delay:0s">
                    <path d="M0 0q8-8 16 0q8-8 16 0" fill="none" stroke="#18367A" stroke-width="2.5" stroke-linecap="round" transform="translate(0 90)" />
                </g>
                <g class="bi" style="animation-delay:-5s">
                    <path d="M0 0q8-8 16 0q8-8 16 0" fill="none" stroke="#18367A" stroke-width="2.5" stroke-linecap="round" transform="translate(0 60)" />
                </g>
                <g class="bi" style="animation-delay:-9s">
                    <path d="M0 0q8-8 16 0q8-8 16 0" fill="none" stroke="#18367A" stroke-width="2.5" stroke-linecap="round" transform="translate(0 128)" />
                </g>

                <!-- Đồi xanh xa -->
                <ellipse cx="150" cy="450" rx="260" ry="70" fill="#A8EBB9" />
                <ellipse cx="470" cy="455" rx="280" ry="60" fill="#8FE0A8" />

                <!-- Tòa nhà bên trái -->
                <g class="building-group" data-label="Khu nhà ở phía Tây" filter="url(#softShadow)">
                    <rect x="60" y="250" width="110" height="190" rx="10" fill="url(#leftBlockGrad)" />
                    <rect x="56" y="244" width="118" height="12" rx="6" fill="#9BB6FF" />

                    <rect x="76" y="272" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng T1-01" style="animation-delay:0.00s" />
                    <rect x="108" y="272" width="18" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng T1-02" style="animation-delay:1.10s" />
                    <rect x="140" y="272" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng T1-03" style="animation-delay:2.20s" />

                    <rect x="76" y="312" width="18" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng T2-01" style="animation-delay:3.30s" />
                    <rect x="108" y="312" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng T2-02" style="animation-delay:0.40s" />
                    <rect x="140" y="312" width="18" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng T2-03" style="animation-delay:1.50s" />

                    <rect x="76" y="352" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng T3-01" style="animation-delay:2.60s" />
                    <rect x="108" y="352" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng T3-02" style="animation-delay:3.70s" />
                    <rect x="140" y="352" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng T3-03" style="animation-delay:0.80s" />

                    <rect x="76" y="392" width="18" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng T4-01" style="animation-delay:1.90s" />
                    <rect x="108" y="392" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng T4-02" style="animation-delay:3.00s" />
                    <rect x="140" y="392" width="18" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng T4-03" style="animation-delay:0.10s" />
                </g>

                <!-- Tòa nhà bên phải -->
                <g class="building-group" data-label="Khu nhà ở phía Đông" filter="url(#softShadow)">
                    <rect x="430" y="230" width="110" height="210" rx="10" fill="url(#rightBlockGrad)" />
                    <rect x="426" y="224" width="118" height="12" rx="6" fill="#B69EFF" />

                    <rect x="446" y="252" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng Đ1-01" style="animation-delay:0.00s" />
                    <rect x="478" y="252" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng Đ1-02" style="animation-delay:0.90s" />
                    <rect x="510" y="252" width="18" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng Đ1-03" style="animation-delay:1.80s" />

                    <rect x="446" y="292" width="18" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng Đ2-01" style="animation-delay:2.70s" />
                    <rect x="478" y="292" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng Đ2-02" style="animation-delay:3.60s" />
                    <rect x="510" y="292" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng Đ2-03" style="animation-delay:0.50s" />

                    <rect x="446" y="332" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng Đ3-01" style="animation-delay:1.40s" />
                    <rect x="478" y="332" width="18" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng Đ3-02" style="animation-delay:2.30s" />
                    <rect x="510" y="332" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng Đ3-03" style="animation-delay:3.20s" />

                    <rect x="446" y="372" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng Đ4-01" style="animation-delay:0.10s" />
                    <rect x="478" y="372" width="18" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng Đ4-02" style="animation-delay:1.00s" />
                    <rect x="510" y="372" width="18" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng Đ4-03" style="animation-delay:1.90s" />
                </g>

                <!-- Tòa KTX chính ở giữa -->
                <g class="building-group" data-label="Tòa KTX trung tâm" filter="url(#softShadow)">
                    <rect x="196" y="150" width="208" height="290" rx="12" fill="url(#mainDormGrad)" />
                    <line x1="196" y1="224" x2="404" y2="224" stroke="#4D6BFF" stroke-width="2" opacity="0.55" />
                    <line x1="196" y1="304" x2="404" y2="304" stroke="#4D6BFF" stroke-width="2" opacity="0.55" />
                    <line x1="196" y1="384" x2="404" y2="384" stroke="#4D6BFF" stroke-width="2" opacity="0.55" />

                    <!-- Biển hiệu KÝ TÚC XÁ -->
                    <rect x="186" y="138" width="228" height="36" rx="11" fill="#FFB703" />
                    <rect x="190" y="142" width="220" height="28" rx="9" fill="none" stroke="#FFE082" stroke-width="1.5" opacity="0.8" />
                    <text x="300" y="162" text-anchor="middle" font-size="15.5" font-weight="800" letter-spacing="1" fill="#18214D">KÝ TÚC XÁ</text>

                    <!-- Hàng 1 -->
                    <rect x="216" y="190" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 501" style="animation-delay:0.00s" />
                    <rect x="250" y="190" width="20" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng 502" style="animation-delay:0.70s" />
                    <rect x="284" y="190" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 503" style="animation-delay:1.40s" />
                    <rect x="318" y="190" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 504" style="animation-delay:2.10s" />
                    <rect x="352" y="190" width="20" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng 505" style="animation-delay:2.80s" />

                    <!-- Hàng 2 -->
                    <rect x="216" y="230" width="20" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng 401" style="animation-delay:3.50s" />
                    <rect x="250" y="230" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 402" style="animation-delay:4.20s" />
                    <rect x="284" y="230" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 403" style="animation-delay:0.40s" />
                    <rect x="318" y="230" width="20" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng 404" style="animation-delay:1.10s" />
                    <rect x="352" y="230" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 405" style="animation-delay:1.80s" />

                    <!-- Hàng 3 -->
                    <rect x="216" y="270" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 301" style="animation-delay:2.50s" />
                    <rect x="250" y="270" width="20" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng 302" style="animation-delay:3.20s" />
                    <rect x="284" y="270" width="20" height="24" rx="4" fill="#FF6B8B" stroke="#FFE5EC" stroke-width="1.5" class="me" data-label="Góc phòng của bạn ✨" style="animation-delay:3.90s" />
                    <rect x="318" y="270" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 304" style="animation-delay:0.10s" />
                    <rect x="352" y="270" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 305" style="animation-delay:0.80s" />

                    <!-- Hàng 4 -->
                    <rect x="216" y="310" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 201" style="animation-delay:1.50s" />
                    <rect x="250" y="310" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 202" style="animation-delay:2.20s" />
                    <rect x="284" y="310" width="20" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng 203" style="animation-delay:2.90s" />
                    <rect x="318" y="310" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 204" style="animation-delay:3.60s" />
                    <rect x="352" y="310" width="20" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng 205" style="animation-delay:4.30s" />

                    <!-- Hàng 5 -->
                    <rect x="216" y="350" width="20" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng 101" style="animation-delay:0.50s" />
                    <rect x="250" y="350" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 102" style="animation-delay:1.20s" />
                    <rect x="284" y="350" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 103" style="animation-delay:1.90s" />
                    <rect x="318" y="350" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Phòng 104" style="animation-delay:2.60s" />
                    <rect x="352" y="350" width="20" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Phòng 105" style="animation-delay:3.30s" />

                    <!-- Hàng 6 -->
                    <rect x="216" y="390" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Sảnh sinh hoạt 1" style="animation-delay:4.00s" />
                    <rect x="250" y="390" width="20" height="24" rx="4" fill="url(#winDark)" class="w" data-label="Sảnh sinh hoạt 2" style="animation-delay:0.20s" />
                    <rect x="318" y="390" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Văn phòng BQL" style="animation-delay:1.60s" />
                    <rect x="352" y="390" width="20" height="24" rx="4" fill="url(#winLit)" class="w" data-label="Hỗ trợ sinh viên" style="animation-delay:2.30s" />

                    <!-- Cửa ra vào chính & bậc thềm -->
                    <rect x="278" y="434" width="44" height="6" rx="3" fill="#CBD7FF" />
                    <rect x="284" y="392" width="32" height="44" rx="7" fill="#FFB703" class="door-group" data-label="Cổng vào chính KTX" />
                    <rect x="288" y="397" width="10" height="16" rx="2" fill="#FFF3B0" opacity="0.7" />
                    <rect x="302" y="397" width="10" height="16" rx="2" fill="#FFF3B0" opacity="0.7" />
                    <circle cx="312" cy="416" r="2.2" fill="#18214D" />
                </g>

                <!-- Thảm cỏ & lối đi dạo -->
                <rect y="440" width="600" height="60" fill="url(#grassGrad)" />
                <rect y="460" width="600" height="24" fill="#F8ECCB" />
                <line x1="0" y1="460" x2="600" y2="460" stroke="#E4D2A4" stroke-width="2" />
                <line x1="0" y1="484" x2="600" y2="484" stroke="#D8C28E" stroke-width="2" />
                <g stroke="#DFC996" stroke-width="2" stroke-dasharray="14 14" stroke-linecap="round">
                    <line x1="12" y1="472" x2="590" y2="472" />
                </g>

                <!-- Cây xanh đung đưa -->
                <g transform="translate(36 440) scale(1)">
                    <g class="sw">
                        <ellipse cx="0" cy="2" rx="14" ry="4" fill="#184E32" opacity="0.22" />
                        <rect x="-4" y="-40" width="8" height="40" rx="3" fill="#8A5A3C" />
                        <circle cy="-62" r="28" fill="#2FB96F" />
                        <circle cx="-16" cy="-46" r="18" fill="#47CF86" />
                        <circle cx="16" cy="-48" r="18" fill="#3DC47C" />
                        <circle cx="-6" cy="-68" r="9" fill="#6BE09E" opacity="0.55" />
                    </g>
                </g>
                <g transform="translate(180 440) scale(0.8)">
                    <g class="sw">
                        <ellipse cx="0" cy="2" rx="14" ry="4" fill="#184E32" opacity="0.22" />
                        <rect x="-4" y="-40" width="8" height="40" rx="3" fill="#8A5A3C" />
                        <circle cy="-62" r="28" fill="#2FB96F" />
                        <circle cx="-16" cy="-46" r="18" fill="#47CF86" />
                        <circle cx="16" cy="-48" r="18" fill="#3DC47C" />
                    </g>
                </g>
                <g transform="translate(424 440) scale(0.9)">
                    <g class="sw">
                        <ellipse cx="0" cy="2" rx="14" ry="4" fill="#184E32" opacity="0.22" />
                        <rect x="-4" y="-40" width="8" height="40" rx="3" fill="#8A5A3C" />
                        <circle cy="-62" r="28" fill="#2FB96F" />
                        <circle cx="-16" cy="-46" r="18" fill="#47CF86" />
                        <circle cx="16" cy="-48" r="18" fill="#3DC47C" />
                    </g>
                </g>
                <g transform="translate(566 440) scale(1.1)">
                    <g class="sw">
                        <ellipse cx="0" cy="2" rx="14" ry="4" fill="#184E32" opacity="0.22" />
                        <rect x="-4" y="-40" width="8" height="40" rx="3" fill="#8A5A3C" />
                        <circle cy="-62" r="28" fill="#2FB96F" />
                        <circle cx="-16" cy="-46" r="18" fill="#47CF86" />
                        <circle cx="16" cy="-48" r="18" fill="#3DC47C" />
                    </g>
                </g>

                <!-- Sinh viên đi bộ (chiều thuận) -->
                <g class="wk">
                    <g transform="translate(0 478)">
                        <ellipse cx="0" cy="2" rx="11" ry="3.5" fill="#18214D" opacity="0.22" />
                        <g class="bob">
                            <rect x="-13" y="-38" width="7" height="16" rx="3.5" fill="#18214D" />
                            <rect x="-8" y="-38" width="16" height="24" rx="7" fill="#FF6B8B" />
                            <circle cy="-46" r="8" fill="#FFD2A6" />
                            <path d="M-8-47a8 8 0 0 1 16 0z" fill="#3A2A1E" />
                        </g>
                        <rect x="-6" y="-14" width="5" height="14" rx="2.5" fill="#18214D" />
                        <rect x="1" y="-14" width="5" height="14" rx="2.5" fill="#18214D" />
                    </g>
                </g>

                <!-- Sinh viên đi bộ (chiều ngược) -->
                <g class="wk rv">
                    <g transform="translate(0 478)">
                        <ellipse cx="0" cy="2" rx="11" ry="3.5" fill="#18214D" opacity="0.22" />
                        <g class="bob">
                            <rect x="-13" y="-38" width="7" height="16" rx="3.5" fill="#18214D" />
                            <rect x="-8" y="-38" width="16" height="24" rx="7" fill="#FFB703" />
                            <circle cy="-46" r="8" fill="#FFD2A6" />
                            <path d="M-8-47a8 8 0 0 1 16 0z" fill="#3A2A1E" />
                        </g>
                        <rect x="-6" y="-14" width="5" height="14" rx="2.5" fill="#18214D" />
                        <rect x="1" y="-14" width="5" height="14" rx="2.5" fill="#18214D" />
                    </g>
                </g>
            </svg>
        </div>
    </div>

    <div class="lf">
        <div class="login-card">
            <span class="login-badge">Cổng sinh viên KTX</span>
            <form method="POST" action="{{ route('login.authenticate') }}" novalidate>
                @csrf
                <h2>Đăng nhập</h2>
                <p class="mu login-subtitle">Sử dụng tài khoản do Ban quản lý KTX cấp.</p>

                <div class="form-group">
                    <label for="username">Tài khoản đăng nhập</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}"
                        placeholder="Ví dụ: SV2026001" autocomplete="username" autofocus required>
                    @error('username')
                    <p class="validation-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <div class="password-field">
                        <input id="password" name="password" type="password" autocomplete="current-password"
                            placeholder="Nhập mật khẩu của bạn" data-password-input required>
                        <button type="button" class="password-toggle-btn" data-password-toggle aria-pressed="false">Hiện</button>
                    </div>
                    @error('password')
                    <p class="validation-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                @if ($errors->has('login'))
                <p class="validation-error" role="alert">{{ $errors->first('login') }}</p>
                @endif

                <div class="form-meta">
                    <label class="remember-row" for="remember">
                        <input id="remember" type="checkbox" name="remember" value="1">
                        <span>Ghi nhớ đăng nhập</span>
                    </label>
                </div>

                <button type="submit" class="b submit-button">Đăng nhập</button>
            </form>

            <div class="login-footer-note">
                Cần hỗ trợ tài khoản? Liên hệ <strong>Ban quản lý KTX</strong>.
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<style>
    :root {
        box-sizing: border-box;
        padding-top: env(safe-area-inset-top, 0px);
        padding-bottom: env(safe-area-inset-bottom, 0px);
        --bg: #F3F8FF;
        --card: #fff;
        --ink: #18214D;
        --mut: #5B6489;
        --pri: #2F6BFF;
        --pri-dark: #2152D6;
        --pri2: #E4EEFF;
        --acc: #FFC93C;
        --ok: #0E8F6E;
        --bad: #D93036;
        --warn: #9A6200;
        --line: #DCE7F7;
        --sh: 0 8px 24px rgba(47, 107, 255, .09);
        --card-sh: 0 18px 44px rgba(24, 33, 77, .08), 0 2px 8px rgba(47, 107, 255, .05);
        color-scheme: light
    }

    @media(prefers-color-scheme:dark) {
        :root:not([data-theme="light"]) {
            --bg: #0B1730;
            --card: #13264A;
            --ink: #EEF1FF;
            --mut: #9AA4D6;
            --pri: #6FA3FF;
            --pri-dark: #4E86EB;
            --pri2: #1D3868;
            --ok: #4FD6AE;
            --bad: #FF7B80;
            --warn: #FFC857;
            --line: #24427A;
            --sh: none;
            --card-sh: 0 18px 40px rgba(0, 0, 0, .35);
            color-scheme: dark
        }
    }

    :root[data-theme="dark"] {
        --bg: #0B1730;
        --card: #13264A;
        --ink: #EEF1FF;
        --mut: #9AA4D6;
        --pri: #6FA3FF;
        --pri-dark: #4E86EB;
        --pri2: #1D3868;
        --ok: #4FD6AE;
        --bad: #FF7B80;
        --warn: #FFC857;
        --line: #24427A;
        --sh: none;
        --card-sh: 0 18px 40px rgba(0, 0, 0, .35);
        color-scheme: dark
    }

    html {
        scroll-padding-top: calc(env(safe-area-inset-top, 0px) + 76px)
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0
    }

    body {
        min-height: 100vh;
        font: 15px/1.55 "Be Vietnam Pro", system-ui, -apple-system, "Segoe UI", sans-serif;
        background: var(--bg);
        color: var(--ink)
    }

    button,
    input,
    select,
    textarea {
        font: inherit;
        color: inherit
    }

    :focus-visible {
        outline: 3px solid var(--acc);
        outline-offset: 2px
    }

    h1 {
        font-weight: 800;
        line-height: 1.2
    }

    h2 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 6px
    }

    small,
    .mu {
        color: var(--mut)
    }

    .b {
        background: linear-gradient(135deg, var(--pri), var(--pri-dark));
        color: #fff;
        border: 0;
        border-radius: 12px;
        padding: 12px 18px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(47, 107, 255, .24);
        transition: transform .16s ease, box-shadow .16s ease, filter .16s ease
    }

    .b:hover {
        filter: brightness(1.06);
        transform: translateY(-1.5px);
        box-shadow: 0 12px 24px rgba(47, 107, 255, .3)
    }

    .b:active {
        transform: translateY(0)
    }

    .login-page {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1.1fr 1fr;
    }

    .lp {
        min-height: 100vh;
        position: relative;
        overflow: hidden;
        background: linear-gradient(180deg, #3F8CFF, #7BE0F0 55%, #FFE08A);
        color: #12307A;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px 32px 0;
        text-align: center;
    }

    .lp h1 {
        font-size: 34px;
    }

    .lp p {
        margin: 8px 0 0;
        max-width: 420px;
    }

    #lb {
        position: relative;
        margin: auto -32px 0;
        width: calc(100% + 64px);
        line-height: 0;
    }

    .lb-tooltip {
        position: absolute;
        top: 14px;
        left: 46px;
        z-index: 5;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(24, 33, 77, 0.86);
        color: #FFFDF5;
        font-size: 12.5px;
        font-weight: 600;
        line-height: 1.2;
        letter-spacing: 0.2px;
        backdrop-filter: blur(6px);
        box-shadow: 0 4px 14px rgba(18, 33, 77, 0.22);
        pointer-events: none;
        transition: opacity .2s ease, transform .2s ease;
    }

    .sc {
        display: block;
        width: 100%;
        height: auto;
    }

    .building-group {
        transition: transform .28s cubic-bezier(.22, 1, .36, 1), filter .28s ease;
        transform-box: fill-box;
        transform-origin: center bottom;
    }

    .building-group.is-hovered {
        transform: translateY(-4px);
        filter: brightness(1.04);
    }

    .w,
    .me,
    .door-group {
        cursor: pointer;
        transition: filter .2s ease, transform .2s ease;
        transform-box: fill-box;
        transform-origin: center;
    }

    .w:hover,
    .me:hover {
        filter: brightness(1.25) drop-shadow(0 0 6px rgba(255, 226, 122, 0.85));
        transform: scale(1.08);
    }

    .door-group:hover {
        filter: brightness(1.12);
    }

    .cl {
        animation: dr 32s linear infinite
    }

    .cl.b2 {
        animation-duration: 48s;
        animation-delay: -22s
    }

    @keyframes dr {
        from {
            transform: translateX(-130px)
        }

        to {
            transform: translateX(720px)
        }
    }

    .bi {
        animation: fl 15s linear infinite
    }

    @keyframes fl {
        from {
            transform: translate(-60px, 0)
        }

        to {
            transform: translate(700px, -40px)
        }
    }

    .sw {
        transform-box: fill-box;
        transform-origin: 50% 100%;
        animation: swy 3.5s ease-in-out infinite alternate
    }

    @keyframes swy {
        from {
            transform: rotate(-3deg)
        }

        to {
            transform: rotate(3deg)
        }
    }

    .wk {
        animation: wkk 17s linear infinite
    }

    .wk.rv {
        animation-direction: reverse;
        animation-duration: 24s;
        animation-delay: -8s
    }

    @keyframes wkk {
        from {
            transform: translateX(-80px)
        }

        to {
            transform: translateX(680px)
        }
    }

    .bob {
        animation: bb .45s ease-in-out infinite alternate
    }

    @keyframes bb {
        to {
            transform: translateY(-3px)
        }
    }

    .rays {
        transform-box: fill-box;
        transform-origin: center;
        animation: rt 40s linear infinite
    }

    @keyframes rt {
        to {
            transform: rotate(360deg)
        }
    }

    .w {
        animation: winPulse 4.5s ease-in-out infinite alternate;
    }

    .me {
        animation: meGlow 2.4s ease-in-out infinite alternate;
    }

    @keyframes winPulse {
        0% {
            opacity: .84;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes meGlow {
        0% {
            opacity: .86;
            filter: brightness(1);
        }

        100% {
            opacity: 1;
            filter: brightness(1.18);
        }
    }

    /* Khu vực form bên phải (.lf) */
    .lf {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 36px 28px;
        background:
            radial-gradient(circle at 85% 15%, rgba(47, 107, 255, 0.08), transparent 45%),
            radial-gradient(circle at 15% 88%, rgba(255, 201, 60, 0.12), transparent 42%),
            var(--bg);
    }

    .login-card {
        width: min(420px, 100%);
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 24px;
        padding: 32px 30px 26px;
        box-shadow: var(--card-sh);
    }

    .login-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 999px;
        background: var(--pri2);
        color: var(--pri);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.2px;
        margin-bottom: 14px;
    }

    .lf h2 {
        font-size: 27px;
        font-weight: 800;
        letter-spacing: -0.02em;
        margin-bottom: 4px;
    }

    .login-subtitle {
        font-size: 14px;
        margin-bottom: 22px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        font-size: 13.5px;
        margin-bottom: 6px;
        color: var(--ink);
    }

    .login-page input[type="text"],
    .login-page input[type="password"] {
        display: block;
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid var(--line);
        border-radius: 12px;
        background: var(--bg);
        color: var(--ink);
        font-weight: 400;
        transition: border-color .18s ease, box-shadow .18s ease, background-color .18s ease;
    }

    .login-page input[type="text"]:focus,
    .login-page input[type="password"]:focus {
        outline: none;
        background: var(--card);
        border-color: var(--pri);
        box-shadow: 0 0 0 4px rgba(47, 107, 255, 0.14);
    }

    .login-page input::placeholder {
        color: var(--mut);
        opacity: 0.72;
    }

    .password-field {
        position: relative;
        display: flex;
        align-items: center;
    }

    .password-field input {
        padding-right: 66px;
    }

    .password-toggle-btn {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        border: 0;
        background: var(--pri2);
        color: var(--pri);
        font-size: 12.5px;
        font-weight: 700;
        padding: 5px 10px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color .16s ease, color .16s ease;
    }

    .password-toggle-btn:hover {
        background: var(--pri);
        color: #fff;
    }

    .form-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 6px 0 20px;
    }

    .login-page .remember-row {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        font-size: 13.5px;
        font-weight: 500;
        color: var(--mut);
        cursor: pointer;
        user-select: none;
        margin: 0;
    }

    .login-page .remember-row input[type="checkbox"] {
        width: 17px;
        height: 17px;
        margin: 0;
        accent-color: var(--pri);
        cursor: pointer;
        border-radius: 5px;
    }

    .login-page .validation-error {
        color: var(--bad);
        font-size: 13px;
        font-weight: 500;
        margin-top: 6px;
    }

    .login-page .submit-button {
        width: 100%;
        padding: 12.5px 18px;
        font-size: 15px;
        border-radius: 13px;
    }

    .login-footer-note {
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px dashed var(--line);
        text-align: center;
        font-size: 12.5px;
        color: var(--mut);
    }

    @media (max-width: 820px) {
        .login-page {
            grid-template-columns: 1fr;
        }

        .lp {
            min-height: auto;
            padding: 24px 20px 0;
        }

        .lp h1 {
            font-size: 24px;
        }

        #lb {
            margin: 16px -20px 0;
            width: calc(100% + 40px);
        }

        .lb-tooltip {
            top: 10px;
            left: 26px;
            font-size: 11.5px;
            padding: 5px 10px;
        }

        .lf {
            min-height: auto;
            padding: 24px 16px 36px;
        }

        .login-card {
            padding: 24px 20px 20px;
            border-radius: 20px;
        }
    }

    @media(prefers-reduced-motion:reduce) {

        *,
        *::before,
        *::after {
            animation: none !important;
            transition: none !important
        }

        .w {
            opacity: .85
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Bật/ẩn mật khẩu
        const password = document.querySelector('[data-password-input]');
        const toggle = document.querySelector('[data-password-toggle]');

        if (password && toggle) {
            toggle.addEventListener('click', () => {
                const showing = password.type === 'text';
                password.type = showing ? 'password' : 'text';
                toggle.setAttribute('aria-pressed', String(!showing));
                toggle.textContent = showing ? 'Hiện' : 'Ẩn';
            });
        }

        // Tương tác rê chuột vào tòa nhà, cửa sổ và cửa chính trong #lb
        const container = document.getElementById('lb');
        const tooltip = container ? container.querySelector('[data-lb-tooltip]') : null;
        const defaultText = 'Ký túc xá sinh viên';

        if (container && tooltip) {
            const buildings = container.querySelectorAll('.building-group');
            const interactiveItems = container.querySelectorAll('.w, .me, .door-group');

            buildings.forEach((building) => {
                building.addEventListener('mouseenter', () => {
                    buildings.forEach((b) => b.classList.remove('is-hovered'));
                    building.classList.add('is-hovered');
                    tooltip.textContent = building.getAttribute('data-label') || defaultText;
                });

                building.addEventListener('mouseleave', () => {
                    building.classList.remove('is-hovered');
                    tooltip.textContent = defaultText;
                });
            });

            interactiveItems.forEach((item) => {
                item.addEventListener('mouseenter', (e) => {
                    e.stopPropagation();
                    tooltip.textContent = item.getAttribute('data-label') || defaultText;
                });

                item.addEventListener('mouseleave', (e) => {
                    e.stopPropagation();
                    const parentBuilding = item.closest('.building-group');
                    tooltip.textContent = parentBuilding ?
                        (parentBuilding.getAttribute('data-label') || defaultText) :
                        defaultText;
                });
            });
        }
    });
</script>
@endpush