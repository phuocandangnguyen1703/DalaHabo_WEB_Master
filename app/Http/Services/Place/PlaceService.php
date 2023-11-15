<?php

namespace App\Http\Services\Place;

use App\Models\Place;
use App\Models\PlaceImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PlaceService
{

    public function getAll()
    {
        return Place::with('category')->orderBy('id')->search()->paginate(10);
    }

    public function getPlaceId()
    {
        $place = Place::all()->last();
        return $place->id;
    }

    public function count()
    {
        return Place::count();
    }

    public function create($request)
    {
        try {
            $request->except("_token");
            Place::create([
                'name' => (string) $request->input('name'),
                'category_id' => (int) $request->input('categoryId'),
                'address' => (string) $request->input('address'),
                'location' => (string) $request->input('location'),
                'summary' => (string) $request->input('summary'),
                'description' => (string) $request->input('description'),
            ]);
            return true;
        } catch (\Exception $err) {
            return false;
        }
    }

    public function update($place, $request)
    {
        try {
            $request->except("_token");
            $place->fill($request->input());
            $place->save();

            return $place;
        } catch (\Exception $err) {
            return $err;
        }
    }

    public function destroyImages($id) {
        $images = PlaceImage::where('place_id', $id)->get();
        $length = count($images);
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

    public function destroy($request)
    {
        $id = $request->input('id');
        $place = Place::find($id);

        if ($place) {
            $this->destroyImages($id);
            
            $place->delete();
            return true;
        }
        return false;
    }

    public function destroySelected($request)
    {
        $ids =  explode(',', $request->ids);
        $places = Place::whereIn('id', $ids)->get();
        $length = count($places);

        if ($places) {
            try {
                for($i = 0; $i < $length; $i++) {
                    $this->destroyImages($places[$i]->id);
                    $places[$i]->delete();
                }
                return true;
            } catch (\Exception $err) {
                return false;
            }
        }
        return false;
    }
}
