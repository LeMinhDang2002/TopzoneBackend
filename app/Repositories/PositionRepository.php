<?php

namespace App\Repositories;

use App\Models\Position;
use DB;

class PositionRepository extends BaseRepositoryEloquent
{
    public function __construct(Position $position)
    {
        parent::__construct($position);
    }
    public function findByUserId($id){
        return (Position::where('userid', $id)->get());
    }
    public function checkRequestPosition($id, $lists){
        foreach($lists as $list){
            if($id == json_decode($list))
            {
                return true;
            }
        }
        return false;
    }
    public function checkDBPosition($id, $lists){
        foreach($lists as $list){
            if($id == $list->position_detail_id){
                return true;
            }
        }
        return false;
    }
}