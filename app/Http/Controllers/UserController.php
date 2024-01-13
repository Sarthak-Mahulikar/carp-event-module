<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    private UserRepositoryInterface $userRepository;

    public function  __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository=$userRepository;
    }

    public function addUser(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users,email',
            'password'=>'required|string'
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        $data=$validator->validated();
        $user=$this->userRepository->createUser($data);

        return new UserResource($user);


    }



}
