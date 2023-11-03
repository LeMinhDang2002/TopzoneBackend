<?php

namespace App\Repositories;

use App\Models\Image;
use DB;

class ImagesRepository extends BaseRepositoryEloquent
{
    public function __construct(Image $image)
    {
        parent::__construct($image);
    }
    public function getImagesByProductID($id){
        return (Image::where('productid', $id)->where('type', 'image')->get());
    }
    public function getThumbnailByProductID($id){
        return (Image::where('productid', $id)->where('type', 'thumbnail')->first());
    }
    public function getImageUrl($fileName)
    {
        // Định dạng đường dẫn tương ứng với cách bạn lưu trữ tệp tin ảnh
        return asset('storage/' . $fileName);
    }
    public function getImagesProduct($id){
        return(Image::where('ProductID', $id)->orderByDesc('Type')->get());
    }
}