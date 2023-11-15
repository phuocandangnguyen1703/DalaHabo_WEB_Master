<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateFormRequest;
use App\Http\Services\Category\CategoryService;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function all()
    {
        return view('admin.categories.all', [
            'title' => 'Danh mục',
            'menu' => 'Danh sách danh mục',
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    public function create()
    {
        return view('admin.categories.add', [
            'title' => 'Danh mục',
            'menu' => 'Thêm danh mục'
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $result = $this->categoryService->create($request);
        if($result) {
            return response()->json([
                'error' => false,
                'message' => 'Tạo mới thành công'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }

    public function show(Category $category)
    {
        return view('admin.categories.edit', [
            'title' => 'Danh mục',
            'menu' => 'Danh sách danh mục',
            'item' => $category->name,
            'category' => $category
        ]);
    }

    public function update(Category $category, CreateFormRequest $request)
    {
        $result = $this->categoryService->update($category, $request);
        if($result) {
            return response()->json([
                'error' => false,
                'message' => 'Cập nhật thành công'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = $this->categoryService->destroy($request);
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
        $result = $this->categoryService->destroySelected($request);
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
