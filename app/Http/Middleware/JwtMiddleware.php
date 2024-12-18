<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use App\Http\Response\Response as ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(
                    (new ApiResponse(false, "Token is Invalid"))
                , Response::HTTP_UNAUTHORIZED);
                
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(
                    (new ApiResponse(false, "Token is Invalid"))
                , Response::HTTP_UNAUTHORIZED);
            }else{
                return response()->json(
                    (new ApiResponse(false, "Token is Invalid"))
                , Response::HTTP_UNAUTHORIZED);
            }
        }
        return $next($request);
    }
}