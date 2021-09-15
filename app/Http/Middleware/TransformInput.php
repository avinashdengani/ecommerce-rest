<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        $response = $next($request);

        if(isset($response->exception) && $response->exception instanceof ValidationException) {

            $data = $response->getData();
            $transformedErrors = [];
            foreach( $data->error as $key => $value) {
                $transformedKey = $transformer::getTransformedAttribute($key);

                $transformedErrors[$transformedKey] = str_replace($key, $transformedKey, $value);
            }
            $data->error = $transformedErrors;

            $response->setData($data);
        }

        return $response;
    }
}
