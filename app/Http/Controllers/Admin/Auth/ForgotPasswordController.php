<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('admin.auth.forgot', [
            'title' => 'Quên mật khẩu',
        ]);
    }

    public function sendEmail($data) {
        Mail::send('email.email_forgot', ['data' => $data], function($email) use($data) {
            $email->subject($data['title']);
            $email->to($data['email']);
        });
    }

    public function store(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if($user !== null) {
            $token = Str::random(50);
            $user->token = $token;
            $user->save();

            $title = 'DalaHabo Admin - Đặt lại mật khẩu';
            $email = $user->email;
            $name = $user->name;
           
            $link_reset_password = url('/admin/reset-password?email=' . $email . '&token='. $token);
            $data = array(
                "title" => $title,
                "link" => $link_reset_password,
                "email" => $email,
                "name" => $name,
            );
            $this->sendEmail($data);

            return redirect()->back()->with('success', 'Email xác nhận đã được gửi. Vui lòng kiểm tra email của bạn');
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy email người dùng');
        }
    }

    
}
