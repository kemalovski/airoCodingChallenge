<?php

namespace App\Http\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UserStoreRequest;
use App\Http\Response\Response as ApiResponse;


class UserController extends Controller
{
    public function register(UserStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
        	'email' => $request->email,
        	'password' => bcrypt($request->password)
        ])->getAttributes();
        
        return response()->json([
            (new ApiResponse(true, "User created successfully", $user))
        ], Response::HTTP_CREATED);
    	
    }
    
}
