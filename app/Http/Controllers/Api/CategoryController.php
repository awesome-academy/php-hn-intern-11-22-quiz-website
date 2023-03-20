<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        try {
            $categories = $this->categoryRepo->getAll();

            return response()->json([
                'message' => __('Get categories successfully'),
                'data' => $categories,
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage(),
            ], 500);
        }
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->categoryRepo->create([
                'name' => $request->name,
            ]);

            return response()->json([
                'message' => __('Add category successfully'),
                'category' => $category,
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage(),
            ], 500);
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = $this->categoryRepo->update($id, [
                'name' => $request->name,
            ]);

            return response()->json([
                'message' => __('Update Category Successfully'),
                'data' => $category,
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->categoryRepo->delete($id);

            return response()->json([
                'category_id' => $id,
                'message' => __('Remove Category Successfully'),
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage(),
            ], 500);
        }
    }
}
