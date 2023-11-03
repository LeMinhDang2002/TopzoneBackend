<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecificationDetail extends Model
{
    use HasFactory;
    protected $table = 'specification_details';
    protected $fillable = [
        'name',
        'description',
        'groupid',
    ];
}
