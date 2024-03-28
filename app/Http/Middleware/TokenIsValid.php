<?php

namespace App\Http\Middleware;

use App\Models\Device;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class TokenIsValid
{
    public function handle(Request $request, Closure $next)
    {
        // toDo check user, account and token

        if(Device::where('token_hash', $request->header(Config::get('app.token_header_name')))->count()==1)
            return $next($request);
        return  response()->error(401,"token is invalid", ["token is invalid"]);
    }
}
