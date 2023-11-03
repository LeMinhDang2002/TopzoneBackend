<?php

namespace App\Repositories;

use App\Models\Specification;
use DB;

class SpecificationRepository extends BaseRepositoryEloquent
{
    public function __construct(Specification $specification)
    {
        parent::__construct($specification);
    }
    public function findByIdProduct($id){
        return(DB::table('specifications')->where('ProductID', $id)->get(
            [
                'id',
                'ProductID',
                'SpecificationName',
                'SpecificationDetailID',
            ]
        ));
    }
    public function getAll(){
        return(DB::table('specifications')->get(
            [
                'ProductID',
                'SpecificationName',
                'SpecificationDetailID',
            ]
        ));
    }
    public function getSpecification($id){
        return (DB::table('specifications')->where('ProductID', $id)
                    ->join('specification_details', 'specifications.specificationDetailID', 'specification_details.id')
                    ->get());
    }
    public function findByGroupIdAndProductId($id, $groupid){
        return(DB::table('specifications')
                    ->join('specification_details', 'specifications.spec_detail_id', '=', 'specification_details.id')
                    ->select('specification_details.*')
                    ->where('specifications.productid', '=', $id)
                    ->where('specification_details.groupid', '=', $groupid)
                    ->first());
    }
    public function findByProductId($id){
        return(Specification::where('productid', $id)->get());
    }
    public function findByProductIdAndSpecId($id, $spec_id){
        return(Specification::where('productid', $id)->where('spec_detail_id', $spec_id)->first());
    }
    public function findGroupSpecificationOfProduct($id){
        return (DB::table('group_specifications')
                    ->join(DB::raw("(SELECT group_specifications.parentid FROM specifications 
                        JOIN specification_details ON specifications.spec_detail_id = specification_details.id
                        JOIN group_specifications ON specification_details.groupid = group_specifications.id
                        WHERE specifications.productid = $id
                        GROUP BY group_specifications.parentid) AS subquery"), function ($join) {
                            $join->on('group_specifications.id', '=', DB::raw('subquery.parentid'));
                        })
                    ->select('group_specifications.id', 'group_specifications.name')
                    ->get());
    }
    public function findSpecificationOfProduct($groupid, $id){
        return (DB::table('group_specifications')
                    ->join('specification_details', 'group_specifications.id', '=', 'specification_details.groupid')
                    ->join('specifications', 'specification_details.id', '=', 'specifications.spec_detail_id')
                    ->select('specification_details.*')
                    ->where('group_specifications.parentid', '=', $groupid)
                    ->where('specifications.productid', '=', $id)
                    ->get());
    }
}