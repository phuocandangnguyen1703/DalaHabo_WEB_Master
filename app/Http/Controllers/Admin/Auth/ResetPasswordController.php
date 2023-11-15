<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('admin.auth.reset', [
            'title' => 'Đặt lại mật khẩu',
        ]);
        
    }

    public function store(Request $request)
    {
        // validate
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu mới của bạn.',
            'confirm_password.required' => 'Vui lòng xác nhận mật khẩu mới.',
            'confirm_password.same' => "Mật khẩu không khớp."
        ]);

        $user = User::where('email', $request->input('email'))->where('token', $request->input('token'))->first();
        if ($user !== null) {
            $password = bcrypt($request->password);
            $user->password = $password;
            $user->token = NULL;
            $user->save();

            return redirect()->route('login')->with('success', 'Lấy lại mật khẩu thành công.');
        }
        return redirect()->route('password.forgot')->with('error', 'Đường dẫn đã hết hạn. Vui lòng nhập lại email xác nhận.');
        
    }
}
