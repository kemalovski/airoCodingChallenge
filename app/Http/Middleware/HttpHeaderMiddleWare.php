<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Response\Response as ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class HttpHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $bearerRegexPattern = '/^([a-zA-Z0-9_=]+)\.([a-zA-Z0-9_=]+)\.([a-zA-Z0-9_\-\+\/=]*)/';
        
        $jwtToken = explode(" ", $request->header('Authorization'));
        
        if(
            $request->header('Content-Type')== "application/json" 
            && isset($jwtToken[1])
            && preg_match($bearerRegexPattern, $jwtToken[1])
            && $jwtToken[0] == "Bearer"
            ){
                return $next($request);
        }
        
        return response()->json([
            (new ApiResponse(false, "You must add Http Header; Content-Type application/json,  Authorization Bearer <JWT Token>"))
        ], Response::HTTP_OK);
        
    }
}
