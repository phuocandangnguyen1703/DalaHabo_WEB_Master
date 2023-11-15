<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\ProfileService;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function show_profile()
    {
        return view('admin.profile', [
            'title' => 'Thông tin tài khoản',
            'menu' => 'Thông tin tài khoản',
        ]);
    }

    public function updateInfo(Request $request)
    {
        $result = $this->profileService->updateInfo($request);

        if($result) {
            return response()->json([
                'error' => false,
                'message' => 'Cập nhật thông tin tài khoản thành công'
            ]);
        }
        return response()->json([
            'error' => true
        ]);  
    }

    public function updatePicture(Request $request)
    {   
        $result = $this->profileService->updatePicture($request);
       
        if($result) {
            return response()->json([
                'status' => 1,
                'msg' => 'Cập nhật ảnh đại diện thành công'
            ]);
        }
        return response()->json([
            'status' => 0,
            'msg' => 'Có lỗi xảy ra. Vui lòng thử lại.'
        ]);         
    }

    public function changePassword(Request $request)
    {
        $result = $this->profileService->changePassword($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Đổi mật khẩu thành công'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Mật khẩu cũ không chính xác. <br> Vui lòng thử lại.'
        ]);
    }
}
