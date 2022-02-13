<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Response\Response as ApiResponse;
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
