<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\http\middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;
//use JWTAuth;

class ProtectedByToken extends BaseMiddleware
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
            try{
                $user = JWTAuth::parseToken()->authenticate();
            }
                catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                    response()->json([
                        'status' => 'error',
                        'message' => 'Token expirou'
                    ], $e->getStatusCode());
            
                } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            
                    response()->json([
                        'status' => 'error',
                        'message' => 'Token é invalido'
                    ], $e->getStatusCode());
            
                } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            
                    response()->json([
                        'status' => 'error',
                        'message' => 'Token nao informado'
                    ], $e->getStatusCode());
        
        
                }
            return $next($request);
    }
}
