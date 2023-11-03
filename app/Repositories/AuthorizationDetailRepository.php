<?php

namespace App\Repositories;

use App\Models\AuthorizationDetail;
use DB;

class AuthorizationDetailRepository extends BaseRepositoryEloquent
{
    public function __construct(AuthorizationDetail $authorizationDetail)
    {
        parent::__construct($authorizationDetail);
    }
}