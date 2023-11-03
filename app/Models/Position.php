<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $table = 'positions';
    protected $fillable = [
        'userid',
        'position_detail_id',
    ];
    public function isPostCreator(): bool
    {
       if($this->position_detail_id === 3){
            return true;
       }
       return false;
    }
    public function isManagerProducts():bool {
        if($this->position_detail_id === 2){
            return true;
       }
       return false;
    }
}
