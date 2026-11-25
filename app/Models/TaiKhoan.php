<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
    use Notifiable;

    // Bảng lưu tài khoản trong database
    protected $table = 'tai_khoan';

    // Nếu khóa chính không phải 'id', đổi lại cho đúng (vd: protected $primaryKey = 'ma_tk';)
    // Nếu bảng không có created_at / updated_at, bật dòng dưới:
    // public $timestamps = false;

    protected $fillable = [
        'ten_dang_nhap',
        'mat_khau',
    ];

    protected $hidden = [
        'mat_khau',
        'remember_token',
    ];

    public function getAuthPassword(): string
    {
        return (string) $this->mat_khau;
    }

    protected function casts(): array
    {
        return [
            'mat_khau' => 'hashed',
        ];
    }
}
