<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class CacheMiddleware
{
    public function handle(Request $request, Closure $next, $ttl = 3600)
    {
        $url = $request->url();

        if ("no-cache" === $request->header("Cache-Control")) {
            Cache::forget($url);
        }

        // Para não cachear o erro uma exceção deve ser lançada do controler
        return Cache::remember($url, $ttl, function () use ($request, $next) {
            return $next($request);
        });
    }
}