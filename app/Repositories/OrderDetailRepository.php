<?php

namespace App\Repositories;

use App\Models\OrderDetail;

class OrderDetailRepository extends BaseRepositoryEloquent
{
    public function __construct(OrderDetail $orderDetail)
    {
        parent::__construct($orderDetail);
    }
}