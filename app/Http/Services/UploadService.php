<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

class UploadService
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                $file = $request->file('file');
                $folder = $request->input('folder');
                $pre = strtoupper(substr($folder, 0, 1));

                $name = $pre . 'IMG' . date('Ymd') . uniqid() . '.' . $file->getClientOriginalExtension();

                $path_full = 'uploads/' . $folder;
                $file->storeAs(
                    'public/' . $path_full, $name
                );

                return '/storage/' . $path_full . '/' . $name;

            } catch(\Exception $err) {
                return false;
            }
        }
        
    }

    public function destroy($request)
    {
        try {
            $path = str_replace('storage', 'public', $request->input('val'));
            Storage::delete($path);
            return true;
        } catch (\Exception $err){
            return false;
        }
        
    }
}
