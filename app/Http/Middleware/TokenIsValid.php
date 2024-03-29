<?php

namespace App\Http\Middleware;

use App\Models\Device;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TokenIsValid
{
    public function handle(Request $request, Closure $next)
    {
        // toDo check user, account and token
        $validator = Validator::make($request->all(), ['unique_info' => 'required']);
        if ($validator->fails())
            return  response()->error(401,"The authentication information used is incorrect", $validator->messages()->getMessages());


        $dev = Device::where('unique_info', $request->unique_info)->first();
        if ($dev && Hash::check($request->header(Config::get('app.token_header_name')), $dev->token_hash))
            return $next($request);
        return  response()->error(401,"The authentication information used is incorrect");
    }
}
