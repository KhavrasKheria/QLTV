<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Controller này xử lý đăng nhập và đăng xuất cho hệ thống.
    | Sau khi đăng nhập → vào dashboard (/ad)
    | Sau khi đăng xuất → quay về trang đăng nhập (/login)
    |
    */

    use AuthenticatesUsers;

    /**
     * Nơi chuyển hướng sau khi đăng nhập thành công
     *
     * @var string
     */
    protected $redirectTo = '/ad';

    /**
     * Khởi tạo controller
     */
    public function __construct()
    {
        // Chưa đăng nhập mới được vào login
        $this->middleware('guest')->except('logout');

        // Chỉ user đã đăng nhập mới được logout
        $this->middleware('auth')->only('logout');
    }

    /**
     * Xử lý đăng xuất
     * Logout xong → về trang đăng nhập
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Hủy session hiện tại
        $request->session()->invalidate();

        // Tạo lại token CSRF
        $request->session()->regenerateToken();

        // Chuyển về trang đăng nhập
        return redirect('/login');
    }
}
