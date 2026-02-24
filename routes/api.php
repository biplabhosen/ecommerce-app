<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are typically stateless. Here we register an endpoint to
| return the authenticated user when the request is authorized using the
| Passport `auth:api` guard (Authorization Code Grant).
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return response()->json($request->user());
});
