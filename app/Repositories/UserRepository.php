<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface {


    public function createUser($user_details)
    {
        $user_details['password'] = Hash::make($user_details['password']);
        return User::create($user_details);
    } 
}





