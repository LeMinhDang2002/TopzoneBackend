<?php

namespace App\Repositories;

use App\Models\Message;
use DB;

class MessageRepository extends BaseRepositoryEloquent
{
    public function __construct(Message $message)
    {
        parent::__construct($message);
    }
}