<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\DangNhapRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public const ROLE_ADMIN = 1;
    public const ROLE_STUDENT = 2;

    private function guard()
    {
        return Auth::guard('tai_khoan');
    }

    /**
     * Xác định route đích theo vai trò tài khoản.
     * Đổi 'vai_tro' thành tên cột vai trò thực tế trong bảng `taikhoan` (vd: 'role', 'ma_vai_tro').
     */
    private function redirectRouteByRole(object $user): ?string
    {
        $role = (int) ($user->vai_tro ?? 0);

        return match ($role) {
            self::ROLE_ADMIN => 'quanly.dashboard',     // 1: Quản lý
            self::ROLE_STUDENT => 'sinhvien.dashboard', // 2: Sinh viên
            default => null,
        };
    }

    public function show(): View|RedirectResponse
    {
        if ($this->guard()->check()) {
            $targetRoute = $this->redirectRouteByRole($this->guard()->user());

            if ($targetRoute) {
                return redirect()->route($targetRoute);
            }
        }

        return view('dangnhap.dangNhap');
    }

    public function authenticate(DangNhapRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Đổi 'username' thành tên cột đăng nhập thực tế trong bảng `taikhoan`
        $credentials = [
            'ten_dang_nhap' => $validated['username'],
            'password' => $validated['password'],
        ];

        if ($this->guard()->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = $this->guard()->user();

            // Kiểm tra tài khoản có bị khóa không (nếu bảng có cột `trang_thai`)
            if (isset($user->trang_thai) && (int) $user->trang_thai === 0) {
                $this->guard()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()
                    ->withErrors(['login' => 'Tài khoản của bạn hiện đang bị khóa.'])
                    ->onlyInput('username');
            }

            // Kiểm tra vai trò: 1 = Quản lý, 2 = Sinh viên
            $targetRoute = $this->redirectRouteByRole($user);

            if (!$targetRoute) {
                $this->guard()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()
                    ->withErrors(['login' => 'Vai trò tài khoản không hợp lệ. Vui lòng liên hệ Ban quản lý KTX.'])
                    ->onlyInput('username');
            }

            return redirect()->intended(route($targetRoute));
        }

        return back()
            ->withErrors(['login' => 'Thông tin đăng nhập không chính xác.'])
            ->onlyInput('username');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('tai_khoan')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
