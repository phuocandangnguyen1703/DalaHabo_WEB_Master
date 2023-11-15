<?php

namespace App\Http\Services\Place;

use App\Models\PlaceImage;
use Illuminate\Support\Facades\Storage;

class PlaceImageService
{
    public function getAll($place)
    {
        return PlaceImage::where('place_id', $place->id)->orderByDesc('created_at')->get();
    }
    
    public function create($request, $placeId)
    {
        $files =  explode(',', $request->input('image'));
        $flength = count($files);

        if ($flength > 0) {
            for($i=0; $i <  $flength - 1; $i++) {
                $image_name = current(explode('.', $files[$i])); 
                $name = substr($image_name, -25);
                try {    
                    PlaceImage::create([
                        'name' => (string) $name,
                        'image' => (string) $files[$i],
                        'place_id' => (int) $placeId,
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
        $image = PlaceImage::where('id', $request->input('id'))->first();
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

        $images = PlaceImage::whereIn('id', $ids)->get();
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

