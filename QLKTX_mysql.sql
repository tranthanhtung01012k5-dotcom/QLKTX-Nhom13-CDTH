-- =====================================================
-- DATABASE: QUAN LY KY TUC XA
-- QUY TAC: SNAKE_CASE
-- Luu y: Script danh cho database moi / chua co du lieu trung lap.
-- =====================================================

CREATE DATABASE IF NOT EXISTS qlktx
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE qlktx;

-- =====================================================
-- 1. TOA NHA
-- =====================================================

CREATE TABLE IF NOT EXISTS toa_nha (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_toa VARCHAR(50) NOT NULL UNIQUE,
    ten_toa VARCHAR(100) NOT NULL,
    so_tang INT NOT NULL DEFAULT 1,
    trang_thai VARCHAR(50) NOT NULL DEFAULT 'Dang hoat dong',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 2. TANG
-- =====================================================

CREATE TABLE IF NOT EXISTS tang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_tang VARCHAR(50) NOT NULL UNIQUE,
    ten_tang VARCHAR(100) NOT NULL,
    trang_thai VARCHAR(50) NOT NULL DEFAULT 'Dang hoat dong',
    toa_nha_id INT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_tang_toa_nha
        FOREIGN KEY (toa_nha_id)
        REFERENCES toa_nha(id)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 3. LOAI PHONG
-- =====================================================

CREATE TABLE IF NOT EXISTS loai_phong (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_loai_phong VARCHAR(50) NOT NULL UNIQUE,
    ten_loai_phong VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 4. PHONG
-- =====================================================

CREATE TABLE IF NOT EXISTS phong (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_phong VARCHAR(50) NOT NULL UNIQUE,
    ten_phong VARCHAR(100) NOT NULL,
    loai_phong VARCHAR(50) NULL,
    suc_chua INT NOT NULL DEFAULT 4,
    so_nguoi_hien_tai INT NOT NULL DEFAULT 0,
    gia_phong DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    trang_thai VARCHAR(50) NOT NULL DEFAULT 'Trong',

    truong_phong_id INT NULL,
    tang_id INT NULL,
    loai_phong_id INT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_phong_tang
        FOREIGN KEY (tang_id)
        REFERENCES tang(id)
        ON DELETE SET NULL,

    CONSTRAINT fk_phong_loai_phong
        FOREIGN KEY (loai_phong_id)
        REFERENCES loai_phong(id)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 5. SINH VIEN
-- =====================================================

CREATE TABLE IF NOT EXISTS sinh_vien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_sinh_vien VARCHAR(50) NOT NULL UNIQUE,
    lop VARCHAR(50) NULL,
    ngay_sinh DATE NULL,
    khoa_hoc VARCHAR(50) NULL,
    so_cccd VARCHAR(20) NULL UNIQUE,
    ho_va_ten VARCHAR(120) NOT NULL,
    so_dien_thoai VARCHAR(20) NULL,
    dia_chi VARCHAR(255) NULL,
    email VARCHAR(120) NULL,
    ma_phong VARCHAR(50) NULL,
    phong_id INT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_sinh_vien_phong
        FOREIGN KEY (phong_id)
        REFERENCES phong(id)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Them khoa ngoai truong_phong_id sau khi da co bang sinh_vien.
-- Do day la khoa ngoai vong (phong -> sinh_vien -> phong), can them sau.

ALTER TABLE phong
    ADD CONSTRAINT fk_phong_truong_phong
    FOREIGN KEY (truong_phong_id)
    REFERENCES sinh_vien(id)
    ON DELETE SET NULL;

-- =====================================================
-- 6. QUAN LY
-- =====================================================

CREATE TABLE IF NOT EXISTS quan_ly (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_quan_ly VARCHAR(50) NOT NULL UNIQUE,
    phong_ban VARCHAR(100) NULL,
    chuc_vu VARCHAR(100) NULL,
    so_cccd VARCHAR(20) NULL UNIQUE,
    so_dien_thoai VARCHAR(20) NULL,
    ho_ten VARCHAR(120) NOT NULL,
    vai_tro VARCHAR(50) NULL,
    email VARCHAR(120) NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 7. TAI KHOAN
-- VAI TRO: 1 = QUAN LY, 2 = SINH VIEN
-- =====================================================

CREATE TABLE IF NOT EXISTS tai_khoan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_tai_khoan VARCHAR(50) NULL UNIQUE,
    ten_dang_nhap VARCHAR(100) NOT NULL UNIQUE,
    mat_khau VARCHAR(255) NOT NULL,

    nguoi_dung_id INT NULL,

    vai_tro TINYINT NOT NULL DEFAULT 2
        COMMENT '1: Quan ly, 2: Sinh vien',

    trang_thai TINYINT NOT NULL DEFAULT 1
        COMMENT '1: Hoat dong, 0: Khoa',

    remember_token VARCHAR(100) NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 8. DOT DANG KY
-- =====================================================

CREATE TABLE IF NOT EXISTS dot_dang_ky (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_dot VARCHAR(50) NOT NULL UNIQUE,
    ten_dot VARCHAR(150) NOT NULL,
    ngay_bat_dau DATE NULL,
    ngay_ket_thuc DATE NULL,
    chi_tieu INT NOT NULL DEFAULT 0,
    trang_thai VARCHAR(50) NOT NULL DEFAULT 'Mo',

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 9. DON DANG KY
-- =====================================================

CREATE TABLE IF NOT EXISTS don_dang_ky (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_don VARCHAR(50) NOT NULL UNIQUE,
    ngay_nop DATETIME NULL,
    loai_phong_id INT NULL,
    trang_thai_duyet VARCHAR(50) NOT NULL DEFAULT 'Cho duyet',
    ly_do_tu_choi TEXT NULL,

    sinh_vien_id INT NULL,
    dot_dang_ky_id INT NULL,
    phong_id INT NULL,
    quan_ly_id INT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_don_dang_ky_loai_phong
        FOREIGN KEY (loai_phong_id)
        REFERENCES loai_phong(id)
        ON DELETE SET NULL,

    CONSTRAINT fk_don_dang_ky_sinh_vien
        FOREIGN KEY (sinh_vien_id)
        REFERENCES sinh_vien(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_don_dang_ky_dot
        FOREIGN KEY (dot_dang_ky_id)
        REFERENCES dot_dang_ky(id)
        ON DELETE SET NULL,

    CONSTRAINT fk_don_dang_ky_phong
        FOREIGN KEY (phong_id)
        REFERENCES phong(id)
        ON DELETE SET NULL,

    CONSTRAINT fk_don_dang_ky_quan_ly
        FOREIGN KEY (quan_ly_id)
        REFERENCES quan_ly(id)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 10. HOP DONG
-- Tao sau DON DANG KY vi co khoa ngoai don_dang_ky_id.
-- =====================================================

CREATE TABLE IF NOT EXISTS hop_dong (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_hop_dong VARCHAR(50) NOT NULL UNIQUE,

    ngay_ky DATE NULL,
    ngay_bat_dau DATE NOT NULL,
    ngay_ket_thuc DATE NOT NULL,
    ngay_thanh_ly DATE NULL,

    tien_coc DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    gia_phong DECIMAL(12,2) NOT NULL DEFAULT 0.00,

    trang_thai VARCHAR(50) NOT NULL DEFAULT 'Cho ky',
    file_hop_dong VARCHAR(255) NULL,
    ghi_chu TEXT NULL,

    sinh_vien_id INT NULL,
    phong_id INT NULL,
    quan_ly_id INT NULL,
    don_dang_ky_id INT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_hop_dong_sinh_vien
        FOREIGN KEY (sinh_vien_id)
        REFERENCES sinh_vien(id)
        ON DELETE SET NULL,

    CONSTRAINT fk_hop_dong_phong
        FOREIGN KEY (phong_id)
        REFERENCES phong(id)
        ON DELETE SET NULL,

    CONSTRAINT fk_hop_dong_quan_ly
        FOREIGN KEY (quan_ly_id)
        REFERENCES quan_ly(id)
        ON DELETE SET NULL,

    CONSTRAINT fk_hop_dong_don_dang_ky
        FOREIGN KEY (don_dang_ky_id)
        REFERENCES don_dang_ky(id)
        ON DELETE SET NULL,

    -- Mot don dang ky chi lap toi da mot hop dong.
    -- Nhieu hop dong co the de don_dang_ky_id = NULL.
    UNIQUE KEY uq_hop_dong_don_dang_ky (don_dang_ky_id),

    INDEX idx_hop_dong_sinh_vien (sinh_vien_id),
    INDEX idx_hop_dong_phong (phong_id),
    INDEX idx_hop_dong_trang_thai (trang_thai)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 11. YEU CAU ROI KTX
-- =====================================================

CREATE TABLE IF NOT EXISTS yeu_cau_roi_ktx (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_yeu_cau VARCHAR(50) NOT NULL UNIQUE,
    ngay_gui_yeu_cau_roi DATE NULL,
    ly_do TEXT NULL,
    trang_thai VARCHAR(50) NOT NULL DEFAULT 'Cho xu ly',

    nguoi_tao_id INT NULL,
    nguoi_xac_nhan_id INT NULL,
    sinh_vien_id INT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_yeu_cau_roi_sinh_vien
        FOREIGN KEY (sinh_vien_id)
        REFERENCES sinh_vien(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_yeu_cau_roi_nguoi_tao
        FOREIGN KEY (nguoi_tao_id)
        REFERENCES tai_khoan(id)
        ON DELETE SET NULL,

    CONSTRAINT fk_yeu_cau_roi_nguoi_xac_nhan
        FOREIGN KEY (nguoi_xac_nhan_id)
        REFERENCES quan_ly(id)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 12. KY LUAT
-- =====================================================

CREATE TABLE IF NOT EXISTS ky_luat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_vi_pham VARCHAR(50) NOT NULL UNIQUE,
    ten_vi_pham VARCHAR(150) NOT NULL,
    ngay_vi_pham DATE NULL,
    hinh_thuc_xu_ly VARCHAR(150) NULL,
    muc_phat DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    minh_chung VARCHAR(255) NULL,
    trang_thai VARCHAR(50) NOT NULL DEFAULT 'Da ghi nhan',

    sinh_vien_id INT NULL,
    quan_ly_id INT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_ky_luat_sinh_vien
        FOREIGN KEY (sinh_vien_id)
        REFERENCES sinh_vien(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_ky_luat_quan_ly
        FOREIGN KEY (quan_ly_id)
        REFERENCES quan_ly(id)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 13. THONG BAO
-- =====================================================

CREATE TABLE IF NOT EXISTS thong_bao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_thong_bao VARCHAR(50) NOT NULL UNIQUE,
    tieu_de VARCHAR(200) NOT NULL,
    noi_dung TEXT NOT NULL,
    doi_tuong_nhan VARCHAR(100) NULL,
    ngay_tao DATETIME NULL,
    trang_thai VARCHAR(50) NOT NULL DEFAULT 'Hien thi',

    quan_ly_id INT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_thong_bao_quan_ly
        FOREIGN KEY (quan_ly_id)
        REFERENCES quan_ly(id)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 14. SU CO
-- =====================================================

CREATE TABLE IF NOT EXISTS su_co (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_su_co VARCHAR(50) NOT NULL UNIQUE,
    loai_su_co VARCHAR(100) NOT NULL,
    vi_tri VARCHAR(150) NULL,
    mo_ta TEXT NULL,
    muc_do_uu_tien VARCHAR(50) NULL,
    anh_minh_hoa VARCHAR(255) NULL,
    ghi_chu_xu_ly TEXT NULL,
    ngay_bao_cao DATETIME NULL,
    ngay_hoan_thanh DATETIME NULL,

    phong_id INT NULL,
    sinh_vien_id INT NULL,
    quan_ly_id INT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_su_co_phong
        FOREIGN KEY (phong_id)
        REFERENCES phong(id)
        ON DELETE SET NULL,

    CONSTRAINT fk_su_co_sinh_vien
        FOREIGN KEY (sinh_vien_id)
        REFERENCES sinh_vien(id)
        ON DELETE SET NULL,

    CONSTRAINT fk_su_co_quan_ly
        FOREIGN KEY (quan_ly_id)
        REFERENCES quan_ly(id)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 15. CHI SO DIEN NUOC
-- =====================================================

CREATE TABLE IF NOT EXISTS chi_so_dien_nuoc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_chi_so VARCHAR(50) NOT NULL UNIQUE,
    ngay_ghi DATETIME NULL,

    chi_so_dien_cu INT NOT NULL DEFAULT 0,
    chi_so_dien_moi INT NOT NULL DEFAULT 0,

    chi_so_nuoc_cu INT NOT NULL DEFAULT 0,
    chi_so_nuoc_moi INT NOT NULL DEFAULT 0,

    ma_phong VARCHAR(50) NULL,
    nguoi_cap_nhat VARCHAR(100) NULL,
    phong_id INT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_chi_so_dien_nuoc_phong
        FOREIGN KEY (phong_id)
        REFERENCES phong(id)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 16. GIA TIEN
-- =====================================================

CREATE TABLE IF NOT EXISTS gia_tien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_loai_tien VARCHAR(50) NOT NULL UNIQUE,
    ten_loai_tien VARCHAR(100) NOT NULL,
    don_gia DECIMAL(12,2) NOT NULL DEFAULT 0.00,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 17. HOA DON
-- =====================================================

CREATE TABLE IF NOT EXISTS hoa_don (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_hoa_don VARCHAR(50) NOT NULL UNIQUE,
    loai_hoa_don VARCHAR(50) NULL,
    ky_thanh_toan VARCHAR(50) NULL,

    tien_dien DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    tien_nuoc DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    tien_phong DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    tong_tien DECIMAL(12,2) NOT NULL DEFAULT 0.00,

    ngay_phat_hanh DATE NULL,
    han_thanh_toan DATE NULL,
    trang_thai VARCHAR(50) NOT NULL DEFAULT 'Chua thanh toan',

    ma_giao_dich VARCHAR(100) NULL,
    so_tien DECIMAL(12,2) NULL,
    phuong_thuc VARCHAR(50) NULL,
    ngay_thanh_toan DATETIME NULL,
    anh_chung_tu VARCHAR(255) NULL,

    sinh_vien_id INT NULL,
    phong_id INT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_hoa_don_sinh_vien
        FOREIGN KEY (sinh_vien_id)
        REFERENCES sinh_vien(id)
        ON DELETE SET NULL,

    CONSTRAINT fk_hoa_don_phong
        FOREIGN KEY (phong_id)
        REFERENCES phong(id)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 18. DU LIEU MAU
-- =====================================================

-- TOA NHA
INSERT INTO toa_nha
(id, ma_toa, ten_toa, so_tang, trang_thai, created_at, updated_at)
VALUES
(1, 'TN01', 'Tòa A - Khu KTX Trung Tâm', 5, 'Dang hoat dong', NOW(), NOW()),
(2, 'TN02', 'Tòa B - Khu KTX Sinh Viên', 4, 'Dang hoat dong', NOW(), NOW());

-- TANG
INSERT INTO tang
(id, ma_tang, ten_tang, trang_thai, toa_nha_id, created_at, updated_at)
VALUES
(1, 'T_A1', 'Tầng 1 - Tòa A', 'Dang hoat dong', 1, NOW(), NOW()),
(2, 'T_A3', 'Tầng 3 - Tòa A', 'Dang hoat dong', 1, NOW(), NOW()),
(3, 'T_B1', 'Tầng 1 - Tòa B', 'Dang hoat dong', 2, NOW(), NOW());

-- LOAI PHONG
INSERT INTO loai_phong
(id, ma_loai_phong, ten_loai_phong, created_at, updated_at)
VALUES
(1, 'LP01', 'Phòng 4 người tiêu chuẩn', NOW(), NOW()),
(2, 'LP02', 'Phòng 6 người dịch vụ', NOW(), NOW());

-- PHONG
INSERT INTO phong
(id, ma_phong, ten_phong, loai_phong, suc_chua,
 so_nguoi_hien_tai, gia_phong, trang_thai,
 truong_phong_id, tang_id, loai_phong_id,
 created_at, updated_at)
VALUES
(1, 'P303', 'Phòng 303', 'Loai 1', 4, 1,
 1200000.00, 'Trong', NULL, 2, 1, NOW(), NOW()),
(2, 'P102', 'Phòng 102', 'Loai 2', 6, 0,
 900000.00, 'Trong', NULL, 1, 2, NOW(), NOW());

-- SINH VIEN
INSERT INTO sinh_vien
(id, ma_sinh_vien, lop, ngay_sinh, khoa_hoc, so_cccd,
 ho_va_ten, so_dien_thoai, dia_chi, email,
 ma_phong, phong_id, created_at, updated_at)
VALUES
(1, 'SV2026001', 'CNTT26A', '2005-08-15', 'K26',
 '037205001234', 'Nguyễn Văn An', '0912345678',
 'Ninh Bình', 'an.sv@ktx.edu.vn',
 'P303', 1, NOW(), NOW());

-- CAP NHAT TRUONG PHONG
UPDATE phong
SET truong_phong_id = 1,
    so_nguoi_hien_tai = 1
WHERE id = 1;

-- QUAN LY
INSERT INTO quan_ly
(id, ma_quan_ly, phong_ban, chuc_vu, so_cccd,
 so_dien_thoai, ho_ten, vai_tro, email,
 created_at, updated_at)
VALUES
(1, 'QL001', 'Ban Quản Lý KTX', 'Trưởng Ban Quản Lý',
 '037085009876', '0987654321', 'Trần Minh Quân',
 'Quan ly', 'quanly@ktx.edu.vn', NOW(), NOW());

-- TAI KHOAN
-- Mat khau ca hai tai khoan: 123456 (ma hoa BCrypt)
INSERT INTO tai_khoan
(id, ma_tai_khoan, ten_dang_nhap, mat_khau,
 nguoi_dung_id, vai_tro, trang_thai,
 remember_token, created_at, updated_at)
VALUES
(1, 'TK_QL01', 'admin_ktx',
 '$2y$12$11UKyKQdjbqsn53lQRQ6oeoS/4Vcs0xEU5ivADCPJr3f2EA/.ciMC',
 1, 1, 1, NULL, NOW(), NOW()),
(2, 'TK_SV01', 'SV2026001',
 '$2y$12$11UKyKQdjbqsn53lQRQ6oeoS/4Vcs0xEU5ivADCPJr3f2EA/.ciMC',
 1, 2, 1, NULL, NOW(), NOW());

-- GIA TIEN
INSERT INTO gia_tien
(id, ma_loai_tien, ten_loai_tien, don_gia, created_at, updated_at)
VALUES
(1, 'GT_DIEN', 'Giá điện sinh hoạt (kWh)', 3500.00, NOW(), NOW()),
(2, 'GT_NUOC', 'Giá nước sinh hoạt (m3)', 12000.00, NOW(), NOW());

-- DOT DANG KY
INSERT INTO dot_dang_ky
(id, ma_dot, ten_dot, ngay_bat_dau, ngay_ket_thuc,
 chi_tieu, trang_thai, created_at, updated_at)
VALUES
(1, 'DOT_2026_1',
 'Đợt đăng ký ở KTX học kỳ 1 năm 2026',
 '2026-08-01', '2026-09-15',
 200, 'Mo', NOW(), NOW());

-- THONG BAO
INSERT INTO thong_bao
(id, ma_thong_bao, tieu_de, noi_dung, doi_tuong_nhan,
 ngay_tao, trang_thai, quan_ly_id, created_at, updated_at)
VALUES
(1, 'TB001',
 'Thông báo đóng tiền phòng và điện nước',
 'Sinh viên vui lòng thanh toán hóa đơn trước ngày 10 hàng tháng.',
 'Sinh vien', NOW(), 'Hien thi', 1, NOW(), NOW());

-- HOA DON
INSERT INTO hoa_don
(id, ma_hoa_don, loai_hoa_don, ky_thanh_toan,
 tien_dien, tien_nuoc, tien_phong, tong_tien,
 ngay_phat_hanh, han_thanh_toan, trang_thai,
 ma_giao_dich, so_tien, phuong_thuc, ngay_thanh_toan,
 anh_chung_tu, sinh_vien_id, phong_id,
 created_at, updated_at)
VALUES
(1, 'HD202611_303', 'Tong hop', '11/2026',
 140000.00, 60000.00, 1200000.00, 1400000.00,
 '2026-11-01', '2026-11-10', 'Chua thanh toan',
 NULL, 1400000.00, NULL, NULL, NULL,
 1, 1, NOW(), NOW());

-- HOP DONG: chen sau khi sinh_vien, phong va quan_ly da co du lieu.
-- don_dang_ky_id de NULL vi bo du lieu mau nay chua tao don dang ky.
INSERT INTO hop_dong (
    id,
    ma_hop_dong,
    ngay_ky,
    ngay_bat_dau,
    ngay_ket_thuc,
    ngay_thanh_ly,
    tien_coc,
    gia_phong,
    trang_thai,
    file_hop_dong,
    ghi_chu,
    sinh_vien_id,
    phong_id,
    quan_ly_id,
    don_dang_ky_id,
    created_at,
    updated_at
)
VALUES (
    1,
    'HDKTX2026001',
    '2026-08-01',
    '2026-08-01',
    '2027-01-31',
    NULL,
    1200000.00,
    1200000.00,
    'Dang hieu luc',
    NULL,
    'Hợp đồng lưu trú học kỳ 1 năm học 2026-2027',
    1,
    1,
    1,
    NULL,
    NOW(),
    NOW()
);

-- =====================================================
-- 19. KIEM TRA DU LIEU
-- =====================================================

-- SELECT * FROM toa_nha;
-- SELECT * FROM tang;
-- SELECT * FROM loai_phong;
-- SELECT * FROM phong;
-- SELECT * FROM sinh_vien;
-- SELECT * FROM quan_ly;
-- SELECT * FROM tai_khoan;
-- SELECT * FROM dot_dang_ky;
-- SELECT * FROM don_dang_ky;
-- SELECT * FROM hop_dong;
-- SELECT * FROM yeu_cau_roi_ktx;
-- SELECT * FROM ky_luat;
-- SELECT * FROM thong_bao;
-- SELECT * FROM su_co;
-- SELECT * FROM chi_so_dien_nuoc;
-- SELECT * FROM gia_tien;
-- SELECT * FROM hoa_don;
