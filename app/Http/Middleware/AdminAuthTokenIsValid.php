<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Traits\ResponseTrait;

class AdminAuthTokenIsValid
{
    use ResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = JWTAuth::user();
        if ($user && $user->login_type === 'admin') {
            return $next($request);
        }

        return $this->responseError(
            __('string.response.token.fail'),
            null,
            401
        );
    }
}
