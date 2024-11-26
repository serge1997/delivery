<?php

namespace App\Http\Middleware;

use App\Traits\HttpResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCustomerMiddleware
{
    use HttpResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()->tokenCan('role:customer')){
            return response()
                ->json($this->errorResponse('Not Authorized'), 401);
        }
        return $next($request);
    }
}
