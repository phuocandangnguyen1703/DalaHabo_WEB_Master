<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\User\UserService;
use App\Http\Services\Role\RoleService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\User\CreateNewUserFormRequest;
use App\Http\Requests\User\UpdateUserFormRequest;
use App\Models\User;

class UserController extends Controller
{
    protected $userService, $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function all()
    {
        return view('admin.users.all', [
            'title' => 'Tài khoản',
            'menu' => 'Danh sách tài khoản',
            'accounts' => $this->userService->getAll(),
        ]);
    }

    public function create()
    {
        return view('admin.users.add', [
            'title' => 'Tài khoản',
            'menu' => 'Thêm tài khoản',
            'roles' => $this->roleService->getAll(),
        ]);
    }

    public function show(User $user)
    {
        return view('admin.users.edit', [
            'title' => 'Tài khoản',
            'menu' => 'Danh sách tài khoản',
            'item' => $user->name,
            'user' => $user,
            'roles' => $this->roleService->getAll(),
        ]);
    }

    public function store(CreateNewUserFormRequest $request)
    {
        $result = $this->userService->create($request);
        
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Tạo mới thành công'
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }

    public function update(User $user, UpdateUserFormRequest $request)
    {
        $result = $this->userService->update($user, $request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Cập nhật thành công'
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = $this->userService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }

    public function destroySelected(Request $request): JsonResponse
    {
        $result = $this->userService->destroySelected($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công'
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }
}
