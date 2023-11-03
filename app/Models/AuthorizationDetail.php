<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizationDetail extends Model
{
    use HasFactory;
    protected $table = 'authorization_details';
    protected $fillable = [
        'name_author',
    ];
}
