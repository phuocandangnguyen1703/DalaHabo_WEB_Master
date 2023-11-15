<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Tourguide\TourguideImageService;

use App\Models\Tourguide;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;

class TourguideImageController extends Controller
{
    protected $tourguideService;

    public function __construct(TourguideImageService $tourguideService)
    {
        $this->tourguideService = $tourguideService;
    }

    public function all(Tourguide $tourguide)
    {
        return view('admin.tourguides.images', [
            'title' => 'Hình ảnh hướng dẫn viên',
            'menu' => $tourguide->name,
            'images' => $this->tourguideService->getAll($tourguide),
        ]);
    }

    public function store(Request $request, Tourguide $tourguide)
    {
        $result = $this->tourguideService->create($request, $tourguide->id);
        if ($result) {
            Session::flash('success', 'Thêm hình ảnh thành công');
        } else {
            Session::flash('error', 'Có lỗi xảy ra. Vui lòng thử lại');
        }
        return redirect()->back();
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = $this->tourguideService->destroy($request);
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
        $result = $this->tourguideService->destroySelected($request);
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
