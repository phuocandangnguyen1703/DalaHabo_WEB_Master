<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Place\CreateFormRequest;
use App\Http\Services\Place\PlaceService;
use App\Http\Services\Category\CategoryService;
use App\Http\Services\Place\PlaceImageService;

use App\Models\Place;
use Illuminate\Http\JsonResponse;

class PlaceController extends Controller
{
    protected $categoryService, $placeService, $placeImageService;

    public function __construct(CategoryService $categoryService, PlaceService $placeService, PlaceImageService $placeImageService)
    {
        $this->categoryService = $categoryService;
        $this->placeService = $placeService;
        $this->placeImageService = $placeImageService;
    }

    public function all()
    {
        return view('admin.places.all', [
            'title' => 'Địa điểm',
            'menu' => 'Danh sách địa điểm',
            'places' => $this->placeService->getAll(),
        ]);
    }

    public function create()
    {
        return view('admin.places.add', [
            'title' => 'Địa điểm',
            'menu' => 'Thêm địa điểm',
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $rsplace = $this->placeService->create($request);
        if ($rsplace) {
            $result = true;
            if ($request->has('image')) {
                $placeId = $this->placeService->getPlaceId();
                $result = $this->placeImageService->create($request, $placeId);
            }
           
            if($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Tạo mới thành công'
                ]);
            }
        }
        return response()->json([
            'error' => true,
        ]);
    }

    public function show(Place $place)
    {
        return view('admin.places.edit', [
            'title' => 'Địa điểm',
            'menu' => 'Danh sách địa điểm',
            'item' => $place->name,
            'place' => $place,
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    public function update(Place $place, CreateFormRequest $request)
    {
        $result = $this->placeService->update($place, $request);
        if($result) {
            return response()->json([
                'error' => false,
                'message' => 'Cập nhật thành công'
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = $this->placeService->destroy($request);
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

    public function destroySelected(Request $request): JsonResponse
    {
        $result = $this->placeService->destroySelected($request);
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
}
