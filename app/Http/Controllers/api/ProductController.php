<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ImagesRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ColorRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SpecificationRepository;

class ProductController extends Controller
{
    protected $productRepository;
    protected $imagesRepository;
    protected $colorRepository;
    protected $categoryRepository;
    protected $specificationRepository;
    public function __construct(ProductRepository $productRepository, 
                                ImagesRepository $imagesRepository,
                                ColorRepository $colorRepository,
                                SpecificationRepository $specificationRepository,
                                CategoryRepository $categoryRepository){
        $this->productRepository = $productRepository;
        $this->imagesRepository = $imagesRepository;
        $this->colorRepository = $colorRepository;
        $this->specificationRepository = $specificationRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function getAllTypeProduct($type){
        if($type == 'iphones')
            $products = $this->productRepository->getTypeProduct(1);
        else if($type == 'ipads'){
            $products = $this->productRepository->getTypeProduct(2);
        }
        else if($type == 'macs'){
            $products = $this->productRepository->getTypeProduct(3);
        }
        else if($type == 'watches'){
            $products = $this->productRepository->getTypeProduct(4);
        }
        else if($type == 'sounds'){
            $products = $this->productRepository->getTypeProduct(5);
        }
        else{}
        foreach($products as $product){
            $thumbnail = $this->imagesRepository->getThumbnailByProductID($product->id);
            $product->thumbnail = $this->imagesRepository->getImageUrl($thumbnail->file_name);
        }
        return response()->json($products, 200);
    }
    public function getProductOfCategory($type){
        $products = $this->productRepository->getProductByCategoryId($type);
        foreach($products as $product){
            $thumbnail = $this->imagesRepository->getThumbnailByProductID($product->id);
            $product->thumbnail = $this->imagesRepository->getImageUrl($thumbnail->file_name);
        }
        return response()->json($products, 200);
    }
    public function getCategoryProduct($type){
        if($type == 'iphones'){
            $subcategory = $this->categoryRepository->getSubCategory(1);
        }
        else if($type == 'ipads'){
            $subcategory = $this->categoryRepository->getSubCategory(2);
        }
        else if($type == 'macs'){
            $subcategory = $this->categoryRepository->getSubCategory(3);
        }
        else if($type == 'watches'){
            $subcategory = $this->categoryRepository->getSubCategory(4);
        }
        else if($type == 'sounds'){
            $subcategory = $this->categoryRepository->getSubCategory(5);
        }
        else{}
        return response()->json($subcategory, 200);
    }

    public function getProduct(Request $request, $id){
        $product = $this->productRepository->findById($id);
        $versions = $this->productRepository->getAllVersionOfProduct($product->id);
        foreach($versions as $version){
            $idversion = $this->productRepository->getIdOfVersion($version->version, $product->id);
            $version->id = $idversion;
        }
        $product['versions'] = $versions;
        $colors = $this->colorRepository->getGroupColor($product->id);
        $color = $this->colorRepository->findByProductId($product->id);
        $product['colors'] = $colors;
        $product['color'] = $color;
        return response()->json($product, 200);
    }
    public function getProductSimilar(Request $request, $id){
        $products = $this->productRepository->getProductSimilar($id);
        foreach($products as $product){
            $thumbnail = $this->imagesRepository->getThumbnailByProductID($product->id);
            $product->thumbnail = $this->imagesRepository->getImageUrl($thumbnail->file_name);
        }
        return response()->json($products, 200);
    }

    public function getSpecification(Request $request, $id){
        $groupSpecifications = $this->specificationRepository->findGroupSpecificationOfProduct($id);
        foreach($groupSpecifications as $groupSpecification){
            $specification = $this->specificationRepository->findSpecificationOfProduct($groupSpecification->id, $id);
            $groupSpecification->specification = $specification;
        }
        return response()->json($groupSpecifications, 200);
    }

    public function getProductOfCart(Request $request){
        $ids = json_decode($request->id);
        $products = [];
        foreach($ids as $id)
        {
            $product = $this->productRepository->findById($id);

            $thumb = $this->imagesRepository->getThumbnailByProductID($id);
            $color = $this->colorRepository->findByProductId($id);
            $thumbnail = $this->imagesRepository->getImageUrl($thumb->file_name);
            $product['thumbnail'] = $thumbnail;
            $product['color'] = $color;
            $products[] = $product;
        }
        return response()->json($products, 200);
    }
}
