<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    use HasFactory;
    protected $table = 'authorizations';
    protected $fillable = [
        'userid',
        'authorid',
    ];
    public function isPostCreator(): bool
    {
        if($this->authorid === 4){
            return true;
        }
        return false;
    }

    public function viewUpdatePost():bool{
        if($this->authorid == 6){
            return true;
        }
        return false;
    }
    
    public function canDeletePost():bool{
        if($this->authorid == 5){
            return true;
        }
        return false;
    }

    public function viewAddProduct():bool {
        if($this->authorid == 1){
            return true;
        }
        return false;
    }
    public function viewUpdateProduct():bool {
        if($this->authorid == 1){
            return true;
        }
        return false;
    }
    public function deleteProduct():bool {
        if($this->authorid == 2){
            return true;
        }
        return false;
    }

}
