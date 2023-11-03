<?php

namespace App\Repositories;

use App\Models\Order;
use DB;

class OrderRepository extends BaseRepositoryEloquent
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }
    public function getOrderWithCustomer(){
        return(DB::table('orders')
                    ->join('customers', 'orders.CustomerID', 'customers.id')
                    ->get(
                        [
                            'orders.id',
                            'orders.OrderDate',
                            'orders.Status',
                            'customers.CustomerName',
                            'customers.PhoneNumber'
                        ]
                    ));
    }
}