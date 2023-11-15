<?php

namespace App\Http\Services\Tourguide;

use App\Models\TourguideImage;
use Illuminate\Support\Facades\Storage;

class TourguideImageService
{
    public function getAll($tourguide)
    {
        return TourguideImage::where('tourguide_id', $tourguide->id)->orderByDesc('created_at')->get();
    }

    public function create($request, $tourguideId)
    {
        $files =  explode(',', $request->input('image'));
        $flength = count($files);

        if ($flength > 0) {
            for($i=0; $i <  $flength - 1; $i++) {
                $image_name = current(explode('.', $files[$i]));  
                $name = substr($image_name, -25);
                try {    
                    TourguideImage::create([
                        'name' => (string) $name,
                        'image' => (string) $files[$i],
                        'tourguide_id' => (int) $tourguideId,
                    ]);

                } catch(\Exception $err) {
                    return false;
                }
            }
            return true;
        }  
        return false;
    }

    public function destroy($request)
    {
        $image = TourguideImage::where('id', $request->input('id'))->first();
        if ($image) {
            try {
                $path = str_replace('storage', 'public', $image->image);
                Storage::delete($path);
                return $image->delete();
            } catch(\Exception $err) {
                return false;
            }
        }
        return false;
    }   

    public function destroySelected($request)
    {
        $ids =  explode(',', $request->ids);

        $images = TourguideImage::whereIn('id', $ids)->get();
        $length = count($images);

        if ($images) {
            try {
                for($i = 0; $i < $length; $i++) {
                    $path = str_replace('storage', 'public', $images[$i]->image);
                    Storage::delete($path);
                    $images[$i]->delete();
                }
                return true;
            } catch (\Exception $err) {
                return false;
            }
        }
        return false;
    }
}

