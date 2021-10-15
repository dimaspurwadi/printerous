<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Helpers\JwtHelper;

class JwtMiddleware extends JwtHelper
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
        $token = $request->bearerToken();
        
        try {
            $token = $this->getTokenDecode($token);
        } catch (Exception $e) {
            if ($e instanceof \Firebase\JWT\SignatureInvalidException){
                return response()->json([
                    'status' => false,
                    'message' => 'Token is Invalid',
                    'data' => []
                ], 400);
            }else if ($e instanceof \Firebase\JWT\ExpiredException){
                return response()->json([
                    'status' => false,
                    'message' => 'Token is Expired',
                    'data' => []
                ], 400);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Authorization Token Not Found',
                    'data' => []
                ], 400);
            }
        }

        return $next($request);
    }
}