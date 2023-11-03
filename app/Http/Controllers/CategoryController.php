<?php

namespace App\Http\Controllers;
use App\Repositories\CategoryRepository;
use App\Repositories\PositionRepository;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $positionRepository;
    public function __construct(PositionRepository $positionRepository,
                                CategoryRepository $categoryRepository)
    {
        $this->positionRepository = $positionRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function postAddCategory(Request $request){
        $positions = $this->positionRepository->findByUserId($request->user()->id);
        foreach($positions as $position){
            if($request->user()->can('addCategory', $position)){
                $category = [
                    'parentid' => $request->parentid,
                    'category_name' => $request->category_name,
                    'description' => $request->description,
                    'url' => $request->url,
                    'status' => $request->status, 
                ];
                $this->categoryRepository->create($category);
                toast('Thêm danh mục sản phẩm thành công','success', 'top-right')->showCloseButton();
                return back();
            }
        }
        toast('Bạn không có quyền thêm danh mục sản phẩm','error', 'top-right')->showCloseButton();
        return back();
    }
}
