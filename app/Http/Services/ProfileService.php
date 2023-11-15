<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    public function updateInfo($request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        if($user) {
            $user->update([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
            ]);
            
            return true;
        }
        return false;
    }

    public function destroyOldPicture($old) {
        $old_path = str_replace('storage', 'public', $old);
        Storage::delete($old_path); 
    }

    public function storePicture($file, $path, $new_image_name) {
        try {
            $file->storeAs(
                'public/' . $path,  $new_image_name
            );
            return '/storage/' . $path . '/' . $new_image_name;
        } catch (\Exception $err) {
            return false;
        }
    }

    public function updatePicture($request)
    {
        $path = 'uploads/users';

        $file = $request->file('admin_image');

        $new_image_name = 'UIMG'.date('Ymd').uniqid().'.jpg';
        
        $path_full = $this->storePicture($file, $path, $new_image_name);

        if($path_full) {
            $user = User::find(Auth::user()->id);
            $old = $user->getAttributes()['image'];
            if($old != '') {
                $this->destroyOldPicture($old);      
            }
            
            $update = $user->update(['image' => $path_full]);

            if($update) {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Cập nhật ảnh đại diện thành công'
                ]);
            }
        }
        return response()->json([
            'status' => 0,
            'msg' => 'Có lỗi xảy ra. Vui lòng thử lại.'
        ]);         
    }

    public function changePassword($request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $result = Hash::check($request->input('old_password'), $user->password);

        if ($result) {
            $user->update([
                'password' => bcrypt($request->input('new_password')),
            ]);

            return true;
        }
        return false;
    }
}
