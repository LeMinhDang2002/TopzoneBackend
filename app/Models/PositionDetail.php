<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionDetail extends Model
{
    use HasFactory;
    protected $table = 'position_details';
    protected $fillable = [
        'name_position',
    ];
}
