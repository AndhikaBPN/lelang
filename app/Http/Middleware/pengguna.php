<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;

class pengguna
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
        $token = JWTAuth::parseToken()->getPayload();

        if($token->get('role') == 'pengguna'){
            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (Exception $e) {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){ 
                    return response()->json(['status' => 'Token is Invalid']); 
                }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){ 
                    return response()->json(['status' => 'Token is Expired']); 
                }else{ 
                    return response()->json(['status' => 'Authorization Token not found']); 
                }
            }
            return $next($request);
        }else{
            return response()->json(['data'=>[
                "message" => 'Anda tidak memiliki akses'
            ]], 403);
        }
    }
}
