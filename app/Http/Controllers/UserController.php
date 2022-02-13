<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Services\UserService;


class UserController extends Controller
{
    public function register(UserStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
        	'email' => $request->email,
        	'password' => bcrypt($request->password)
        ])->getAttributes();
        
        return (new UserService())->getToken($request);
    	
    }

}
