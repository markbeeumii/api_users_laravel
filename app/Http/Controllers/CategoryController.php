<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Api\CategoryCreateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $category = Category::all();
            return[
                'category'=> $category
            ];
        }catch(\Exception $ex){
            return response()->json([
                'error' => 'Fail to get categories.',
                'message'=> $ex->getMessage()
              ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        return [
            'data'=> $request->all()
        ];
    }

    /**
     *
     * 
     * @param array $request 
     */
    public function store(array $request)
    {
        
        Log::info('request=>'. $request);
        return 'sss';
    }

   /**
     * Show the form for creating a new resource.
     * 
     * @param  Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        try{
            $cate = $this->showOne($category);
            return[
                'category'=> $cate
            ];
        }catch (\Exception $ex){
            return response()->json([
                'error' => 'Fail to get category.',
                'message'=> $ex->getMessage()
              ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param Category $category
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        try{
            $category->fill(
                $request->only([
                    'name'=> $request->name
                ])
            );
            if ($category->isClean()) {
                return $this->errorResponse('You need to specify any different value to update', 422);
            }
    
            $category->save();
    
            return $this->showOne($category);
        }catch (\Exception $ex){
            return response()->json([
                'error' => 'Fail to get category.',
                'message'=> $ex->getMessage()
              ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int  $id
     */
    public function destroy(int $id)
    {
        return $id;
    }
}
