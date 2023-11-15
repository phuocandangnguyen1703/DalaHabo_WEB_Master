<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tourguide\CreateFormRequest;
use App\Http\Services\Tourguide\TourguideService;
use App\Http\Services\Tourguide\TourguideImageService;
use App\Models\Tourguide;

class TourguideController extends Controller
{
    protected $tourguideService, $tourguideImageService;

    public function __construct(TourguideService $tourguideService, TourguideImageService $tourguideImageService)
    {
        $this->tourguideService = $tourguideService;
        $this->tourguideImageService = $tourguideImageService;
    }

    public function all()
    {
        return view('admin.tourguides.all', [
            'title' => 'Hướng dẫn viên',
            'menu' => 'Danh sách hướng dẫn viên',
            'tourguides' => $this->tourguideService->getAll(),
        ]);
    }

    public function create()
    {
        return view('admin.tourguides.add', [
            'title' => 'Hướng dẫn viên',
            'menu' => 'Thêm hướng dẫn viên'
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $rstourguide = $this->tourguideService->create($request);
        
        if ($rstourguide) {
            $result = true;
            if ($request->has('image')) {
                $tourguideId = $this->tourguideService->getTourguideId();
                $result = $this->tourguideImageService->create($request, $tourguideId);
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

    public function show(Tourguide $tourguide)
    {
        return view('admin.tourguides.edit', [
            'title' => 'Hướng dẫn viên',
            'menu' => 'Danh sách hướng dẫn viên',
            'item' => $tourguide->name,
            'tourguide' => $tourguide
        ]);
    }

    public function update(Tourguide $tourguide, CreateFormRequest $request)
    {
        $result = $this->tourguideService->update($tourguide, $request);
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
            'error' => true
        ]);
    }
}
