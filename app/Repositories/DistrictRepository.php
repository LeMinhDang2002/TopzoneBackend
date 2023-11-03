<?php

namespace App\Repositories;

use App\Models\Districts;

class DistrictRepository extends BaseRepositoryEloquent
{
    public function __construct(Districts $districts)
    {
        parent::__construct($districts);
    }
    public function getByProvinceId($id){

        return Districts::where('province_code', $id)
                        ->get(['code', 'name']);
    }
}