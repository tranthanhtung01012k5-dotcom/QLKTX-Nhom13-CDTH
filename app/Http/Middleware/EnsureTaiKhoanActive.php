<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTaiKhoanActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $guard = Auth::guard('tai_khoan');
        $account = $guard->user();

        if (!$account) {
            return redirect()->route('login');
        }

        // Ví dụ: nếu bảng taikhoan có cột trang_thai (1 = hoạt động, 0 = bị khóa)
        // Đổi tên cột cho khớp với bảng `taikhoan` thực tế của bạn
        if (isset($account->trang_thai) && (int) $account->trang_thai === 0) {
            $guard->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors(['login' => 'Tài khoản của bạn hiện đang bị khóa. Vui lòng liên hệ Ban quản lý KTX.']);
        }

        return $next($request);
    }
}
