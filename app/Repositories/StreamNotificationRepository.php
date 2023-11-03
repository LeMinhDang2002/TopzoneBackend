<?php

namespace App\Repositories;

use App\Models\StreamNotification;

class StreamNotificationRepository extends BaseRepositoryEloquent
{
    public function __construct(StreamNotification $streamNotification)
    {
        parent::__construct($streamNotification);
    }
    public function findByUserIdDest($id){
        return(StreamNotification::where('userid_dest', $id)->orderBy('created_at', 'desc')->limit(10)->get());
    }
}