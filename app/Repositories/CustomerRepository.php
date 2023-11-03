<?php

namespace App\Repositories;

use App\Models\Customer;
use DB;

class CustomerRepository extends BaseRepositoryEloquent
{
    public function __construct(Customer $customer)
    {
        parent::__construct($customer);
    }
    public function checkCustomer($phone){
        $checkCustomer = DB::table('customers')->where('PhoneNumber', $phone)->first();
        if($checkCustomer != null)
        {
            return true;
        }
        return false;
    }
    public function findCustomerByPhone($phone){
        return(DB::table('customers')->where('phone', $phone)->first());
    }
}