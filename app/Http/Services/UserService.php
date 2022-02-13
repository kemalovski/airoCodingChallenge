<?php

namespace App\Http\Services;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Response\Response as ApiResponse;

class UserService
{

    public function getToken($request){

        $credentials = $request->only('email', 'password');
        try {
            if (! $token['token'] = JWTAuth::attempt($credentials)) {
                $response = (new ApiResponse(false, "Login credentials are invalid.", $token));
                return response()->json(
                	$response
                , Response::HTTP_OK);
            }
        } catch (JWTException $e) {
            
            throw new HttpResponseException(
                response()->json(
                	(new ApiResponse(false, $e->getMessage()))
                , Response::HTTP_NOT_FOUND)
            );
        }
        
        $response = (new ApiResponse(true, "Token created successfully.", $token));
        
        return response()->json(
            $response
        , Response::HTTP_OK);
    }
}
