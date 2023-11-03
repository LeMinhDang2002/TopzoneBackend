<?php

namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository extends BaseRepositoryEloquent
{
    public function __construct(Supplier $supplier)
    {
        parent::__construct($supplier);
    }
}