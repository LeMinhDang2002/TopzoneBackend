<?php

namespace App\Repositories;

use App\Models\Authorization;
use DB;

class AuthorizationRepository extends BaseRepositoryEloquent
{
    public function __construct(Authorization $authorization)
    {
        parent::__construct($authorization);
    }
    public function findByUserId($id){
        return (Authorization::where('userid', $id)->get());
    }
    public function checkRequestAuth($id, $lists){
        foreach($lists as $list){
            if($id == json_decode($list)){
                return true;
            }
        }
        return false;
    }
    public function checkDBAuth($id, $lists){
        foreach($lists as $list){
            if($id == $list->authorid){
                return true;
            }
        }
        return false;
    }
}