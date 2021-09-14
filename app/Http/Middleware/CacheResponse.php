<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $url = request()->url();
        $queryParameters = request()->query();
        $method = request()->getMethod();
        ksort($queryParameters);

        $queryString = http_build_query($queryParameters);
        $fullUrl = "$method:{$url}?{$queryString}";

        if(Cache::has($fullUrl)) {
            return Cache::get($fullUrl);
        }
        return $next($request);
    }
}
