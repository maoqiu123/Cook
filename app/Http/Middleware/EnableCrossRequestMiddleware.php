<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class EnableCrossRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if ($response instanceof BinaryFileResponse) {
            return $response;
        }
        $response->headers->add(['Access-Control-Allow-Origin' => '*']);
        $response->headers->add(['Access-Control-Allow-Headers' => 'Origin, Content-Type, Cookie,X-CSRF-TOKEN, Accept,Authorization']);
        $response->headers->add(['Access-Control-Expose-Headers' => 'Authorization,authenticated']);
        $response->headers->add(['Access-Control-Allow-Methods' => 'GET, POST, PATCH, PUT, OPTIONS']);
        $response->headers->add(['Access-Control-Allow-Credentials' => 'true']);

        return $response;
    }
}