<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm(LoginRequest $request)
    {
        if ($request->isMethod('POST')) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                toastr()->success('Đăng nhập thành công', 'Thông báo');
                if (Auth::user()->role != 1) {
                    return redirect()->route('admin.order.index');
                }
                return redirect()->route('admin.dashboard-analytics');
            }
            toastr()->info('Email hoặc mật khẩu không chính xác', 'Thông báo');
            return redirect()->back();
        }
        return view('auth.login');
    }

    public function registerForm(RegisterRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = [
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role'=>0
            ];
            $createUser = User::create($params);
            toastr()->success('Đăng ký thành công', 'Thông báo');
            return redirect()->route('login');
        }
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();
        toastr()->success('Đăng xuất thành công', 'Thông báo');
        return redirect()->back();
    }
}
