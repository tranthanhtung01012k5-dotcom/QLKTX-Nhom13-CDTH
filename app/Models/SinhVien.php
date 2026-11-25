<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SinhVien extends Model
{
    protected $table = 'sinh_vien';

    protected $fillable = [
        'ma_sinh_vien',
        'lop',
        'ngay_sinh',
        'khoa_hoc',
        'so_cccd',
        'ho_va_ten',
        'so_dien_thoai',
        'dia_chi',
        'email',
        'ma_phong',
        'phong_id',
    ];

    public function phong(): BelongsTo
    {
        return $this->belongsTo(Phong::class, 'phong_id', 'id');
    }
}
