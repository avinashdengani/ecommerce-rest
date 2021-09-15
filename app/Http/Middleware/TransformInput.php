<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TransformInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $transformer)
    {
        $transformInput = [''];
        foreach( $request->all() as $key => $value) {
            $transformInput[$transformer::getOriginalAttribute($key)] = $value;
        }
        $request->replace($transformInput);
        return $next($request);
    }
}
