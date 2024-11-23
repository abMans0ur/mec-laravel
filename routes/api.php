<?php

use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return response()->json($request->user());
})->middleware('auth:sanctum');

// Route::post('/tokens/create', function (Request $request) {
//     dd($request);
//     $token = $request->user()->createToken($request->token_name);

//     return ['token' => $token->plainTextToken];
// });

Route::post('register',[UserController::class,'store']);
Route::post('login', [UserController::class, 'login']);


Route::prefix('v1/client')->middleware('auth:sanctum')->group(
    function () {
        // Route::get('products',[ProductController::class,'index']);
        Route::apiResource('products',ProductController::class);
    }
);