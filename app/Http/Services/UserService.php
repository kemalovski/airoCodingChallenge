<?php

namespace App\Http\Services;

use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Response\Response as ApiResponse;

class UserService
{

    public function getToken($request){

        $credentials = $request->only('email', 'password');
        
        if (! $token['token'] = JWTAuth::attempt($credentials)) {
            $response = (new ApiResponse(false, "Login credentials are invalid.", $token));
            return response()->json(
                $response
            , Response::HTTP_UNAUTHORIZED);
        }
        
        $response = (new ApiResponse(true, "Token created successfully.", $token));
        
        return response()->json(
            $response
        , Response::HTTP_OK);
    }
}
