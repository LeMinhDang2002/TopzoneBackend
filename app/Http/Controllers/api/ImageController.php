<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ImagesRepository;

class ImageController extends Controller
{
    protected $imagesRepository;
    public function __construct(ImagesRepository $imagesRepository){
        $this->imagesRepository = $imagesRepository;
    }
    public function getImageOfProduct(Request $request, $id){
        $images = $this->imagesRepository->getImagesProduct($id);
        foreach($images as $image){
            $link = $this->imagesRepository->getImageUrl($image->file_name);
            $image['link'] = $link;
        }
        return response()->json($images, 200);
    }
}
