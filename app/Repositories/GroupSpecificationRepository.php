<?php

namespace App\Repositories;

use App\Models\GroupSpecification;
use DB;

class GroupSpecificationRepository extends BaseRepositoryEloquent
{
    public function __construct(GroupSpecification $groupSpecification)
    {
        parent::__construct($groupSpecification);
    }
    public function getGroupSpecificationParent(){
        return (GroupSpecification::whereColumn('id', 'parentid')->get());
    }
    public function getSubGroupSpecification($id){
        return (GroupSpecification::where('parentid', $id)->whereColumn('id', '!=', 'parentid')->get());
    }
    public function getGroupSpecificationOfProduct($id){
        return DB::table(DB::raw('(SELECT group_specifications.parentid AS pid
                                    FROM group_specifications
                                    JOIN specification_details ON group_specifications.id = specification_details.groupid
                                    JOIN specifications ON specification_details.id = specifications.spec_detail_id
                                    WHERE specifications.productid = 4
                                    GROUP BY group_specifications.parentid) AS subquery'))
                                    ->join('group_specifications', 'subquery.pid', '=', 'group_specifications.id')
                                    ->select('group_specifications.*')
                                    ->get();
    }

    public function getSubGroupSpecificationByGroupIdAndProductId($id, $groupid){
        return(DB::table('specifications')
                    ->select('specification_details.*')
                    ->join('specification_details', 'specifications.spec_detail_id', '=', 'specification_details.id')
                    ->join('group_specifications', 'group_specifications.id', '=', 'specification_details.groupid')
                    ->where('specifications.productid', '=', $id)
                    ->where('group_specifications.parentid', '=', $groupid)
                    ->get());
    }
}