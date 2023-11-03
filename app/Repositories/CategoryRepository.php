<?php

namespace App\Repositories;
use DB;
use App\Models\Category;

class CategoryRepository extends BaseRepositoryEloquent
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
    public function getCategory()
    {
        return (Category::whereColumn('id', 'ParentID')->get());
    }
    public function getSubCategoryAll()
    {
        return (Category::whereColumn('id', '!=','ParentID')->get());
    }
    public function getNameOfSubCategory(){
        return (DB::table('categories')->whereColumn('id', '!=', 'ParentID')->get(
            [
                'id',
                'CategoryName',
            ]
        ));
    }
    public function getSubCategory($id){
        return(Category::where('parentid', $id)
                        ->whereColumn('id', '!=', 'parentid')
                        ->orderBy('category_name', 'desc')
                        ->get());
    }
}