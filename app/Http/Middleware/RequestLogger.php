<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class RequestLogger
{

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $log = [
            'TOKEN' =>$request->header(Config::get('app.token_header_name')),
            'URI' => sprintf('%s [%s]', $request->getRequestUri(), $request->getMethod()),
            'BODY' => $request->all(),
            'RESPONSE' => $response->getContent()
        ];

        $dev = DB::table('devices')->where('token_hash', $request->header(Config::get('app.token_header_name')))
            ->join('users', 'users.id', '=', 'devices.user_id')
            ->join('accounts', 'accounts.id', '=', 'users.account_id')
            ->select( 'devices.id as device', 'accounts.id as account')
            ->first();

        DB::table('request_logs')->insert([
            'account_id' => $dev->account,
            'device_id' => $dev->device,
            'log_data' => json_encode($log),
            'created_at'    => Carbon::now()
        ]);

        return $response;
    }
}
