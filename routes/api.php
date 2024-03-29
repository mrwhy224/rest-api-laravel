<?php

use App\Http\Middleware\TokenIsValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::any('/v1/get_token', [\App\Http\Controllers\api\v1\UserController::class, 'login']);
Route::group(['prefix'=>'v1', 'namespace'=>'App\Http\Controllers\api\v1', 'middleware' => ['App\Http\Middleware\TokenIsValid', 'App\Http\Middleware\RequestLogger']], function () {
    Route::get('/account', [\App\Http\Controllers\api\v1\AccountController::class, 'index']);
    Route::any('/account/store', [\App\Http\Controllers\api\v1\AccountController::class, 'store']);
});
