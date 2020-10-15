<?php

namespace App\Http\Middleware\V1\Kerberos;

use Closure;
use Illuminate\Http\Response;

/**
 * Class TicketsMiddleware
 * @package App\Http\Middleware\V1\Kerberos
 */
class TicketsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $ticket)
    {
        if (! isDevelop() && ! isTesting()) {
            if (! allowed($request->user['username'], $ticket)) {
                return response()->json([
                    'message' => showText('messages.status', Response::HTTP_FORBIDDEN)
                ], Response::HTTP_FORBIDDEN);
            }
        }

        return $next($request);
    }
}
