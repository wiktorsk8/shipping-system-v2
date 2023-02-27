<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Helpers\Enums\UserRole;

class ClientRepository implements UserRepositoryInterface
{   
    public static function all(){
        return User::where('role', '=', UserRole::Client->value)->get();
    }
    
    public static function getIdList()
    {
        $users = User::where('role', '=', UserRole::Client->value)->get();
        $id_list = [];

        if($users != null){
            foreach($users as $user){
                array_push($id_list, $user->id);
            }
        }   
        return $id_list;
    }
}