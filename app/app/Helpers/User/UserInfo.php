<?php

namespace App\Helpers\User;

use App\Models\User;
use App\Helpers\Enums\UserRole;

class UserInfo
{

    // each individual instance corresponds to a different user role (Client or Courier)    

    private $users;                                                      // list of all user
    private $users_id_list = [];                                         // list of all user ids

    public static $senders_address_fields = [
        'city',
        'postal_code', 
        'street_name', 
        'street_number', 
        'flat_number'
    ];

    public static $receivers_address_fields = [
        'receivers_city',
        'receivers_postal_code', 
        'receivers_street_name', 
        'receivers_street_number', 
        'receivers_flat_number'
    ];

    public function __construct(int $role)                               
    {                                                                      
        if ($role == UserRole::Client->value) {
            $this->ProcessUsers($role);
        }
        if ($role == UserRole::Courier->value) {
            $this->ProcessUsers($role);
        }
    }

    private function ProcessUsers($role){                               // fetching data according to user role
        $this->users = User::where('role', '=', (string)$role)->get();
        if($this->users != null){
            foreach($this->users as $user){
                array_push($this->users_id_list, $user->id);
            }
        }
    }

    public function GetUsers(){
        return $this->users;
    }

    public function GetIdList(){
        return $this->users_id_list;
    }
}
