<?php

namespace App\Http\Services\Category;

use App\Models\Category;
use App\Models\Place;
use App\Models\PlaceImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class CategoryService
{

    public function getAll()
    {
        return Category::orderBy('id')->search()->get();
    }

    public function count()
    {
        return Category::count();
    }

    public function getPlacesbyCategoryID($id) {
        return Place::where('category_id', $id)->get();
    }

    public function create($request)
    {
        try {
            $request->except("_token");
            Category::create([
                'name' => (string) $request->input('name'),
                'description' => (string) $request->input('description'),
                'active' => (int) $request->input('active'),
            ]);
        } catch (\Exception $err) {
            return false;
        }
        return true;
    }

    public function update($category, $request)
    {
        try {
            $category->fill($request->input());
            $category->save();

            return true;
        } catch (\Exception $err) {
            return false;
        }
    }

    public function destroyImages($images) {
        $length = count($images);
        if ($images) {
            for($i = 0; $i < $length; $i++) {
                $path = str_replace('storage', 'public', $images[$i]->image);
                Storage::delete($path);
                $images[$i]->delete();
            }
            return true;
        }
        return false;
    }

    public function destroyPlaces($places) {
        $length = count($places);
        if ($places) {
            for($i = 0; $i < $length; $i++) {
                $images = PlaceImage::where('place_id', $places[$i]->id)->get();
                $result = $this->destroyImages($images);
                if ($result === true) {
                    $places[$i]->delete();
                }
            }
            return true;
        }
        return false;
    }

    public function destroy($request)
    {
        $id = $request->input('id');
        $category = Category::find($id);
        
        if ($category) {
            $places = $this->getPlacesbyCategoryID($id);
            $result = $this->destroyPlaces($places);
            if ($result === true) {
                return $category->delete();
            }
            return false;
        }
        return false;
    }

    public function destroySelected($request)
    {
        $ids =  explode(',', $request->ids);

        $categories = Category::whereIn('id', $ids)->get();
        $length = count($categories);
        
        if ($categories) {
            try {
                for($i = 0; $i < $length; $i++) {
                    $places = $this->getPlacesbyCategoryID($categories[$i]->id);
                    $result = $this->destroyPlaces($places);
                    if ($result) {
                        $categories[$i]->delete();
                    }
                }
                return true;
            } catch (\Exception $err) {
                return false;
            }
        }
        return false;
    }
}
