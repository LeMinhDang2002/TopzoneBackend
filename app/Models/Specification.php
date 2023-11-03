<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;
    protected $table = 'specifications';
    protected $fillable = [
        'productid',
        'spec_name',
        'spec_detail_id',
    ];
}
