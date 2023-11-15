<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Services\User\UserService;
use App\Http\Requests\User\CreateFormRequest;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('admin.auth.login', [
            'title' => 'Đăng nhập',
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $remember_token = $request->has('remember_token') ? true : false;

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ], $remember_token)) {

            $result = $this->userService->getUser($request);
            Session::put('user', $result);

            return redirect()->route('admin');
        }

        Session::flash('error', 'Email hoặc mật khẩu không đúng');

        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}
