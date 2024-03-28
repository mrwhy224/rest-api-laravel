<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenIsValid
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
       // return response()->success('valid', $request);
    }
}
