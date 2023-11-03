<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepositoryEloquent
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
    public function checkEmail($tmp): bool {
        // dd($tmp['id']);
        $users = User::where('id', '!=', $tmp['id'])->get();
        foreach($users as $user){
            if($user->email === $tmp['email']){
                return true;
            }
        }
        return false;
    }
    public function checkPhone($tmp): bool {
        $users = User::where('id', '!=', $tmp['id'])->get();
        foreach($users as $user){
            if($user->phone === $tmp['phone']){
                return true;
            }
        }
        return false;
    }
    public function findAdmins(){
        return(User::where('type_user', 'admin')->get());
    }
}