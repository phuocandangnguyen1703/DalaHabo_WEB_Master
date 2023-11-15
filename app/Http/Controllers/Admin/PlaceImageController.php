<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Place\PlaceImageService;

use App\Models\Place;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;

class PlaceImageController extends Controller
{
    protected $placeService;

    public function __construct(PlaceImageService $placeImageService)
    {
        $this->placeImageService = $placeImageService;
    }

    public function all(Place $place)
    {
        return view('admin.places.images', [
            'title' => 'Hình ảnh địa điểm',
            'menu' => $place->name,
            'place' => $place,
            'images' => $this->placeImageService->getAll($place),
        ]);
    }

    public function store(Request $request, Place $place)
    {
        $result = $this->placeImageService->create($request, $place->id);
        if ($result) {
            Session::flash('success', 'Thêm hình ảnh thành công');
        } else {
            Session::flash('error', 'Có lỗi xảy ra. Vui lòng thử lại');
        }
        return redirect()->back();
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = $this->placeImageService->destroy($request);
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
        $result = $this->placeImageService->destroySelected($request);
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
