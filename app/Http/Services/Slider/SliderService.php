<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function create($request)
    {
        try {
            $request->except("_token");
            Slider::create($request->input());
        } catch (\Exception $err) {
            return false;
        }
        return true;
    }

    public function getAll()
    {
        return Slider::orderBy('id')->search()->get();
    }

    public function count()
    {
        return Slider::count();
    }

    public function update($slider, $request)
    {
        try {
            $slider->fill($request->input());
            $slider->save();

            return true;
        } catch (\Exception $err) {
            return false;
        }
    }

    public function destroy($request)
    {
        $id = $request->input('id');
        $slider = Slider::find($id);
        if ($slider) {
            try {
                $path = str_replace('storage', 'public', $slider->image);
                Storage::delete($path);
                return $slider->delete();
            } catch (\Exception $err) {
                return false;
            }
        }
        return false;
    }

    public function destroySelected($request)
    {
        $ids =  explode(',', $request->ids);

        $sliders = Slider::whereIn('id', $ids)->get();
        $length = count($sliders);

        if ($sliders) {
            try {
                for($i = 0; $i < $length; $i++) {
                    $path = str_replace('storage', 'public', $sliders[$i]->image);
                    Storage::delete($path);
                    $sliders[$i]->delete();
                }
                return true;
            } catch (\Exception $err) {
                return false;
            }
        }
        return false;
    }
}
