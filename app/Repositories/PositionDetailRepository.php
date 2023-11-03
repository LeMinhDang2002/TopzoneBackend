<?php

namespace App\Repositories;

use App\Models\PositionDetail;
use DB;

class PositionDetailRepository extends BaseRepositoryEloquent
{
    public function __construct(PositionDetail $positionDetail)
    {
        parent::__construct($positionDetail);
    }
}