<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Exception;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        {try {
            $user = JWTAuth::parseToken()->authenticate();
            return $next($request);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'Token is Invalid'], Response::HTTP_UNAUTHORIZED);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'Token is Expired'], Response::HTTP_UNAUTHORIZED);
        } catch (Exception $e) {
            return response()->json(['status' => 'Authorization Token not found'], Response::HTTP_UNAUTHORIZED);
        }
    }
}
}
