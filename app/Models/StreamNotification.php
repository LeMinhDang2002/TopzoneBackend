<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamNotification extends Model
{
    use HasFactory;
    protected $table = 'stream_notifications';
    protected $fillable = [
        'notificationid',
        'userid_src',
        'userid_dest',
        'status',
    ];
}
