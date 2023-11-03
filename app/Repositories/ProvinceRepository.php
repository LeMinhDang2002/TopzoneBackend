<?php

namespace App\Repositories;

use App\Models\Provinces;

class ProvinceRepository extends BaseRepositoryEloquent
{
    public function __construct(Provinces $provinces)
    {
        parent::__construct($provinces);
    }
    public function getAll(){
        return(Provinces::get(['code','name']));
    }
}