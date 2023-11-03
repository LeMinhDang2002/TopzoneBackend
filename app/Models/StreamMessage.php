<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamMessage extends Model
{
    use HasFactory;
    protected $table = 'stream_messages';
    protected $fillable = [
        'message_id',
        'userid_src',
        'userid_dest',
        'status',
    ];
}
