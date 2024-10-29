<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerifyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('token');
        $result = JWTToken::verifyToken($token);
        if($result=== 'Unauthorized'){
            return response()->json([
                'status'=>'Failed',
                'Message'=>'Unauthorized'
            ],401);
        }else {
            $request->headers->set('email',$result);
            return $next($request);
        }

       
    }
}
