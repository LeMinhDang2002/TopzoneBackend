<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PostRepository;
use App\Repositories\ImagesRepository;
use App\Repositories\CategoryPostRepository;

class PostController extends Controller
{
    protected $postRepository;
    protected $imagesRepository;
    protected $categoryPostRepository;
    public function __construct(PostRepository $postRepository,
                                ImagesRepository $imagesRepository,
                                CategoryPostRepository $categoryPostRepository){
        $this->postRepository = $postRepository;
        $this->imagesRepository = $imagesRepository;
        $this->categoryPostRepository = $categoryPostRepository;
    }

    public function getAllPost(){
        $posts = $this->postRepository->findAll();
        foreach($posts as $post){
            $post['link_thumbnail'] = $this->imagesRepository->getImageUrl($post->thumbnail);
        }
        return response()->json($posts, 200);
    }
    public function get3Post(){
        $posts = $this->postRepository->getLimit3Post();
        foreach($posts as $post){
            $post->link_thumbnail = $this->imagesRepository->getImageUrl($post->thumbnail);
        }
        return response()->json($posts, 200);
    }
    public function getCategoryPost(){
        $categories = $this->categoryPostRepository->findAll();
        return response()->json($categories, 200);
    }
    public function getSubCategoryPost($url){
        $posts = $this->postRepository->getPostByUrl($url);
        foreach($posts as $post){
            $post->link_thumbnail = $this->imagesRepository->getImageUrl($post->thumbnail);
        }
        return response()->json($posts, 200);
    }
}
