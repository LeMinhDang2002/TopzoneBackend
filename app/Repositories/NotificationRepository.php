<?php

namespace App\Repositories;

use App\Models\Notification;
use DB;

class NotificationRepository extends BaseRepositoryEloquent
{
    public function __construct(Notification $notification)
    {
        parent::__construct($notification);
    }
    public function findNotification(){
        return(Notification::orderBy('created_at', 'desc')->limit(5)->get());
    }
    public function findAllNotification(){
        return(Notification::orderBy('created_at', 'desc')->get());
    }
    public function findForPostCreator(){
        return(Notification::where('position_detail_id', '3')->orderBy('created_at', 'desc')->limit(5)->get());
    }
    public function findAllForPostCreator(){
        return(Notification::where('position_detail_id', '3')->orderBy('created_at', 'desc')->get());
    }
}