<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Requests\Category\CreateFormRequest;
// use App\Http\Services\Category\CategoryService;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    // protected $categoryService;

    // public function __construct(CategoryService $categoryService)
    // {
    //     $this->categoryService = $categoryService;
    // }

    public function all()
    {
        return view('admin.blogs.all', [
            'title' => 'Bài viết',
            'menu' => 'Danh sách bài viết',
            // 'categories' => $this->categoryService->getAll(),
            // 'count' => $this->categoryService->count(),
        ]);
    }

    public function create()
    {
        return view('admin.blogs.add', [
            'title' => 'Bài viết',
            'menu' => 'Thêm bài viết',
        ]);
    }

    // public function store(CreateFormRequest $request)
    // {
    //     $this->categoryService->create($request);
    //     return redirect()->back();
    // }

    // public function show(Category $category)
    // {
    //     return view('admin.categories.edit', [
    //         'title' => 'Danh mục',
    //         'menu' => 'Danh sách danh mục',
    //         'item' => $category->name,
    //         'category' => $category
    //     ]);
    // }

    // public function update(Category $category, CreateFormRequest $request)
    // {
    //     $this->categoryService->update($category, $request);
    //     return redirect('admin/categories/all');
    // }

    // public function destroy(Request $request): JsonResponse
    // {
    //     $result = $this->categoryService->destroy($request);
    //     if ($result) {
    //         return response()->json([
    //             'error' => false,
    //             'message' => 'Xóa thành công'
    //         ]);
    //     }
    //     return response()->json([
    //         'error' => true
    //     ]);
    // }
}
