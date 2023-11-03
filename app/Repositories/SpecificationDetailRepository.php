<?php

namespace App\Repositories;

use App\Models\SpecificationDetail;
use DB;

class SpecificationDetailRepository extends BaseRepositoryEloquent
{
    public function __construct(SpecificationDetail $specificationDetail)
    {
        parent::__construct($specificationDetail);
    }
    public function getTypeSpecification($str){
        return (DB::table('specification_details')->where('Key', $str)->get());
    }
    public function groupBySpecification(){
        return (DB::table('specification_details')->select('Key', 'Name')->groupBy('Key', 'Name')->get());
    }
    public function getSpecByProductID($id){
        return (DB::table('specifications')->where('ProductID', $id)
                    ->join('specification_details', 'specification_details.id', 'specifications.SpecificationDetailID')
                    ->get(
                        [
                            'specifications.id',
                            'specifications.ProductID',
                            'specifications.SpecificationDetailID',
                            'specification_details.Key', 
                            'specification_details.Name', 
                            'specification_details.Description', 
                        ]
                        ));
                }
    public function findByGroupId($id){
        return (SpecificationDetail::where('groupid', $id)->get());
    }
    
}