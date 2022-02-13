<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Services\UserService;


class UserController extends Controller
{
    public function register(UserStoreRequest $request)
    {
        User::create([
            'name' => $request->name,
        	'email' => $request->email,
        	'password' => bcrypt($request->password)
        ]);
        
        return (new UserService())->getToken($request);
    	
    }

}
