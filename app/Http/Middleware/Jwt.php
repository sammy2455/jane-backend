<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Jwt
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (empty($user)) {
                throw new HttpResponseException(response()->json([
                    'success' => false,
                    "message" => "Unauthorized"
                ], 401));
            }

        } catch (TokenExpiredException $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                "message" => "Token Expired"
            ], 401));
        } catch (TokenInvalidException $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                "message" => "Token Invalid"
            ], 401));
        } catch (JWTException $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                "message" => "Token Absent"
            ], 401));
        } catch (Exception $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                "message" => $e->getMessage()
            ], 500));
        }

        return $next($request);
    }
}
