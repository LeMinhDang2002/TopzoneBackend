<?php

namespace App\Repositories;

use App\Models\Wards;

class WardRepository extends BaseRepositoryEloquent
{
    public function __construct(Wards $wards)
    {
        parent::__construct($wards);
    }
    public function getByDistrictId($id){

        return Wards::where('district_code', $id)
                        ->get(['code', 'name']);
    }
}