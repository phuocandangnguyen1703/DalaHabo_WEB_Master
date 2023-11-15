<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;
use App\Http\Requests\User\CreateFormRequest;

class RoleController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function all()
    {
        return view('admin.accounts.all', [
            'title' => 'Tài khoản',
            'menu' => 'Danh sách tài khoản',
            // 'roles' => $this->userService->getAll(),
            // 'count' => $this->userService->count(),
        ]);
    }
}
