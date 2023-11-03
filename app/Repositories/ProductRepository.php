<?php

namespace App\Repositories;

use App\Models\Product;
use DB;

class ProductRepository extends BaseRepositoryEloquent
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }
    public function searchProduct($search){
        return (DB::table(function ($query) use ($search) {
                        $query->select('products.ProductAvailable', 'products.Version', 'colors.NameColor', 'products.ProductDescription', 'products.Price', 'products.Discount', 'images.FileName', 'products.QuantityInStock')
                            ->from('products')
                            ->join('colors', 'products.id', '=', 'colors.ProductID')
                            ->join('images', 'products.id', '=', 'images.ProductID')
                            ->where('images.Type', 'LIKE', '%thumbnail%');
                        }, 'subquery')
                        ->where('ProductDescription', 'LIKE', '%'.$search.'%')
                        ->orWhere('Version', 'LIKE', '%'.$search.'%')
                        ->orWhere('NameColor', 'LIKE', '%'.$search.'%')
                        ->orWhere('ProductAvailable', 'LIKE', '%'.$search.'%')
                        ->get());
    }
    public function getAll(){
        return (DB::table('products')
                    ->join('graphics', 'products.GraphicID', '=', 'graphics.ID')
                    ->get(
                        [
                            'products.id', 
                            'products.ProductName', 
                            'products.ProductDescription', 
                            'products.Version', 
                            'products.Price', 
                            'products.Discount', 
                            'products.QuantityInStock', 
                            'graphics.ColorName', 
                        ]
                    ));
    }
    public function getProductByStatus($status){
        return Product::where('ProductAvailable', $status)->get();
    }
    public function findByIdProduct($id){
        return(DB::table('specifications')->where('ProductID', $id)->first());
    }
    public function getTypeProduct($id){
        return (DB::table('products')
                    ->join('categories', 'products.categoryid', '=', 'categories.id')
                    ->where('categories.parentid', '=', $id)
                    ->select('products.*')
                    ->get());
    }
    public function getAllVersionOfProduct($id){
        return DB::table('products')
            ->select('products.version')
            ->join(DB::raw("(SELECT product_name FROM products WHERE id = $id) as subquery"), function ($join) {
                $join->on('products.product_name', '=', 'subquery.product_name');
            })
            ->groupBy('products.version')
            ->get();
    }
    public function getIdOfVersion($version, $id)
    {
        return DB::table('products')
            ->joinSub(function ($query) use ($id) {
                $query->from('products')
                    ->select('product_name')
                    ->where('id', $id);
            }, 'subquery', function ($join) use ($version) {
                $join->on('products.product_name', '=', 'subquery.product_name')
                    ->where('products.version', '=', $version);
            })
            ->select('products.id')
            ->first();
    }
    public function getTypeSubCategoryProduct($id){
        return (DB::table(function ($query) {
            $query->select('products.id' ,'products.ProductName', 'products.ProductDescription', 'colors.NameColor', 'colors.CodeColor', 'products.Version', 'products.Price', 'products.Discount', 'products.QuantityInStock', 'images.Type', 'images.FileName', 'categories.id as CategoryID')
                ->from('products')
                ->join('colors', 'products.id', '=', 'colors.ProductID')
                ->join('images', 'products.id', '=', 'images.ProductID')
                ->join('categories', 'products.CategoryID', 'categories.id')
                ->where('images.Type', 'LIKE', '%thumbnail%');
            }, 'subquery')
            ->where('CategoryID', $id)
            ->get());
    }
    public function getProductById($id){
        return (DB::table(function ($query) {
            $query->select('products.id' ,'products.ProductName', 'products.ProductDescription', 'colors.NameColor', 'colors.CodeColor', 'products.Version', 'products.Price', 'products.Discount', 'products.QuantityInStock', 'images.Type', 'images.FileName', 'categories.id as CategoryID')
                ->from('products')
                ->join('colors', 'products.id', '=', 'colors.ProductID')
                ->join('images', 'products.id', '=', 'images.ProductID')
                ->join('categories', 'products.CategoryID', 'categories.id')
                ->where('images.Type', 'LIKE', '%thumbnail%');
            }, 'subquery')
            ->where('id', $id)
            ->first());
    }
    public function getVersionOfProduct($nameProduct){
        return(DB::table('products')
                    ->where('products.ProductName', $nameProduct)
                    ->groupByRaw('products.Version')
                    ->get([
                        'products.Version',
                    ]));
    }
    public function getCategoryIDOfProduct($nameProduct){
        return(DB::table('products')
                    ->join('categories', 'products.CategoryID', 'categories.ID')
                    ->where('products.ProductName', $nameProduct)
                    ->first([
                        'categories.ParentID',
                    ]));
    }
    public function getCategoryIDOfProductByID($id){
        return(DB::table('products')
                    ->join('categories', 'products.CategoryID', 'categories.ID')
                    ->where('products.id', $id)
                    ->first([
                        'categories.ParentID',
                    ]));
    }
    public function getColorOfProduct($nameProduct, $version){
        return(DB::table('products')
                    ->join('colors', 'products.id', '=', 'colors.ProductID')
                    ->where('products.ProductName',$nameProduct)
                    ->where('products.Version', 'like','%'.$version.'%')
                    ->get([
                        'colors.CodeColor',
                    ]));
    }
    public function ProductByNameAndVersion($nameProduct, $version){
        return (DB::table(function ($query) {
            $query->select('products.id' ,'products.ProductName', 'products.ProductDescription', 'colors.NameColor', 'colors.CodeColor', 'products.Version', 'products.Price', 'products.Discount', 'products.QuantityInStock', 'images.Type', 'images.FileName', 'categories.ParentID')
                ->from('products')
                ->join('colors', 'products.id', '=', 'colors.ProductID')
                ->join('images', 'products.id', '=', 'images.ProductID')
                ->join('categories', 'products.CategoryID', 'categories.id')
                ->where('images.Type', 'LIKE', '%thumbnail%');
            }, 'subquery')
            ->where('ProductName', $nameProduct)
            ->where('Version', $version)
            ->first());
    }
    public function ProductByNameAndVersionAndColor($nameProduct, $version, $color){
        return (DB::table(function ($query) {
            $query->select('products.id' ,'products.ProductName', 'products.ProductDescription', 'colors.NameColor', 'colors.CodeColor', 'products.Version', 'products.Price', 'products.Discount', 'products.QuantityInStock', 'images.Type', 'images.FileName', 'categories.ParentID')
                ->from('products')
                ->join('colors', 'products.id', '=', 'colors.ProductID')
                ->join('images', 'products.id', '=', 'images.ProductID')
                ->join('categories', 'products.CategoryID', 'categories.id')
                ->where('images.Type', 'LIKE', '%thumbnail%');
            }, 'subquery')
            ->where('ProductName', $nameProduct)
            ->where('CodeColor', $color)
            ->where('Version', $version)
            ->first());
    }
    public function getProductSimilar($id){
        return (DB::table('products')
                    ->join(DB::raw("(SELECT product_name, categoryid FROM products WHERE id = $id) AS subquery"), function ($join) {
                        $join->on('products.product_name', '!=', DB::raw('subquery.product_name'))
                            ->whereColumn('products.categoryid', 'subquery.categoryid');
                    })
                    ->select('products.*')
                    ->get());
    }
    public function getProductByCategoryId($id){
        return(Product::where('categoryid' , $id)->get());
    }
}