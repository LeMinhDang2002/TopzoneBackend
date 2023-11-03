<?php

namespace App\Repositories;

use App\Models\CategoryPost;
use DB;

class CategoryPostRepository extends BaseRepositoryEloquent
{
    public function __construct(CategoryPost $categoryPost)
    {
        parent::__construct($categoryPost);
    }
    // public function getByUrl($url){
    //     return (DB::table('category_posts')->where('Description', $url)->first());
    // }
    public function getTypeCategory($id){
        return (DB::table('category_posts')->where('id', $id)->first());
    }
}