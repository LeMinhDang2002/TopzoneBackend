<?php

namespace App\Repositories;

use App\Models\Color;
use DB;

class ColorRepository extends BaseRepositoryEloquent
{
    public function __construct(Color $color)
    {
        parent::__construct($color);
    }
    public function getColorByProductID($id){
        return (DB::table('colors')->where('ProductID', $id)->first());
    }
    public function findByProductId($id){
        return(Color::where('productid', $id)->first());
    }
    public function getGroupColor($id){
        return(DB::table('colors')
                ->join(DB::raw("(SELECT products.id FROM products JOIN (SELECT products.product_name, products.version FROM products WHERE products.id = $id) AS subquery 
                                ON products.product_name = subquery.product_name AND products.version = subquery.version) AS groupproduct"), function ($join) {
                    $join->on('colors.productid', '=', 'groupproduct.id');
                })
                ->get());
    }
}