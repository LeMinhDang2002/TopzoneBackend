<?php

namespace App\Repositories;

use App\Models\Post;
use DB;

class PostRepository extends BaseRepositoryEloquent
{
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }
    public function getTypePost($id){
        return(Post::where('CategoryID', $id)->get());
    }
    public function getLimit3Post()
    {
        return(DB::table('posts')
                    ->orderBy('created_at', 'desc')
                    ->skip(0)
                    ->take(3)
                    ->get());
    }
    public function getPostByUrl($url){
        return(DB::table('category_posts')
                ->join('posts', 'category_posts.id', '=', 'posts.categoryid')
                ->where('category_posts.url', $url)
                ->select('posts.*')
                ->get());
    }
    public function getPostBySearch($search){
        return (DB::table('posts')
                    ->join('category_posts', 'posts.CategoryID', 'category_posts.id')
                    ->where('posts.Title', 'like', '%'.$search.'%')
                    ->orwhere('category_posts.CategoryName', 'like', '%'.$search.'%')
                    ->get([
                        'posts.id',
                        'category_posts.CategoryName',
                        'posts.CategoryID',
                        'posts.Thumbnail',
                        'posts.Title',
                        'posts.URL'
                    ]));
    }
}