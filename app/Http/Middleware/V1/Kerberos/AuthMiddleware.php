<?php

namespace App\Http\Middleware\V1\Kerberos;

use App\Services\API\MuApiService;
use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Response;

/**
 * Class AuthMiddleware
 * @package App\Http\Middleware\V1\Kerberos
 */
class AuthMiddleware
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
        if (! isDevelop() && ! isTesting()) {
            if (! $request->headers->has('Authorization')) {
                throw new \Exception("Authorization key in headers not found.", Response::HTTP_UNAUTHORIZED);
            }

            [$schema, $token] = preg_split("/[\s,]+/", $request->header('Authorization'));

            if (! is_logged($token)) {
                throw new \Exception("Access Token is invalid or not logged.", Response::HTTP_UNAUTHORIZED);
            }

            $request->request->add(['user' => get_user($token)]);
        }

        return $next($request);
    }
}
