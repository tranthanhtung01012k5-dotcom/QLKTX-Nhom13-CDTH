<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ThanhToanRequest extends FormRequest
{
    public const PHUONG_THUC = [
        'Chuyen khoan' => 'Chuyển khoản ngân hàng',
        'Vi dien tu'   => 'Ví điện tử (Momo, ZaloPay...)',
        'Tien mat'     => 'Tiền mặt tại phòng Quản lý KTX',
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $khongPhaiTienMat = $this->input('phuong_thuc') !== 'Tien mat';

        return [
            'phuong_thuc' => ['required', Rule::in(array_keys(self::PHUONG_THUC))],
            'ma_giao_dich' => [
                $khongPhaiTienMat ? 'required' : 'nullable',
                'string',
                'max:100',
                'regex:/^[A-Za-z0-9\-_\.\/ ]+$/',
            ],
            'anh_chung_tu' => [
                $khongPhaiTienMat ? 'required' : 'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:4096',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'phuong_thuc.required'     => 'Vui lòng chọn phương thức thanh toán.',
            'phuong_thuc.in'           => 'Phương thức thanh toán không hợp lệ.',
            'ma_giao_dich.required'    => 'Vui lòng nhập mã giao dịch.',
            'ma_giao_dich.max'         => 'Mã giao dịch không được vượt quá 100 ký tự.',
            'ma_giao_dich.regex'       => 'Mã giao dịch chỉ gồm chữ, số và các ký tự - _ . /',
            'anh_chung_tu.required'    => 'Vui lòng tải lên ảnh/biên lai chứng từ thanh toán.',
            'anh_chung_tu.file'        => 'Tệp chứng từ không hợp lệ.',
            'anh_chung_tu.mimes'       => 'Chứng từ chỉ chấp nhận định dạng JPG, PNG, WEBP hoặc PDF.',
            'anh_chung_tu.max'         => 'Chứng từ không được vượt quá 4 MB.',
            'anh_chung_tu.uploaded'    => 'Tải chứng từ lên thất bại (có thể do dung lượng quá lớn).',
        ];
    }
}
