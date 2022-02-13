<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserAuthenticateRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
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

    public function authenticate(UserAuthenticateRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token['token'] = JWTAuth::attempt($credentials)) {
                $response = (new ApiResponse(false, "Login credentials are invalid.", $token));
                return response()->json([
                	$response
                ], Response::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            
            throw new HttpResponseException(
                response()->json([
                	(new ApiResponse(false, $e->getMessage()))
                ], Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }
        
        $response = (new ApiResponse(true, "Token created successfully.", $token));
        
        return response()->json([
            $response
        ], Response::HTTP_OK);
 		
    }
    
}
