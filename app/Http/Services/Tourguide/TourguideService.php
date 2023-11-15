<?php

namespace App\Http\Services\Tourguide;

use App\Models\Tourguide;
use App\Models\TourguideImage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TourguideService
{
    public function getAll()
    { 
        return Tourguide::orderBy('id')->search()->paginate(10);   
    }

    public function getTourguideId()
    {
        $tourguide = Tourguide::all()->last();
        return $tourguide->id;
    }

    public function count()
    {
        return Tourguide::count();
    }

    public function create($request)
    {
        try {
            $request->except("_token");
            Tourguide::create([
                'name' => (string) $request->input('name'),
                'dob' => (string) $request->input('dob'),
                'gender' => (integer) $request->input('gender'),
                'email' => (string) $request->input('email'),
                'phone' => (string) $request->input('phone'),
                'short_description' => (string) $request->input('short_description'),
                'description' => (string) $request->input('description'),
                'rental_price' => (double) $request->input('rental_price'),
            ]);
            return true;
        } catch (\Exception $err) {
            return false;
        }
    }

    public function update($tourguide, $request)
    {
        try {
            $tourguide->fill($request->input());
            $tourguide->save();

            return true;
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function destroyImages($id) {
        $images = TourguideImage::where('tourguide_id', $id)->get();
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
        $tourguide = Tourguide::find($id);

        if ($tourguide) {
            $rs = $this->destroyImages($id);
            if ($rs) {
                return $tourguide->delete();
            }
            return false;
        }
        return false;
    }

    public function destroySelected($request)
    {
        $ids =  explode(',', $request->ids);
        $tourguides = Tourguide::whereIn('id', $ids)->get();
        $length = count($tourguides);

        if ($tourguides) {
            try {
                for($i = 0; $i < $length; $i++) {
                    $this->destroyImages($tourguides[$i]->id);
                    $tourguides[$i]->delete();
                }
                return true;
            } catch (\Exception $err) {
                return false;
            }
        }
        return false;
    }
}
