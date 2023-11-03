<?php

namespace App\Repositories;

use App\Models\StreamMessage;

class StreamMessageRepository extends BaseRepositoryEloquent
{
    public function __construct(StreamMessage $streamMessage)
    {
        parent::__construct($streamMessage);
    }
    public function findByUserIdDest($id){
        return(StreamMessage::where('userid_dest', $id)->orderBy('created_at', 'desc')->limit(10)->get());
    }
}